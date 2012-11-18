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
        
        $data = array(
            'title' 		=> ''   //Title na aktualnej stranke
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
        
    }
    
    public function detail($project_id)
    {
        
    }
    
    public function add()
    {
        parent::add('add_project', $this->router->class, $this->router->method);
        
        $this->load->model('selecter');
        
        $data = array(
            'project_categories'              => $this->selecter->get_project_categories()
        );
            
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function add_project_item( $project_id )
    {
        parent::add_param('add_project_item', $project_id, $this->router->class, $this->router->method);
        
        $data = array(
            'view'              => "{$this->router->class}_view"
        );
            
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function edit($project_id)
    {
        
    }
    
    public function delete($project_id)
    {
        
    }
    
}

/* End of file projects.php */
/* Location: ./application/controllers/projects.php */