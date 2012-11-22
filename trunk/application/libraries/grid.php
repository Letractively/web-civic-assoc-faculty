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
}

class Col
{
	public $text;
	public $editable = true;
	public $visible = true;
	public $component;
	
	public function __construct($text)
	{
		$this->text = $text;
		$this->component = new Component();
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

	public function __construct()
	{
	}
	
	public function bind($table, $unique_key) // ocakava array of object alebo array of array
	{	
		if (count($table) == 0) return;
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
	}
	
	public function header($head_id)
	{
		return $this->headCols[$head_id];
	}
	
	public function row($unique_key)
	{
		return $this->rows[$unique_key];
	}
	
	public function genjs()
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
			var new_confirm = document.createElement('input');
			new_confirm.setAttribute('type','submit');
			new_confirm.setAttribute('name','operation_'+operation);
			new_confirm.setAttribute('value',text);
			return new_confirm;
		}
		
		function createCancelButton(text)
		{
			var new_cancel = document.createElement('span');
			new_cancel.setAttribute('onclick','document.location.reload(true);');
			new_cancel.innerHTML = text;
			return new_cancel;
		}
		
		function changeToForm(id)
		{
			removeAllButtons();
			for (var col in cols)
			{
				if (cols[col] == 'textbox')
					changeToTextbox(col, col+id);
				else if (cols[col] == 'combobox')
					changeToCombobox(col, col+id, combobox_dataSources[col]);
			}

			var row = document.getElementById('row'+id);
			var td_confirm = document.createElement('td');
			td_confirm.appendChild( createConfirmButton('potvrď', 'edit') );
			var td_cancel = document.createElement('td');
			td_cancel.appendChild( createCancelButton('zruš') );
			row.appendChild(td_confirm);
			row.appendChild(td_cancel);
			
			if (id == 0)
				document.getElementById('grid_form').setAttribute('action', addURL);
			else
				document.getElementById('grid_form').setAttribute('action', editURL+'/'+id);
		}
		
	</script>
	<?php
	}
	
	public function display()
	{
		$this->genjs();
		
		echo '<form id="grid_form" action="" method="get">'."\n";
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
						echo '<td id="'.$index.$row->cells[$this->unique].'" class="grid_cell">'.$cell.'</td>';
				}
				if ($this->edit_url != "" && $row->editable == true)
				{
					if ($this->edit_mode == "internal")
						echo '<td id="edit'.$unique_key.'btn" class="grid_row_btn_cell"><img class="aaa" src="../../assets/img/edit.png" alt="edit" onclick="changeToForm('.$unique_key.')" /></td>';
					else if ($this->edit_mode == "external")
						echo '<td id="edit'.$unique_key.'btn" class="grid_row_btn_cell"><a href="'.$this->edit_url.'/'.$unique_key.'"><img src="../../assets/img/edit.png" alt="edit" /></a></td>';
				}
				if ($this->remove_url != "" && $row->removable == true)
					echo '<td id="delete'.$unique_key.'btn" class="grid_row_btn_cell"><a href="'.$this->remove_url.'/'.$unique_key.'"><img src="../../assets/img/delete.png" alt="delete" /></a></td>';
				echo '</tr>'."\n";
			}
		}
		
		if ($this->add_url != "")
		{
			echo '<tr id="row0">'."\n";
			foreach ($row->cells as $index => $cell)
			{
				if ($this->headCols[$index]->visible == true)
					echo '<td id="'.$index.'0"></td>';
			}
			if ($this->add_mode == "internal")
				echo '<td id="addbtn" class="grid_row_btn_cell"><div onclick="changeToForm(0)"><img src="../../assets/img/add.png" alt="add" /></div></td>';
			else if ($this->add_mode == "external")
				echo '<td id="addbtn" class="grid_row_btn_cell"><a href="'.$this->add_url.'"><img src="../../assets/img/add.png" alt="add" /></a></td>';
			echo '</tr>'."\n";
		}
		
		echo '</table>'."\n";
		echo '</form>'."\n";
	}
}