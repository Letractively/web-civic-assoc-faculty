<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/dhtmlxcalendar.css" />
<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/skins/dhtmlxcalendar_omega.css" />
<script src="../../../assets/js/calendar/dhtmlxcalendar.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/calendar/dhtmlxcalendar.css" />
<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/js/calendar/skins/dhtmlxcalendar_omega.css" />
<script type="text/javascript" src="<?= base_url(); ?>assets/js/calendar/dhtmlxcalendar.js"></script>
<script type="text/javascript">
	window.onload = function()
	{
		var calendar = new dhtmlXCalendarObject(["from","to"]);
		calendar.setDateFormat("%d.%m.%Y %H:%i");
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
		//calendar.attachObj("from");
	};
</script>

<?= js_insert_bbcode('events/edit', 'textarea'); ?>
<div id="content_wrapper_large">

	<div class="errors">
		<?php 
			echo validation_errors();  
			$field = $this->selecter->id($event_id,'events','event_id');
		?>
	</div>

	<?= form_open("events/edit/".$event_id) ?>
		<div class="inputitem">
			<p class="label"> <label for="event_category_id" class="<?= $error['event_category_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label> </p>
			<?= gen_dropdown('event_category_id', set_value('event_category_id', $field->event_event_category_id),$this->selecter->get_event_categories(),'event_category_id','event_category_name', 'dropdown'); ?>
		</div>

	 <!--generovat prioritu-->
		<div class="inputitem">
			<p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
			<?= gen_dropdown('priority', set_value('priority_id', $field->event_priority), $priorities, 'id', 'value', 'dropdown_priority'); ?>
		</div>
	 <!--end-->
	 
		<div class="inputitem">
			<p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
			<?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name', $field->event_name)) ?>
		</div>
	 
	<!--od -> do-->
		<div class="inputitem">
			<p class="label"> <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label> </p>
			<?= form_input(array('name' => 'from', 'id' => 'from', 'class' => 'input_data_date_time'.$error['from'], 'maxlength' => 16, 'size' => 16), set_value('from', date_create_from_format('Y-m-d H:i:s', $field->event_from)->format('d.m.Y H:i') )) ?>
		</div>
	 
		<div class="inputitem">
			<p class="label"> <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label> </p>
			<?= form_input(array('name' => 'to', 'id' => 'to', 'class' => 'input_data_date_time'.$error['to'], 'maxlength' => 16, 'size' => 16), set_value('to', date_create_from_format('Y-m-d H:i:s', $field->event_to)->format('d.m.Y H:i') )) ?>
		</div>
	<!--end-->
		<div class="inputitem">
			<p class="label"> <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label> </p>
			<div>
				<?php foreach($buttons as $i)
					{
						echo $i;
					}
				?>
			</div>
			<?= form_textarea(array('name' => 'about', 'id' => 'textarea', 'class' => 'textarea_data3'.$error['about']), set_value('about', $field->event_about)) ?>
		</div>

		
		<div class="inputitem">
		     <?php echo '<p class="button_back">'; echo anchor('events/', $this->lang->line('to_events')); echo '</p>'; ?>
		</div>
		
		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_edit_event')) ?>
		</div>
	<?= form_close() ?>
</div>