<script type="text/javascript" charset="UTF-8">
	var base_url = '<?=base_url()?>';

	function changeFilter(sender)
	{
		var payment_filter = document.getElementById('payment_filter');
		var user_filter = document.getElementById('user_filter');
		var url = payment_filter.options[payment_filter.selectedIndex].value;
		var selected_user = user_filter.options[user_filter.selectedIndex].value;
		window.location = base_url+url+'/'+selected_user;
	}
</script>

<?php
    $this->load->library('grid');
    $this->load->helper('payments');   
?> 
<div id="grid_wrapper">   

	<?php
		$payment_filters = array(
			array('id' => 'payments', 'value' => $this->lang->line('payment_all')),
			array('id' => 'payments/paid', 'value' => $this->lang->line('payment_paid')),
			array('id' => 'payments/nopaid', 'value' => $this->lang->line('payment_nopaid'))
		);
		$totalRows = $this->selecter->UsersInDatabase('users', 'user_id', 0);
		$users = $this->selecter->get_users($totalRows,0,0);
		$userlist = array();
		if ($this->userdata->is_admin())
		{
			foreach ($users as $user)
			{
				$userlist[] = array(
					'id' => $user->user_id,
					'name' => $user->user_name
				);
			}
			$userlist[] = array('id' => 0, 'name' => 'Všetci');
		}
		else
		{
			$userID = $this->userdata->get_user_id();
			$userlist[] = array('id' => $userID, 'name' => $this->userdata->full_name($userID));
		}
	?>

    <div class="inputitem">
        <span class="label"> Zoradit podla: </span>
		<?= gen_dropdown('payment_filter', $payment_filters[$flag]['id'], $payment_filters, 'id', 'value', 'dropdown','id="payment_filter" onchange="changeFilter(this);"'); ?>
	</div>
	
	<div class="inputitem">
		<span class="label"> Platby používateľa: </span>
		<?= gen_dropdown('user_filter', $pay_id, $userlist, 'id', 'name', 'dropdown','id="user_filter" onchange="changeFilter(this);"'); ?>
    </div> <br />
 
    <?php
        $grid = new Grid();
        $payments = array();
        switch ( $flag )
        {
            case 0:
                $payments = $this->selecter->get_payments($c_pagination['per_page'], $c_pagination['cur_page'], $pay_id, true);
                break;
            case 1:
                $payments = $this->selecter->get_payments_paid($c_pagination['per_page'], $c_pagination['cur_page'], $pay_id, true);
                break;
            case 2:
                $payments = $this->selecter->get_payments_nopaid($c_pagination['per_page'], $c_pagination['cur_page'], $pay_id, true);
                break;
        }
        
        $paymentsData = array();
        if($payments->num_rows == 0)
            $paymentsData = $payments;
        else
            $paymentsData = updatePaymentsData($payments);
        
        if( $grid->bind($paymentsData, 'payment_id') )
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
            $grid->header('payment_total_sum')->set_numformat('{2:,: } €');
            $grid->header('payment_paid_sum')->set_numformat('{2:,: } €');
            $grid->header('payment_paid_time')->text = $this->lang->line('label_date'); 
            $grid->header('payment_paid_time')->set_datetime();
            $grid->header('payment_type')->text = $this->lang->line('label_paidtype'); 
				
            $grid->add_url = "payments/add";
            
            if($flag != 1)
            {
                $grid->edit_url = "payments/edit";
                $grid->edit_mode = "external";
            }
            $grid->remove_url = "payments/delete";
            $grid->add_mode = "external";
            
				
            //$grid->display();
        }
		$grid->display();
	echo pagination($pagination);
    ?>
</div>
