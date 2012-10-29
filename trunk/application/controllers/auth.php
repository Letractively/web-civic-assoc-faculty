<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{
    
    function __construct() {
        parent::__construct();
        $this->load->model('musers');
        
        $data = array(
            'view' 		=> "{$this->router->class}_{$this->router->method}",
            'title' 		=> 'Homepage'   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function index()
    {
        $data = array( 
            'view'       => "{$this->router->class}"
        );
        
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function registration()
    {
        $this->load->model('mstudy_programs');
        $this->load->model('mdegrees');
        $this->load->model('mplaces');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") == TRUE )
            {
                $this->form_validation->set_error_delimiters('<p class="validation_error">', '</p>');
                if( $this->musers->check_login($this->input->post('email')) == TRUE )
                {
                    if( $this->musers->{$this->router->method}() == TRUE )
                    {
                        //redirect na show_message view
                    }
          
                }
            }else
                        echo 'Daco sa porantalo<br /><br />';
        }
        
        //array_debug($this->mstudy_programs->all());
        
        $data = array(
            'error'         => $this->form_validation->form_required(array('name','surname','username', 'password', 'password_again', 'email', 'phone','study_program_id', 'degree_id', 'place_of_birth_id', 'postcode', 'degree_year')),
            'programs'      => $this->recompile_into_array($this->mstudy_programs->all(), 'study_program_id', 'study_program_name'),
            'degrees'       => $this->recompile_into_array($this->mdegrees->all(), 'degree_id', 'degree_name'),
            'places'        => $this->recompile_into_array($this->mplaces->all(), 'place_of_birth_id', 'place_of_birth_name'),
        );
        
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function login()
    {
        
    }
    
    public function logout()
    {
        
    }
    
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */