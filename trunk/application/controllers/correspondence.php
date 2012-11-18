<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Correspondence extends MY_Controller
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
                'title' 		=> ''   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        public function index()
        {
            $this->load->model('selecter');

            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
                {
                    //FLOWCHART
                }
            }

            $data = array( 
                'view'          => "{$this->router->class}_view",
                'email_types'   => $this->selecter->get_email_types()
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        public function review()
        {
            $data = array(

            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }
}

/* End of file correspondence.php */
/* Location: ./application/controllers/correspondence.php */