﻿<?php
    $obj = $this->selecter->get_post_detail($post_id);
    //array_debug($obj);
?>

<div id="content_wrapper">
	<div class="post_label">
		<?= $obj->post_title ?>
	</div>

	<div class="post_content">
		<?= parse_bbcode($obj->post_content) ?>  
	</div>

	<div class="post_add_info">
		<span class="post_created_by"> <?= $this->lang->line('created_by'); ?>: </span>
		<span class="link_text"> <?= anchor('users/detail/'.$obj->post_author_id, $obj->author_name.' '.$obj->author_surname); ?></span>, 
		<?= datetime($obj->post_date, FALSE).' '. time_withou_seconds(datetime($obj->post_date, TRUE)) ?>
		<br /> <br />		
	</div>

	<?php if($obj->post_modifie_date == TRUE && $obj->post_modifie_author_id == TRUE): ?>
		<div class="post_modifie_info">
			<span class="post_last_update"><?= $this->lang->line('last_update'); ?></span>
			<span class="link_text"> <?= anchor('users/detail/'.$obj->post_modifie_author_id, $obj->modifie_name.' '.$obj->modifie_surname) ?></span>,
			<?= datetime($obj->post_modifie_date, FALSE).' '. time_withou_seconds(datetime($obj->post_modifie_date, TRUE)) ?> 
			<br /> <br />
		</div>
		
		<div>
			<span class="button_edit"><?= anchor('posts/modifiers/'.$post_id, "Zobraziť históriu modifikácií") ?></span>
		</div>
	<?php endif; ?>
	
	<?php if( $this->userdata->is_admin() ): ?>
		<div id="post_options">
			<p class="button_edit"> <?= anchor('posts/edit/'.$post_id, $this->lang->line('edit_item')); ?> </p>
			<p class="button_delete"> <?= anchor('posts/delete/'.$post_id, $this->lang->line('delete_item')); ?> </p>
		</div>
	<?php endif; ?>
	
	<?php echo '<p class="button_back">'; echo anchor('posts/', $this->lang->line('to_posts')); echo '</p>'; ?> 
</div>