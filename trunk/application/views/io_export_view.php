<div class="errors">
    <?php echo validation_errors(); ?>
</div>

<?php
	$tables = array(
		array('id' => 'users', 'name' => $this->lang->line('users')),
		array('id' => 'payments', 'name' => $this->lang->line('payments')),
		array('id' => 'events', 'name' => $this->lang->line('events')),
		array('id' => 'projects', 'name' => $this->lang->line('projects')),
	);
?>

<div id="content_wrapper_small">
	<?= form_open("io/export") ?>
		<div class="inputitem">
			<p class="label"> <label for="table"><?= $this->lang->line('label_table') ?></label> </p>
			<?= gen_dropdown('datasource', set_value('id'), $tables, 'id', 'name', 'dropdown'); ?>
		</div>
		<br />
		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_export')) ?>
		</div>		
	<?= form_close() ?>
</div>