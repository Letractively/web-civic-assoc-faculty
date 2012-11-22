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
			unset($_GET['operation_add']);
			$this->db->insert('users', $_GET);
		}
		redirect('/test', 'refresh');
	}
	
	public function edit($id)
	{
		if ($this->input->get('operation_edit'))
		{
			unset($_GET['operation_edit']);
			$this->db->where('user_id', $id);
			$this->db->update('users', $_GET); 
		}
		redirect('/test', 'refresh');
	}
	
	public function delete($id)
	{
		redirect('/test', 'refresh');
	}
}
