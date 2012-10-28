<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
    protected $data 			= array();
    public $language                    = '';

    public function __construct()
    {
	parent::__construct();
        
        $this->load_languages();
    }
    
    public function index()
    {
        $data = array(
            'view'  => $this->router->class,
	);
    }
    
    protected function load_languages()
    {
        $this->lang->load('default', $this->language);
        $this->lang->load("{$this->router->class}", $this->language);
    }
}
// END Sub-Controller class

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
