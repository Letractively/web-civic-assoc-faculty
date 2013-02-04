<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* Row
* 
* Trieda popisuje jeden riadok/zaznam gridu. Obsahuje bunky riadka, atributy či je viditeľný, editovateľný, mazateľný.
* 
*/
class Row
{
	public $cells = array(); // bunky riadka [stlpec_index] = 'hodnota_bunky'
	public $visible = true;
	public $editable = true;
	public $removable = true;
}

/*
* Component
* 
* Trieda popisuje typ komponentu pre daný stĺpec. Tento komponent sa zobrazí na danom stĺpci a konkrétnom riadku pri pridávaní alebo editovaní záznamu.
* 
*/
class Component
{
	public $type = 'textbox'; // textbox, combobox
	public $data = array(); // doplnujuce data, nemaju pevnu strukturu, zavisle od kontretneho komponentu
	
	/*
	* bind
	* 
	* Metóda binduje dáta pre combobox. Tieto dáta sa potom zobrazia v comboboxe na výber pri pridávaní alebo editovaní.
	* 
        * @access	public
	* @param datasource Dvojrozmerné pole dát vo formáte array of object alebo array of array. V prípade array of array musí mať pole nižšej úrovne indexy ako string, ktoré zároveň definujú kľúče pre combobox.
	* @param id V ktorom stĺpci/atribúte objektu sa nachádza id-čko, ktoré sa použije ako identifikátor vybraného záznamu v comboboxe.
	* @param value V ktorom stĺpci/atribúte objektu sa nachádza hodnota, ktorá sa zobrazuje reálne v comboboxe.
	*/
	public function bind($datasource, $id, $value)
	{
		foreach ($datasource as $data_row)
		{
			if (is_object($data_row))
				$data_row = get_object_vars($data_row);
			$item['id'] = $data_row[$id];
			$item['value'] = $data_row[$value];
			$this->data[] = $item;
		}
	}
}

/*
* Col
* 
* Trieda popisuje stĺpec gridu. Popisuje jeho vlastnosti a správanie sa pri jednotlivých operáciach. Umožňuje zobraziť dáta ako text, datetime alebo link, prípadne je možné označiť stĺpec ako neviditeľný alebo needitovateľný. DateTime je mozne formatovat.
*/
class Col
{
	public $type; // co sa ma spachat alebo ako sa ma zobrazit text podliehajuci tomuto stlpcu (text, anchor, datetime, numformat)
	public $options; // podrobnejsie nastavenia typu zobrazenia (napr. anchor ma url, datetime ma formatting string, ...)
	public $text; // string, ktory sa zobrazuje v hlavicke stlpca (tento text sa neodosiela do formulara, tam ide id-cko)
	public $editable = true;
	public $visible = true;
	public $component; // atributy pre komponent: Component
	
	/*
	* contructor
	* 
	* Vytvára stĺpec gridu a inicializuje ho na predvolené nastavenia.
	* 
        * @access	public
	* @param text Text, ktorý sa zobrazuje v hlavičke stĺpca.
	*/
	public function __construct($text)
	{
		$this->text = $text;
		$this->component = new Component();
		$this->type = 'text';
		$this->options = null;
	}
	
	/*
	* set_anchor
	* 
	* Metóda nastavuje, aby sa dáta v tomto stĺpci zobrazili ako link na controller.
	* 
        * @access	public
	* @param controller Názov controlleru, na ktorý má link odkazovať.
	* @param id Názov stĺpca, ktorý obsahuje id-čko - id-čko z tohto stĺpca sa pripisuje ku controlleru, aby bolo možné ďalej identifikovať kliknutý záznam.
	*/
	public function set_anchor($controller, $id)
	{
		$this->type = 'anchor';
		$this->options['controller'] = $controller;
		$this->options['id'] = $id;
	}
	
	/*
	* set_datetime
	* 
	* Metóda nastavuje formátovanie dátumu. V prípade, že text nezodpovedá dátumu, nezobrazí sa nič.
	*
        * @access	public
	* @param inputFormat Formátovací reťazec, podľa ktorého sa parsuje string na vytvorenie štruktúry datetime.
	* @param outputFormat Formátovací reťazec, podľa ktorého sa formátuje čas a dátum na výstupe.
	*
	* @link Bližšie informácie o formátovacích značkách na http://php.net/manual/en/function.date.php @endlink
	*/
	public function set_datetime($inputFormat = "Y-m-d H:i:s", $outputFormat = "d.m.Y")
	{
		$this->type = 'datetime';
		$this->options['inputFormat'] = $inputFormat;
		$this->options['outputFormat'] = $outputFormat;
	}
	
