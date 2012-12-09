<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($event_id,'events','event_id');
    ?>
</div>
<?= js_insert_bbcode('events/edit', 'textarea'); ?>
<?= form_open("events/edit/".$event_id) ?>
    <div class="inputitem">
        <label for="event_category_id" class="<?= $error['event_category_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label>
        <?= gen_dropdown('event_category_id', set_value('event_category_id', $field->event_event_category_id),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>
    </div>

 <!--generovat prioritu-->
    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value'); ?>
    </div>
 <!--end-->
 
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name', $field->event_name)) ?>
    </div>
 
<!--od -> do-->
    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from'], 'maxlength' => 10, 'size' => 10), set_value('from', datetime($field->event_from, FALSE))) ?>
        <?= form_input(array('name' => 'from_time', 'maxlength' => 5, 'size' => 5), set_value('from_time',  time_withou_seconds(datetime($field->event_from, TRUE)))); ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to'], 'maxlength' => 10, 'size' => 10), set_value('to',  datetime($field->event_to, FALSE))) ?>
        <?= form_input(array('name' => 'to_time', 'maxlength' => 5, 'size' => 5), set_value('to_time', time_withou_seconds(datetime($field->event_to, TRUE)))); ?>
    </div>
<!--end-->
    <div>
        <?php
            foreach($buttons as $i)
            {
                echo $i;
            }
        ?>
    </div>  
    <div class="inputitem">
        <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label>
        <?= form_textarea(array('name' => 'about', 'id' => 'textarea', 'class' => ''.$error['about']), set_value('about', $field->event_about)) ?>
    </div>

    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit_event')) ?>
    </div>
<?= form_close() ?>
