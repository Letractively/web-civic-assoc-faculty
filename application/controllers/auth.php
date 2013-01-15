<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
{
 
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         */
        function __construct() 
        {
            parent::__construct();

            $data = array(
                'title' 		=> $this->lang->line('title')   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         */
        public function index()
        {      
            $this->load->model('selecter');
            $this->load->model('inserter');
            $data = array( 
                'view'       => "{$this->router->class}_view"  
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /*
         * registration
         * 
         * Tato funkcia registruje navstevnika stranky do systemu obcianskeho
         * zdruzenia a zaradi ho na listinu schvalovania administratorom, ktory ho
         * schvali manualne ked pride platba. Taktiez prerozdeli jeho peniaze medzi
         * kategorie tak ako si on zelal
         * 
         */
        public function registration()
        {
            if( $this->userdata->is_logged() )
                redirect(base_url ());
            $this->load->model('selecter');
            $this->load->model('inserter');

            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") == TRUE )
                {
                    if(  $this->inserter->add_register( $this->input->post() ) == TRUE )
                    {
                        redirect('show_message/index/success_registration');
                    }       
                }      
            }

            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'name', 'surname', 'username', 'password', 'password_again', 
                                                                                'email', 'phone', 'study_program_id', 'degree_id', 
                                                                                'place_of_birth', 'postcode', 'degree_year',
                                                                                'vs','total_sum')
                                                                                ),     
                'years'                 => $this->generate_years(60, 2012, 50),
                'title' 		=> $this->lang->line('title_registration')   //Title na aktualnej stranke
           );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /*
         * login
         * 
         * Funkcia prihlasi navstevnika stranky do aplikacie
         *    
         */
        public function login()
        {
            
            $this->load->model('selecter');
            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
                {
                    if ( $this->selecter->is_activated( $this->input->post() ) )
                    {
                        $user_obj = $this->selecter->get_login( $this->input->post() );

                        if( !empty($user_obj) )
                        {
                            $this->session->set_userdata( array('user' => $user_obj->user_id, 'logged_in' => TRUE, 'user_role' => $user_obj->user_role) );
                            if( $user_obj->user_role == 1 )
                                $this->session->set_userdata( array('admin' => TRUE) );     
                        }
                        else                
                            redirect('show_message/index/error_input');
                    }
                    else
                        redirect('show_message/index/inactive_registration');
                }
                else
                    redirect('show_message/index/error_validation');
            }
            redirect('auth');
        }

        /*
         * logout
         * 
         * Funkcia odhlasi pouzivatela z aplikacie
         * 
         */
        public function logout()
        {
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('admin');
            $this->session->unset_userdata('user');
            redirect(base_url());
        }

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */