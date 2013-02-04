<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration extends MY_Controller
{
    
        /*
         * __construct
         * 
         * Konstruktor triedy
         * 
         * @access      private
         * @return void
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
         * @access      public
         * @return void
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