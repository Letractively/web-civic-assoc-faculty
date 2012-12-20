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
	
	//array_debug($this->selecter->get_payments_nopaid($users[1]['user_id']));
	
	switch ($flag)
	{
	case ROLE_OZ_MEMBER: // prvych n neuhradenych platieb
		/*for ($i = 0; $i < count($users); ++$i);
			$users[$i]['nopaid_payments'] = count($this->selecter->get_payments_nopaid($users[$i]['user_id']));*/
		break;
	case ROLE_EX_MEMBER: // prvych n udalosti
		break;
	case ROLE_LECTURER: // prvych n prednasok
		break;
	}
	
	if( $grid->bind($users, 'user_id') )
	{
		$grid->header('user_id')->visible = false;
		
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