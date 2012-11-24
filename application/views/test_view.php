<?php

	$this->load->library('grid');
	$this->load->model('selecter');
	
	$grid = new Grid();
	
	$grid->bind($this->db->query("SELECT u.user_id, u.user_name, u.user_surname, u.user_email, sp.study_program_name, d.degree_name, u.user_postcode FROM users u, degrees d, study_programs sp WHERE u.user_degree_id = d.degree_id && u.user_study_program_id = sp.study_program_id ORDER BY user_id")->result(), 'user_id');
	
	$grid->add_url = "{$this->router->class}/add";
	$grid->edit_url = "{$this->router->class}/edit";
	$grid->remove_url = "{$this->router->class}/delete";
	//$grid->add_mode = "external";
	//$grid->edit_mode = "external";
	
	$grid->header('user_id')->editable = false;
	$grid->header('study_program_name')->component->type = "combobox";
	$grid->header('study_program_name')->component->bind( $this->selecter->get_study_programs(), "study_program_id", "study_program_name"); // data_source, id, value
	$grid->header('degree_name')->component->type = "combobox";
	$grid->header('degree_name')->component->bind( $this->selecter->get_degrees(), "degree_id", "degree_name");
	
	$grid->display();
?>
