<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_events(1));
    
    $grid->bind($this->selecter->get_nopaid_payments(1), 'nopaid_payments_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('nopaid_payments_id')->editable = false;
    
	
    $grid->display();
?>
