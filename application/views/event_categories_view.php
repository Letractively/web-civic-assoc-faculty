<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->->get_event_categories());
    
    $grid->bind($this->selecter->get_event_categories(), 'event_category_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('event_category_id')->editable = false;
    
	
    $grid->display();
?>