	/*
	* set_format
	* 
	* Metóda nastavuje formátovanie čísla. V prípade nevalidného formátovacieho reťazca na pri display zobrazí varovanie.
	*
        * @access	public
	* @param format Formátovací reťazec, podľa ktorého sa formátuje číslo.
	*
	* @code
	*	Syntax: set_numformat( {<desatinnych_miest>:<desatinna_bodka>:<separator_tisiciek>} )
	*	Default: desatinnych_miest = 0	desatinna_bodka = ","	separator_tisiciek = ""
	*
	*	Number: 12345.6789
	*
	*	set_numformat('Suma {2:.: } EUR')	--> Suma 12 345.68 EUR
	*	set_numformat('Suma {2:.:} EUR')	--> Suma 12345.68 EUR
	*	set_numformat('Suma {2:.} EUR')		--> Suma 12345.68 EUR
	*	set_numformat('Suma {2:: } EUR')	--> Suma 12 345,68 EUR
	*	set_numformat('Suma {2:} EUR')		--> Suma 12345,68 EUR
	*	set_numformat('Suma {2} EUR')		--> Suma 12345,68 EUR
	*	set_numformat('Suma {:: } EUR')		--> Suma 12 346 EUR
	*	set_numformat('Suma {} EUR')		--> Suma 12346 EUR
	*	set_numformat('Suma EUR')			--> Suma EUR
	*	set_numformat('{}')					--> 12346
	* @endcode
	*/
	public function set_numformat($format)
	{
		$this->type = 'numformat';
		$this->options['format'] = $format;
	}
}

/*
* Grid
* 
* Trieda zapúzdruje celý komponent grid. Cez túto triedu sa grid nastavuje, napĺňa dátami a zobrazuje.
*/
class Grid
{
	private $unique = ""; // ktorý stĺpec obsahuje id-čka záznamov
	private $headCols = array(); // jednotlivé stĺpce: array of Col
	private $rows = array(); // zoznam záznamov: array of Row
	public $add_url = ""; // controller na add
	public $add_mode = "internal"; // ktorý formulár sa použije na pridanie, či ten v gride alebo vlastný
	public $edit_url = "";
	public $edit_mode = "internal";
	public $remove_url = ""; // controller na mazanie, existuje len externý

	/*
	 * bind
	 * 
	 * Metóda napĺňa grid dátami.
	 * 
         * @access	public
	 * @param table Dvojrozmerné pole dát vo formáte array of object alebo array of array. V prípade array of array musí mať pole nižšej úrovne indexy ako string, ktoré zároveň definujú názvy stĺpcov gridu.
	 * @param unique_key Názov stĺpca, ktorý obsahuje IDčko záznamu.
	 */
	public function bind($table, $unique_key) // ocakava array of object alebo array of array alebo CI_DB_mysql_result
	{	
		if (gettype($table) == 'object') // ci je datasource objekt
		{
			if (get_class($table) == 'CI_DB_mysql_result') // ak je objekt, ci je takeho typu aky potrebujem
			{
				if (count($table->result()) == 0) // ak vysledok z db neobsahuje ziaden zaznam
				{
					foreach ($table->list_fields() as $col) // prejdi nazvy stlpcov a nabinduj ich na grid
						$this->headCols[$col] = new Col($col);
					$this->unique = $unique_key;
					return true; // bind sa podaril
				}
				else // ak vysledok z db obsahuje nejake zaznamy
					$table = $table->result(); // vytiahni z objektu array zaznamov a pokracuj normalne dalej
			}
			else return false; // ak je objekt zleho typu
		}
		
		if (gettype($table) == 'array')
		{
			if (count($table) == 0) return false; // ak neprisiel ziaden zaznam, da ende
			$this->unique = $unique_key;
			
			// ---------- bindovanie stlpcov ----------
			// bindovanie prebieha tak, ze ci vycucne prvy riadok zaznamu a z neho povytahuje nie hodnoty, ale indexy ala nazvy stlpcov
			if (is_object($table[0])) // ak su zaznamy objekty --> prerob na array a vycucni riadok
				$row = get_object_vars($table[0]);
			else // ak nie, iba vycucni riadok
				$row = $table[0];
			foreach ($row as $key => $value) // nahadz nazvy stlpcov hlavicky gridu
				$this->headCols[$key] = new Col($key);
			
			// ---------- bindovanie záznamov ----------
			foreach ($table as $table_row) // pre vsetky zaznamy
			{
				$row = new Row; // vytvori novy riadok
				if (is_object($table_row)) // prerobi objekt na array
					$table_row = get_object_vars($table_row);
				foreach($table_row as $key => $value) // pre vsetky hodnoty v riadku
					$row->cells[$key] = $value; // uklada hodnoty pod kluc (nazov stlpca)
				$this->rows[$table_row[$unique_key]] = $row; // riadok ulozi pod index, ktory je v stlpci id-čiek (kvoli idenitifikacii zaznamu cez id-cko)
			}
			
			return true;
		}
		else return false;
	}

