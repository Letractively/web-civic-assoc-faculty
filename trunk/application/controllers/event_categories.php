<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_categories extends MY_Controller
{
    
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
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

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         */
        public function index()
        {       
            $this->load->view('container', $this->data);   
        }

        /*
         * add
         * 
         * Funkcia prida novy typ eventovej kategorie do db
         * 
         */
        public function add()
        {        
            parent::add('add_event_category', 'operation_add'); 
        }

        /*
         * edit
         * 
         * Funkcia upravi typ eventovej kategorie v db
         * 
         * @param event_category_id ID typ eventovej kategorie ktora sa upravi
         * 
         */
        public function edit( $event_category_id )
        {
            parent::edit('edit_event_category', $event_category_id, 'operation_edit'); 
        }

        /*
         * delete
         * 
         * Funkcia zmeze typ eventovej kategorie z db
         * 
         * @param event_category_id ID typu eventovej kategorie ktora sa ma vymazat
         * 
         */
        public function delete( $event_category_id )
        {
            parent::delete('remove_event_category', $event_category_id, $this->router->class);

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