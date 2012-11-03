<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_categories extends MY_Controller
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
        
    }
    
    public function edit($event_category_id)
    {
        
    }
    
    public function delete($event_category_id)
    {
        
    }
    
}

/* End of file event_categories.php */
/* Location: ./application/controllers/event_categories.php */