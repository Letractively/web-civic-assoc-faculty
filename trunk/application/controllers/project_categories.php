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
    
    public function add()
    {
        parent::add('add_project_category', $this->router->class, $this->router->method);
        
        $data = array(
            'view'              => "{$this->router->class}_view"
        );
            
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function detail($project_category_id)
    {
        parent::add('add_transaction', $this->router->class, $this->router->method);
        
        $this->load->model('selecter');
        
        $data = array(
            'category_detail'       => $this->selecter->get_category_detail( $project_category_id ),
            'event_categories'      => $this->selecter->get_event_categories(),
            'transactions'          => $this->selecter->get_transactions( $project_category_id ),
            'projects'              => $this->selecter->get_projects( $project_category_id )
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function edit($project_category_id)
    {
        
    }
    
    public function delete($project_category_id)
    {
        
    }
    
}

/* End of file project_categories.php */
/* Location: ./application/controllers/project_categories.php */