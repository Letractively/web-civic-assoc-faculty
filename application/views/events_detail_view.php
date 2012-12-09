<?php
    $obj = $this->selecter->get_event_detail($event_id);
    
    //array_debug($obj);
    
    $date = datetime($obj[0]->event_created, FALSE);
    $time = time_withou_seconds(datetime($obj[0]->event_created, TRUE));
    
?>
<?= $this->lang->line('label_event_category_id').': '; ?> <?= anchor('events/'.$obj[0]->event_category_id, $obj[0]->event_category); ?>
<div class="event_title">
    <?= $obj[0]->event_name ?>
</div>
<div class="event_body">
    <?= parse_bbcode($obj[0]->event_about) ?>  
</div>
<div class="event_time">
    <span><?= $this->lang->line('event_date'); ?></span>
    <?= datetime($obj[0]->event_from, FALSE).' '.time_withou_seconds(datetime($obj[0]->event_from, TRUE)) ?>  
    <?php echo '-'; ?>
    <?= datetime($obj[0]->event_to, FALSE).' '.time_withou_seconds(datetime($obj[0]->event_to, TRUE)) ?>  
</div>
<div class="event_priority">
    <span><?= $this->lang->line('label_priority').': ' ?></span>
    <?= $obj[0]->event_priority ?> 
</div>
<div class="event_add_info">
    <span><?= $this->lang->line('event_author'); ?></span>
    <?= $obj[0]->event_author ?>,
    <?= $date.' '.$time; ?>
</div>

<?php
    if( $this->userdata->is_admin() )
    {
        echo anchor('events/edit/'.$event_id, $this->lang->line('button_edit_event') );
        echo anchor('events/delete/'.$event_id, $this->lang->line('button_delete_event') );
    }
        
?>