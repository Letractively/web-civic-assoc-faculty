<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function array_debug($arr, $return = false)
{
    if ($return) 
    {
        if (is_string($arr)) 
            return '<pre>' . print_r(str_replace(array('<','>'), array('&lt;','&gt;'), $arr), true) . '</pre>';
        return '<pre>' . print_r($arr, true) . '</pre>';
    } 
    else 
    {
        echo '<pre>';
        if (is_string($arr)) 
            print_r(str_replace(array('<','>'), array('&lt;','&gt;'), $arr), false);
        else 
            print_r($arr, false);
        echo '</pre>';
    }
}

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

function datetime($datetime, $all = TRUE)
{
	$input 		= explode(' ', $datetime);
	$date 		= explode('-', $input[0]);
	$output 	= "{$date[2]}.{$date[1]}.{$date[0]}";
	
	if( $all )
		$output .= " {$input[1]}";
	
	return $output;
}

function time_withou_seconds($input)
{
    $time = explode(' ', $input);
    return substr($time[1], 0, strlen($time[1])-3);
}