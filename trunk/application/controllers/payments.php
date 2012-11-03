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
    public function index($pay_id = 0)
    {
        
    }
    
    public function paid($pay_id = 0)
    {
        
    }
    
    public function nopaid($pay_id = 0)
    {
        
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