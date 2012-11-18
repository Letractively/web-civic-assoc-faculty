<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Degrees extends MY_Controller
{
    
        function __construct() 
        {
            parent::__construct();

            if( !$this->userdata->is_admin() )
                redirect(base_url());
            
            $data = array(
                'title' 		=> 'Tituly',   //Title na aktualnej stranke
                'view'      => "{$this->router->class}_view"
            );

            $this->data = array_merge($this->data, $data);
        }

        public function index()
        {
            $this->load->model('selecter');
            
            $data = array(
                'view'          => "{$this->router->class}_view",
                'degrees'       => $this->selecter->get_degrees()
            );
                
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        public function add()
        {
            /*$this->load->model('inserter');
            
            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->methos}") )
                {
                    $this->inserter->add_degree( $this->input->post() );
                    redirect('degrees');
                }
            }
            
            $data = array(
                'view'          => "{$this->router->class}_view"
            );
                
            $this->load->view('container', array_merge($this->data, $data));*/
            
            parent::add('add_degree', $this->router->class, $this->router->method);
            
            $this->load->model('selecter');
            
            $data = array(
                'view'              => "{$this->router->class}_view",
                'degrees'           => $this->selecter->get_degrees()
            );
                
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        public function delete( $degree_id )
        {
            $data = array(
                
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        public function edit( $degree_id )
        {
            $this->load->model('updater');
            
            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->methos}") )
                {
                    $this->inserter->edit_degree( $degree_id, $this->input->post() );
                    redirect('degrees');
                }
            }
            
            $data = array(
                'view'          => "{$this->router->class}_view"
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
}