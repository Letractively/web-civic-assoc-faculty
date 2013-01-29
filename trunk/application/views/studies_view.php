<?php
$this->load->library('grid');
    
    $grid = new Grid();
    
    $grid->bind($this->selecter->get_study_programs(true), 'study_program_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('study_program_id')->editable = false;
    $grid->header('study_program_id')->visible = false;
    $grid->header('study_program_name')->text = $this->lang->line('label_name');
    
	echo '<div id="grid_wrapper">';
		$grid->display();
	echo '</div>'
?>
