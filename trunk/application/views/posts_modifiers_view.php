<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    $grid->bind($this->selecter->get_post_modifiers($post_id), 'post_modifie_id');
    $grid->header('post_modifie_id')->editable = false;
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    $grid->display();
?>
