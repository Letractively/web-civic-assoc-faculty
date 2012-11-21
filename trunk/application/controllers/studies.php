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
        parent::delete('remove_study_program', $study_id, $this->router->class);
            
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$study_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
}

/* End of file studies.php */
/* Location: ./application/controllers/studies.php */