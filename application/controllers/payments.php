<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MY_Controller
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
            'title' 		=> 'Platby',   //Title na aktualnej stranke
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
    public function index($pay_id = 0)
    {
        $this->load->view('container', $this->data); 
    }
    
    public function paid($pay_id = 0)
    {
        
    }
    
    public function nopaid($pay_id = 0)
    {
        
    }
    
    public function add()
    {
        parent::add('add_payments', $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data); 
    }
    
    public function edit($pay_id)
    {
        parent::edit('edit_payments', $pay_id, $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data); 
    }
    
    public function delete( $pay_id )
    {
        parent::delete('remove_payments', $pay_id, $this->router->class);
            
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$pay_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
}

/* End of file payments.php */
/* Location: ./application/controllers/payments.php */