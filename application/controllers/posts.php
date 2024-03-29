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
 * Posts class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Posts
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Posts extends MY_Controller
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
            
            $data = array(
                'title' 		=> 'Články'   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne, zobrazi vsetky prispevky
         * 
         * @access      public
         * @param       inteher $page Cislo strany
         * @return      void 
         */
        public function index($page = 0)
        {
            $this->load->library('pagination');
            $this->load->model('selecter');
            $this->totalRows = $this->selecter->rows('posts', 'post_id');
            
            $this->c_pagination['base_url'] = base_url().'posts/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            
            if ( $this->userdata->is_admin() )
            {
                $this->c_pagination['total_rows'] = $this->totalRows;
            }      
            else 
            {
                $posts = $this->selecter->get_posts($this->totalRows, 0);
                $this->totalRows = 0;
                
                foreach ($posts as $post)
                {
                    if($post->post_published == 1)
                        $this->totalRows += 1; 
                }
                
                $this->c_pagination['total_rows'] = $this->totalRows;
            }
            $this->pagination->initialize($this->c_pagination);
            
            $data = array(
                'view'          => "{$this->router->class}_view",
                'c_pagination'  => $this->c_pagination,
                'pagination'    => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * detail
         * 
         * Metoda ktora vrati obsah konkretneho prispevku
         * 
         * @access      public
         * @param       integer $post_id ID-prispevku, ktory chceme zobrazit
         * @return      void
         */
        public function detail( $post_id )
        {
            $this->load->model('selecter');
            if(!$this->selecter->exists('posts','post_id', $post_id))
                redirect('404');
            $data = array(
                'post_id'       => $post_id
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * add
         * 
         * Metoda, ktora prida novy prispevok do DB
         * 
         * @access      public
         * @return      void
         */
        public function add()
        {
            if( !$this->userdata->is_admin() )
                redirect(base_url());
            parent::add( 'add_post' );

            $data = array(
                'error'         => $this->form_validation->form_required(array('title','content','priority')),
                'priorities'    => $this->generate_priorities($this->priorits),
                'buttons'       => get_bbcode_buttons()
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * edit
         * 
         * Metoda, ktora upravi konkretny prispevok
         * 
         * @access      public
         * @param       integer $post_id ID-prispevku, ktory chceme upravit
         * @return      void
         */
        public function edit( $post_id )
        {
            $this->load->model('selecter');
            if( $post_id == '' || !$this->selecter->exists('posts','post_id', $post_id))
                redirect('404');
            if( !$this->userdata->is_admin() )
                redirect(base_url());
            parent::edit( 'edit_post', $post_id );

            $data = array(
                'post_id'       => $post_id,
                'error'         => $this->form_validation->form_required(array('title','content','priority')),
                'priorities'    => $this->generate_priorities($this->priorits),
                'buttons'       => get_bbcode_buttons()
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * delete
         * 
         * Metoda, ktora zmaze konkretny prispevok zo systemu
         * 
         * @access      public
         * @param       integer $post_id ID prispevku, ktory chceme vymazat
         * @return      void
         */
        public function delete( $post_id )
        {
            parent::delete('remove_post', $post_id, $this->router->class);

            $data = array(
                'view'            => 'confirm_view',
                'type'            => 'delete',
                'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'          => $this->router->class.'/'.$this->router->method.'/'.$post_id
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * modifiers
         * 
         * Metoda, ktora vrati zoznam vstekych uzivatelov, ktory modifikovali dany prispevok
         * 
         * @access      public
         * @param       integer $post_id ID prispevku pre ktory to chceme zistit
         * @return      array of objects
         */
        public function modifiers( $post_id )
        {
            $this->load->model('selecter');
            if( $post_id == '' || !$this->selecter->exists('posts','post_id', $post_id))
                redirect('404');

            $data = array(
                'post_id'       => $post_id
            );
            $this->load->view('container', array_merge($this->data, $data));
        } 
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */