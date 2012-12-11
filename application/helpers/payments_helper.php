<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function addAdditional($payments)
{	
	$CI =& get_instance();

	$result = array();
	foreach ($payments as $payment)
	{
		$arr = get_object_vars($payment);
		$paid = $payment->payment_paid_sum;
		$total = $payment->payment_total_sum;
		$arr['stav'] = ($paid == 0) ? $CI->lang->line('nopaid') : ((($total - $paid) > 0) ? $CI->lang->line('partly_paid') : $CI->lang->line('paid'));
		$result[] = $arr;
	}
	return $result;
}