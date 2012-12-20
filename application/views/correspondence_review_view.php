<?php
	$this->load->library('grid');

	$grid = new Grid();

	if ( $grid->bind($this->selecter->get_users_filter($get), 'user_id') )
	{
		$grid->header('user_id')->visible = false;
		$grid->header('user_name')->text = 'meno';
		$grid->header('user_name')->set_anchor("users/detail", 'user_id');
		$grid->header('user_surname')->text = 'priezvisko';
		$grid->header('degree_name')->text = 'titul';
		$grid->header('study_program_name')->text = 'študijný program';
		$grid->header('user_email')->text = 'email';
	}
	
	$grid->display();
?>