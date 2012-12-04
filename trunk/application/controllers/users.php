<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
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
    public function index()
    {
        $this->load->view('container', $this->data);
    }
    
    public function detail( $user_id )
    {
        $this->load->model('selecter');
        $data = array(
            'user_id'      => $user_id
        );
        
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function add()
    {
        $this->load->model('selecter');
        $data = array(
            'error'         => $this->form_validation->form_required(array( 'name', 'surname', 'username', 'password', 'password_again', 
                                                                                'email', 'phone', 'study_program_id', 'degree_id', 
                                                                                'place_of_birth', 'postcode', 'degree_year',
                                                                                'vs','total_sum', 'project_category_1', 'project_category_2','project_category_3','project_category_4',
                                                                                'project_category_5', 'project_category_6','oz_member','ex_member','lecturer','degrees_id','vs_box')
                                                                        ),
            'numb_proj_cat'         => $this->selecter->count_project_categories(),        
                'years'                 => $this->generate_years(60, 2012, 50),
                'title' 		=> $this->lang->line('title_add_user') 
        );
        $this->load->view('container', array_merge($this->data, $data));
        
    }
    
    public function edit( $user_id )
    {
        $data = array(
            'user_id'   => $user_id
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function delete( $user_id )
    {
        parent::delete('remove_user', $user_id, $this->router->class);
        
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$user_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
}
    

/* End of file users.php */
/* Location: ./application/controllers/users.php */