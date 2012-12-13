<!--<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.min.css" />-->
<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/dhtmlxcalendar.css"></link>
<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/skins/dhtmlxcalendar_omega.css"></link>
<script src="../../../assets/js/calendar/dhtmlxcalendar.js"></script>
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

<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>
<?= js_insert_bbcode('events/add', 'textarea'); ?>
<?= form_open("events/add", array('onload' => 'initCalendar()')) ?>
    <div class="inputitem">
        <label for="event_category_id" class="<?= $error['event_category_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label>
        <?= gen_dropdown('event_category_id', set_value('event_category_id'),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>     
    </div>
 <!--dropdown robis takto ako je hore gen_dropdown, to co su tie parametre uvidis ked si otvoris danu funkciu-->
 <!--generovat prioritu-->
    <div class="inputitem">
        <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label>
        <?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value'); ?>
    </div>
 <!--end-->
 
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?>
    </div>
 
<!--od -> do-->
    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from'], 'maxlength' => 16, 'size' => 16), set_value('from')) ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to'], 'maxlength' => 16, 'size' => 16), set_value('to')) ?>
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
        <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label>
        <?= form_textarea(array('name' => 'about', 'id' => 'textarea', 'class' => ''.$error['about']), set_value('about')) ?>
    </div>

    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_event')) ?>
    </div>
<?= form_close() ?>