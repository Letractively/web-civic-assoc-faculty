﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Events class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Events extends MY_Controller
{
        protected $c_pagination         = array();
        protected $get_query 		= array();
        protected $per_page             = 10;
        protected $totalRows            = 0;
        
        /**
	 * Constructor
	 */
        function __construct() 
        {
            parent::__construct();
            $this->get_query = ( $_GET ) ? '?' . http_build_query($_GET) : '';
            $this->load->library('pagination');
            
            $this->load->model('selecter');
            $data = array(
                'title' 		=> 'Udalosti'   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access      public
         * @param       integer $event_cat_id ID kategorie na ktoru sa to vztahuje default 0-vsetky
         * @param       integer $page Cislo strany
         * @return      void Vsetky udalosti
         */
        public function index( $event_cat_id = 0, $page = 0 )
        {
            $this->load->model('selecter');
            $this->totalRows = $this->selecter->EventRowsInCategory('events', 'event_id', $event_cat_id);
            $this->c_pagination['base_url'] = base_url().'events/'.$event_cat_id.'/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->totalRows;
            $this->pagination->initialize($this->c_pagination);
            
            $data = array(
                'view'              => "{$this->router->class}_view",
                'event_cat_id'      => $event_cat_id,
                'flag'              => 0,
                'c_pagination'      => $this->c_pagination,
                'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * newest
         * 
         * Funkcia vyfiltruje eventy od najnovsich po najstarsie
         * 
         * @access      public
         * @param       integer $event_cat_id ID kategorie na ktoru sa to vztahuje default 0-vsetky
         * @param       integer $page Cislo strany
         * @return      void Najnovsie udalosti
         */
        public function newest( $event_cat_id = 0, $page = 0 )
        {
            $this->load->model('selecter');
            $this->totalRows = $this->selecter->EventRowsInCategory('events', 'event_id', $event_cat_id);
            $this->c_pagination['base_url'] = base_url().'events/newest/'.$event_cat_id.'/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->totalRows;
            $this->pagination->initialize($this->c_pagination);
            
            $data = array(
                'view'              => "{$this->router->class}_view",
                'event_cat_id'      => $event_cat_id,
                'flag'              => 1,
                'c_pagination'      => $this->c_pagination,
                'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * prior
         * 
         * Funkcia vyfiltruje eventy od najviac prioritnych po najmenej priritne
         * 
         * @access      public
         * @param       integer $event_cat_id ID kategorie na ktoru sa to vztahuje default 0-vsetky
         * @param       integer $page Cislo strany
         * @return      void Udalosti s najvyssou priritou
         */
        public function prior( $event_cat_id = 0, $page = 0 )
        {
            $this->load->model('selecter');
            $this->totalRows = $this->selecter->EventRowsInCategory('events', 'event_id', $event_cat_id);
            $this->c_pagination['base_url'] = base_url().'events/prior/'.$event_cat_id.'/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->totalRows;
            $this->pagination->initialize($this->c_pagination);
            
            $data = array(
                'view'              => "{$this->router->class}_view",
                'event_cat_id'      => $event_cat_id,
                'flag'              => 2,
                'c_pagination'      => $this->c_pagination,
                'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * detail
         * 
         * Funkcia zobrazi detail daneho eventu
         * 
         * @access      public
         * @param       integer $event_id ID eventu ktoreho detail sa ma zobrazit
         * @return      void Detajl udalosti
         */
        public function detail( $event_id )
        {
            if( $event_id == '')
                redirect(base_url ());
            if( !$this->selecter->exists( 'events', 'event_id', $event_id) )
                redirect($this->router->class);
            $data = array(
                'event_id'      => $event_id
            );
            $this->load->view('container', array_merge($this->data, $data) );
        }

        /**
         * add
         * 
         * Funkcia prida novy event do DB
         * 
         * @access      public
         * @return      void
         */
        public function add()
        {   
            if( !$this->userdata->is_admin() )
                redirect (base_url());
            parent::add('add_event');

            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'event_category_id','priority','name',
                                                                                        'from','to','about')),
                'priorities'            => $this->generate_priorities($this->priorits),
                'buttons'       => get_bbcode_buttons()
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * edit
         * 
         * Funkcia zedituje konkretny event
         * 
         * @access      public
         * @param       integer $event_id ID eventu ktory sa ma upravit
         * @return      void
         */
        public function edit( $event_id )
        {   
            if( !$this->userdata->is_admin() )
                redirect (base_url());
            
           if(!$this->selecter->exists('events','event_id', $event_id))
                redirect( '404' );
            parent::edit('edit_event', $event_id);
            
            
            
            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'event_category_id','priority','name',
                                                                                        'from','to','about')),
                'priorities'            => $this->generate_priorities($this->priorits),
                'event_id' 		=> $event_id,
                'buttons'       => get_bbcode_buttons()
                
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * delete
         * 
         * Funkcia vymaze dany event z DB
         * 
         * @access      public
         * @param       integer $event_id ID eventu ktory sa ma vymazat
         * @return      void
         */
        public function delete( $event_id )
        {
            if( !$this->userdata->is_admin() )
                redirect (base_url());
            parent::delete('remove_event', $event_id, $this->router->class);
            
            $data = array(
                'view'            => 'confirm_view',
                'type'            => 'delete',
                'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'          => $this->router->class.'/'.$this->router->method.'/'.$event_id,
                'event_id'      => $event_id
            );
            
            $this->load->view('container', array_merge($this->data, $data));            
        }
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */