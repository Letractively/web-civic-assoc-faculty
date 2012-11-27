<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>
<?= form_open("posts/add") ?>
   
    <div class="inputitem">
        <label for="title" class="<?= $error['title'] ?>"><?= $this->lang->line('label_subject') ?></label>
        <?= form_input(array('name' => 'title', 'id' => 'title', 'class' => ''.$error['title']), set_value('title')) ?>
    </div>
 

    <div class="inputitem">
        <label for="content" class="<?= $error['content'] ?>"><?= $this->lang->line('label_content') ?></label>
        <?= form_textarea(array('name' => 'content', 'id' => 'content', 'class' => ''.$error['content']), set_value('content')) ?>
    </div>  

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_post')) ?>
    </div>
<?= form_close() ?>