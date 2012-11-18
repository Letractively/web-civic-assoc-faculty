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
        $this->load->model('selecter');
        
        $data = array(
            'view'      => "{$this->router->class}_view",
            'posts'     => $this->selecter->get_posts()
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function detail( $post_id )
    {
        $this->load->model('selecter');
        
        $data = array(
            'post_detail'   => $this->selecter->get_post_detail( $post_id )
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function add()
    {
        
    }
    
    public function edit( $post_id )
    {
        
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