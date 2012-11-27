<?php
    $obj = $this->selecter->get_event_detail(1);
    array_debug($obj);
?>
Kategoria: <?= $obj[0]->event_category ?>
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
    <?= $obj[0]->event_author_id ?> ,
    <?= $obj[0]->event_created ?> 
</div>
