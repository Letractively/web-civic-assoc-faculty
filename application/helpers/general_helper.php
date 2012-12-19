<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * array_debug
 * 
 * Debugovacia funkcia, ktora sluzi na kontrolny vypis vysledku z DB, vrati formatovany vypis pola
 * 
 * @param arr Array of objects alebo string je vstupnym parametrom
 * @param return ak je true tak sa nic nevypise
 * @return array
 * 
 */
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

/*
 * gen_dropdown
 * 
 * Funkcia vygeneruje uhladne dropdown menu zo vstupneho pola, ktorym moze byt array of obejcts
 * alebo array of array
 * 
 * @param name name atribut pre form_dropdown
 * @param id_selected ID aktualne selektnutej polozky z menu
 * @param data vstupne pole udajov
 * @param id_index key v poli
 * @param value_index value ktora prislucha danemu key
 * @return form_dropdown menu
 *  
 *//*
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
}*/

function gen_dropdown($name, $id_selected, $data, $id_index, $value_index, $css_class = '')
{
	$options = array();
	
	foreach ($data as $val)
	{
		if (is_object($val))
			$val = get_object_vars($val);
		$options[$val[$id_index]] = $val[$value_index];
	}
	
	$css = 'class="'.$css_class.'"';
	if ($css_class != '')
		return form_dropdown($name, $options, $id_selected, $css);
	else return form_dropdown($name, $options, $id_selected);
}

function year($date){
    $input 		= explode(' ', $date);
    $date 		= explode('.', $input[0]);
    $output 	= "{$date[2]}";
    return $output;
}

function day_month($date){
    $input 		= explode(' ', $date);
    $date 		= explode('.', $input[0]);
    $output 	= "{$date[1]}.{$date[0]}";
    return $output;
}
/*
 * datetime
 * 
 * Funkcia vrati formatovany datum z datetime v tvare xx.xx.xxxx ak je druhy parameter TRUE tak vrati aj cas 
 * 
 * @param datetime datum vo formate xxxx-xx-xx
 * @param all ak je true vrati aj cas
 * @return string
 * 
 */
function datetime($datetime, $all = TRUE)
{
	$input 		= explode(' ', $datetime);
	$date 		= explode('-', $input[0]);
	$output 	= "{$date[2]}.{$date[1]}.{$date[0]}";
	
	if( $all )
		$output .= " {$input[1]}";
	
	return $output;
}

/*
 * time_withou_seconds
 * 
 * Funkcia vrati cas bez sekund
 * 
 * @param input datetime vo formate xxxx-xx-xx xx:xx:xx
 * @return string
 * 
 */
function time_withou_seconds($input)
{
    $time = explode(' ', $input);
    return substr($time[1], 0, strlen($time[1])-3);
}

/*
 * perex_from_content
 * 
 * Funkcia vrati cast textu zo vstupneho stringu
 * 
 * @param input vstupny retazec ktory ma byt skrateny na dlzky 165znakov
 * @return string
 * 
 */
function perex_from_content($input)
{
    return parse_bbcode(substr($input, 0, 165));
}

/*
 * format_date
 * 
 * Funkcia naformatuje datum z formatu xx.xx.xxxx na xxxx-xx-xx
 * 
 * @param input date vo formate xx.xx.xxxx
 * @return string
 * 
 */
function format_date($input)
{
    $date = explode('.', $input);
    return $date[2].'-'.$date[1].'-'.$date[0];
}