<?php
	$this->load->library('grid');

	$grid = new Grid();

	$grid->bind($this->selecter->get_users_filter($get), 'user_id');
	$grid->header('user_id')->visible = false;
	
	$grid->display();
?>