	/*
	 * header
	 * 
	 * Metóda vracia atribúty vybraného stĺpca gridu.
	 *
         * @access	public
	 * @param head_id Názov stĺpca.
	 *
	 * @return Objekt ktorý obsahuje atribúty stĺpca. Ak neexistuje, vracia null.
	 */
	public function header($head_id)
	{
		return $this->headCols[$head_id];
	}
	
	/*
	 * row
	 * 
	 * Metóda vracia atribúty vybraného riadka gridu.
	 *
         * @access	public
	 * @param unique_key IDčko záznamu.
	 *
	 * @return Objekt ktorý obsahuje atribúty riadku. Ak neexistuje, vracia null.
	 */
        public function row($unique_key)
	{
		return $this->rows[$unique_key];
	}
	
	/*
	 * all_cols_visible
	 * 
	 * Metóda nastaví príslušnú viditelnosť pre všetky stĺpce gridu.
	 *
         * @access	public
	 * @param state true/false.
	 */
	public function all_cols_visible($state)
	{
		foreach ($this->headCols as $col)
			$col->visible = $state;
	}
	
	/*
	 * genjs
	 * 
	 * Metóda je volaná automaticky metódou display(). Jej úlohou je vygenerovať javascript, ktorý grid používa na add a edit priamo v gride.
	 */
	private function genjs()
	{ ?>
	<script type="text/javascript" charset="UTF-8">
		var ids = [<?php // generuje zoznam id-ciek pre js
			$first = true;
			foreach ($this->rows as $row)
			{
				if ($first == false) echo ',';
				echo $row->cells[$this->unique];
				$first = false;
			}
		?>];
		
		var cols = new Array(); // generuje pre js informaciu o komponente na danych stlpcoch
		<?php
			foreach ($this->headCols as $index => $col)
			{
				if ($col->visible)
				{
					if($col->editable)
						echo 'cols["'.$index.'"] = "'.$col->component->type.'";'."\n";
					else
						echo 'cols["'.$index.'"] = ""'."\n"; // ak nie je editovatelny, hodi pre dany stlpec prazdny string
				}
			}
		?>
		
		var cells = new Array(); // generuje pre js informaciu o komponente na danych stlpcoch
		<?php
			echo 'cells["0"] = new Array();'."\n";
			foreach ($this->headCols as $index => $col)
				echo 'cells["0"]["'.$index.'"] = "";'."\n";
			foreach ($this->rows as $row)
			{
				echo 'cells["'.$row->cells[$this->unique].'"] = new Array();'."\n";
				foreach ($row->cells as $index => $value)
					echo 'cells["'.$row->cells[$this->unique].'"]["'.$index.'"] = "'.$value.'";'."\n";
			}
		?>
		
		var combobox_dataSources = new Array(); // generuje pre js zdroje dat pre comboboxove stlpce
		// toto pole sa indexuje id-ckami kontretnych stlpcov
		// na danom indexe je pole typu [id,value]
		<?php
			foreach ($this->headCols as $index => $col)
			{
				if ($col->visible && $col->editable && $col->component->type == 'combobox') // ak je vidielny, editovatelny a je combobox
				{
					echo 'combobox_dataSources["'.$index.'"] = ['."\n";
					$first = true;
					foreach ($col->component->data as $item)
					{
						if ($first == false) echo ','."\n";
						echo '['.$item['id'].',"'.$item['value'].'"]';
						$first = false;
					}
					echo "\n".'];'."\n";
				}
			}
		?>
		
		var addURL = "<?=$this->add_url?>"; // pre js controllery, tie musi js dat ako do anchorov
		var editURL = "<?=$this->edit_url?>";
		
		// name - toto sa nastavi ako hodnota atributu name v input elemente
		// id - id elementu, do ktoreho sa ma pichut textbox
		function changeToTextbox(name, id)
		{
			var elem = document.getElementById(name+id);
			var old_val = cells[id][name];
			elem.innerHTML = '';
			var textbox = document.createElement('input');
			textbox.setAttribute('type','text');
			textbox.setAttribute('value',old_val);
			textbox.setAttribute('name',name);
			textbox.setAttribute('class','grid_form_elem');
			elem.appendChild(textbox);
		}
		
		// name - toto sa nastavi ako hodnota atributu name v input elemente
		// id - id elementu, do ktoreho sa ma pichut combobox
		// dataSource - pole elementov na selekt do comboboxu, typu [id,value]
		function changeToCombobox(name, id, dataSource)
		{
			var elem = document.getElementById(id);
			var old_val = elem.innerHTML;
			elem.innerHTML = '';
			var combobox = document.createElement('select');
			for (var i = 0; i < dataSource.length; ++i)
			{
				var option = document.createElement('option');
				option.setAttribute('value',dataSource[i][0]);
				if (old_val == dataSource[i][1])
					option.setAttribute('selected','selected');
				option.innerHTML = dataSource[i][1];
				combobox.appendChild(option);
			}
			combobox.setAttribute('name',name);
			combobox.setAttribute('class','grid_form_elem');
			elem.appendChild(combobox);
		}
		
		function removeElement(elem_id)
		{
			var elem = document.getElementById(elem_id);
			if (elem) elem.parentNode.removeChild(elem);
		}
		
		// vyhodi z html vsetky buttony (add,edit,delete)
		function removeAllButtons()
		{
			for (var i = 0; i < ids.length; ++i)
			{
				removeElement('edit'+ids[i]+'btn');
				removeElement('delete'+ids[i]+'btn');
			}
			removeElement('addbtn');
		}
		
		// vracia tlacitko z textom "text", ktore vracia cez formular hodnotu operation_"operation"
		function createConfirmButton(text, operation)
		{
			var new_confirm = document.createElement('button');
			new_confirm.setAttribute('type','submit');
			new_confirm.setAttribute('name','operation_'+operation);
			new_confirm.setAttribute('value','operation_'+operation);
			var new_img = document.createElement('img');
			new_img.setAttribute('src','<?=base_url()?>../assets/img/confirm.png');
			new_img.setAttribute('alt',text);
			new_confirm.appendChild(new_img);
			return new_confirm;
		}
		
		// vracia tlacitko zrusenia aktualneho edit/add
		function createCancelButton(text)
		{
			var new_cancel = document.createElement('div');
			new_cancel.setAttribute('onclick','document.location.reload(true);');
			var new_img = document.createElement('img');
			new_img.setAttribute('src','<?=base_url()?>../assets/img/cancel.png');
			new_img.setAttribute('alt',text);
			new_cancel.appendChild(new_img);
			return new_cancel;
		}
		
		function removeAllChildsIfExist(td_id)
		{
			var elem = document.getElementById(td_id);
			if ( elem.hasChildNodes() && (elem.firstChild.nodeName != '#text') )
			{
				var text = elem.firstChild.innerHTML;
				while ( elem.childNodes.length > 0 )
					elem.removeChild( elem.firstChild );   
				elem.innerHTML = text;
			}
		}
		
		// zmeni riadok so zadanym id na formular add alebo edit
		function changeToForm(id)
		{
			removeAllButtons();
			for (var col in cols)
			{
				if (cols[col] == 'textbox')
				{
					removeAllChildsIfExist(col+id);
					changeToTextbox(col, id);
				}
				else if (cols[col] == 'combobox')
				{
					removeAllChildsIfExist(col+id);
					changeToCombobox(col, col+id, combobox_dataSources[col]);
				}
				document.getElementById(col+id).setAttribute('class','grid_cell_editing');
			}

			var row = document.getElementById('row'+id);
			var td_confirm = document.createElement('td');
			td_confirm.setAttribute('class','grid_row_btn_cell');
			if (id == 0)
				td_confirm.appendChild( createConfirmButton('potvrď', 'add') );
			else
				td_confirm.appendChild( createConfirmButton('potvrď', 'edit') );
			var td_cancel = document.createElement('td');
			td_cancel.setAttribute('class','grid_row_btn_cell');
			td_cancel.appendChild( createCancelButton('zruš') );
			row.appendChild(td_confirm);
			row.appendChild(td_cancel);
			
			if (id == 0)
			{
				document.getElementById('row0').setAttribute('class','grid_row');
				document.getElementById('grid_form').setAttribute('action', addURL);
			}
			else
				document.getElementById('grid_form').setAttribute('action', editURL+'/'+id);
		}
	</script>
	<?php
	}
	
