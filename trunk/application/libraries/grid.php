<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Row
{
	public $cells = array();
	public $visible = true;
	public $editable = true;
	public $removable = true;
}

class Component
{
	public $type = 'textbox'; // textbox, combobox
	public $data = array();
	
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
	
	public function set_textbox()
	{
		$this->type = 'textbox';
	}
	
	public function set_combobox($datasource, $id, $value)
	{
		$this->type = 'combobox';
		$this->bind($datasource, $id, $value);
	}
}

class Col
{
	public $anchor;
	public $text;
	public $editable = true;
	public $visible = true;
	public $component;
	
	public function __construct($text)
	{
		$this->text = $text;
		$this->component = new Component();
		$this->anchor = null;
	}
	
	public function set_anchor($controller, $id)
	{
		$this->anchor['controller'] = $controller;
		$this->anchor['id'] = $id;
	}
}

class Grid
{
	private $unique = "";
	private $headCols = array();
	private $rows = array();
	public $add_url = "";
	public $add_mode = "internal";
	public $edit_url = "";
	public $edit_mode = "internal";
	public $remove_url = "";

	/*
	 * bind
	 * 
	 * Metóda napĺňa grid dátami.
	 * 
	 * @param table Dvojrozmerné pole dát vo formáte array of object alebo array of array. V prípade array of array musí mať pole nižšej úrovne indexy ako string, ktoré zároveň definujú názvy stĺpcov gridu.
	 * @param unique_key Názov stĺpca, ktorý obsahuje IDčko záznamu.
	 */
	public function bind($table, $unique_key) // ocakava array of object alebo array of array
	{	
		if (count($table) == 0) return false;
		$this->unique = $unique_key;
		
		if (is_object($table[0]))
			$row = get_object_vars($table[0]);
		else
			$row = $table[0];
		foreach ($row as $key => $value)
			$this->headCols[$key] = new Col($key);
		
		
		foreach ($table as $table_row)
		{
			$row = new Row;
			if (is_object($table_row))
				$table_row = get_object_vars($table_row);
			foreach($table_row as $key => $value)
				$row->cells[$key] = $value;
			$this->rows[$table_row[$unique_key]] = $row;
		}
		
		return true;
	}
	
	/*
	 * header
	 * 
	 * Metóda vracia atribúty vybraného stĺpca gridu.
	 *
	 * @param head_id Názov stĺpca.
	 *
	 * @return Objekt ktorý obsahuje atribúty stĺpca.
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
	 * @param unique_key IDčko záznamu.
	 *
	 * @return Objekt ktorý obsahuje atribúty riadku.
	 */
	public function row($unique_key)
	{
		return $this->rows[$unique_key];
	}
	
