<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    
    public function form_required( $input = array(), $value = ' error' )
    {    
    	if( is_array($input) )
    	{
    		foreach( $input as $item )
    		{					
    			$output[$item] = ( form_error($item) ) ? $value : '';
    		}
    		
    		return $output;
    	}
    }
}