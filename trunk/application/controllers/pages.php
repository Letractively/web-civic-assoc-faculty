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
			$this->load->view($this->router->class.'_'.$view.'_'.'view');
        }
}