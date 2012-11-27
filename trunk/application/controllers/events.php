<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_Controller
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
                'title' 		=> 'Udalosti'   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * @return      void
         * 
         */
        public function index( $event_id = 0 )
        {
            $this->load->model('selecter');
            
            $data = array(
                'view'      => "{$this->router->class}_view",
                //'event_id'  => $event_id
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        public function newest( $event_id = 0 )
        {
            $data = array(
                'view'      => "{$this->router->class}_view",
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        public function prior( $event_id = 0 )
        {
            $data = array(
                'view'      => "{$this->router->class}_view",
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        public function detail( $event_id )
        {
            $this->load->model('selecter');
            $this->load->view('container', $this->data );
        }

        public function add()
        {            
            parent::add('add_event', $this->router->class, $this->router->method);

            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'event_categories_id','priority','event_name',
                                                                                        'from','to','about')),
                'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        public function edit( $event_id )
        {        
            parent::edit('edit_event', $event_id, $this->router->class, $this->router->method);
            
            
            
            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'event_categories_id','priority','event_name',
                                                                                        'from','to','about')),
                'priorities'            => $this->generate_priorities(5),
                'event_id' 		=> $event_id
                
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        public function delete( $event_id )
        {
            parent::delete('remove_event', $event_id, $this->router->class);
            
            $data = array(
              'view'            => 'confirm_view',
              'type'            => 'delete',
              'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
              'method'          => $this->router->class.'/'.$event_id
            );
            
            $this->load->view('container', array_merge($this->data, $data));            
        }
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */