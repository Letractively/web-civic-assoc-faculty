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