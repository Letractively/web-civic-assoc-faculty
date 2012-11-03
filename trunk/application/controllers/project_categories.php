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
    
    public function detail($project_category_id)
    {
        
    }
    
    public function add()
    {
        
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