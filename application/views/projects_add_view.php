<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>

<div id="content_wrapper">
	<?= form_open("projects/add") ?>

		<div class="inputitem">
			<p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
			<?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name')) ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label> </p>
			<?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => 'textarea_data'.$error['about']), set_value('about')) ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
			<?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value'); ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="project_category_id" class="<?= $error['project_category_id'] ?>"><?= $this->lang->line('label_project_category_id') ?></label> </p>
			<?= gen_dropdown('project_category_id', set_value('project_category_id'),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?> 
		</div>

		<div class="inputitem">
			<p class="label"> <label for="booked_cash" class="<?= $error['booked_cash'] ?>"><?= $this->lang->line('label_booked_cash') ?></label> </p>
			<?= form_input(array('name' => 'booked_cash', 'id' => 'booked_cash', 'class' => 'input_data'.$error['booked_cash']), set_value('booked_cash')) ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label> </p>
			<?= form_input(array('name' => 'from', 'id' => 'from', 'class' => 'input_data_date'.$error['from']), set_value('from')) ?>
		</div>
	 
		<div class="inputitem">
			<p class="label"> <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label> </p>
			<?= form_input(array('name' => 'to', 'id' => 'to', 'class' => 'input_data_date'.$error['to']), set_value('to')) ?>
		</div>

		

		

		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_add_project')) ?>
		</div>
	<?= form_close() ?>
</div>