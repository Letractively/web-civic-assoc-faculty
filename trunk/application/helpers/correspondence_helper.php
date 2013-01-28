<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * updateCorUserList
 * 
 * Funkcia doplni stlpec typ emailu do gridu kde sa nachadza medzi vysledok filtra
 * 
 * @param users Array of objects s udajmi o useroch ktori vyhovuju filtru
 * 
 */
function updateCorUserList($users)
{	
	$CI =& get_instance();

	$email_types = $CI->selecter->get_email_types();
	$array_email_types = array();
	foreach ($email_types as $email_type)
		$array_email_types[$email_type->email_type_id] = $email_type->email_type_name;
	
	$result = array();
	foreach ($users as $user)
	{
		$arr = get_object_vars($user);
		if ($arr['user_email_evidence_email_type_id'] != null) $arr['user_email_evidence_email_type_id'] = $array_email_types[ $arr['user_email_evidence_email_type_id'] ];
		$result[] = $arr;
	}
	return $result;
}