	private function genjs()
	{ ?>
	<script type="text/javascript" charset="UTF-8">
		var ids = [<?php
			$first = true;
			foreach ($this->rows as $row)
			{
				if ($first == false) echo ',';
				echo $row->cells[$this->unique];
				$first = false;
			}
		?>];
		
		var cols = new Array();
		<?php
			foreach ($this->headCols as $index => $col)
			{
				if ($col->visible)
				{
					if($col->editable)
						echo 'cols["'.$index.'"] = "'.$col->component->type.'";'."\n";
					else
						echo 'cols["'.$index.'"] = ""'."\n";
				}
			}
		?>
		
		var combobox_dataSources = new Array();
		<?php
			foreach ($this->headCols as $index => $col)
			{
				if ($col->visible && $col->editable && $col->component->type == 'combobox')
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
		
		var addURL = "<?=$this->add_url?>";
		var editURL = "<?=$this->edit_url?>";
		
		function changeToTextbox(name, id)
		{
			var elem = document.getElementById(id);
			var old_val = elem.innerHTML;
			elem.innerHTML = '';
			var textbox = document.createElement('input');
			textbox.setAttribute('type','text');
			textbox.setAttribute('value',old_val);
			textbox.setAttribute('name',name);
			textbox.setAttribute('class','grid_form_elem');
			elem.appendChild(textbox);
		}
		
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
		
		function removeAllButtons()
		{
			for (var i = 0; i < ids.length; ++i)
			{
				removeElement('edit'+ids[i]+'btn');
				removeElement('delete'+ids[i]+'btn');
			}
			removeElement('addbtn');
		}
		
		function createConfirmButton(text, operation)
		{
			var new_confirm = document.createElement('button');
			new_confirm.setAttribute('type','submit');
			new_confirm.setAttribute('name','operation_'+operation);
			new_confirm.setAttribute('value','operation_'+operation);
			var new_img = document.createElement('img');
			new_img.setAttribute('src','assets/img/confirm.png');
			new_img.setAttribute('alt',text);
			new_confirm.appendChild(new_img);
			return new_confirm;
		}
		
		function createCancelButton(text)
		{
			var new_cancel = document.createElement('div');
			new_cancel.setAttribute('onclick','document.location.reload(true);');
			var new_img = document.createElement('img');
			new_img.setAttribute('src','assets/img/cancel.png');
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
		
		function changeToForm(id)
		{
			removeAllButtons();
			for (var col in cols)
			{
				if (cols[col] == 'textbox')
				{
					removeAllChildsIfExist(col+id);
					changeToTextbox(col, col+id);
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
	
	/*
	 * display
	 * 
	 * Metóda zobrazuje grid s vopred nastavenými atribútami.
	 *
	 */
	public function display()
	{
		$this->genjs();
		
		echo '<form id="grid_form" action="" method="post">'."\n";
		echo '<table id="grid_table" border="0" class="grid_table">'."\n";
		
		echo '<tr class="grid_header">'."\n";
		foreach ($this->headCols as $key => $head)
		{
			if ($this->headCols[$key]->visible == true)
				echo '<th class="grid_header_cell">'.$head->text.'</th>';
		}
		echo '</tr>'."\n";
		
		foreach ($this->rows as $unique_key => $row)
		{
			if ($row->visible == true)
			{
				echo '<tr id="row'.$unique_key.'" class="grid_row">'."\n";
				foreach ($row->cells as $index => $cell)
				{
					if ($this->headCols[$index]->visible == true)
					{
						if ($this->headCols[$index]->anchor)
							echo '<td id="'.$index.$row->cells[$this->unique].'" class="grid_cell"><a href="'.$this->headCols[$index]->anchor['controller'].'/'.$row->cells[ $this->headCols[$index]->anchor['id'] ].'">'.$cell.'</a></td>';
						else
							echo '<td id="'.$index.$row->cells[$this->unique].'" class="grid_cell">'.$cell.'</td>';
					}
				}
				if ($this->edit_url != "" && $row->editable == true)
				{
					if ($this->edit_mode == "internal")
						echo '<td id="edit'.$unique_key.'btn" class="grid_row_btn_cell"><img class="aaa" src="assets/img/edit.png" alt="edit" onclick="changeToForm('.$unique_key.')" /></td>';
					else if ($this->edit_mode == "external")
						echo '<td id="edit'.$unique_key.'btn" class="grid_row_btn_cell"><a href="'.$this->edit_url.'/'.$unique_key.'"><img src="assets/img/edit.png" alt="edit" /></a></td>';
				}
				if ($this->remove_url != "" && $row->removable == true)
					echo '<td id="delete'.$unique_key.'btn" class="grid_row_btn_cell"><a href="'.$this->remove_url.'/'.$unique_key.'"><img src="assets/img/delete.png" alt="delete" /></a></td>';
				echo '</tr>'."\n";
			}
		}
		
		if (count($this->rows) != 0)
		if ($this->add_url != "")
		{
			echo '<tr id="row0">'."\n";
			foreach ($row->cells as $index => $cell)
			{
				if ($this->headCols[$index]->visible == true)
					echo '<td id="'.$index.'0"></td>';
			}
			if ($this->add_mode == "internal")
				echo '<td id="addbtn" class="grid_row_btn_cell"><div onclick="changeToForm(0)"><img src="assets/img/add.png" alt="add" /></div></td>';
			else if ($this->add_mode == "external")
				echo '<td id="addbtn" class="grid_row_btn_cell"><a href="'.$this->add_url.'"><img src="assets/img/add.png" alt="add" /></a></td>';
			echo '</tr>'."\n";
		}
		
		echo '</table>'."\n";
		echo '</form>'."\n";
	}
}