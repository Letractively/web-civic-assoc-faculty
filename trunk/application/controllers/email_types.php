<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_types extends MY_Controller
{
    
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         * @access      private
         * @return void
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
                'view'          => "{$this->router->class}_view"
            );

            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access      public
         * @return void
         */
        public function index()
        {            
            $this->load->view('container', $this->data);
        }

        /*
         * add
         * 
         * Funkcia prida novy typ emailu do db
         * 
         * @access      public
         * @return void
         * 
         */
        public function add()
        {        
            parent::add('add_email_type', 'operation_add');
        }

        /*
         * edit
         * 
         * Funkcia upravi typ emailu v db
         * 
         * @access      public
         * @param email_type_id ID typu emailu ktory sa upravi
         * @return void
         */
        public function edit( $email_type_id )
        {
            parent::edit('edit_email_type', $email_type_id, 'operation_edit');
        }

        /*
         * delete
         * 
         * Funkcia zmeze typ emailu z db
         * 
         * @access      public
         * @param email_type_id ID typu emailu ktory sa ma vymazat
         * @return void
         */
        public function delete( $email_type_id )
        {     
            parent::delete('remove_email_type', $email_type_id);

            $data = array(
                'view'            => 'confirm_view',
                'type'            => 'delete',
                'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'          => $this->router->class.'/'.$this->router->method.'/'.$email_type_id,
                'email_type_id'   => $email_type_id
            );

            $this->load->view('container', array_merge($this->data, $data));
        }
}

/* End of file email_types.php */
/* Location: ./application/controllers/email_types.php */