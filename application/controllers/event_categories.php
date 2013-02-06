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
 * Event Categories class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Event Categories
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Event_categories extends MY_Controller
{
    
        /**
	 * Constructor
	 */
        function __construct() 
        {
            parent::__construct();
            if( !$this->userdata->is_admin() )
                    redirect(base_url());

            $this->load->model('selecter');

            $data = array(
                'title' 		=> $this->lang->line('title'),   //Title na aktualnej stranke
                'view'                  => "{$this->router->class}_view"
            );

            $this->data = array_merge($this->data, $data);
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
            $this->load->view('container', $this->data);   
        }

        /**
         * add
         * 
         * Funkcia prida novy typ eventovej kategorie do db
         * 
         * @access      public
         * @return      void
         */
        public function add()
        {        
            parent::add('add_event_category', 'operation_add'); 
        }

        /**
         * edit
         * 
         * Funkcia upravi typ eventovej kategorie v db
         * 
         * @access      public
         * @param       integer $event_category_id ID typ eventovej kategorie ktora sa upravi
         * @return      void
         */
        public function edit( $event_category_id )
        {
            parent::edit('edit_event_category', $event_category_id, 'operation_edit'); 
        }

        /**
         * delete
         * 
         * Funkcia zmeze typ eventovej kategorie z db
         * 
         * @access      public
         * @param       integer $event_category_id ID typu eventovej kategorie ktora sa ma vymazat
         * @return      void
         */
        public function delete( $event_category_id )
        {
            parent::delete('remove_event_category', $event_category_id);

            $data = array(
                'view'              => 'confirm_view',
                'type'              => 'delete',
                'langs'             => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'            => $this->router->class.'/'.$this->router->method.'/'.$event_category_id,
                'event_category_id' => $event_category_id
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }
    
}

/* End of file event_categories.php */
/* Location: ./application/controllers/event_categories.php */