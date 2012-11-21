<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{
    protected $data 			= array();
    public $language                    = '';

    /*
     * Constructor
     * 
     * Toto je konstruktor, ktory sa zavola po nacitani aplikacie, ked sa spusti
     * tak najprv zavola konstruktor jej nadradenej classy (CI_Controller)
     * 
     * @access      private
     * 
     */
    public function __construct()
    {
	parent::__construct();
        
        $data = array(
            'view'  => $this->router->class.'_'.$this->router->method.'_view',
	);
        
        $this->data = array_merge($this->data, $data);
        $this->load_languages();
    }
    
    /*
     * load_languages
     * 
     * Tato funkcia nacita vsetky potrebne language files z priecinku language
     * prvy load je default lang file, ktory obsahuje jazykove polozky, ktore su
     * dostupne skrz celu aplikacie v hociktorom controllery,modely alebo view
     * Druhy loaduje lang file daneho controllera, ktory obsahuje jazykove 
     * polozky, ktore su dostupne len v danom controllery(vo vsetkych metodach 
     * daneho controllera)
     * Treti lang file zabezpecuje nacitanie databazovych hlasok, ktore su 
     * dostupne, skrz celu aplikaciu, sluzia na logovanie udalosti do databazy
     * 
     * @access      public
     * @return      void
     */
    protected function load_languages()
    {
        $this->lang->load('default', $this->language);
        $this->lang->load("{$this->router->class}", $this->language);
        $this->lang->load('db_message',$this->language);
    }
    
    /*
     * recompile_into_array
     * 
     * Tato funkcia prerobi vstupne pole objektov na pole kluc => hodnota, ktore
     * sa pouziva v comboboxe na view (form_dropdown()). Pricom kluc je zvacsa
     * daka ciselna hodnota (integer - ID z DB).
     * 
     * @access      public
     * @param       array
     * @param       mixed
     * @param       mixed
     * @return      array
     */
    protected function recompile_into_array($array, $key, $value)
    {
        $result = array();
        
        foreach ($array as $obj) 
        {
            $result[$obj->$key]   =   $obj->$value;
        }
        
        return $result;
    }
    
    /*
     * generate_years
     * 
     * Tato funkcia sluzi na vygenerovanie rokov v urcitom casovom useku. Aky
     * velky bude tento casovy usek, zalezi od vstupnych parametrov
     * 
     * @access      public
     * @param       integer
     * @param       integer
     * @param       integer
     * @return      array
     */
    protected function generate_years($back, $default, $forward)
    {
        $result = array();
        $gen_year_start = $default-$back;
        
        for($i = 1; $i <= $back+$forward; $i++)
        {
            $result[$i] = $gen_year_start++;
        }
        
        return $result;
    }
    
    protected function generate_priorities( $how_much )
    {
        $result = array();
        for($i = 1; $i <= $how_much; $i++)
        {
            $result[$i] = $i;
        }
        
        return $result;
    }
    
    protected function add( $method, $class_valid, $method_valid )
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $this->load->model('inserter');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$class_valid}/{$method_valid}") )
            {
                $this->inserter->$method( $this->input->post() );
                redirect( $class_valid );
            }
        }
    }
    
    protected function add_param( $method, $id, $class_valid, $method_valid )
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $this->load->model('inserter');
        
        if( $this->input->post('submit') )
        {
            if( $this->form_validation->run("{$class_valid}/{$method_valid}") )
            {
                $this->inserter->$method( $id, $this->input->post() );
                redirect( $class_valid );
            }
        }
    }
    
    protected function edit( $method, $id, $class_valid, $method_valid )
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $this->load->model('updater');
        
        if( $this->form_validation->run("{$class_valid}/{$method_valid}") )
        {
            $this->updater->$method( $id, $this->input->post() );
                redirect( $class_valid );
        }
    }
    
    protected function delete( $method, $id, $class_valid )
    {
        if( $id == '')
            redirect ('404');
        
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $action = $this->input->post('submit_action');
        
        $this->load->model('deleter');
        
        if( $action == $this->lang->line('confirm_yes') )
        {
            $this->deleter->$method($id);
            redirect($class_valid);
        }
        elseif( $action == $this->lang->line('confirm_no') )
            redirect($class_valid);
    }
    
    protected function delete_param( $method, $id, $param, $class_valid )
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $action = $this->input->post('submit_action');
        
        $this->load->model('deleter');
        
        if( $action == $this->lang->line('confirm_yes') )
        {
            $this->deleter->$method($id, $param);
            redirect($class_valid.'/'.$param);
        }
        elseif( $action == $this->lang->line('confirm_no') )
            redirect($class_valid.'/'.$param);
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
