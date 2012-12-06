<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show_message extends MY_Controller
{
    function __construct() {
        parent::__construct();
        
        $data = array(
            'view'              => "confirm_view",
            'type'              => 'inform',
            'langs'             => $this->lang->line('confirm_ok'),
            'method'            => ''
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function index($url)
    {
        echo $url;
        //$data = array(
        //    'm_text'    => $this->lang->line($url)
        //);
        //$this->load->view('container', array_merge($this->data, $data)); 
    }
}

/* End of file show_message.php */
/* Location: ./application/controllers/show_message.php */