	private function get_formatted_number($format, $number)
	{
		$ERROR = "Neplatné formátovanie";
		
		$strBefore = '';
		$strAfter = '';
		$wasFormat = false;
		$inFormat = false;
		$buffer = '';
		$waitFor = 'decimal';
		
		$decimal = '';
		$decMark = '';
		$thousandMark = '';
		
		for ($i = 0; $i < strlen($format); ++$i)
		{
			$chr = $format[$i]; // ziska znak
			if (!$inFormat) // ak NIE je medzi {}, tj nie je vo formatovacej casti
			{
				if ($chr == '}')
					return $ERROR;
				else if ($chr == '{') // ak prave nacitany znak znamena zaciatok formatovacej casti
				{
					if ($wasFormat) return $ERROR; // ak uz raz bolo formatovanie, vrati error
					$inFormat = true; // nastavi ze je vnutri formatovacej casti
				}
				else // ak nacitany znak je odlisny od vrchnych
				{
					if ($wasFormat) $strAfter .= $chr;
					else $strBefore .= $chr;
				}
			}
			else // ak je medzi formatovacimi znackami, tj JE vo formatovacej casti
			{
				if ($chr == '{')
					return $ERROR;
				else if ($chr == '}') // ak prave nacitany znak znamena koniec formatovacej casti
				{
					$wasFormat = true; // nastavi ze bolo uz nejake formatovanie
					$inFormat = false; // nastavi ze uz dalej nie je vo formatovacej casti
				}
				else if ($chr == ':')
				{
					if ($waitFor == 'decimal') $waitFor = 'decMark';
					else if ($waitFor == 'decMark') $waitFor = 'thousandMark';
					else return $ERROR;
				}
				else if ($waitFor == 'decimal')
				{
					if (is_numeric($chr))
						$decimal .= $chr;
					else if ($chr == ' ');
					else return $ERROR;
				}
				else
				{
					if ($waitFor == 'decMark')
					{
						$decMark .= $chr;
					}
					else if ($waitFor == 'thousandMark')
					{
						$thousandMark .= $chr;
					}
					else return $ERROR;
				}
			}
		}
		if ($decimal == '') $decimal = 0;
		if ($decMark == '') $decMark = ',';
		
		return $strBefore.number_format($number, $decimal, $decMark, $thousandMark).$strAfter;
	}
	
