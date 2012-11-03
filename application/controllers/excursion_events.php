<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excursion_events extends MY_Controller
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
    
    public function detail($excursion_event_id)
    {
        
    }
    
    public function add()
    {
        
    } 
    
    public function edit($excursion_event_id)
    {
        
    }
    
    public function delete($excursion_event_id)
    {
        
    }
    
    
}

/* End of file excursion_events.php */
/* Location: ./application/controllers/excursion_events.php */