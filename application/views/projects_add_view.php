<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>
<?= form_open("projects/add") ?>

    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?>
    </div>

    <div class="inputitem">
        <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label>
        <?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => ''.$error['about']), set_value('about')) ?>
    </div>

    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value'); ?>
    </div>

    <div class="inputitem">
        <label for="project_category_id" class="<?= $error['project_category_id'] ?>"><?= $this->lang->line('label_project_category_id') ?></label>
        <?= gen_dropdown('project_category_id', set_value('project_category_id'),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?> 
    </div>

    <div class="inputitem">
        <label for="booked_cash" class="<?= $error['booked_cash'] ?>"><?= $this->lang->line('label_booked_cash') ?></label>
        <?= form_input(array('name' => 'booked_cash', 'id' => 'booked_cash', 'class' => ''.$error['booked_cash']), set_value('booked_cash')) ?>
    </div>

    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from']), set_value('from')) ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to']), set_value('to')) ?>
    </div>

    

    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_project')) ?>
    </div>
<?= form_close() ?>