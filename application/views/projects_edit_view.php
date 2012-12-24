<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/dhtmlxcalendar.css"></link>
<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/skins/dhtmlxcalendar_omega.css"></link>
<script src="../../../assets/js/calendar/dhtmlxcalendar.js"></script>
<script type="text/javascript">
	window.onload = function()
	{
		var calendar = new dhtmlXCalendarObject(["from","to"]);
		calendar.setDateFormat("%d.%m.%Y");
		dhtmlXCalendarObject.prototype.langData["sk"] =
		{
			//date format
			dateformat: '%d.%m.%Y',
			//full names of months
			monthesFNames: ["Január","Február","Marec","Apríl","Máj","Jún","Júl","August","September","Október","November","December"],
			//shortened names of months
			monthesSNames: ["Jan","Feb","Mar","Apr","Máj","Jún","Júl","Aug","Sep","Okt","Nov","Dec"],
			//full names of days
			daysFNames: ["Nedeľa","Pondelok","Útorok","Streda","Štvrtok","Piatok","Sobota"],
			//shortened names of days
			daysSNames: ["Ne","Po","Ut","St","Št","Pi","So"],
			//starting day of a week. Number from 1(Monday) to 7(Sunday)
			weekstart: 1
		}
		calendar.loadUserLanguage("sk");
		calendar.setSkin('omega');
		calendar.hideTime();
		//calendar.attachObj("from");
	};
</script>

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

		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_edit1'), $this->lang->line('button_edit_project')) ?>
		
			<?= form_submit(array('type'=>'submit', 'name' => 'close', 'class' => 'button_close'), $this->lang->line('button_close_project')) ?>
		</div>
	<?= form_close() ?>
	
	<?php
			$this->load->library('grid');
			
			$grid = new Grid();
			
			$items_object = $this->selecter->get_project_items($project_id);
			$items = array();
			foreach ($items_object as $item_object)
			{
				$item = get_object_vars($item_object);
				$item['user_fullname'] = $item['user_name'].' '.$item['user_surname'];
				$items[] = $item;
			}
			
			$users_object = $this->selecter->get_users(ROLE_ADMIN);
			$users = array();
			foreach ($users_object as $user_object)
			{
				$user = get_object_vars($user_object);
				$user['user_fullname'] = $user['user_name'].' '.$user['user_surname'];
				$users[] = $user;
			}
			
			if( $grid->bind($items, 'project_item_id') )
			{
				$grid->add_url = base_url()."projects/add_project_item/$project_id";
				$grid->edit_url = base_url()."projects/edit_project_item/$project_id";
				$grid->remove_url = "projects/delete_project_item/$project_id";

				$grid->header('project_item_id')->visible = false;
				$grid->header('user_id')->visible = false;
				$grid->header('user_name')->visible = false;
				$grid->header('user_surname')->visible = false;
				$grid->header('project_item_date')->editable = false;
				$grid->header('project_item_date')->set_datetime('Y-m-d');
				$grid->header('project_item_price')->set_numformat('{2:,: } EUR');
				$grid->header('user_fullname')->component->type = 'combobox';
				$grid->header('user_fullname')->component->bind($users, 'user_id', 'user_fullname');

                                $grid->header('project_item_name')->text = $this->lang->line('label_item');
                                $grid->header('project_item_price')->text = $this->lang->line('label_price');
                                $grid->header('project_item_date')->text = $this->lang->line('label_date');
                                $grid->header('user_fullname')->text = $this->lang->line('label_fullname');
                                
				$grid->display();
			}
		?>
	
        <?php
            echo anchor('projects/', $this->lang->line('to_projects'));
        ?>
</div>