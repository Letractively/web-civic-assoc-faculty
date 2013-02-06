<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Alumni FMFI
 * 
 * Aplikacia na spravu OZ Alumni FMFI
 *
 * @package		AlumniFMFI
 * @author		Tutifruty Team
 * @link		http://kempelen.ii.fmph.uniba.sk
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Auth class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Auth
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------

class Auth extends MY_Controller
{
 
        /**
	 * Constructor
	 */
        function __construct() 
        {
            parent::__construct();
            $this->load->model('selecter');
            
            $data = array(
                'title' 	=> $this->lang->line('title'),
                'page'          => ""
            );

            $this->data = array_merge($this->data, $data);
        }

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access      public
         * @return      void
         */
        public function index()
        {               
            $data = array( 
                'view'       => "{$this->router->class}_view"
            );
                
            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /**
         * registration
         * 
         * Tato funkcia registruje navstevnika stranky do systemu obcianskeho
         * zdruzenia a zaradi ho na listinu schvalovania administratorom, ktory ho
         * schvali manualne ked pride platba. Taktiez prerozdeli jeho peniaze medzi
         * kategorie tak ako si on zelal
         * 
         * @access      public
         * @return      void
         */
        public function registration()
        {
            if( $this->userdata->is_logged() )
                redirect ('show_message/index/error_logged');
            
            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") == TRUE )
                {
                    foreach ($this->input->post('categories') as $cat_id => $ratio)
                    {
                        $this->form_validation->set_rules('categories['.$cat_id.']','lang:table_th_ratio','trim|xss_clean|numeric|is_natural');
                    }
                    if( $this->form_validation->run())
                    {
                        $this->load->model('inserter');
                        if(  $this->inserter->add_register( $this->input->post() ) == TRUE  )
                        {
                            redirect('show_message/index/success_registration');
                        }
                        else
                            redirect('show_message/index/error_registration');
                    }                           
                }      
            }
            
            $data = array(
                'error'                 => $this->form_validation->form_required(array( 'name', 'surname', 'username', 'password', 'password_again', 
                                                                                'email', 'degree_year',
                                                                                'vs','total_sum')
                                                                                ),     
                'years'                 => $this->generate_years(60, 2012, 50),
                'title' 		=> $this->lang->line('title_registration')
           );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /**
         * login
         * 
         * Funkcia prihlasi navstevnika stranky do aplikacie
         * 
         * @access      public
         * @return      void   
         */
        public function login()
        {
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

        /**
         * logout
         * 
         * Funkcia odhlasi pouzivatela z aplikacie
         * 
         * @access      public
         * @return      void
         */
        public function logout()
        {
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('admin');
            $this->session->unset_userdata('user');
            redirect(base_url());
        }
        
        /**
         * reset_password
         * 
         * Funkcia zresetuje heslo pouzivatela  a posle mu nove na emailovu adresu
         * uvedenu pri registracii
         * 
         * @access      public
         * @return      void
         */
        public function reset_password()
        {
            if( $this->userdata->is_logged() )
                redirect(base_url());
            
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->load->helper('string');
                $new_password = random_string('alnum', 10);
                
                $this->load->library('email');
                $this->email->from( $this->userdata->root_email(), $this->lang->line('reset_sender') );
                $this->email->to( $this->input->post('email') ); 
                $this->email->subject( $this->lang->line('reset_subject') );
                $this->email->message( $this->lang->line('reset_message_start').$new_password.$this->lang->line('reset_message_end'));
                $this->email->send();
            }
            
            $data = array(
                'error'             => $this->form_validation->form_required(array('username', 'password','email')),     
                'view'              => 'auth_resetPassword_view',
                'title'             => $this->lang->line('reset_title')
            );
            
            $this->load->view('container', array_merge($this->data, $data)); 
        }
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */