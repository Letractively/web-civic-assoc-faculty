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
            'title' 		=> 'Kategórie udalostí'   //Title na aktualnej stranke
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
            'view'              => "{$this->router->class}_view",
            'event_categories'  => $this->selecter->get_event_categories()
        );
        
        $this->load->view('container', array_merge($this->data, $data));   
    }
    
    public function add()
    {
        /*$this->load->model('inserter');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->inserter->add_event_category( $this->input->post() );
                redirect("{$this->router->class}");
            }
        }*/
        
        parent::add('add_event_category', $this->router->class, $this->router->method);
        
        $this->load->model('selecter');
        
        $data = array(
            'view'              => "{$this->router->class}_view",
            'event_categories'  => $this->selecter->get_event_categories()        
        );
            
        $this->load->view('container', array_merge($this->data, $data));   
    }
    
    public function edit($event_category_id)
    {
        $this->load->model('updater');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->updater->edit_event_category($event_category_id, $this->input->post() );
                redirect("{$this->router->class}");
            }
        }
        
        $data = array(
            'view'              => "{$this->router->class}_view"
        );
        $this->load->view('container', array_merge($this->data, $data));   
    }
    
    public function delete($event_category_id)
    {
        
    }
    
}

/* End of file event_categories.php */
/* Location: ./application/controllers/event_categories.php */