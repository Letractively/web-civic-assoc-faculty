<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Degrees extends MY_Controller
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
            $this->load->model('selecter');
            if( !$this->userdata->is_admin() )
                redirect(base_url());
            
            $data = array(
                'title'             => 'Tituly',   //Title na aktualnej stranke
                'view'              => "{$this->router->class}_view"
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
            $this->load->model('selecter');
            $this->load->view('container', $this->data);
        }
        
        /*
         * add
         * 
         * Funkcia prida novy titul do db
         * 
         */
        public function add()
        {            
            parent::add('add_degree', $this->router->class, $this->router->method);
                            
            $this->load->view('container', $this->data);
        }
        
        /*
         * delete
         * 
         * Funkcia zmeze titul z db
         * 
         * @param degree_id ID titulu ktory sa ma vymazat
         * 
         */
        public function delete( $degree_id )
        {   
            parent::delete('remove_degree', $degree_id, $this->router->class);
            
            $data = array(
              'view'            => 'confirm_view',
              'type'            => 'delete',
              'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
              'method'          => $this->router->class.'/'.$degree_id,
              'degree_id'       => $degree_id
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /*
         * edit
         * 
         * Funkcia upravi titul v db
         * 
         * @param degree_id ID titulu ktory sa upravi
         * 
         */
        public function edit( $degree_id )
        {
            parent::edit('edit_degree', $degree_id, $this->router->class, $this->router->method);
            
            $data = array(
                'degree_id'       => $degree_id
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
}