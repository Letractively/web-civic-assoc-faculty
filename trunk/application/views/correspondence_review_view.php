<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_events(1));
    
    $grid->bind($this->selecter->get_users($study_ids, $degrees, $degree_years),'study_ids', 'degrees', 'degree_years');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('event_id')->editable = false;
    
	
    $grid->display();
?>