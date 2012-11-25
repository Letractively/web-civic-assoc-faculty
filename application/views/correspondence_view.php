<div class="errors">
    <?php echo validation_errors();     
    
    //array_debug($programs) ?>

</div>
<?= form_open("correspondence/review") ?>
    <div class="inputitem">
        <label for="title" class="<?= $error['title'] ?>"><?= $this->lang->line('label_title') ?></label>
        <?= form_input(array('name' => 'title', 'id' => 'title', 'class' => ''.$error['title']), set_value('title')) ?>
    </div>

    <div class="inputitem">
        <label for="body" class="<?= $error['body'] ?>"><?= $this->lang->line('label_body') ?></label>
        <?= form_textarea(array('name' => 'body', 'id' => 'body', 'class' => ''.$error['body']), set_value('body')) ?>
    </div>

    <div class="inputitem">
        <label for="email_types_id" class="<?= $error['email_types_id'] ?>"><?= $this->lang->line('label_email_types_id') ?></label>
        <?= form_dropdown('email_types_id', $email_types, set_value('email_types_id')) ?>
    </div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_correspondence')) ?>
    </div>
<?= form_close() ?>