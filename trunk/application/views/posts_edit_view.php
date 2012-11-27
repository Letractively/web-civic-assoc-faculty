<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($post_id,'posts','post_id');
    ?>
</div>
<?= form_open("posts/edit") ?>
    
    <div class="inputitem">
        <label for="subject" class="<?= $error['subject'] ?>"><?= $this->lang->line('label_subject') ?></label>
        <?= form_input(array('name' => 'subject', 'id' => 'subject', 'class' => ''.$error['subject']), set_value('subject', $field->post_subject)) ?>
    </div>

    <div class="inputitem">
        <label for="content" class="<?= $error['content'] ?>"><?= $this->lang->line('label_content') ?></label>
        <?= form_textarea(array('name' => 'content', 'id' => 'content', 'class' => ''.$error['content']), set_value('content', $field->post_content)) ?>
    </div>

    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit_post')) ?>
    </div>
<?= form_close() ?>
