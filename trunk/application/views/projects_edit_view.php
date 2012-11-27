<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($project_id,'projects','project_id');
    ?>
</div>
<?= form_open("project/edit") ?>

    <div class="inputitem">
        <label for="project_name" class="<?= $error['project_name'] ?>"><?= $this->lang->line('project_name') ?></label>
        <?= form_input(array('name' => 'project_name', 'id' => 'project_name', 'class' => ''.$error['project_name']), set_value('project_name', $field->project_name)) ?>
    </div>

    <div class="inputitem">
        <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label>
        <?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => ''.$error['about']), set_value('about', $field->project_about)) ?>
    </div>

 <!--generovat prioritu-->
    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= form_dropdown('priority', $priorities, set_value('priority_id', $field->event_priority)) ?>
    </div>
 <!--end-->
 
    <div class="inputitem">
        <label for="project_categories_id" class="<?= $error['project_categories_id'] ?>"><?= $this->lang->line('label_project_category_id') ?></label>
        <?= gen_dropdown('project_categories_id', set_value('project_categories_id', $field->project_project_category_id),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?>
    </div>
    
    <div class="inputitem">
        <label for="booked_cash" class="<?= $error['booked_cash'] ?>"><?= $this->lang->line('label_booked_cash') ?></label>
        <?= form_input(array('name' => 'booked_cash', 'id' => 'booked_cash', 'class' => ''.$error['booked_cash']), set_value('booked_cash', $field->project_booked_cash)) ?>
    </div>
 
<!--od -> do-->
    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from']), set_value('from', $field->project_from)) ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to']), set_value('to', $field->project_to)) ?>
    </div>
<!--end-->

   

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit_project')) ?>
    </div>
<?= form_close() ?>
