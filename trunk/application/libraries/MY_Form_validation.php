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
 *  Form validation class
 *
 * @package		AlumniFMFI
 * @subpackage          Libraries
 * @category            Form Validation
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------

class MY_Form_validation extends CI_Form_validation 
{  
        /**
         * form_required
         * 
         * Funkcia skontroluje required polozky, ktore boli vyplnene. Vpripade ak
         * nebola dana polozka vyplnena vo formulari tak v poli error ostane jej
         * kluc prazdny v takom pripade sa prida css class na view s nazvom error k
         * danemu inputu. Tymto sposobom ulahci odchytavanie takychto poloziek a ich
         * elegantne nastylovanie cez css.
         * 
         * @access      public
         * @param       array $input
         * @param       string $value
         * @return      array
         */
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

        /**
	 * greater_or_equal_than
	 *
	 * @access	public
	 * @param	string $str
         * @param       integer $min minimalny pocet
	 * @return	boolean
	 */
	public function greater_or_equal_than($str, $min)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str >= $min;
	}
        
        /**
         * valid_date
         * 
         * Funkcia validuje na platny date format
         * 
         * @access	public
         * @param       string $str
         * @return	boolean
         */
        public function valid_date($str)
        {
            return ( ! preg_match('/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/', $str)) ? FALSE : TRUE;
        }
        
        /**
         * valid_datetime
         * 
         * Funkcia validuje na platny datetime format
         * 
         * @access	public
         * @param       string $str String
         * @return	boolean
         */
        public function valid_datetime($str)
        {
            return ( ! preg_match('/^[0-9]{2}.[0-9]{2}.[0-9]{4} [0-9]{2}:[0-9]{2}$/', $str)) ? FALSE : TRUE;
        }
        
        /**
	 * Numeric
	 *
	 * @access	public
	 * @param	string $str string
	 * @return	boolean
	 */
	public function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}
        
        /**
         * natural_no_zero
         * 
         * Vacsie ako 0 
         * 
         * @access	public
         * @param       string $str string
         * @return	boolean
         */
        public function natural_no_zero($str)
        {
            if(numeric($str))
                if ($str == 0)
		{
                    return FALSE;
		}
                else
                {
                    if($str > 0)
                        return TRUE;
                }
            else
                return FALSE;
        }
}