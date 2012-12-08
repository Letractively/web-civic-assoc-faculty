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
        <?= form_dropdown('priority', $priorities, set_value('priority_id', $field->event_priority)) ?>
    </div>
 <!--end-->
 
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name', $field->event_name)) ?>
    </div>
 
<!--od -> do-->
    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from']), set_value('from', $field->event_from)) ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to']), set_value('to', $field->event_to)) ?>
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
