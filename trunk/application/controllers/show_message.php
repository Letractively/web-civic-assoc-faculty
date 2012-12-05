<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show_message extends MY_Controller
{
    function __construct() {
        parent::__construct();
        
        $data = array(
            'view'              => "{$this->router->class}_view",
            'title'             => $this->lang->line('title')
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function index( $url )
    {
        $data = array( 
            'message'       => $this->lang->line($url)
        );
        
        $this->load->view('container', array_merge($this->data, $data)); 
    }
}

/* End of file show_message.php */
/* Location: ./application/controllers/show_message.php */