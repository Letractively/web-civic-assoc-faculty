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
    
    public function detail( $user_id )
    {
        
    }
    
    public function add()
    {
        
    }
    
    public function edit( $user_id )
    {
        
    }
    
    public function delete( $user_id )
    {
        parent::delete('remove_user', $user_id, $this->router->class);
        
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$user_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
}
    

/* End of file users.php */
/* Location: ./application/controllers/users.php */