<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correspondence extends MY_Controller
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
    
    public function import()
    {
        
    }
    
    public function export()
    {
        
    }
}

/* End of file io.php */
/* Location: ./application/controllers/io.php */