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