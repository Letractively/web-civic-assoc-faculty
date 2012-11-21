<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_categories extends MY_Controller
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
            'title' 		=> 'Kategórie udalostí',   //Title na aktualnej stranke
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
    public function index()
    {       
        $this->load->view('container', array_merge($this->data, $data));   
    }
    
    public function add()
    {        
        parent::add('add_event_category', $this->router->class, $this->router->method);
        
        $this->load->view('container', $this->data);   
    }
    
    public function edit( $event_category_id )
    {
        parent::edit('edit_event_category', $event_category_id, $this->router->class, $this->router->method);
               
        $this->load->view('container', $this->data);   
    }
    
    public function delete( $event_category_id )
    {
        parent::delete('remove_event_category', $event_category_id, $this->router->class);
            
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$event_category_id
        );
            
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
}

/* End of file event_categories.php */
/* Location: ./application/controllers/event_categories.php */