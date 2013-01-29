<?php
    $obj = $this->selecter->get_event_detail($event_id);    
    $date = datetime($obj[0]->event_created, FALSE);
    $time = time_withou_seconds(datetime($obj[0]->event_created, TRUE));
?>
<div id="content_wrapper_large">
	<p class="event_category"> <?= $this->lang->line('label_event_category_id').': '; ?> <span class="link_text"> <?= anchor('events/'.$obj[0]->event_category_id, $obj[0]->event_category); ?> </span> </p>
	<div class="event_title">
		<?= $obj[0]->event_name ?>
	</div>
	<div class="event_body">
		<?= parse_bbcode($obj[0]->event_about) ?>  
	</div>
	<div class="event_time">
		<span class="event_label"><?= $this->lang->line('event_date'); ?></span>
		<?= datetime($obj[0]->event_from, FALSE).' '.time_withou_seconds(datetime($obj[0]->event_from, TRUE)) ?>  
		<?php echo '-'; ?>
		<?= datetime($obj[0]->event_to, FALSE).' '.time_withou_seconds(datetime($obj[0]->event_to, TRUE)) ?>  
	</div>
	<div class="event_add_info">
		<span class="event_label"><?= $this->lang->line('event_author'); ?></span>
		<?= anchor('users/detail/'.$obj[0]->user_id, $obj[0]->event_author) ?>,
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