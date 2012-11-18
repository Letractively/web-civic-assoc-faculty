<?php

	$this->load->library('grid');
	
	$grid = new Grid();
	
	$grid->bind($users, 'user_id');
	
	$grid->add_url = "test/add";
	$grid->edit_url = "test/edit";
	$grid->remove_url = "test/delete";
	
	$grid->header('user_id')->visible = false;
	$grid->header('user_date')->visible = false;
	$grid->header('user_study_program_id')->component->type = "combobox";
	$grid->header('user_study_program_id')->component->bind( $this->db->query("SELECT * FROM study_programs")->result(), "study_program_id", "study_program_name"); // data_source, id, value
	$grid->header('user_degree_id')->component->type = "combobox";
	$grid->header('user_degree_id')->component->bind( $this->db->query("SELECT * FROM degrees")->result(), "degree_id", "degree_name");
	
	$grid->display();
?>
