<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($post_id,'posts','post_id');
    ?>
</div>

<div id="content_wrapper">
	<?= js_insert_bbcode('posts/edit', 'textarea'); ?>
	<?= form_open("posts/edit/".$post_id) ?>
		<div class="inputitem">
			<p class="label"> <label for="title" class="<?= $error['title'] ?>"><?= $this->lang->line('label_subject') ?></label> </p>
			<?= form_input(array('name' => 'title', 'id' => 'title', 'class' => 'input_data'.$error['title']), set_value('title', $field->post_title)) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
			<?= gen_dropdown('priority', set_value('priority_id', $field->post_priority), $priorities, 'id', 'value', 'dropdown_priority'); ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="content" class="<?= $error['content'] ?>"><?= $this->lang->line('label_content') ?></label> </p>
			<div>
				<?php foreach($buttons as $i)
					{
						echo $i;
					}
				?>
			</div> 
			<?= form_textarea(array('name' => 'content', 'id' => 'textarea', 'class' => 'textarea_data'.$error['content']), set_value('content', $field->post_content)) ?>
		</div>
                <div class="inputitem">
                        <p class="label"><label for="content" class="<?= $error['content'] ?>"><?=$this->lang->line('published')?></label> </p>
			<?php
                           if($field->post_published == 1)
                            {
                                echo form_checkbox(array('checked'=>'checked','value'=>'1','name' => 'post_published', 'class' => 'post_published', 'id' => 'post_published','onchange'=>'zmenstav()'));
                            }
                            else
                                echo form_checkbox(array('value'=>'0','name' => 'post_published', 'class' => 'post_published', 'id' => 'post_published','onchange'=>'zmenstav()'));
                        ?>
		</div>
		
		<div class="inputitem">
			<?php echo '<p class="button_back">'; echo anchor('posts/detail/'.$post_id, $this->lang->line('to_post_detail')); echo '</p>'; ?>
		</div>
		
		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_edit_post')) ?>
		</div>
	<?= form_close() ?>

</div>