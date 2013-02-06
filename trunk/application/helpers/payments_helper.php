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
 *  Payments helper
 *
 * @package		AlumniFMFI
 * @subpackage          Helpers
 * @category            Payments
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


/**
 * updatePaymentsData
 * 
 * Funkcia doplni stlpec 'stav' do gridu kde sa nachadzaju payments
 * 
 * @access      public
 * @param       array $payments Array of objects s paymentmi
 * @return      array Array of objects platieb
 */
function updatePaymentsData($payments)
{	
	$CI =& get_instance();

	$pTypes = array(1 => $CI->lang->line('payment_type_account'), 2 => $CI->lang->line('payment_type_voluntary'));
	
	$result = array();
	foreach ($payments->result() as $payment)
	{
		$arr = get_object_vars($payment);
		unset($arr['payment_accepted']);
		$paid = $payment->payment_paid_sum;
		$total = $payment->payment_total_sum;
		if ($payment->payment_accepted == 1)
			$arr['payment_state'] = $CI->lang->line('accepted');
		else
		{
			if ($payment->payment_paid_sum == 0)
				$arr['payment_state'] = $CI->lang->line('nopaid');
			else if ( ($payment->payment_total_sum - $payment->payment_paid_sum) > 0)
				$arr['payment_state'] = $CI->lang->line('partly_paid');
			else
				$arr['payment_state'] = $CI->lang->line('paid');
		}
		$arr['payment_type'] = in_array($arr['payment_type'],array(1,2)) ? $pTypes[$arr['payment_type']] : '-';
		$result[] = $arr;
	}
	return $result;
}