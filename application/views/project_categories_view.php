<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_events(1));
    
    $grid->bind($this->selecter->get_project_categories(), 'project_categories_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('project_categories_id')->editable = false;
    
	
    $grid->display();
?>
