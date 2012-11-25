<!--
    kategoria
    ?????????
-->

<div class="event_title">
    <?= auto_typography($event_id->title) ?>  
</div>
<div class="event_body">
    <?= auto_typography($event_id->body) ?>  
</div>
<div class="event_time">
    <span>Kedy:</span>
    <?= auto_typography($event_id->from) ?>  
    <?= auto_typography($event_id->to) ?>  
</div>
<div class="event_priority">
    <span>Priorita:</span>
    <?= $event_id->prior ?>  
</div>
<div class="event_add_info">
    <span>Pridal:</span>
    <?= $event_id->user_id ?>,
    <?= $event_id->time ?>
</div>