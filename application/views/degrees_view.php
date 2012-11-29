<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_degrees(1));
    
    $grid->bind($this->selecter->get_degrees(),'degree_id');
    $grid->header('degree_id')->editable = false;
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    $grid->display();
?>