<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excursions extends MY_Controller
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
            
    public function add()
    {
        
    }
    
    /*
     * index
     * 
     * @return      void
     * 
     */
    public function index($from = '', $to = '')
    {
        
    }
    
    public function detail($excursion_id)
    {
        
    }
    
    public function edit($excursion_id)
    {
        
    }
    
    public function delete($excursion_id)
    {
        
    }
    
    
}

/* End of file excursions.php */
/* Location: ./application/controllers/excursions.php */