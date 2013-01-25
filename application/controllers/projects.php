<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends MY_Controller
{    
        /*
         * Constructor
         * 
         * @return      void
         * 
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

        /*
         * index
         * 
         * @return      void
         * 
         */
	public function index($pr_cat_id = 0)
        {
            $data = array(
                'view'                  => "{$this->router->class}_view",
		'category_id'		=> $pr_cat_id
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        public function detail($project_id)
        {
            $errors = array_merge($this->data['error'], array('to' => '', 'cash' => ''));
            $data = array(
                'project_id'   => $project_id,
                'error'                 => $errors
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        public function add()
        {
            parent::add('add_project');

            $data = array(
                'error'         => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                'booked_cash', 'from', 'to','password','username')),
                'priorities'            => $this->generate_priorities(5)
            );
            
            $this->load->view('container', array_merge($this->data, $data)); 
        }

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
            //parent::add_param('add_project_item', $project_id, 'operation_add');

            $data = array(
				'error'         => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                'booked_cash', 'from', 'to','password','username')),
                'view'              => "{$this->router->class}_edit_view",
                'project_id'        => $project_id,
				'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        public function edit( $project_id )
        {
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
            //parent::edit('edit_project_item', $project_id, 'operation_edit');

            $data = array(
				'error'         => $this->form_validation->form_required(array( 'name', 'about', 'priority', 'project_category_id',
                                                                                'booked_cash', 'from', 'to','password','username')),
                'view'         				=> "{$this->router->class}_edit_view",
                'project_id'        => $project_id,
				'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }
        
        public function edit_project_closed( $project_id )
        {
            $this->load->model('updater');
            $this->updater->edit_project_closed( $project_id );
            redirect($this->router->class);
            /*$data = array(
                'project_id'        => $project_id
            );
            $this->load->view('container', array_merge($this->data, $data));*/
        }

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
        
        public function delete_project_item( $project_id, $project_item_id)  //vymazat project?id
        {
            if( $project_id == '')
                redirect ('404');
            
            //parent::delete_param('remove_project_item', $project_id,$project_item_id, $this->router->class);
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