<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends MY_Controller
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
    
    public function detail($post_id)
    {
        
    }
    
    public function add()
    {
        
    }
    
    public function edit($post_id)
    {
        
    }
    
    public function delete($post_id)
    {
        
    }
    
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */