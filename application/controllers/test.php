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
            'view'       => "{$this->router->class}_view",
            'users' => $this->db->query("SELECT * from users")->result()
        );
        
        $this->load->view('container', array_merge($this->data, $data));
	}
	
	public function add()
	{
		if ($this->input->post('operation_add'))
		{
			$data = array(
				'degree_name' => $_POST['degree_name'],
				'degree_grade' => $_POST['degree_grade']
			);
			$this->db->insert('degrees', $data);
		}
		redirect('/test', 'refresh');
	}
	
	public function edit($id)
	{
		if ($this->input->post('operation_edit'))
		{
			$data = array(
				'degree_name' => $_POST['degree_name'],
				'degree_grade' => $_POST['degree_grade']
			);
			$this->db->where('degree_id', $id);
			$this->db->update('degrees', $data); 
		}
		redirect('/test', 'refresh');
	}
	
	public function delete($id)
	{
		$this->db->delete('degrees', array('degree_id' => $id)); 
		redirect('/test', 'refresh');
	}
	
	public function detail($id)
	{
		$data = array( 
            'view'       => "test_detail_view",
			'id' => $id
        );
 
        $this->load->view('container', array_merge($this->data, $data));
	}
}
