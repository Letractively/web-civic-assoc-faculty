<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller
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
    public function index($event_id = 0)
    {
        
    }
    
    public function newest($event_id = 0)
    {
        
    }
    
    public function prior($event_id = 0)
    {
        
    }
    
    public function detail($event_id)
    {
        
    }
    
    public function add()
    {
        
    }
    
    public function edit($event_id)
    {
        
    }
    
    public function delete($event_id)
    {
        
    }
    
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */