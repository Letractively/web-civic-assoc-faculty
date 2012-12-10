<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($event_id,'events','event_id');
    ?>
</div>
<?= js_insert_bbcode('events/edit', 'textarea'); ?>
<div id="form_wrapper">
	<?= form_open("events/edit/".$event_id) ?>
		<div class="inputitem">
			<p class="label"> <label for="event_category_id" class="<?= $error['event_category_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label> </p>
			<?= gen_dropdown('event_category_id', set_value('event_category_id', $field->event_event_category_id),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>
		</div>

	 <!--generovat prioritu-->
		<div class="inputitem">
			<p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
			<?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value'); ?>
		</div>
	 <!--end-->
	 
		<div class="inputitem">
			<p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
			<?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name', $field->event_name)) ?>
		</div>
	 
	<!--od -> do-->
		<div class="inputitem">
			<p class="label"> <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label> </p>
			<?= form_input(array('name' => 'from', 'id' => 'from', 'class' => 'input_data_date'.$error['from'], 'maxlength' => 10, 'size' => 10), set_value('from', datetime($field->event_from, FALSE))) ?>
			<?= form_input(array('name' => 'from_time', 'maxlength' => 5, 'size' => 5, 'class' => 'input_data_time'), set_value('from_time',  time_withou_seconds(datetime($field->event_from, TRUE)))); ?>
		</div>
	 
		<div class="inputitem">
			<p class="label"> <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label> </p>
			<?= form_input(array('name' => 'to', 'id' => 'to', 'class' => 'input_data_date'.$error['to'], 'maxlength' => 10, 'size' => 10), set_value('to',  datetime($field->event_to, FALSE))) ?>
			<?= form_input(array('name' => 'to_time', 'maxlength' => 5, 'size' => 5, 'class' => 'input_data_time'), set_value('to_time', time_withou_seconds(datetime($field->event_to, TRUE)))); ?>
		</div>
	<!--end-->
		<div>
			<?php
				foreach($buttons as $i)
				{
					echo $i;
				}
			?>
		</div>  
		<div class="inputitem">
			<p class="label"> <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label> </p>
			<?= form_textarea(array('name' => 'about', 'id' => 'textarea', 'class' => 'textarea_data'.$error['about']), set_value('about', $field->event_about)) ?>
		</div>

		

		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_edit_event')) ?>
		</div>
	<?= form_close() ?>
</div>