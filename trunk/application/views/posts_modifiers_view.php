<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    $grid->bind($this->selecter->get_post_modifiers($post_id), 'post_modifie_id');
    $grid->header('user_id')->visible = false;
    $grid->header('post_modifie_id')->visible = false;
    $grid->display();
?>
