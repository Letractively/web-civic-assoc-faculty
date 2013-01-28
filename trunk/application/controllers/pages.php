<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller
{
    
        /*
         * __construct
         * 
         * Konstruktor triedy
         * 
         */
        function __construct() 
        {
            parent::__construct();
            $this->load->model('selecter');
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         */
        public function index($page_name)
        {
            $data = array( 
                'view' =>  $this->router->class.'_'.'view',
                'page'  => $page_name
            );
            
            switch ($page_name)
            {
		case 'rules': 
                    $data['title'] = $this->lang->line('title_rules');
                    break;
		case 'contact': 
                    $data['title'] = $this->lang->line('title_contact');
                    break;
		case 'about': 
                    $data['title'] = $this->lang->line('title_about'); 
                    break;
		default: 
                    $data['title'] = ''; 
                    break;
            }     
			
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        public function edit( $page_name )
        {
            parent::edit('edit_page_text', $page_name);
            
            $data = array(
                'error'         =>  $this->form_validation->form_required(array('page_text')),
                'title'         =>  $this->lang->line('title_editor'),
                'buttons'       =>  get_bbcode_buttons(),
                'page'          =>  $page_name
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
}