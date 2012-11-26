<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function gen_dropdown($name, $id_selected, $data, $id_index, $value_index)
{
	$options = array();
	
	foreach ($data as $val)
	{
		if (is_object($val))
			$val = get_object_vars($val);
		$options[$val[$id_index]] = $val[$value_index];
	}
	
	return form_dropdown($name, $options, $id_selected);
}