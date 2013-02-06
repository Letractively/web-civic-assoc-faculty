<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Controller class
 *
 * @package		AlumniFMFI
 * @subpackage          Core
 * @category            Controller
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


abstract class MY_Controller extends CI_Controller
{
    protected   $data                   = array();
    public      $language               = '';
    protected   $priorits               = 5;
    protected   $priorits_name          = array(
                                            'Vysoka',
                                            'Vyssia',
                                            'Stredna',
                                            'Nizsia',
                                            'Nizka'
                                          );

    /**
     * Constructor
     */
    public function __construct()
    {
	parent::__construct();
        
        $data = array(
            'view'      => $this->router->class.'_'.$this->router->method.'_view',
            'error'     => $this->form_validation->form_required(array('username', 'password')) 
	);
        
        $this->data = array_merge($this->data, $data);
        $this->load_languages();
    }
    
    /**
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
     * @access      protected
     * @return      void
     */
    protected function load_languages()
    {
        $this->lang->load('default', $this->language);
        $this->lang->load("{$this->router->class}", $this->language);
        $this->lang->load('db_message',$this->language);
    }
    
    /**
     * recompile_into_array
     * 
     * Tato funkcia prerobi vstupne pole objektov na pole kluc => hodnota, ktore
     * sa pouziva v comboboxe na view (form_dropdown()). Pricom kluc je zvacsa
     * daka ciselna hodnota (integer - ID z DB).
     * 
     * @access      protected
     * @param       array $array Vstupne pole udajov
     * @param       integer $key Kluc vo vyslednom zazname
     * @param       string $value hodnota premennej vo vyslednom zazname
     * @return      array vysledkov
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
    
    /**
     * generate_years
     * 
     * Tato funkcia sluzi na vygenerovanie rokov v urcitom casovom useku. Aky
     * velky bude tento casovy usek, zalezi od vstupnych parametrov
     * 
     * @access      protected
     * @param       integer $back Ciselna hodnota poctu rokov ktore sa vygeneruje od aktualneho roku dozadu 
     * @param       integer $default pociatocny rok od ktoreho sa budu generovat dopredu a dozadu roky
     * @param       integer $forward Ciselna hodnota poctu rokov ktore sa vygeneruje od aktualneho roku dopredu
     * @return      array Vygenerovane roky
     */
    protected function generate_years($back, $default, $forward)
    {
        $result = array();
        $gen_year_start = $default-$back;
        
        for($i = 1; $i <= $back+$forward; $i++)
        {
            $result[$gen_year_start] = $gen_year_start;
            $gen_year_start++;
        }
        
        return $result;
    }
    
    /**
     * generete_priorities
     * 
     * Funkcia vygeneruje urcity pocet priorit
     * 
     * @access      protected
     * @param       integer $how_much pocet priorit ktore sa maju vygenerovat
     * @return      array Vygenerovane priority
     */
    protected function generate_priorities( $how_much )
    {
        $result = array();
        for($i = 1; $i <= $how_much; $i++)
        {
            $result[$i]['id'] = $i;
            $result[$i]['value'] = $this->priorits_name[$i-1];
        }
        
        return $result;
    }
    
    /**
     * add
     * 
     * Funkcia vola modelovu funkciu na pridanie zaznamu do databazy
     * 
     * @access      protected
     * @param       string $method Nazov modelovej funkcie ktora sa ma zavolat
     * @param       string $submit Hodnota odosielacieho tlacidla
     * @return      void
     */
    protected function add( $method, $submit = 'submit')
    {
        if( !$this->userdata->is_admin() )
          redirect(base_url());

        if( $this->input->post($submit) )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {

                $this->load->model('inserter');
                $this->inserter->$method( $this->input->post() );
                redirect($this->router->class);
            }
        }
        
    }
    
    /**
     * add
     * 
     * Funkcia vola modelovu funkciu na pridanie zaznamu do databazy
     * 
     * @access      protected
     * @param       string $method Nazov modelovej funkcie ktora sa ma zavolat
     * @param       integer $id vacsinou foreign key na inu tabulku aby boli udaje konzistentne
     * @param       string $submit Hodnota odosielacieho tlacidla
     * @return      void
     */
    protected function add_param( $method, $id, $submit = 'submit')
    {
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $this->load->model('inserter');
        
        if( $this->input->post( $submit ) )
        {
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->inserter->$method( $id, $this->input->post() );
                redirect( $this->router->class );
            }
        }
    }
    
    /**
     * edit
     * 
     * Funkcia vola prislusnu modelovu funkciu na upravenie zaznamu v databaze
     * 
     * @access      protected
     * @param       string $method Nazov metody ktora sa ma zavolat
     * @param       integer $id ID zaznamu ktory sa ma upravit
     * @param       string $submit Hodnota odosielacieho submit buttonu defaultne je submit
     * @return      void
     */
    protected function edit( $method, $id, $submit = 'submit' )
    {
        if( $id == '')
            redirect ('404');

        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        if ( $this->input->post( $submit ) )
	{
            if( $this->form_validation->run("{$this->router->class}/{$this->router->method}") )
            {
                $this->load->model('updater');
                $this->updater->$method( $id, $this->input->post() );
                if( $this->router->class == 'pages' )
                    redirect( $this->router->class.'/index/'.$id);
                else
                    redirect( $this->router->class );
            }
        }   
    }

    /**
     * delete
     * 
     * Funkcia vola prislusnu modelovu funkciu na vymazaie zaznamu z databazy
     * 
     * @access      protected
     * @param       string $method Nazov prislusnej modelovej funkcie ktora sa ma vykonat
     * @param       integer $id ID zaznamu ktory sa ma vymazat
     * @return      void
     */
    protected function delete( $method, $id )
    {
        if( $id == '' )
            redirect ('404');
        
        if( !$this->userdata->is_admin() )
            redirect(base_url());
        
        $action = $this->input->post('submit_action');
        
        $this->load->model('deleter');
        
        if( $action == $this->lang->line('confirm_yes') )
        {
            $this->deleter->$method($id);
            redirect( $this->router->class );
        }
        elseif( $action == $this->lang->line('confirm_no') )
            redirect( $this->router->class );
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */