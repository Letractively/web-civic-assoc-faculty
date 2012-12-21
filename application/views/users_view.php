<?php
    $this->load->library('grid');
    $grid = new Grid();
?>  
<div id="paid_navig">
        <ul>
            <li><?= anchor('users/members',$this->lang->line('oz_member')) ?></li>
            <li><?= anchor('users/visitors',$this->lang->line('ex_member')) ?></li>
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
	case ROLE_EX_MEMBER: // prvych n udalosti
		break;
	case ROLE_LECTURER: // prvych n prednasok
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
		$grid->header('user_email')->visible = true;
		if ($flag == ROLE_OZ_MEMBER) $grid->header('user_phone')->visible = true;
		if ($flag == ROLE_OZ_MEMBER) $grid->header('study_program_name')->visible = true;
		if ($flag == ROLE_OZ_MEMBER) $grid->header('user_degree_year')->visible = true;
		if (in_array($flag, array(ROLE_OZ_MEMBER, ROLE_LECTURER))) $grid->header('degree_name')->visible = true;
		
		$grid->add_url = "users/add";
		$grid->edit_url = "users/edit";
		$grid->remove_url = "users/delete";
		$grid->add_mode = "external";
		$grid->edit_mode = "external";
        $grid->display();
	}
	
	/*
    elseif( $flag == 3 )
    {
        if( !$grid->bind($this->selecter->get_users(2),'user_id') )
        {
            $grid->header('user_id')->editable = false;
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->text = $this->lang->line('label_name');
			$grid->header('user_name')->set_anchor("{$this->router->class}/detail", "user_id");
            $grid->header('user_surname')->text = $this->lang->line('label_vs'); 
			$grid->header('user_surname')->set_anchor("{$this->router->class}/detail", "user_id");
            $grid->header('user_email')->text = $this->lang->line('label_surname');  
			$grid->add_url = "add";
			$grid->edit_url = "edit";
			$grid->remove_url = "delete";
        }
    }
    */
 
		/*$grid->add_mode = "external";
		$grid->edit_mode = "external";
        $grid->display();*/
   
?>