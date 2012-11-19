<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Degrees extends MY_Controller
{
        function __construct() 
        {
            parent::__construct();

            if( !$this->userdata->is_admin() )
                redirect(base_url());
            
            $data = array(
                'title'             => 'Tituly',   //Title na aktualnej stranke
                'view'              => "{$this->router->class}_view"
            );

            $this->data = array_merge($this->data, $data);
        }

        public function index()
        {             
            $this->load->view('container', $this->data);
        }
        
        public function add()
        {            
            parent::add('add_degree', $this->router->class, $this->router->method);
                            
            $this->load->view('container', $this->data);
        }
        
        public function delete( $degree_id )
        {            
            $this->load->view('container', $this->data);
        }
        
        public function edit( $degree_id )
        {
            parent::edit('edit_degree', $degree_id, $this->router->class, $this->router->method);
            
            $this->load->view('container', $this->data);
        }
}