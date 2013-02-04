<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_categories extends MY_Controller
{
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         * @access      private
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
         * @access      public
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
         * @access      public
         * @param project_category_id ID danej kategorie proejktov
         * 
         */
        public function detail( $project_category_id )
        {
            if( $project_category_id == '' || !$this->selecter->exists('project_categories','project_category_id',$project_category_id))
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
         * @access      public
         * 
         */
        public function add_transaction()
        {
            $dataInput = $this->input->post();
            
            $this->form_validation->set_rules('cash', 'lang:label_cash', 'trim|xss_clean|numeric|natural_no_zero');
            if( $this->form_validation->run() )
            {
                $this->load->model('inserter');
                $this->inserter->add_transaction($dataInput);
                $this->load->model('updater');
                $this->updater->edit_project_category_transactions($dataInput);
                redirect('project_categories/detail/'.$dataInput['from']);
            }
        }

        /*
         * edit
         * 
         * Funkcia upravi danu projektovu kategoriu
         * 
         * @access      public
         * @param project_category_id ID projektovej kategorie ktore chceme upravit
         * 
         */
        public function edit( $project_category_id )
        {
            parent::edit('edit_project_category', $project_category_id, 'operation_edit');
        }

        /*
         * delete
         * 
         * Funkcia vymaze z databazy projektovu kategoriu
         * 
         * @access      public
         * @param project_category_id ID projektovej kategorie ktoru chceme zmazat
         * 
         */
        public function delete( $project_category_id )
        {
            parent::delete('remove_project_category', $project_category_id);

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