<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show_message extends MY_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('musers');
        
        $data = array(
            'view'              => "{$this->router->class}",
            'title' 		=> 'Homepage'   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function index( $url )
    {
        $data = array( 
            'message'       => $url
        );
        
        $this->load->view('container', array_merge($this->data, $data)); 
    }
}

/* End of file show_message.php */
/* Location: ./application/controllers/show_message.php */