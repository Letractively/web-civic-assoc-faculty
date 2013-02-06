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
 * Show Message class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Show Message
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Show_message extends MY_Controller
{
        /**
	 * Constructor
	 */
        function __construct() {
            parent::__construct();

            $data = array(
                'view'              => "confirm_view",
                'type'              => 'inform',
                'langs'             => array($this->lang->line('confirm_back')),
                'method'            => '',
                'title'             => $this->lang->line('title')
            );

            $this->data = array_merge($this->data, $data);
        }

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne a zobrazi confirm inform message
         * 
         * @access      public
         * @return      void
         */
        public function index($url)
        {
            $data = array(
                'm_text'    => $this->lang->line($url)
            );
            $this->load->view('container', array_merge($this->data, $data)); 
        }
}

/* End of file show_message.php */
/* Location: ./application/controllers/show_message.php */