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
            $query = $this->db->query('SELECT *
                                    FROM event_categories'); 

                foreach ($query->list_fields() as $field)
                {
                    echo $field.'<br />';
                } 
        /*$data = array( 
            'view'       => "{$this->router->class}_view",
            'users' => $this->db->query("SELECT * from users")->result()
        );
        
        $this->load->view('container', array_merge($this->data, $data));*/
	}
	
	public function add()
	{
		if ($this->input->post('operation_add'))
		{
			unset($_POST['operation_add']);
			$val = $_POST['degree_name'];
			unset($_POST['degree_name']);
			$_POST['user_degree_id'] = $val;
			
			$this->db->insert('users', $_POST);
		}
		redirect('/test', 'refresh');
	}
	
	public function edit($id)
	{
		if ($this->input->post('operation_edit'))
		{
			unset($_POST['operation_edit']);
			$val = $_POST['degree_name'];
			unset($_POST['degree_name']);
			$_POST['user_degree_id'] = $val;
			
			$this->db->where('user_id', $id);
			$this->db->update('users', $_POST); 
		}
		redirect('/test', 'refresh');
	}
	
	public function delete($id)
	{
		$this->db->delete('users', array('user_id' => $id)); 
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
