<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_types extends MY_Controller
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
        
        if( !$this->userdata->is_admin() )
                redirect(base_url());
        
        $data = array(
            'title' 		=> 'Typy emailov'   //Title na aktualnej stranke
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
        $this->load->model('selecter');
        
        $data = array(
            'view'          => "{$this->router->class}_view",
            'email_types'   => $this->selecter->get_email_types()
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function add()
    {
        $this->load->model('inserter');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->inserter->add_email_type( $this->input->post() );
                redirect('email_types');
            }
        }
        
        $data = array(
            'view'      => "{$this->router->class}_view"
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function edit($email_type_id)
    {
        $this->load->model('updater');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->inserter->edit_email_type( $email_type_id, $this->input->post() );
                redirect('email_types');
            }
        }
        
        $data = array(
            'view'      => "{$this->router->class}_view"
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function delete($email_type_id)
    {
        
    }
}

/* End of file email_types.php */
/* Location: ./application/controllers/email_types.php */