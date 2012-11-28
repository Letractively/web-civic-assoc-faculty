<?php
    $obj = $this->selecter->get_event_detail($event_id);
    
    $date = datetime($obj[0]->event_created, FALSE);
    $time = time_withou_seconds(datetime($obj[0]->event_created, TRUE));
    
?>
Kategoria: <?= anchor('events/index/'.$obj[0]->event_category_id, $obj[0]->event_category); ?>
<div class="event_title">
    <?= $obj[0]->event_name ?>
</div>
<div class="event_body">
    <?= $obj[0]->event_about ?>  
</div>
<div class="event_time">
    <span>Kedy:</span>
    <?= $obj[0]->event_from ?>  
    <?= $obj[0]->event_to ?>  
</div>
<div class="event_priority">
    <span>Priorita:</span>
    <?= $obj[0]->event_priority ?>   
</div>
<div class="event_add_info">
    <span>Pridal:</span>
    <?= $obj[0]->event_author ?> ,
    <?= $date.' '.$time; ?>
</div>

<?=anchor('events/edit/'.$event_id, $this->lang->line('button_edit_event') ); ?>
