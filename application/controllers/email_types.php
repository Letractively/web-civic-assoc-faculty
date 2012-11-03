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
        
    }
    
    public function edit($email_type_id)
    {
        
    }
    
    public function delete($email_type_id)
    {
        
    }
}

/* End of file email_types.php */
/* Location: ./application/controllers/email_types.php */