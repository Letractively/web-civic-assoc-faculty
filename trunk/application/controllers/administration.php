<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration extends MY_Controller
{
    
        /*
         * __construct
         * 
         * Konstruktor triedy
         * 
         */
        function __construct() 
        {           
            parent::__construct();
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         */
        public function index()
        {
            if( !$this->userdata->is_admin() )
            {
                redirect(base_url ());
            }
            $data = array(
                'view' => "{$this->router->class}_view",
		'title' => 'Administrácia'
            );
			
            $this->load->view('container', array_merge($this->data, $data));
        }
}