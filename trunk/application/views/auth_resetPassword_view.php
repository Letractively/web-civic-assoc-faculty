<div id="content_wrapper_small">
	<?= form_open("{$this->router->class}/{$this->router->method}"); ?>
	<div class="inputitem">
		<span class="label"> <label for="email" class=" <?= $error['email'] ?>"><?= $this->lang->line('label_email') ?> : </label> </span>
		<?= form_input(array('name' => 'email', 'id' => 'email', 'class'=>'input_data'.$error['email']), set_value('email')); ?>
		<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_sub_edit'), $this->lang->line('reset_send')); ?>
	</div>
	<?= form_close(); ?>
</div>