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
            'view'      => "{$this->router->class}_view"
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function detail( $post_id )
    {
        $this->load->model('selecter');
        
        $data = array(
            'post_id'       => $post_id
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function add()
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        parent::add('add_post', $this->router->class, $this->router->method);
        
        $data = array(
            'error'         => $this->form_validation->form_required(array('title','content','priority')),
            'buttons'       => get_bbcode_buttons()
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function edit( $post_id )
    {
        if( $post_id == '')
            redirect('404');
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        parent::edit('edit_posts', $post_id, $this->router->class, $this->router->method);
        
        $this->load->model('selecter');
        
        
        $data = array(
            'post_id'       => $post_id,
            'error'         => $this->form_validation->form_required(array('title','content','priority')),
            'buttons'       => get_bbcode_buttons()
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function delete( $post_id )
    {
        if( $post_id == '')
            redirect('404');
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        parent::delete('remove_post', $post_id, $this->router->class);
            
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$this->router->method.'/'.$post_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function modifiers( $post_id )
    {
        $this->load->model('selecter');
        
        $data = array(
            'post_id'       => $post_id
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
}

/* End of file posts.php */
/* Location: ./application/controllers/posts.php */