<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * updatePaymentsData
 * 
 * Funkcia doplni stlpec 'stav' do gridu kde sa nachadzaju payments
 * 
 * @access      public
 * @param payments Array of objects s paymentmi
 * @return Array of objects platieb
 * 
 */
function updatePaymentsData($payments)
{	
	$CI =& get_instance();

	$pTypes = array(1 => $CI->lang->line('payment_type_account'), 2 => $CI->lang->line('payment_type_voluntary'));
	
	$result = array();
	foreach ($payments->result() as $payment)
	{
		$arr = get_object_vars($payment);
		$paid = $payment->payment_paid_sum;
		$total = $payment->payment_total_sum;
		$arr['stav'] = ($paid == 0) ? $CI->lang->line('nopaid') : ((($total - $paid) > 0) ? $CI->lang->line('partly_paid') : $CI->lang->line('paid'));
		$arr['payment_type'] = in_array($arr['payment_type'],array(1,2)) ? $pTypes[$arr['payment_type']] : '-';
		$result[] = $arr;
	}
	return $result;
}