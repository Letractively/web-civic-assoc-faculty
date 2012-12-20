<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>
<?= form_open("project_categories/add") ?>
   
    <div class="inputitem">
        <label for="event_name" class="<?= $error['event_name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'event_name', 'id' => 'event_name', 'class' => ''.$error['event_name']), set_value('event_name')) ?>
    </div>

    <div class="inputitem">
        <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label>
        <?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => ''.$error['about']), set_value('about')) ?>
    </div>

    <div class="inputitem">
        <label for="event_categories_id" class="<?= $error['event_categories_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label>
        <?= gen_dropdown('event_categories_id', set_value('event_categories_id'),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>     
    </div>
 
 <!--generovat prioritu-->
    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= form_dropdown('priority', $priorities, set_value('priority_id')) ?>
    </div>
 <!--end-->
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

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_event')) ?>
    </div>
<?= form_close() ?>