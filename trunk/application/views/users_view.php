<script type="text/javascript" charset="UTF-8">
	var base_url = '<?=base_url()?>';

	function changeFilter(sender)
	{
		var user_filter = document.getElementById('user_filter');
		var url = user_filter.options[user_filter.selectedIndex].value;
		window.location = base_url+url;
	}
</script>

<?php
    $this->load->library('grid');
    $grid = new Grid();
?>
 
<div id="grid_wrapper"> 

	<?php
		$user_filters = array(
			array('id' => 'users', 'value' => $this->lang->line('all')),
			array('id' => 'users/admins', 'value' => $this->lang->line('admin')),
			array('id' => 'users/members', 'value' => $this->lang->line('oz_member'))
		);
	?>

	<div class="grid_link_text">
		<span class="grid_label"> Zobraziť: </span>
		<?= gen_dropdown('user_filter', $user_filters[$flag]['id'], $user_filters, 'id', 'value', 'dropdown','id="user_filter" onchange="changeFilter(this);"'); ?>
	</div>
	<?php
		$users_objects = $this->selecter->get_users($flag);
		$users = array();
		foreach ($users_objects as $user)
			$users[] = get_object_vars($user);
		
		switch ($flag)
		{
		case ROLE_OZ_MEMBER: // prvych n neuhradenych platieb
			for ($i = 0; $i < count($users); ++$i)
			{
				$users[$i]['nopaid_payments'] = 0;
				$payments = $this->selecter->get_payments_nopaid($users[$i]['user_id']);
				foreach($payments as $p)
					$users[$i]['nopaid_payments'] += $p->payment_total_sum;
			}
			break;
		}
		
		//array_debug($users);
		
		if( $grid->bind($users, 'user_id') )
		{
			$grid->all_cols_visible(false);
			$grid->header('user_name')->visible = true;
			$grid->header('user_surname')->visible = true;
			$grid->header('user_name')->set_anchor('users/detail', 'user_id');
			$grid->header('user_surname')->set_anchor('users/detail', 'user_id');
			$grid->header('user_email')->visible = false;
			if ($flag == ROLE_OZ_MEMBER) $grid->header('user_phone')->visible = true;
			if ($flag == ROLE_OZ_MEMBER) $grid->header('study_program_name')->visible = true;
			if ($flag == ROLE_OZ_MEMBER) $grid->header('user_degree_year')->visible = true;
			if ($flag == ROLE_OZ_MEMBER) $grid->header('degree_name')->visible = true;
			
					$grid->header('user_name')->text = $this->lang->line('label_name');
					$grid->header('user_surname')->text = $this->lang->line('label_surname');
					$grid->header('user_email')->text = $this->lang->line('label_email');
					$grid->header('user_phone')->text = $this->lang->line('label_phone');
					$grid->header('study_program_name')->text = $this->lang->line('label_study_program_id');
					$grid->header('user_degree_year')->text = $this->lang->line('label_degree_year');
					$grid->header('degree_name')->text = $this->lang->line('label_degree_id');
					
			if( $this->userdata->is_admin() )
                        {	
                            $grid->add_url = "users/add";
                            $grid->edit_url = "users/edit";
                            $grid->remove_url = "users/delete";
                            $grid->add_mode = "external";
                            $grid->edit_mode = "external";
                        }
			$grid->display();
		}
	   
	?>
</div>