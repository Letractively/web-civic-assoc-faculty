<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Alumni FMFI
 * 
 * Aplikacia na spravu OZ Alumni FMFI
 *
 * @package		AlumniFMFI
 * @author		Tutifruty Team
 * @link		http://kempelen.ii.fmph.uniba.sk
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 *  General helper
 *
 * @package		AlumniFMFI
 * @subpackage          Helpers
 * @category            General
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


/**
 * array_debug
 * 
 * Debugovacia funkcia, ktora sluzi na kontrolny vypis vysledku z DB, vrati formatovany vypis pola
 * 
 * @access      public
 * @param       mixed $arr Array of objects alebo string je vstupnym parametrom
 * @param       boolean $return ak je true tak sa nic nevypise
 * @return      array
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

/**
 * gen_dropdown
 * 
 * Funkcia vygeneruje uhladne dropdown menu zo vstupneho pola, ktorym moze byt array of obejcts
 * alebo array of array
 * 
 * @param string $name name atribut pre form_dropdown
 * @param integer $id_selected ID aktualne selektnutej polozky z menu
 * @param array $data vstupne pole udajov
 * @param integer $id_index key v poli
 * @param integer $value_index value ktora prislucha danemu key
 * @param string $css_class n�zov class selektora pre css, defaultne sa nepou��va
 * @param string $attributes dodato�n� atrib�ty pre element, zad�vaju sa vo forme stringu formou 'atribut1="hodnota1", atribut2="hodnota2", ...'
 * @return array form_dropdown menu
 */
function gen_dropdown($name, $id_selected, $data, $id_index, $value_index, $css_class = '', $attributes = '')
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
	{
		if ($attributes == '')
			return form_dropdown($name, $options, $id_selected, $css);
		else
			return form_dropdown($name, $options, $id_selected, $css.' '.$attributes);
	}
	else return form_dropdown($name, $options, $id_selected, $attributes);
}

/**
 * year
 * 
 * Funkcia vrati iba ciselnu podobu roku
 * 
 * @param string $date datetime v tvare xx.xx.xxxx xx:xx:xx
 * @return string rok
 */
function year($date){
    $input 		= explode(' ', $date);
    $date 		= explode('.', $input[0]);
    $output 	= "{$date[2]}";
    return $output;
}

/**
 * day_month
 * 
 * Funkcia vrati iba ciselnu podobu dna a mesiaca
 * 
 * @param string $date datetime v tvare xx.xx.xxxx xx:xx:xx
 * @return string den a mesiac
 */
function day_month($date){
    $input 		= explode(' ', $date);
    $date 		= explode('.', $input[0]);
    $output 	= "{$date[0]}.{$date[1]}";
    return $output;
}

/**
 * datetime
 * 
 * Funkcia vrati formatovany datum z datetime v tvare xx.xx.xxxx ak je druhy parameter TRUE tak vrati aj cas 
 * 
 * @param string $datetime datum vo formate xxxx-xx-xx
 * @param boolean $all ak je true vrati aj cas
 * @return datetime
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

/**
 * time_withou_seconds
 * 
 * Funkcia vrati cas bez sekund
 * 
 * @param string $input datetime vo formate xxxx-xx-xx xx:xx:xx
 * @return string Cas bez sekund
 */
function time_withou_seconds($input)
{
    $time = explode(' ', $input);
    return substr($time[1], 0, strlen($time[1])-3);
}

/**
 * perex_from_content
 * 
 * Funkcia vrati cast textu zo vstupneho stringu
 * 
 * @param string $input vstupny retazec ktory ma byt skrateny na dlzky 165znakov
 * @return string 165znakovy uvodny text
 */
function perex_from_content($input)
{
    return parse_bbcode(substr($input, 0, 165));
}

/**
 * format_date
 * 
 * Funkcia naformatuje datum z formatu xx.xx.xxxx na xxxx-xx-xx
 * 
 * @param string $input date vo formate xx.xx.xxxx
 * @return string naformatovany datum
 */
function format_date($input)
{
    $date = explode('.', $input);
    return $date[2].'-'.$date[1].'-'.$date[0];
}

/**
 * format_datetime
 * 
 * Funkcia vrati naformatovanz datetime aky je standartny tvar pre databazu. Tj
 * xxxx-xx-xx xx:xx:xx
 * 
 * @param string $input slovensky datetime v tvare xx.xx.xxxx xx:xx
 * @return string naformatovany datetime
 */
function format_datetime($input)
{
    $dateAndTime = explode(' ', $input);
    $date = explode('.', $dateAndTime[0]);
    return $date[2].'-'.$date[1].'-'.$date[0].' '.$dateAndTime[1].':00';
}

/**
 * pagination
 * 
 * Funkcia vlozi url odkazy strankovania do wrapera, ktory ju obali a takyto obsah
 * vrati spat.
 * 
 * @param array $pagination url odkazy spolu so strong formatom
 * @return array strankovanie
 */
function pagination( $pagination )
{
	if( $pagination )
	{
		return '
		<div class="pager_right">
			' . $pagination . '
		</div>
		';
	}
	
	return FALSE;
}