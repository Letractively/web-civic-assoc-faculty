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
    $grid = new Grid();
?> 
<div id="grid_wrapper">   

	<?php
		$payment_filters = array(
			array('id' => 'payments', 'value' => $this->lang->line('payment_all')),
			array('id' => 'payments/paid', 'value' => $this->lang->line('payment_paid')),
			array('id' => 'payments/nopaid', 'value' => $this->lang->line('payment_nopaid'))
		);
		
		$users = $this->selecter->get_users(0);
		$userlist = array();
		foreach ($users as $user)
		{
			$userlist[] = array(
				'id' => $user->user_id,
				'name' => $user->user_name.' '.$user->user_surname
			);
		}
		$userlist[] = array('id' => 0, 'name' => 'Všetci');
	?>

    <div class="grid_link_text">
        <span> Zoradit podla: </span>
		<?= gen_dropdown('payment_filter', $payment_filters[$flag]['id'], $payment_filters, 'id', 'value', 'dropdown','id="payment_filter" onchange="changeFilter(this);"'); ?>
		<span>Platby používateľa: </span>
		<?= gen_dropdown('user_filter', $pay_id, $userlist, 'id', 'name', 'dropdown','id="user_filter" onchange="changeFilter(this);"'); ?>
    </div>
 
	<?php
	//array_debug($this->selecter->get_payments($pay_id));
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
				$grid->header('stav')->editable = false;
				
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
				$grid->header('user_name')->editable = false;
				$grid->header('stav')->editable = false;
				$grid->header('payment_vs')->editable = false;
				$grid->header('payment_total_sum')->editable = false;
				$grid->header('payment_paid_time')->editable = false;
				$grid->header('payment_total_sum')->set_numformat('{2:,: } €');
				$grid->header('payment_paid_sum')->set_numformat('{2:,: } €');
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
				$grid->header('user_name')->editable = false;
				$grid->header('payment_vs')->editable = false;
				$grid->header('payment_total_sum')->editable = false;
				$grid->header('payment_paid_time')->editable = false;
				$grid->header('stav')->editable = false;
				$grid->header('user_name')->text = $this->lang->line('label_user_id');
				$grid->header('payment_vs')->text = $this->lang->line('label_vs'); 
				$grid->header('payment_total_sum')->text = $this->lang->line('label_total_sum'); 
				$grid->header('payment_paid_sum')->text = $this->lang->line('label_paid_sum'); 
				$grid->header('payment_total_sum')->set_numformat('{2:,: } €');
				$grid->header('payment_paid_sum')->set_numformat('{2:,: } €');
				$grid->header('payment_paid_time')->text = $this->lang->line('label_date'); 
				$grid->header('payment_paid_time')->set_datetime();
				
				$grid->edit_url = "{$this->router->class}/edit";
				$grid->remove_url = "{$this->router->class}/delete";
				$grid->display();
			}
		}
	?>
</div>
