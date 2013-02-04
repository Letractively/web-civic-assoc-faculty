<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * updateProjectDetailData
 * 
 * Funkcia premapuje stlpec project_active v gride s projektami na textovu podobu
 * 0 zmeni na uzavrety projekt, a 1 zmeni na prebiehajuci projekt
 * 
 * @access      public
 * @param projects Array of objects projektov
 * @return Array of objects projektov pre grid
 * 
 */
function updateProjectDetailData($projects)
{	
	$CI =& get_instance();

	$pStates = array(0 => $CI->lang->line('label_closed'), 1 => $CI->lang->line('label_active'));
	
	$result = array();
	foreach ($projects->result() as $project)
	{
		$arr = get_object_vars($project);
		$arr['project_active'] = in_array($arr['project_active'],array(0,1)) ? $pStates[$arr['project_active']] : '-';
		$result[] = $arr;
	}
	return $result;
}