<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Row
{
	public $cells = array();
	public $visible = true;
	public $editable = true;
	public $removable = true;
}

class Col
{
	public $text;
	public $editable = true;
	public $visible = true;
	
	public function __construct($text)
	{
		$this->text = $text;
	}
}

class Grid
{
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
	
	public function bind($table, $unique_key) // ocakava array of object
	{
		if (count($table) == 0) return;
		
		$row = $table[0];
		foreach ($row as $key => $value)
			$this->headCols[$key] = new Col($key);
		
		foreach ($table as $table_row)
		{
			$row = new Row;
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
	
	public function display()
	{
		echo '<table id="grid" border="1">';
		
		echo '<tr>';
		foreach ($this->headCols as $key => $head)
		{
			if ($this->headCols[$key]->visible == true)
				echo '<th>'.$head->text.'</th>';
		}
		echo '</tr>';
		
		foreach ($this->rows as $unique_key => $row)
		{
			if ($row->visible == true)
			{
				echo '<tr id="row'.$unique_key.'">';
				foreach ($row->cells as $index => $cell)
				{
					if ($this->headCols[$index]->visible == true)
						echo '<td>'.$cell.'</td>';
				}
				if ($this->edit_url != "" && $row->editable == true)
				{
					if ($this->edit_mode == "internal")
					{
					}
					else if ($this->edit_mode == "external")
						echo '<td><a href="'.$this->edit_url.'/'.$unique_key.'">edit</a></td>';
				}
				if ($this->remove_url != "" && $row->removable == true)
					echo '<td><a href="'.$this->remove_url.'/'.$unique_key.'">remove</a></td>';
				echo '</tr>';
			}
		}
		
		echo '</table>';
		if ($this->add_url != "")
		{
			if ($this->add_mode == "internal")
			{
			}
			else if ($this->add_mode == "external")
				echo '<a href="'.$this->add_url.'">Add</a>';
		}
	}
}