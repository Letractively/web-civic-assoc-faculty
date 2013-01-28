<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_categories extends MY_Controller
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
            if( !$this->session->userdata('admin') )
                redirect(base_url ());
            $this->load->model('selecter');
            $data = array(
                'title' 		=> $this->lang->line('title'),   //Title na aktualnej stranke
                'view'              => "{$this->router->class}_view"
            );

            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne, zobrazi vsetky kategorie projektov
         * 
         */
        public function index()
        {
            $this->load->view('container', $this->data); 
        }

        /*
         * add
         * 
         * Metoda prida novu kategoriu projektov do systemu
         * 
         */
        public function add()
        {
            parent::add('add_project_category', 'operation_add');
        }

        /*
         * detail
         * 
         * Metoda zobrazi podrobnejsie infofmacie o konkretnej projektovej kategorie
         * 
         * @param project_category_id ID danej kategorie proejktov
         */
        public function detail( $project_category_id )
        {
            if( $project_category_id == '')
                redirect('404');
            
            $errors = array_merge($this->data['error'], array('to' => '', 'cash' => ''));
            
            $data = array(
                'view'                  => "{$this->router->class}_{$this->router->method}_view",
                'project_category_id'   => $project_category_id,
                'error'                 => $errors
            );
                
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /*
         * add_transaction
         * 
         * Metoda prida novu transakciu do databazy
         * 
         */
        public function add_transaction()
        {
            parent::add('add_transaction');
        }

        public function edit( $project_category_id )
        {
            parent::edit('edit_project_category', $project_category_id, 'operation_edit');
        }

        public function delete( $project_category_id )
        {
            parent::delete('remove_project_category', $project_category_id, $this->router->class);

            $data = array(
                'view'            => 'confirm_view',
                'type'            => 'delete',
                'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'          => $this->router->class.'/'.$this->router->method.'/'.$project_category_id
            );

            $this->load->view('container', array_merge($this->data, $data));
        }  
}

/* End of file project_categories.php */
/* Location: ./application/controllers/project_categories.php */