<div class="errors">
    <?php echo validation_errors();         
    //array_debug($programs) ?>
</div>
<?= form_open("correspondence/review") ?>
    <div class="inputitem">
        <label for="correspondence_subject" class="<?= $error['correspondence_subject'] ?>"><?= $this->lang->line('label_correspondence_subject') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'correspondence_subject', 'class' => ''.$error['correspondence_subject']), set_value('correspondence_subject')) ?>
    </div>

    <div class="inputitem">
        <label for="correspondence_content" class="<?= $error['correspondence_content'] ?>"><?= $this->lang->line('label_correspondence_content') ?></label>
        <?= form_textarea(array('name' => 'correspondence_content', 'id' => 'correspondence_content', 'class' => ''.$error['correspondence_content']), set_value('correspondence_content')) ?>
    </div>

    <div class="inputitem">
        <label for="email_type_id" class="<?= $error['email_type_id'] ?>"><?= $this->lang->line('label_email_type_id') ?></label>
        <?= gen_dropdown('email_type_id', set_value('email_type_id'),$this->selecter->get_email_types(),'email_type_id','email_type_name'); ?>
    </div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_correspondence')) ?>
    </div>
<?= form_close() ?>
