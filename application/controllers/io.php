<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Io extends MY_Controller
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
            'title' 		=> 'Export'   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function import()
    {
        
    }
    
    public function export()
    {
		$data = array(
			'view'              => "{$this->router->class}_{$this->router->method}_view",
		);
		
		$this->load->view('container', array_merge($this->data, $data));
    }
}

/* End of file io.php */
/* Location: ./application/controllers/io.php */