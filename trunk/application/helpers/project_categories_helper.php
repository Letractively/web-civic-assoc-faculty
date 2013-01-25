<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function updateProjCatDetailData($projects)
{	
	$CI =& get_instance();

	$pStates = array(0 => $CI->lang->line('label_closed'), 1 => $CI->lang->line('label_active'));
	
	$result = array();
	foreach ($projects as $project)
	{
		$arr = get_object_vars($project);
		$arr['project_active'] = in_array($arr['project_active'],array(0,1)) ? $pStates[$arr['project_active']] : '-';
		$result[] = $arr;
	}
	return $result;
}