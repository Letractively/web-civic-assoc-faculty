<?php
    $this->load->library('grid');
	$this->load->helper('payments');
    $grid = new Grid();
?>    
    <div id="paid_navig">
        <ul>
            <li><?= anchor('payments',$this->lang->line('payment_all')) ?></li>
            <li><?= anchor('payments/paid',$this->lang->line('payment_paid')) ?></li>
            <li><?= anchor('payments/nopaid',$this->lang->line('payment_nopaid')) ?></li>
        </ul>
    </div>
 
<?php

    if( $flag == 0 )
    {
        if( $grid->bind(addAdditional($this->selecter->get_payments($pay_id)), 'payment_id') )
        {
            $grid->header('payment_id')->editable = false;
            $grid->header('payment_id')->visible = false;
            $grid->header('user_name')->editable = false;
            $grid->header('payment_vs')->editable = false;
            $grid->header('payment_total_sum')->editable = false;
            $grid->header('payment_paid_time')->editable = false;
            
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->set_anchor('users/detail', 'user_id');
            $grid->header('user_name')->text = $this->lang->line('label_user_id');
            $grid->header('payment_vs')->text = $this->lang->line('label_vs'); 
            $grid->header('payment_total_sum')->text = $this->lang->line('label_total_sum'); 
            $grid->header('payment_paid_sum')->text = $this->lang->line('label_paid_sum'); 
            $grid->header('payment_paid_time')->text = $this->lang->line('label_date'); 
            $grid->header('payment_paid_time')->set_datetime();
            $grid->add_url = "{$this->router->class}/add";
            $grid->edit_url = "{$this->router->class}/edit";
            $grid->remove_url = "{$this->router->class}/delete";
            $grid->display();
        }
    }
    elseif ( $flag == 1 ) 
    {
        if( $grid->bind(addAdditional($this->selecter->get_payments_paid($pay_id)), 'payment_id') )
        {
            $grid->header('payment_id')->editable = false;
            $grid->header('payment_id')->visible = false;
			$grid->header('user_id')->visible = false;
			$grid->header('user_name')->set_anchor('users/detail', 'user_id');
            $grid->header('user_name')->text = $this->lang->line('label_user_id');
            $grid->header('payment_vs')->text = $this->lang->line('label_vs'); 
            $grid->header('payment_total_sum')->text = $this->lang->line('label_total_sum'); 
            $grid->header('payment_paid_sum')->text = $this->lang->line('label_paid_sum'); 
            $grid->header('payment_paid_time')->text = $this->lang->line('label_date'); 
			$grid->header('payment_paid_time')->set_datetime();
            $grid->display();
        }
    }
    elseif( $flag == 2 )
    {
        if( $grid->bind(addAdditional($this->selecter->get_payments_nopaid($pay_id)), 'payment_id') )
        {
            $grid->header('payment_id')->editable = false;
            $grid->header('payment_id')->visible = false;
			$grid->header('user_id')->visible = false;
			$grid->header('user_name')->set_anchor('users/detail', 'user_id');
            $grid->header('user_name')->text = $this->lang->line('label_user_id');
            $grid->header('payment_vs')->text = $this->lang->line('label_vs'); 
            $grid->header('payment_total_sum')->text = $this->lang->line('label_total_sum'); 
            $grid->header('payment_paid_sum')->text = $this->lang->line('label_paid_sum'); 
            $grid->header('payment_paid_time')->text = $this->lang->line('label_date'); 
			$grid->header('payment_paid_time')->set_datetime();
            $grid->add_url = "{$this->router->class}/add";
            $grid->edit_url = "{$this->router->class}/edit";
            $grid->remove_url = "{$this->router->class}/delete";
            $grid->display();
        }
    }
?>
