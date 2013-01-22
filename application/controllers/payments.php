<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payments extends MY_Controller
{
    
        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         */
        function __construct() 
        {
            parent::__construct();
            $this->load->model('selecter');
            if( !$this->userdata->is_logged() )
                redirect(base_url());

             $this->load->model('selecter');

            $data = array(
                'title' 		=> 'Platby',   //Title na aktualnej stranke
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
        public function index($pay_id = 0)
        {   
            if( !$this->userdata->is_admin() && ($pay_id != $this->userdata->get_user_id() ) )
                $pay_id = $this->userdata->get_user_id();
				
            $data = array(
                'flag'      => 0,
                'pay_id'    => $pay_id
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
        public function paid($pay_id = 0)
        {
			if( !$this->userdata->is_admin() && ($pay_id != $this->userdata->get_user_id() ) )
				$pay_id = $this->userdata->get_user_id();
		
            $data = array(
                'flag'      => 1,
                'pay_id'    => $pay_id
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
        public function nopaid($pay_id = 0)
        {
			if( !$this->userdata->is_admin() && ($pay_id != $this->userdata->get_user_id() ) )
				$pay_id = $this->userdata->get_user_id();
		
            $data = array(
                'flag'      => 2,
                'pay_id'    => $pay_id
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
                
                $this->form_validation->set_rules('payment_vs','lang:label_vs','trim|required|xss_clean|numeric');
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