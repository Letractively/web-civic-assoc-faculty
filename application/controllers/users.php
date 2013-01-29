<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Controller
{
    private $start_offset = 60;
    private $actual_year = 2012;
    private $end_offset = 50;
    
    protected $c_pagination         = array();
    protected $get_query            = array();
    protected $per_page             = 3;
    protected $totalRows            = 0;
    /*
     * Constructor
     * 
     * @return      void
     * 
     */
    function __construct() 
    {
        parent::__construct();
        $this->get_query = ( $_GET ) ? '?' . http_build_query($_GET) : '';
        
        $this->load->model('selecter');
        $data = array(
            'title' 		=> 'Užívatelia'
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    /*
     * index
     * 
     * @return      void
     * 
     */
    public function index( $page = 0 )
    {
        $this->load->library('pagination');
        $this->totalRows = $this->selecter->UsersInDatabase('users', 'user_id', 0);
            
        $this->c_pagination['base_url']     = base_url().'users/';
        $this->c_pagination['cur_page']     = $page;
        $this->c_pagination['per_page']     = $this->per_page;
        $this->c_pagination['total_rows']   = $this->totalRows;
        $this->pagination->initialize($this->c_pagination);
        
        $data = array(
            'flag'              => 0,
            'view'              => $this->router->class.'_view',
            'c_pagination'      => $this->c_pagination,
            'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function admins( $page = 0 )
    {
        $this->load->library('pagination');
        $this->totalRows = $this->selecter->UsersInDatabase('users', 'user_id', ROLE_ADMIN);
            
        $this->c_pagination['base_url']     = base_url().'users/admins';
        $this->c_pagination['cur_page']     = $page;
        $this->c_pagination['per_page']     = $this->per_page;
        $this->c_pagination['total_rows']   = $this->totalRows;
        $this->pagination->initialize($this->c_pagination);
        
        $data = array(
            'flag'              => ROLE_ADMIN,
            'view'              => "{$this->router->class}_view",
            'c_pagination'      => $this->c_pagination,
            'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function members( $page = 0 )
    {
        $this->load->library('pagination');
        $this->totalRows = $this->selecter->UsersInDatabase('users', 'user_id', ROLE_OZ_MEMBER);
            
        $this->c_pagination['base_url']     = base_url().'users/members/';
        $this->c_pagination['cur_page']     = $page;
        $this->c_pagination['per_page']     = $this->per_page;
        $this->c_pagination['total_rows']   = $this->totalRows;
        $this->pagination->initialize($this->c_pagination);
        
        $data = array(
            'flag'              => ROLE_OZ_MEMBER,
            'view'              => "{$this->router->class}_view",
            'c_pagination'      => $this->c_pagination,
            'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function potentials( $page = 0 )
    {
        $this->load->library('pagination');
        $this->totalRows = $this->selecter->UsersInDatabase('users', 'user_id', ROLE_PO_MEMBER);
            
        $this->c_pagination['base_url']     = base_url().'users/potentials/';
        $this->c_pagination['cur_page']     = $page;
        $this->c_pagination['per_page']     = $this->per_page;
        $this->c_pagination['total_rows']   = $this->totalRows;
        $this->pagination->initialize($this->c_pagination);
        
        $data = array(
            'flag'              => ROLE_PO_MEMBER,
            'view'              => "{$this->router->class}_view",
            'c_pagination'      => $this->c_pagination,
            'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
        );
        $this->load->view('container', array_merge($this->data, $data)); 
    }
    
    public function innactive( $page = 0 )
    {
        $this->load->library('pagination');
        $this->totalRows = $this->selecter->UsersInDatabase('users', 'user_id', ROLE_INACTIVE);
            
        $this->c_pagination['base_url']     = base_url().'users/innactive/';
        $this->c_pagination['cur_page']     = $page;
        $this->c_pagination['per_page']     = $this->per_page;
        $this->c_pagination['total_rows']   = $this->totalRows;
        $this->pagination->initialize($this->c_pagination);
        
        $data = array(
            'flag'              => ROLE_INACTIVE,
            'view'              => "{$this->router->class}_view",
            'c_pagination'      => $this->c_pagination,
            'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
        );
        $this->load->view('container', array_merge($this->data, $data));
    }
    
    public function detail( $user_id )
    {
        if( !$this->selecter->exists('users','user_id', $user_id) )
            redirect('404');
        if( $user_id == '')
            redirect( $this->router->class );
        
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
       
        if ( $this->input->post('submit') )
        {
             if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
             {
                 if($this->input->post('hidden_payment') == 1)
                 {
                    $this->form_validation->set_rules('vs','lang:label_vs','trim|required|integer|min_length[4]|max_length[10]');
                    $this->form_validation->set_rules('total_sum','lang:label_total_tum','trim|required|xss_clean|greater_or_equal_than[5]');
                    foreach ($this->input->post('categories') as $cat_id => $ratio)
                    {
                        $this->form_validation->set_rules('categories[$cat_id]','lang:label_proj_category','trim|xss_clean|numeric');
                    }
                    if( $this->form_validation->run() )
                    {
                        $this->load->model('inserter');
                        $this->inserter->add_user($this->input->post());
                        redirect($this->router->class);
                    }
                 }
             }
        }
        $this->load->model('selecter');
        
        $data = array(
                'error'         => $this->form_validation->form_required(array( 'name', 'surname', 'username', 'password', 'password_again', 
                                                                                'email', 'phone', 'place_of_birth', 'postcode', 'degree_year',
                                                                                'vs','total_sum')
                                                                        ),       
                'years'                 => $this->generate_years($this->start_offset, $this->actual_year, $this->end_offset),
                'title' 		=> $this->lang->line('title_add_user') 
        );
        $this->load->view('container', array_merge($this->data, $data));
        
    }
    
    public function edit( $user_id )
    {
        if( !$this->selecter->exists('users','user_id', $user_id) )
            redirect('404');
        if( $user_id == '')
            redirect( $this->router->class );
        
        if( $this->userdata->is_admin() || $user_id == $this->session->userdata('user') )
        {
            if ( $this->input->post( $submit = 'submit' ) )
            {
                if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
                {
                    $this->load->model('updater');
                    $this->updater->edit_user( $user_id, $this->input->post() );
                    redirect( $this->router->class );
                }
            }
        }
        else
            redirect ( base_url () );

        $data = array(
            'user_id'       => $user_id,
            'error'         => $this->form_validation->form_required(array( 'username', 'name','surname', 'email', 
                                                                            'phone', 'place_of_birth', 'postcode', 'degree_year'
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
            redirect( $this->router->class );
        
        parent::delete( 'remove_user', $user_id );
        
        $data = array(
            'view'            => 'confirm_view',
            'type'            => 'delete',
            'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
            'method'          => $this->router->class.'/'.$this->router->method.'/'.$user_id
        );
            
        $this->load->view('container', array_merge($this->data, $data));
    } 
}
    

/* End of file users.php */
/* Location: ./application/controllers/users.php */