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
            'title' 		=> 'Typy emailov',   //Title na aktualnej stranke
            'view'          => "{$this->router->class}_view"
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
        parent::add('add_email_type', $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data);
    }
    
    public function edit($email_type_id)
    {
        parent::edit('edit_email_type', $email_type_id, $this->router->class, $this->router->method);
            
        $this->load->view('container', $this->data);
    }
    
    public function delete($email_type_id)
    {
        if( $email_type_id == '')
                redirect ('404');
            
        parent::delete('remove_email_type', $email_type_id, $this->router->class);
            
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$email_type_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
}

/* End of file email_types.php */
/* Location: ./application/controllers/email_types.php */