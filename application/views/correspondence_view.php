<div class="errors">
    <?php echo validation_errors();         
    //array_debug($programs) ?>
</div>
<?= form_open("correspondence/review") ?>
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?>
    </div>

    <div class="inputitem">
        <label for="body" class="<?= $error['body'] ?>"><?= $this->lang->line('label_body') ?></label>
        <?= form_textarea(array('name' => 'body', 'id' => 'body', 'class' => ''.$error['body']), set_value('body')) ?>
    </div>

    <div class="inputitem">
        <label for="email_type_id" class="<?= $error['email_type_id'] ?>"><?= $this->lang->line('label_email_type_id') ?></label>
        <?= gen_dropdown('email_type_id', set_value('email_type_id'),$this->selecter->get_email_types(),'email_type_id','email_type_name') ?>
    </div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_correspondence')) ?>
    </div>
<?= form_close() ?>
