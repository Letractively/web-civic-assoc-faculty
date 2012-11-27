<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_events(1));
    
    $grid->bind($this->selecter->get_email_types(), 'email_id');
    
//    $grid->header('degree_name')->component->type = "combobox";
//    $grid->header('degree_name')->component->bind( $this->selecter->get_email_types(), "email_id", "email_type");
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('email_id')->editable = false;
    
	
    $grid->display();
?>
