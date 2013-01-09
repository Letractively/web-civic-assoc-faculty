<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studies extends MY_Controller
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
                'title' 		=> $this->lang->line('title'),   //Title na aktualnej stranke
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
            $this->load->view('container', $this->data);
        }

        /*
         * add
         * 
         * Funkcia prida novy studijny program do db
         * 
         */
        public function add()
        {
            parent::add('add_study_program', 'operation_add');
        }

        /*
         * edit
         * 
         * Funkcia upravi studijny program v db
         * 
         * @param study_id ID studijneho programu ktory sa upravi
         * 
         */
        public function edit( $study_id )
        {
            parent::edit('edit_study_program', $study_id, 'operation_edit');
        }

        /*
         * delete
         * 
         * Funkcia zmeze studijny program z db
         * 
         * @param study_id ID studijneho programu ktory sa ma vymazat
         * 
         */
        public function delete( $study_id )
        {
            parent::delete('remove_study_program', $study_id, $this->router->class);

            $data = array(
                'view'            => 'confirm_view',
                'type'            => 'delete',
                'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'          => $this->router->class.'/'.$this->router->method.'/'.$study_id
            );

            $this->load->view('container', array_merge($this->data, $data));
        }
    
}

/* End of file studies.php */
/* Location: ./application/controllers/studies.php */