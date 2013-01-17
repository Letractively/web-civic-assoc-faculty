<?php
    $this->load->library('grid');
    $grid = new Grid();
?>
 
<div id="grid_wrapper"> 
	<div class="grid_link_text">
		<span class="grid_label"> Zoradit podľa: </span>
		<ul>
			<li><?= anchor('users/members',$this->lang->line('oz_member')) ?></li>
			<!--li><?= anchor('users/visitors',$this->lang->line('ex_member')) ?></li-->
			<li><?= anchor('users/lecturers',$this->lang->line('lecturer')) ?></li>
			<li><?= anchor('users/admins',$this->lang->line('admin')) ?></li>
			<li><?= anchor('users/index',$this->lang->line('all')) ?></li>
		</ul>
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