<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller
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
        public function index($view)
        {
			$data = array( 
                'view' => $this->router->class.'_'.$view.'_'.'view',
            );
			
			switch ($view)
			{
				case 'rules': $data['title'] = 'Stanovy'; break;
				case 'contact': $data['title'] = 'Kontakt'; break;
				case 'about': $data['title'] = 'O nás'; break;
				default: $data['title'] = ''; break;
			}
			
			$this->load->view('container', array_merge($this->data, $data));
        }
}