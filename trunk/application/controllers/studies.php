<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Alumni FMFI
 * 
 * Aplikacia na spravu OZ Alumni FMFI
 *
 * @package		AlumniFMFI
 * @author		Tutifruty Team
 * @link		http://kempelen.ii.fmph.uniba.sk
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Studies class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Studies
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Studies extends MY_Controller
{
    
        /**
	 * Constructor
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

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access      public
         * @return      void
         */
        public function index()
        {
            $this->load->view('container', $this->data);
        }

        /**
         * add
         * 
         * Funkcia prida novy studijny program do db
         * 
         * @access      public
         * @return      void
         */
        public function add()
        {
           parent::add('add_study_program', 'operation_add');
        }

        /**
         * edit
         * 
         * Funkcia upravi studijny program v db
         * 
         * @access      public
         * @param       integer $study_id ID studijneho programu ktory sa upravi
         * @return      void
         */
        public function edit( $study_id )
        {
            parent::edit('edit_study_program', $study_id, 'operation_edit');
        }

        /**
         * delete
         * 
         * Funkcia zmeze studijny program z db
         * 
         * @access      public
         * @param       integer $study_id ID studijneho programu ktory sa ma vymazat
         * @return      void
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