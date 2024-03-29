<div id="content_wrapper_large">

	<div class="errors">
		<?php
		echo validation_errors();
		?>
	</div>

    <?= js_insert_bbcode('posts/add', 'textarea'); ?>
    <?= form_open("posts/add") ?>
    <div class="inputitem">
        <p class="label"> <label for="title" class="<?= $error['title'] ?>"><?= $this->lang->line('label_subject') ?></label> </p>
        <?= form_input(array('name' => 'title', 'id' => 'title', 'class' => 'input_data' . $error['title']), set_value('title')) ?>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
        <?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value', 'dropdown_priority'); ?>
    </div>

    <div class="inputitem">
        <p class="label"> <label for="content" class="<?= $error['content'] ?>"><?= $this->lang->line('label_content') ?></label> </p>
        <div>
            <?php
            foreach ($buttons as $i) {
                echo $i;
            }
            ?>
        </div> 
        <?= form_textarea(array('name' => 'content', 'id' => 'textarea', 'class' => 'textarea_data3' . $error['content']), set_value('content')) ?>
    </div>  

    <div class="inputitem">
        <p class="label"><label for="post_published" ><?= $this->lang->line('published') ?></label> </p>
        <?= form_checkbox(array('value' => '0', 'name' => 'post_published', 'class' => 'post_published', 'id' => 'post_published','onchange'=>'zmenstav()')) ?>
    </div>

    <div class="inputitem">
        <?php echo '<p class="button_back">';
        echo anchor('posts/', $this->lang->line('to_posts'));
        echo '</p>'; ?>
    </div>

    <div class="inputitem">
    <?= form_submit(array('type' => 'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_add_post')) ?>
    </div>
<?= form_close() ?>
</div>