	/*
	 * display
	 * 
	 * Metóda zobrazuje grid s vopred nastavenými atribútami.
	 *
         * @access	public
         * 
	 */
	public function display()
	{
		$this->genjs();
		
		echo '<form id="grid_form" action="" method="post">'."\n";
		echo '<table id="grid_table" border="0" class="grid_table">'."\n";
		
		// generuje hlavicku
		echo '<tr class="grid_header">'."\n";
		$i = 0;
		$last = -1;
		foreach ($this->headCols as $key => $head)
		{
			if ($this->headCols[$key]->visible == true) $last++;
		}
		foreach ($this->headCols as $key => $head)
		{
			if ($this->headCols[$key]->visible == true)
			{
				$css_class_postfix = '';
				if ($i == 0) $css_class_postfix = '_first';
				else if ($i == $last) $css_class_postfix = '_last';
				
				echo '<th class="grid_header_cell'.$css_class_postfix.'">'.$head->text.'</th>';
				$i++;
			}
		}
		echo '</tr>'."\n";
		
		// generuje jednotlive riadky
		foreach ($this->rows as $unique_key => $row)
		{
			if ($row->visible == true) // ak je dany riadok viditelny
			{
				echo '<tr id="row'.$unique_key.'" class="grid_row">'."\n";
				$i = 0;
				$last = -1;
				foreach ($row->cells as $index => $cell)
				{
					if ($this->headCols[$index]->visible == true) $last++;
				}
				foreach ($row->cells as $index => $cell) // generuje bunky riadka
				{
					$cell_value = ( ($cell != null) && ($cell != "") ) ? $cell : '&nbsp;';
					if ($this->headCols[$index]->visible == true) // ak bunka patri stlpcu, ktory je viditelny
					{
						$css_class_postfix = '';
						if ($i == 0) $css_class_postfix = '_first';
						else if ($i == $last) $css_class_postfix = '_last';
					
						echo '<td id="'.$index.$row->cells[$this->unique].'" class="grid_cell'.$css_class_postfix.'">';
						if ($this->headCols[$index]->type == 'anchor') // ak to ma byt link
						{
							$postfix_id = $row->cells[ $this->headCols[$index]->options['id'] ];
							if ($postfix_id != '')
								echo '<a href="'.base_url().$this->headCols[$index]->options['controller'].'/'.$postfix_id.'">'.$cell_value.'</a>';
							else
								echo $cell_value;
						}
						else if ($this->headCols[$index]->type == 'datetime') // ak to ma byt formatovany datum a cas
						{
							$date = date_create_from_format($this->headCols[$index]->options['inputFormat'], $cell_value);
							if ($date) echo $date->format($this->headCols[$index]->options['outputFormat']);
							else echo '&nbsp';
						}
						else if ($this->headCols[$index]->type == 'numformat')
						{
							if ($cell_value == '&nbsp;') $cell_value = '0';
							echo $this->get_formatted_number($this->headCols[$index]->options['format'], $cell_value);
						}
						else // ak to ma byt iba cisty text (alebo nejaky iny nedefinovany typ)
							echo $cell_value;
						echo '</td>'."\n";
						$i++;
					}
				}
				if ($this->edit_url != "" && $row->editable == true) // ak mame zadany controller na edit a dany riadok je editovatelny - zobrazi tlacitko edit
				{
					if ($this->edit_mode == "internal") // ak sa ma pouzit editacia v gride
						echo '<td id="edit'.$unique_key.'btn" class="grid_row_btn_cell"><img class="aaa" src="'.base_url().'../assets/img/edit.png" alt="edit" onclick="changeToForm('.$unique_key.')" /></td>';
					else if ($this->edit_mode == "external") // ak sa ma pouzit editacia na vlastnom forme
						echo '<td id="edit'.$unique_key.'btn" class="grid_row_btn_cell"><a href="'.base_url().$this->edit_url.'/'.$unique_key.'"><img src="'.base_url().'../assets/img/edit.png" alt="edit" /></a></td>';
				}
				if ($this->remove_url != "" && $row->removable == true) // ak mame zadany controller na delete a dany riadok je mazatelny - zobrazi tlacitko delete
					echo '<td id="delete'.$unique_key.'btn" class="grid_row_btn_cell"><a href="'.base_url().$this->remove_url.'/'.$unique_key.'"><img src="'.base_url().'../assets/img/delete.png" alt="delete" /></a></td>';
				echo '</tr>'."\n";
			}
		}
		
		if (count($this->headCols) != 0) // osetrenie, ak nemame nabindovanie ziade data, nevieme kam co jako pridat (nepozname stlpce tabulky), nezobrazime add button
		{
			if ($this->add_url != "") // ak mame zadany controller na add
			{
				// vygeneruje pridavaci riadok tak ci tak, len bude mat taky styl, aby neboli vidno jeho bunky
				echo '<tr id="row0">'."\n";
				foreach ($this->headCols as $index => $cell)
				{
					if ($this->headCols[$index]->visible == true)
						echo '<td id="'.$index.'0"></td>';
				}
				if ($this->add_mode == "internal")
					echo '<td id="addbtn" class="grid_row_btn_cell"><div onclick="changeToForm(0)"><img src="'.base_url().'../assets/img/add.png" alt="add" /></div></td>';
				else if ($this->add_mode == "external")
					echo '<td id="addbtn" class="grid_row_btn_cell"><a href="'.base_url().$this->add_url.'"><img src="'.base_url().'../assets/img/add.png" alt="add" /></a></td>';
				echo '</tr>'."\n";
			}
		}
		
		echo '</table>'."\n";
		echo '</form>'."\n";
	}
}