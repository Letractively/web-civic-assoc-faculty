<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>
<?= js_insert_bbcode('events/add', 'textarea'); ?>
<?= form_open("events/add") ?>
    <div class="inputitem">
        <label for="event_category_id" class="<?= $error['event_category_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label>
        <?= gen_dropdown('event_category_id', set_value('event_category_id'),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>     
    </div>
 <!--dropdown robis takto ako je hore gen_dropdown, to co su tie parametre uvidis ked si otvoris danu funkciu-->
 <!--generovat prioritu-->
    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= form_dropdown('priority', $priorities, set_value('priority_id')) ?>
    </div>
 <!--end-->
 
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?>
    </div>
 
<!--od -> do-->
    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from']), set_value('from')) ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to']), set_value('to')) ?>
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
        <?= form_textarea(array('name' => 'about', 'id' => 'textarea', 'class' => ''.$error['about']), set_value('about')) ?>
    </div>

    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_event')) ?>
    </div>
<?= form_close() ?>