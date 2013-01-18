<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Degrees extends MY_Controller
{
        protected $c_pagination         = array();
        protected $get_query 		= array();
        protected $per_page             = 3;
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         */
        function __construct() 
        {
            parent::__construct();
            $this->get_query = ( $_GET ) ? '?' . http_build_query($_GET) : '';
            $this->load->model('selecter');
            if( !$this->userdata->is_admin() )
                redirect(base_url());
            
            $data = array(
                'title' 		=> $this->lang->line('title')   //Title na aktualnej stranke
            );
            
            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         */
        public function index( $page = 0 )
        {   
            $this->load->library('pagination');
            $this->load->model('selecter');
            
            $this->c_pagination['base_url'] = base_url().'degrees/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->selecter->rows('degrees', 'degree_id');
            $this->pagination->initialize($this->c_pagination);
            
            $data = array(
                'view'              => "{$this->router->class}_view",
                'c_pagination'  => $this->c_pagination,
                'pagination'    => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /*
         * add
         * 
         * Funkcia prida novy titul do db
         * 
         */
        public function add()
        {     
            redirect('test');
            //parent::add('add_degree', 'operation_add');
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
              'method'          => $this->router->class.'/'.$this->router->method.'/'.$degree_id,
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
           parent::edit('edit_degree', $degree_id, 'operation_edit');
        }
}