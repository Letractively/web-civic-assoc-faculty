<?= form_open("{$this->router->class}/{$this->router->method}"); ?>
<label for="email" class=" <?= $error['email'] ?>"><?= $this->lang->line('label_email') ?> : </label>
<?= form_input(array('name' => 'email', 'id' => 'email', 'class'=>'input_data'.$error['email']), set_value('email')); ?>
<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => ''), $this->lang->line('reset_send')); ?>
<?= form_close(); ?>