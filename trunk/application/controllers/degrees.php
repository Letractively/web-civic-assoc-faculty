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
 * Degrees class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Degrees
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Degrees extends MY_Controller
{
        protected $c_pagination         = array();
        protected $get_query 		= array();
        protected $per_page             = 3;
        
        /**
	 * Constructor
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

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access      public
         * @return      void
         */
        public function index( $page = 0 )
        {   
            $this->load->model('selecter');
            
            $data = array(
                'view'              => "{$this->router->class}_view"
            );
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /**
         * add
         * 
         * Funkcia prida novy titul do db
         * 
         * @access      public
         * @return      void
         */
        public function add()
        {     
            parent::add('add_degree', 'operation_add');
        }
        
        /**
         * delete
         * 
         * Funkcia zmeze titul z db
         * 
         * @access      public
         * @param       integer $degree_id ID titulu ktory sa ma vymazat
         * @return      void
         */
        public function delete( $degree_id )
        {   
            parent::delete('remove_degree', $degree_id);
            
            $data = array(
              'view'            => 'confirm_view',
              'type'            => 'delete',
              'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
              'method'          => $this->router->class.'/'.$this->router->method.'/'.$degree_id,
              'degree_id'       => $degree_id
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /**
         * edit
         * 
         * Funkcia upravi titul v db
         * 
         * @access      public
         * @param       integer $degree_id ID titulu ktory sa upravi
         * @return      void
         */
        public function edit( $degree_id )
        {
           parent::edit('edit_degree', $degree_id, 'operation_edit');
        }
}