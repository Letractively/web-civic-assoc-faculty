<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->get_project_detail($project_id,'projects','project_id');
    ?>
</div>

<div id="content_wrapper">
	<?= form_open("projects/edit") ?>

		<div class="inputitem">
			<p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
			<?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name', $field[0]->project_name)) ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label> </p>
			<?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => 'textarea_data'.$error['about']), set_value('about', $field[0]->project_about)) ?>
		</div>

	 <!--generovat prioritu-->
		<div class="inputitem">
			<p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
			<?= form_dropdown('priority', $priorities, set_value('priority_id', $field[0]->project_priority)) ?>
		</div>
	 <!--end-->
	 
		<div class="inputitem">
			<p class="label"> <label for="project_categories_id" class="<?= $error['project_category_id'] ?>"><?= $this->lang->line('label_project_category_id') ?></label> </p>
			<?= gen_dropdown('project_categories_id', set_value('project_categories_id', $field[0]->project_project_category_id),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?>
		</div>
		
		<div class="inputitem">
			<p class="label"> <label for="booked_cash" class="<?= $error['booked_cash'] ?>"><?= $this->lang->line('label_booked_cash') ?></label> </p>
			<?= form_input(array('name' => 'booked_cash', 'id' => 'booked_cash', 'class' => 'input_data'.$error['booked_cash']), set_value('booked_cash', $field[0]->project_booked_cash)) ?>
		</div>
	 
	<!--od -> do-->
		<?php
			$from = datetime($field[0]->project_date_from, FALSE);
			$to = datetime($field[0]->project_date_to, FALSE);
		?>
		<div class="inputitem">
			<p class="label"> <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label> </p>
			<?= form_input(array('name' => 'from', 'id' => 'from', 'class' => 'input_data_date'.$error['from']), set_value('from', $from)) ?>
		</div>
	 
		<div class="inputitem">
			<p class="label"> <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label> </p>
			<?= form_input(array('name' => 'to', 'id' => 'to', 'class' => 'input_data_date'.$error['to']), set_value('to', $to)) ?>
		</div>
	<!--end-->

		<?php
			$this->load->library('grid');
			
			$grid = new Grid();
			if( $grid->bind($this->selecter->get_project_items($project_id), 'project_id') )
			{
				$grid->add_url = "{$this->router->class}/add";
				$grid->edit_url = "{$this->router->class}/edit";
				$grid->remove_url = "{$this->router->class}/delete";

				$grid->header('project_id')->editable = false;


				$grid->display();
			}
		?>

		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_edit1'), $this->lang->line('button_edit_project')) ?>
		
			<?= form_submit(array('type'=>'submit', 'name' => 'close', 'class' => 'button_close'), $this->lang->line('button_close_project')) ?>
		</div>
	<?= form_close() ?>
        <?php
            echo anchor('projects/', $this->lang->line('to_projects'));
        ?>
</div>