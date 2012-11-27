<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($post_id,'posts','post_id');
    ?>
</div>
<?= form_open("posts/edit") ?>
    
    <div class="inputitem">
        <label for="title" class="<?= $error['title'] ?>"><?= $this->lang->line('label_subject') ?></label>
        <?= form_input(array('name' => 'title', 'id' => 'title', 'class' => ''.$error['title']), set_value('title', $field->post_title)) ?>
    </div>

    <div class="inputitem">
        <label for="content" class="<?= $error['content'] ?>"><?= $this->lang->line('label_content') ?></label>
        <?= form_textarea(array('name' => 'content', 'id' => 'content', 'class' => ''.$error['content']), set_value('content', $field->post_content)) ?>
    </div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit_post')) ?>
    </div>
<?= form_close() ?>