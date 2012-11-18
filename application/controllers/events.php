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
        public function index( $event_id = 0 )
        {
            $this->load->model('selecter');
            
            $data = array(
                'view'      => "{$this->router->class}_view",
                'events'      => $this->selecter->get_events( $event_id )
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
            
            $data = array(
                'event_detail'      => $this->selecter->get_event_detail( $event_id )
            );
            $this->load->view('container', array_merge($this->data, $data));
        }

        public function add()
        {
            if( !$this->userdata->is_admin() )
                redirect(base_url());

            /*$this->load->model('inserter');

            if( $this->input->post('submit') )
            {
                if( $this->form_validation("{$this->router->class}/{$this->router->method}") )
                {
                    $this->inserter->add_event( $this->input->post() );
                    redirect('events/index');
                }
            }*/
            
            parent::add('add_event', $this->router->class, $this->router->method);
            
            $this->load->model('selecter');

            $data = array(
                'event_categories'      => $this->selecter->get_event_categories(),
                'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        public function edit( $event_id )
        {        
            if( !$this->userdata->is_admin() )
                    redirect(base_url());

            $this->load->model('updater');

            if( $this->input->post('submit') )
            {
                if( $this->form_validation("{$this->router->class}/{$this->router->method}") )
                {
                    $this->updater->edit_event( $event_id, $this->input->post() );
                    redirect('events/index');
                }
            }

            $data = array(
                'event_categories'      => $this->selecter->get_event_categories(),
                'priorities'            => $this->generate_priorities(5)
            );

            $this->load->view('container', array_merge($this->data, $data));
        }

        public function delete( $event_id )
        {
            if( !$this->userdata->is_admin() )
                redirect(base_url());

            $this->load->model('deleter');
            $this->deleter->remove_event( $event_id );
            redirect('events/index');                
        }
}

/* End of file events.php */
/* Location: ./application/controllers/events.php */