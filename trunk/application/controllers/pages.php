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
 * Pages class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Pages
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Pages extends MY_Controller
{
    
        /**
	 * Constructor
	 */
        function __construct() 
        {
            parent::__construct();
            $this->load->model('selecter');
        }

        /**
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @access public
         * @param string $page_name Meno stranky
         */
        public function index($page_name = 'rules')
        {
            if(!in_array($page_name, array('rules','contact','about')))
               redirect( '404' );
            $data = array( 
                'view' =>  $this->router->class.'_'.'view',
                'page'  => $page_name
            );
            
            switch ($page_name)
            {
		case 'rules': 
                    $data['title'] = $this->lang->line('title_rules');
                    break;
		case 'contact': 
                    $data['title'] = $this->lang->line('title_contact');
                    break;
		case 'about': 
                    $data['title'] = $this->lang->line('title_about'); 
                    break;
		default: 
                    $data['title'] = ''; 
                    break;
            }     
			
            $this->load->view('container', array_merge($this->data, $data));
        }
        
        /**
         * edit
         * 
         * Funkcia upravy danu stranku
         * 
         * @param string $page_name meno stranky ktore sa ma upravit
         * 
         */
        public function edit( $page_name )
        {
            if(!in_array($page_name, array('rules','contact','about')))
               redirect( '404' );
            parent::edit('edit_page_text', $page_name);
            
            $data = array(
                'error'         =>  $this->form_validation->form_required(array('page_text')),
                'title'         =>  $this->lang->line('title_editor'),
                'buttons'       =>  get_bbcode_buttons(),
                'page'          =>  $page_name
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }
}