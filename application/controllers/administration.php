<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Administration class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Adinistration
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------
class Administration extends MY_Controller
{
        /**
	 * Constructor
	 */
        function __construct() 
        {           
            parent::__construct();
        }

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access      public
         * @return      void
         */
        public function index()
        {
            if( !$this->userdata->is_admin() )
            {
                redirect(base_url ());
            }
            $data = array(
                'view' => "{$this->router->class}_view",
		'title' => 'Administrácia'
            );
            $this->load->view('container', array_merge($this->data, $data));
        }
}