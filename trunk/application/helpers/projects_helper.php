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
 * Projects helper
 *
 * @package		AlumniFMFI
 * @subpackage          Helpers
 * @category            Projects
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


/**
 * updateProjectDetailData
 * 
 * Funkcia premapuje stlpec project_active v gride s projektami na textovu podobu
 * 0 zmeni na uzavrety projekt, a 1 zmeni na prebiehajuci projekt
 * 
 * @access      public
 * @param       array $projects Array of objects projektov
 * @return      array Array of projekty projektov pre grid
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