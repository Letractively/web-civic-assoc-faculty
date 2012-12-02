<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_categories extends MY_Controller
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
            'title' 		=> 'Kategórie projektov',   //Title na aktualnej stranke
            'view'              => "{$this->router->class}_view"
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    /*
     * index
     * 
     * @return      void
     * 
     */
    public function index()
    {
        $this->load->view('container', $this->data); 
    }
    
    public function add()
    {
        parent::add('add_project_category', $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data); 
    }
    
    public function detail( $project_category_id )
    {
        parent::add('add_transaction', $this->router->class, $this->router->method);
        
        $data = array(
            'view'              => "{$this->router->class}_{$this->router->method}_view",
            'project_category_id'   => $project_category_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function edit( $project_category_id )
    {
        parent::edit('edit_project_category', $project_category_id, $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data); 
    }
    
    public function delete( $project_category_id )
    {
        parent::delete('remove_project_category', $project_category_id, $this->router->class);
            
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$project_category_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
}

/* End of file project_categories.php */
/* Location: ./application/controllers/project_categories.php */