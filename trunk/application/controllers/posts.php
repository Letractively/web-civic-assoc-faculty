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
            'title' 		=> 'Aktuality'   //Title na aktualnej stranke
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
        $data = array(
            'view'      => "{$this->router->class}_view"
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function detail( $post_id )
    {
        $this->load->view('container', $this->data);
    }
    
    public function add()
    {
        parent::add('add_post', $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data);
    }
    
    public function edit( $post_id )
    {
        parent::edit('edit_posts', $post_id, $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data);
    }
    
    public function delete( $post_id )
    {
        
    }
    
    public function modifiers( $post_id )
    {
        
    }
    
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */