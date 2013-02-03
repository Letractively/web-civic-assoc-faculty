<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation 
{  
        /*
         * form_required
         * 
         * Funkcia skontroluje required polozky, ktore boli vyplnene. Vpripade ak
         * nebola dana polozka vyplnena vo formulari tak v poli error ostane jej
         * kluc prazdny v takom pripade sa prida css class na view s nazvom error k
         * danemu inputu. Tymto sposobom ulahci odchytavanie takychto poloziek a ich
         * elegantne nastylovanie cez css.
         * 
         * @access      public
         * @param       array
         * @param       string
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

        /*
	 * Greather or equal than
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function greater_or_equal_than($str, $min)
	{
		if ( ! is_numeric($str))
		{
			return FALSE;
		}
		return $str >= $min;
	}
        
        /*
         * valid_date
         * 
         * Funkcia validuje na platny date format
         * 
         * @param str String
         * 
         */
        public function valid_date($str)
        {
            return ( ! preg_match('/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/', $str)) ? FALSE : TRUE;
        }
        
        /*
         * valid_datetime
         * 
         * Funkcia validuje na platny datetime format
         * 
         * @param str String
         * 
         */
        public function valid_datetime($str)
        {
            return ( ! preg_match('/^[0-9]{2}.[0-9]{2}.[0-9]{4} [0-9]{2}:[0-9]{2}$/', $str)) ? FALSE : TRUE;
        }
        
        /**
	 * Numeric
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	public function numeric($str)
	{
		return (bool)preg_match( '/^[\-+]?[0-9]*\.?[0-9]+$/', $str);

	}
        
        /*
         * natural_no_zero
         * 
         * Vacsie ako 0 
         * 
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