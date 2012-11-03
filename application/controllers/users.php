<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
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
    
    public function detail($user_id)
    {
        
    }
    
    public function add()
    {
        
    }
    
    public function edit($user_id)
    {
        
    }
    
    public function delete($user_id)
    {
        
    }
    
}
    

/* End of file users.php */
/* Location: ./application/controllers/users.php */