<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package        CodeIgniter
 * @author        Rick Ellis
 * @copyright    Copyright (c) 2006, EllisLab, Inc.
 * @license        http://www.codeignitor.com/user_guide/license.html
 * @link        http://www.codeigniter.com
 * @since        Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter bbCode Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Helpers
 * @author        Santoni Jean-André
 */

// ------------------------------------------------------------------------

/**
 * JS Insert bbCode
 *
 * Generates the javascrip function needed to insert bbcodes into a form field
 *
 * @access    public
 * @param    string    form name
 * @param    string    field name
 * @return    string
 */    

function js_insert_bbcode($form_name = '', $form_field = '')
{
    ?>
    <script type="text/javascript">
        function insert_bbcode(open, close)
        {
            var obsah = document.getElementById("textarea");
            
            var textObsah = open + obsah.value.substr(obsah.selectionStart, (obsah.selectionEnd - obsah.selectionStart)) + close;
                if (document.selection) 
                {
                    obsah.focus();
                    sel = document.selection.createRange();
                    sel.text = obsah;
                }
                //MOZILLA and others
                else if (obsah.selectionStart || obsah.selectionStart == '0') {
                    var startPos = obsah.selectionStart;
                    var endPos = obsah.selectionEnd;
                    obsah.value = obsah.value.substring(0, startPos)
                        + textObsah
                        + obsah.value.substring(endPos, obsah.value.length);
                } else {
                    obsah.value += open+close;
                }
        }
    </script> 
    <?php 
} 
 


// ------------------------------------------------------------------------

/**
 * Parse bbCode
 *
 * Takes a string as input and replace bbCode by (x)HTML tags
 *
 * @access    public
 * @param    string    the text to be parsed
 * @return    string
 */    
function parse_bbcode($str, $clear = 0, $bbcode_to_parse = NULL)
{
    if ( ! is_array($bbcode_to_parse))
    {
        if (FALSE === ($bbcode_to_parse = _get_bbcode_to_parse_array()))
        {
            return FALSE;
        }        
    }
    
    foreach ($bbcode_to_parse as $key => $val)
    {        
        for ($i = 1; $i <= $bbcode_to_parse[$key][2]; $i++) // loop for imbricated tags
        {
            $str = preg_replace($key, $bbcode_to_parse[$key][$clear], $str);
        }
    }

    return $str;
}

// ------------------------------------------------------------------------

/**
 * Clear bbCode
 *
 * Takes a string as input and remove bbCode tags
 *
 * @access    public
 * @param    string    the text to be parsed
 * @return    string
 */    
function clear_bbcode($str)
{
    return parse_bbcode($str, 1);
}

// ------------------------------------------------------------------------

/**
 * Get bbCode Buttons
 *
 * Returns an array of bbcode buttons that can be clicked to be inserted 
 * into a form field.  
 *
 * @access    public
 * @return    array
 */    

function get_bbcode_buttons($bbcode = NULL)
{
    if ( ! is_array($bbcode))
    {
        if (FALSE === ($bbcode = _get_bbcode_array()))
        {
            return $str;
        }        
    }

    foreach ($bbcode as $key => $val)
    {
        $button[] = '<input type="button" class="button" id="'.$key.'" name="'.$key.'" value="'.$key.'" onClick="'.$val.'" />';
    }
    
    return $button;
}

// ------------------------------------------------------------------------

/**
 * Get bbCode Array
 *
 * Fetches the config/bbcode.php file
 *
 * @access    private
 * @return    mixed
 */    
function _get_bbcode_array()
{
    if ( ! file_exists(APPPATH.'config/bbcode'.EXT))
    {
        return FALSE;
    }

    include(APPPATH.'config/bbcode'.EXT);

    if ( ! isset($bbcode) OR ! is_array($bbcode))
    {
        return FALSE;
    }
    
    return $bbcode;
}

// ------------------------------------------------------------------------

/**
 * Get bbCode Array for parsing
 *
 * Fetches the config/bbcode.php file
 *
 * @access    private
 * @return    mixed
 */    
function _get_bbcode_to_parse_array()
{
    if ( ! file_exists(APPPATH.'config/bbcode'.EXT))
    {
        return FALSE;
    }

    include(APPPATH.'config/bbcode'.EXT);
    
    if ( ! isset($bbcode_to_parse) OR ! is_array($bbcode_to_parse))
    {
        return FALSE;
    }
    
    return $bbcode_to_parse;
}

?> 