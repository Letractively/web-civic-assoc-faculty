<?php
    $obj = $this->selecter->get_post_detail($post_id);
    array_debug($obj);
?>

<div class="post_title">
    <?= $obj[0]->post_title ?>
</div>

<div id="post_options">
    <?= anchor('posts/delete/'.$post_id, $this->lang->line('delete_item')); ?>
    <?= anchor('posts/edit/'.$post_id, $this->lang->line('edit_item')); ?>
</div>

<div class="post_content">
    <?= parse_bbcode($obj[0]->post_content) ?>  
</div>

<div class="post_add_info">
    <span><?= $this->lang->line('created_by'); ?>:</span>
    <?= anchor('users/detail/'.$obj[0]->post_author_id, $obj[0]->author_name.' '.$obj[0]->author_surname); ?> ,
    <?= $obj[0]->post_date ?> 
</div>

<div class="post_modifie_info">
    <span><?= $this->lang->line('last_update'); ?></span>
    <?= anchor('users/detail/'.$obj[0]->post_modifie_author_id, $obj[0]->modifie_name.' '.$obj[0]->modifie_surname) ?> ,
    <?= $obj[0]->post_modifie_date ?> 
</div>