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
            'title' 		=> 'Štúdijné programy',   //Title na aktualnej stranke
            'view'              => "{$this->router->class}_view"
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
        $this->load->view('container', $this->data);
    }
    
    public function add()
    {
        parent::add('add_study_program', $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data);
    }
    
    public function edit( $study_id )
    {
        parent::edit('edit_study_program', $study_id, $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data);
    }
    
    public function delete( $study_id )
    {
        
    }
    
}

/* End of file studies.php */
/* Location: ./application/controllers/studies.php */