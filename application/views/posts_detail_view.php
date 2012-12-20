<?php
    $obj = $this->selecter->get_post_detail($post_id);
    //array_debug($obj);
?>

<div class="post_title">
    <?= $obj->post_title ?>
</div>

<?php if( $this->userdata->is_admin() ): ?>
    <div id="post_options">
        <?= anchor('posts/delete/'.$post_id, $this->lang->line('delete_item')); ?>
        <?= anchor('posts/edit/'.$post_id, $this->lang->line('edit_item')); ?>
    </div>
<?php endif; ?>

<div class="post_content">
    <?= parse_bbcode($obj->post_content) ?>  
</div>

<div class="post_add_info">
    <span><?= $this->lang->line('created_by'); ?>:</span>
    <?= anchor('users/detail/'.$obj->post_author_id, $obj->author_name.' '.$obj->author_surname); ?>, 
    <?= datetime($obj->post_date, FALSE).' '. time_withou_seconds(datetime($obj->post_date, TRUE)) ?> 
</div>

<?php if($obj->post_modifie_date == TRUE && $obj->post_modifie_author_id == TRUE): ?>
    <div class="post_modifie_info">
        <span><?= $this->lang->line('last_update'); ?></span>
        <?= anchor('users/detail/'.$obj->post_modifie_author_id, $obj->modifie_name.' '.$obj->modifie_surname) ?>,
        <?= datetime($obj->post_modifie_date, FALSE).' '. time_withou_seconds(datetime($obj->post_modifie_date, TRUE)) ?> 
    </div>
	<div>
		<span><?= anchor('posts/modifiers/'.$post_id, "Zobraziť históriu modifikácií") ?></span>
	</div>
<?php endif; ?>
<?php
        echo anchor('posts/', $this->lang->line('to_posts'));
   
?>