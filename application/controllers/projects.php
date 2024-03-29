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
 * Projects class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Projects
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Projects extends MY_Controller
{    
        /**
	 * Constructor
	 */
        function __construct() 
        {
            parent::__construct();
            $this->load->model('selecter');
            
            $data = array(
                'title' 		=> 'Projekty'   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        /**
         * index
         * 
         * @access      public
         * @param       integer  $pr_cat_id Cislo strany
         * @return      void
         */
	public function index($pr_cat_id = 0)
        {
            $data = array(
                'view'                  => "{$this->router->class}_view",
		'category_id'		=> $pr_cat_id
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * Funkcia vrati detajl daneho projektu
         * 
         * @access      public
         * @param       integer $project_id ID projektu ktoreho detajl chceme ziskat
         * @return      void
         */
        public function detail($project_id)
        {
            if($project_id == '' || !$this->selecter->exists('projects','project_id',$project_id))
               redirect('404');
            $errors = array_merge($this->data['error'], array('to' => '', 'cash' => ''));
            $data = array(
                'project_id'   => $project_id,
                'error'                 => $errors
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * add
         * 
         * Funkcia prida novy projekt do databazi
         * 
         * @access      public
         * @return      void
         */
        public function add()
        {
            parent::add('add_project');

            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                        'booked_cash', 'from', 'to','password','username')),
                'priorities'            => $this->generate_priorities(5)
            );
            
            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /**
         * add_project_item
         * 
         * Funkcia prida novu polozku projektu do databazi
         * 
         * @access      public
         * @param       integer $project_id ID projektu ku ktoremu chceme pridat danu polozku
         * @return      void
         */
        public function add_project_item( $project_id )
        {
			$new_post = array(
				'name' => $_POST['project_item_name'],
				'price' => $_POST['project_item_price'],
				'user_id' => $_POST['user_name']
			);
			$_POST = $new_post;
			
			$this->load->model('inserter');
			$this->inserter->add_project_item($project_id, $_POST);
                        redirect('projects/edit/'.$project_id);

            $data = array(
				'error'         => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                'booked_cash', 'from', 'to','password','username')),
                'view'              => "{$this->router->class}_edit_view",
                'project_id'        => $project_id,
				'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        /**
         * edit
         * 
         * Funkcia upravi projekt
         * 
         * @access      public
         * @param       integer $project_id ID projektu ktori chceme upravit
         * @return      void
         */
        public function edit( $project_id )
        {
            if($project_id == '' || !$this->selecter->exists('projects','project_id',$project_id))
               redirect('404');
            
            if($this->input->post('submit') == $this->lang->line('button_close_project'))
                $this->edit_project_closed ($project_id);
            
            parent::edit('edit_project', $project_id);

            $data = array(
                'error'         => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                'booked_cash', 'from', 'to')),
                'project_id'            => $project_id,
                'priorities'            => $this->generate_priorities($this->priorits)
            );
            
            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /**
         * edit_project_item
         * 
         * Funkcia upravi polozku projektu
         * 
         * @access      public
         * @param       integer $project_id ID projektu
         * @param       integer $project_item_id ID polozky
         * @return      void
         */
        public function edit_project_item($project_id, $project_item_id )
        {
            $new_post = array(
				'name' => $_POST['project_item_name'],
				'price' => $_POST['project_item_price'],
				'user_id' => $_POST['user_name']
			);
			$_POST = $new_post;
			
			$this->load->model('updater');
			$this->updater->edit_project_item($project_item_id, $_POST);
                        redirect('projects/edit/'.$project_id);


            $data = array(
				'error'         => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                'booked_cash', 'from', 'to','password','username')),
                'view'         				=> "{$this->router->class}_edit_view",
                'project_id'        => $project_id,
				'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /**
         * edit_project_closed
         * 
         * Funkcia uzavre projekt
         * 
         * @access      public
         * @param       integer $project_id ID projektu
         * @return      void
         */
        public function edit_project_closed( $project_id )
        {
            $this->load->model('updater');
            $this->updater->edit_project_closed( $project_id );
            redirect($this->router->class.'/detail/'.$project_id);
        }

        /**
         * delete
         * 
         * Funkcia zmaze projekt
         * 
         * @access      public
         * @param       integer $project_id ID projektu
         * @return      void
         */
        public function delete( $project_id )
        {
            parent::delete('remove_project', $project_id, $this->router->class);
            
            $data = array(
              'view'            => 'confirm_view',
              'type'            => 'delete',
              'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
              'method'          => $this->router->class.'/'.$this->router->method.'/'.$project_id
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /**
         * delete_project_item
         * 
         * Funkcia zmaze polozku projektu
         * 
         * @access      public
         * @param       integer $project_id ID projektu
         * @param       integer $project_item_id ID projektovej polozky
         * @return      void
         */
        public function delete_project_item( $project_id, $project_item_id)
        {
            if( $project_id == '')
                redirect ('404');
            
            $this->load->model('deleter');
            $this->deleter->remove_project_item($project_item_id);
            redirect('projects/edit/'.$project_id);
            
            $data = array(
                'view'                  => "{$this->router->class}_edit_view",
		'error'                 => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                        'booked_cash', 'from', 'to','password','username')),
                'project_id'            => $project_id,
                'priorities'            => $this->generate_priorities(5)
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
}

/* End of file projects.php */
/* Location: ./application/controllers/projects.php */