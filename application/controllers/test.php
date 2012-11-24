<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends MY_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->library('grid');
		$this->load->helper('url');
		$this->load->model('selecter');
		
		$data = array(
            'title' 		=> 'Homepage'   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
	}
	
	public function index()
	{
        $data = array( 
            'view'       => "{$this->router->class}_view"
        );
        
        $this->load->view('container', array_merge($this->data, $data));
	}
	
	public function add()
	{
		if ($this->input->get('operation_add'))
		{
			$data = array(
				'user_postcode' => $_GET['user_postcode'],
				'user_study_program_id' => $_GET['study_program_name'],
				'user_degree_id' => $_GET['degree_name'],
				'user_role' => 0,
				'user_name' => $_GET['user_name'],
				'user_surname' => $_GET['user_surname'],
				'user_email' => $_GET['user_email']
			);
			$this->db->insert('users', $data);
		}
		redirect('/test', 'refresh');
	}
	
	public function edit($id)
	{
		if ($this->input->get('operation_edit'))
		{
			$data = array(
				'user_postcode' => $_GET['user_postcode'],
				'user_study_program_id' => $_GET['study_program_name'],
				'user_degree_id' => $_GET['degree_name'],
				'user_role' => 0,
				'user_name' => $_GET['user_name'],
				'user_surname' => $_GET['user_surname'],
				'user_email' => $_GET['user_email']
			);
			$this->db->where('user_id', $id);
			$this->db->update('users', $data); 
		}
		redirect('/test', 'refresh');
	}
	
	public function delete($id)
	{
		$this->db->delete('users', array('user_id' => $id)); 
		redirect('/test', 'refresh');
	}
}
