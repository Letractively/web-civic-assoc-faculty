<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show_message extends MY_Controller
{
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         */
        function __construct() {
            parent::__construct();

            $data = array(
                'view'              => "confirm_view",
                'type'              => 'inform',
                'langs'             => array($this->lang->line('confirm_back')),
                'method'            => '',
                'title'             => $this->lang->line('title')
            );

            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne a zobrazi confirm inform message
         * 
         */
        public function index($url)
        {
            $data = array(
                'm_text'    => $this->lang->line($url)
            );
            $this->load->view('container', array_merge($this->data, $data)); 
        }
}

/* End of file show_message.php */
/* Location: ./application/controllers/show_message.php */