<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{
    private $start_offset = 60;
    private $actual_year = 2012;
    private $end_offset = 50;
    /*
     * Constructor
     * 
     * @return      void
     * 
     */
    function __construct() 
    {
        parent::__construct();
        $this->load->model('selecter');
        $data = array(
            'title' 		=> 'Užívatelia'   //Title na aktualnej stranke
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
            'flag'              => 0,
            'view'              => $this->router->class.'_view'
        );
        $this->load->view('container', array_merge($this->data, $data));
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
        if( !$this->userdata->is_admin() )
            redirect(base_url ());
       
        $this->load->model('selecter');
        
        parent::add( 'add_user' );
        $data = array(
            'error'         => $this->form_validation->form_required(array( 'name', 'surname', 'username', 'password', 'password_again', 
                                                                                'email', 'phone', 'study_program_id', 'degree_id', 
                                                                                'place_of_birth', 'postcode', 'degree_year',
                                                                                'vs','total_sum', 'project_category_1', 'project_category_2','project_category_3','project_category_4',
                                                                                'project_category_5', 'project_category_6','oz_member','ex_member','lecturer','admin','degrees_id','vs_box','role')
                                                                        ),
//            'numb_proj_cat'         => $this->selecter->count_project_categories(),        
                'years'                 => $this->generate_years($this->start_offset, $this->actual_year, $this->end_offset),
                'title' 		=> $this->lang->line('title_add_user') 
        );
        $this->load->view('container', array_merge($this->data, $data));
        
    }
    
    public function edit( $user_id )
    {
        if( $user_id == '')
            redirect('404');
        
        parent::edit( 'edit_user', $user_id );
        $data = array(
            'user_id'       => $user_id,
            'error'         => $this->form_validation->form_required(array( 'username', 'name','surname', /*'password',*/'email', 
                                                                            'phone', 'place_of_birth', 'postcode', 'degree_year',
                                                                          )
                                                                        ),
            'years'         => $this->generate_years($this->start_offset, $this->actual_year, $this->end_offset)
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function delete( $user_id )
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url ());
        
        if( $user_id == '')
            redirect('404');
        
        parent::delete('remove_user', $user_id, $this->router->class);
        
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$this->router->method.'/'.$user_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function members()
    {
        $data = array(
            'flag'              => ROLE_OZ_MEMBER,
            'view'              => "{$this->router->class}_view"
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function visitors()
    {
        $data = array(
            'flag'              => ROLE_EX_MEMBER,
            'view'              => "{$this->router->class}_view"
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function lecturers()
    {
        $data = array(
            'flag'              => ROLE_LECTURER,
            'view'              => "{$this->router->class}_view"
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
	
	public function admins()
    {
        $data = array(
            'flag'              => ROLE_ADMIN,
            'view'              => "{$this->router->class}_view"
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
}
    

/* End of file users.php */
/* Location: ./application/controllers/users.php */