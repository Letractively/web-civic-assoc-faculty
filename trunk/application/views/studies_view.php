<?php
$this->load->library('grid');
    
    $grid = new Grid();
    
    $grid->bind($this->selecter->get_study_programs(), 'study_program_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('study_program_id')->editable = false;
    	
    $grid->display();
?>