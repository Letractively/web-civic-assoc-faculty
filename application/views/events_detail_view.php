<?php
    $obj = $this->selecter->get_event_detail($event_id);    
    $date = datetime($obj->event_created, FALSE);
    $time = time_withou_seconds(datetime($obj->event_created, TRUE));
?>
<div id="content_wrapper_large">
	<p class="event_category"> <?= $this->lang->line('label_event_category_id').': '; ?> <span class="link_text"> <?= anchor('events/'.$obj->event_category_id, $obj->event_category); ?> </span> </p>
	<div class="event_title">
		<?= $obj->event_name ?>
	</div>
	<div class="event_body">
		<?= parse_bbcode($obj->event_about) ?>  
	</div>
	<div class="event_time">
		<span class="event_label"><?= $this->lang->line('event_date'); ?></span>
		<?= datetime($obj->event_from, FALSE).' '.time_withou_seconds(datetime($obj->event_from, TRUE)) ?>  
		<?php echo '-'; ?>
		<?= datetime($obj->event_to, FALSE).' '.time_withou_seconds(datetime($obj->event_to, TRUE)) ?>  
	</div>
	<div class="event_add_info">
		<span class="event_label"><?= $this->lang->line('event_author'); ?></span>
		<?= anchor('users/detail/'.$obj->user_id, $obj->event_author) ?>,
		<?= $date.' '.$time; ?>
	</div>

	<?php
		echo '<p class="button_back">'; echo anchor('events/', $this->lang->line('to_events')); echo '</p>';
		if( $this->userdata->is_admin() )
		{
			echo '<p class="button_edit">'; echo anchor('events/edit/'.$event_id, $this->lang->line('button_edit_event') ); echo '</p>'; 
			echo '<p class="button_delete">'; echo anchor('events/delete/'.$event_id, $this->lang->line('button_delete_event') ); echo '</p>';
		}            
	?>
</div>