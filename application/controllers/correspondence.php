﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 * Correspondence class
 *
 * @package		AlumniFMFI
 * @subpackage          Controllers
 * @category            Correspondence
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Correspondence extends MY_Controller
{
    
        /**
	 * Constructor
	 */
        function __construct() 
        {
            parent::__construct();
            $this->load->model('selecter');
            
            if( !$this->userdata->is_admin() )
                redirect(base_url());

            $data = array(
                'title' 		=> $this->lang->line('title')   //Title na aktualnej stranke
            );

            $this->data = array_merge($this->data, $data);
        }

        /**
         *  index
         * 
         * Index funkcia triedy
         * 
         * @access      public
         * @return      void
         */
        public function index()
        {

            if( $this->input->post('submit') )
            {
                if( $this->form_validation->run("{$this->router->class}") )
                {
                    if($this->input->post('correspondence_cc') != '' )
                        $this->form_validation->set_rules('correspondence_cc','lang:label_correspondence_cc','trim|xss_clean|valid_email');
                    if( $this->form_validation->run() )
                    {
                        if ($this->send_email( $this->input->post() ) )
                            redirect('show_message/index/success_correspondence');
                    }
                }
            }

            $data = array( 
		'years'         => $this->generate_years(60, 2012, 50),
                'view'          => "{$this->router->class}_view",
                'error'         => $this->form_validation->form_required(array('correspondence_subject','correspondence_content',
                                                                                'correspondence_sender', 'correspondence_cc'))
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }
        
        /**
         * send_email
         * 
         * Funkcia posle hromadny email
         * 
         * @access      public
         * @param       array $post_params Polozky odoslane POST-om
         * @return      void
         */
        public function send_email( $post_params )
        {
            $users = $this->selecter->get_users_filter( $post_params );
            $ids = array();
            $this->load->library('email');
            $logged_user_id = $this->session->userdata('user');
            
            if($users != '')
            {
                foreach ($users as $user) 
                {
                    array_push($ids, $user->user_id);

                    $this->email->from( $post_params['correspondence_sender'], $this->userdata->full_name($logged_user_id) );
                    $this->email->to($user->user_email); 
                    $this->email->cc($post_params['correspondence_cc']); 
                    $this->email->subject($post_params['correspondence_subject']);
                    $this->email->message( parse_bbcode($post_params['correspondence_content']) );
                    $this->email->send();
                }
                return $this->inserter->add_email_log($post_params['email_type_id'], $ids);
            }
        }

        /**
         * review
         * 
         * Funkcia zobraziu pouzivatelov ktori vyhovuju filtracnej podmienke
         * 
         * @access      public
         * @return      void
         */
        public function review()
        {
            $data = array(
		'get' => $_GET
            );

            $this->load->view('container', array_merge($this->data, $data));
        }
}

/* End of file correspondence.php */
/* Location: ./application/controllers/correspondence.php */