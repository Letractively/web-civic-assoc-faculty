﻿<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MY_Controller
{
        protected $c_pagination         = array();
        protected $get_query 		= array();
        protected $per_page             = 20;
        protected $totalRows            = 0;
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         */
        function __construct() 
        {
            parent::__construct();
            
            if( !$this->userdata->is_logged() )
                redirect(base_url());
            
            $this->get_query = ( $_GET ) ? '?' . http_build_query($_GET) : '';
            $this->load->model('selecter');
            $this->load->library('pagination');
            
            $data = array(
                'title'             => 'Platby',
                'view'              => "{$this->router->class}_view"
            );

            $this->data = array_merge($this->data, $data);
        }

        /*
         * index
         * 
         * default index metoda, ktora sa vola primarne
         * 
         * @param pay_id    ak je ID 0 co je dafaultne tak sa zobrazia platby vsetkych 
         *                  userov ak daco ine tak konkretneho usera
         * @return array
         * 
         */
        public function index( $pay_id = 0, $page = 0 )
        {   
            if( !$this->userdata->is_admin() && ($pay_id != $this->userdata->get_user_id() ) )
                $pay_id = $this->userdata->get_user_id();
             
            $this->totalRows = $this->selecter->PaymentsInDatabase('payments', 'payment_id', $pay_id, 0);
            $this->c_pagination['base_url'] = base_url().'payments/'.$pay_id.'/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->totalRows;
            $this->pagination->initialize($this->c_pagination);
            
            $data = array(
                'flag'              => 0,
                'pay_id'            => $pay_id,
                'c_pagination'      => $this->c_pagination,
                'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /*
         * paid
         * 
         * Metoda vrati zaplatene platby
         * 
         * @param pay_id    defaultne je 0 co symbolizuej vsetkych userov, 
         *                  v inom pripade su to platby konkretneho usera
         * @return array
         * 
         */
        public function paid( $pay_id = 0, $page = 0 )
        {
            if( !$this->userdata->is_admin() && ($pay_id != $this->userdata->get_user_id() ) )
                $pay_id = $this->userdata->get_user_id();
	
            $this->totalRows = $this->selecter->PaymentsInDatabase('payments', 'payment_id', $pay_id, 1);
            $this->c_pagination['base_url'] = base_url().'payments/paid/'.$pay_id.'/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->totalRows;
            $this->pagination->initialize($this->c_pagination);

            $data = array(
                'flag'              => 1,
                'pay_id'            => $pay_id,
                'c_pagination'      => $this->c_pagination,
                'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /*
         * nopaid
         * 
         * Metoda vrati nezaplatene platby
         * 
         * @param pay_id    defaultne je 0 co symbolizuej vsetkych userov, 
         *                  v inom pripade su to platby konkretneho usera
         * @return array
         * 
         */
        public function nopaid( $pay_id = 0, $page = 0 )
        {
            if( !$this->userdata->is_admin() && ($pay_id != $this->userdata->get_user_id() ) )
                $pay_id = $this->userdata->get_user_id();
		
            $this->totalRows = $this->selecter->PaymentsInDatabase('payments', 'payment_id', $pay_id, 2);
            $this->c_pagination['base_url'] = base_url().'payments/nopaid/'.$pay_id.'/';
            $this->c_pagination['cur_page'] = $page;
            $this->c_pagination['per_page'] = $this->per_page;
            $this->c_pagination['total_rows'] = $this->totalRows;
            $this->pagination->initialize($this->c_pagination);

            $data = array(
                'flag'              => 2,
                'pay_id'            => $pay_id,
                'c_pagination'      => $this->c_pagination,
                'pagination'        => preg_replace('/(href="[^"]*)/i', "$1" . $this->get_query, $this->pagination->create_links())
            );

            $this->load->view('container', array_merge($this->data, $data)); 
        }

        /*
         * add
         * 
         * Metoda zaeviduje platbu do systemu
         * 
         */
        public function add()
        {
            if ( $this->input->post('submit') )
            {
                //array_debug($this->input->post());
                if( $this->input->post('payment_type') == 1 )
                    $this->form_validation->set_rules('total_sum','lang:label_total_sum','trim|required|xss_clean|numeric|greater_or_equal_than[5]');
                else
                    $this->form_validation->set_rules('total_sum','lang:label_total_sum','trim|required|xss_clean|numeric|greater_or_equal_than[1]');
                
                $this->form_validation->set_rules('payment_vs','lang:label_vs','trim|required|xss_clean|integer|min_length[4]|max_length[10]');
                /*foreach ($this->input->post('categories') as $cat_id => $ratio)
                {
                    $this->form_validation->set_rules('categories[$cat_id]','lang:label_proj_category','required|xss_clean|numeric');
                }*/
                if( $this->form_validation->run() )
                {
                    $this->load->model('inserter');
                    $this->inserter->add_payments( $this->input->post() );
                    redirect('users/detail/'.$this->userdata->get_user_id());
                }
            }
            
            $data = array(
                'view'      => $this->router->class.'_'.$this->router->method.'_view'
            );
            
            $this->load->view('container', array_merge($this->data, $data));
        }

        /*
         * edit
         * 
         * Metoda upravi platbu v systeme
         * 
         * @param pay_id ID platby ktoru treba upravit
         * 
         */
        public function edit($pay_id)
        {
            if ($this->input->post())
			{
				redirect('payments');
			}
			else
			{
				$data = array(
					'view' => "payments_edit_view"
				);
				$data = array_merge($data, $this->selecter->get_payment_detail($pay_id));
				//array_debug($data);
				$this->load->view('container', array_merge($this->data, $data));
			}
        }

        /*
         * delete
         * 
         * Metoda zmaze platbu zo systemu
         * 
         * @param pay_id ID platby ktora sa vymaze
         * 
         */
        public function delete( $pay_id )
        {
            parent::delete('remove_payments', $pay_id, $this->router->class);

            $data = array(
                'view'            => 'confirm_view',
                'type'            => 'delete',
                'langs'           => array($this->lang->line('confirm_yes'), $this->lang->line('confirm_no')),
                'method'          => $this->router->class.'/'.$this->router->method.'/'.$pay_id
            );

            $this->load->view('container', array_merge($this->data, $data));
        }
}

/* End of file payments.php */
/* Location: ./application/controllers/payments.php */