<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($post_id,'posts','post_id');
    ?>
</div>
<?= js_insert_bbcode('posts/edit', 'textarea'); ?>
<?= form_open("posts/edit/".$post_id) ?>
    
    <div class="inputitem">
        <label for="title" class="<?= $error['title'] ?>"><?= $this->lang->line('label_subject') ?></label>
        <?= form_input(array('name' => 'title', 'id' => 'title', 'class' => ''.$error['title']), set_value('title', $field->post_title)) ?>
    </div>
    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value'); ?>
    </div>
    <div>
        <?php
            foreach($buttons as $i)
            {
                echo $i;
            }
        ?>
    </div> 
    <div class="inputitem">
        <label for="content" class="<?= $error['content'] ?>"><?= $this->lang->line('label_content') ?></label>
        <?= form_textarea(array('name' => 'content', 'id' => 'textarea', 'class' => ''.$error['content']), set_value('content', $field->post_content)) ?>
    </div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit_post')) ?>
    </div>
<?= form_close() ?>