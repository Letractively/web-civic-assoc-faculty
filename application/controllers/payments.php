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
            'title' 		=> 'Platby'   //Title na aktualnej stranke
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
        
        $this->load->model('selecter');
        
        $data = array(
            'view'              => "{$this->router->class}_view"
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function edit($pay_id)
    {
        
    }
    
    public function delete($pay_id)
    {
        
    }
    
}

/* End of file payments.php */
/* Location: ./application/controllers/payments.php */