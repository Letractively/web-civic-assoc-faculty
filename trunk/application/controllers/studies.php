<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Studies extends MY_Controller
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
            'title' 		=> ''   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    /*
     * index
     * 
     * @return      void
     * 
     */
    public function index()
    {
        
    }
    
    public function add()
    {
        parent::add('add_study_program', $this->router->class, $this->router->method);
        
        $this->load->model('selecter');
        
        $data = array(
            'view'              => "{$this->router->class}_view",
            'study_programs'    => $this->selecter->get_study_programs()
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function edit($study_id)
    {
        
    }
    
    public function delete($study_id)
    {
        
    }
    
}

/* End of file studies.php */
/* Location: ./application/controllers/studies.php */