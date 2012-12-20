<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    $grid->bind($this->selecter->get_post_modifiers($post_id), 'post_modifie_id');
    $grid->header('user_id')->visible = false;
    $grid->header('post_modifie_id')->visible = false;
    
    $grid->header('user_name')->text = $this->lang->line('user_name');
    $grid->header('user_surname')->text = $this->lang->line('user_surname');
    $grid->header('post_modifie_date')->text = $this->lang->line('label_post_date');
    $grid->display();
    
    echo anchor('posts/detail/'.$post_id, $this->lang->line('detail'));
?>
