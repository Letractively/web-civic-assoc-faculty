<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller
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
        $this->load->model('users_model');
        
        $data = array(
            'title' 		=> 'Homepage'   //Title na aktualnej stranke
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
     * @access      public
     * @return      void
     */
    public function registration()
    {
        $this->load->model('study_programs_model');
        $this->load->model('degrees_model');
        $this->load->model('places_model');
        $this->load->model('project_categories_model');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") == TRUE )
            {
                if( $this->musers->check_unique_email($this->input->post('email')) == TRUE )
                {
                    $params = array(
                        'event'     =>    $this->lang->line('add_user_system') 
                    );
                    if(  $this->musers->registration( $this->input->post(), $params  ) == TRUE )
                    {   
                        redirect('show_message/index/'.$this->lang->line('success_registration'));
                        //echo 'success<br />';
                        //redirect na show_message view s hlaskou success
                    }
                    else{ echo 'error1';/* redirect na show_message view s hlaskou DB add error*/}
                }
                else{ echo 'error2';/*redirect na show_message view s hlaskou error*/}
            }
            else{ echo 'error3';/*redirect na show_message view s hlaskou error*/}          
        }
        
        $data = array(
            'error'         => $this->form_validation->form_required(array( 'name', 'surname', 'username', 'password', 'password_again', 
                                                                            'email', 'phone', 'study_program_id', 'degree_id', 
                                                                            'place_of_birth_id', 'postcode', 'degree_year',
                                                                            'vs','total_sum', 'project_category_1', 'project_category_2','project_category_3','project_category_4',
                                                                            'project_category_5', 'project_category_6')
                                                                    ),
            'numb_proj_cat' => $this->project_categories_model->count_project_categories(),
            'programs'      => $this->recompile_into_array($this->study_programs_model->all(), 'study_program_id', 'study_program_name'),
            'degrees'       => $this->recompile_into_array($this->degrees_model->all(), 'degree_id', 'degree_name'),
            'places'        => $this->recompile_into_array($this->places_model->all(), 'place_of_birth_id', 'place_of_birth_name'),
            'years'         => $this->generate_years(60, 2012, 50)
       );
        
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    /*
     * login
     * 
     * Funkcia prihlasi navstevnika stranky do aplikacie
     * 
     * @access      public
     * @return      void         
     */
    public function login()
    {
        
    }
    
    /*
     * logout
     * 
     * Funkcia odhlasi pouzivatela z aplikacie
     * 
     * @access      public
     * @return      void
     */
    public function logout()
    {
        
    }
    
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */