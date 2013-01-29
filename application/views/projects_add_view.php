<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/dhtmlxcalendar.css"></link>
<link rel="stylesheet" type="text/css" href="../../../assets/js/calendar/skins/dhtmlxcalendar_omega.css"></link>
<script src="../../../assets/js/calendar/dhtmlxcalendar.js"></script>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/calendar/dhtmlxcalendar.css"></link>
<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/js/calendar/skins/dhtmlxcalendar_omega.css"></link>
<script src="<?= base_url() ?>assets/js/calendar/dhtmlxcalendar.js"></script>
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
    <?php echo validation_errors(); ?>
</div>

<div id="content_wrapper_small">
    <?= form_open("projects/add") ?>

    <div class="inputitem">
        <p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data' . $error['name']), set_value('name')) ?>
    </div>

    <div class="inputitem">
        <p class="label"> <label for="priority" class="<?= $error['priority'] ?>"><?= $this->lang->line('label_priority') ?></label> </p>
        <?= gen_dropdown('priority', set_value('priority_id'), $priorities, 'id', 'value', 'dropdown_priority'); ?>
    </div>

    <div class="inputitem">
        <p class="label"> <label for="project_category_id" class="<?= $error['project_category_id'] ?>"><?= $this->lang->line('label_project_category_id') ?></label> </p>
        <?= gen_dropdown('project_category_id', set_value('project_category_id'), $this->selecter->get_project_categories(), 'project_category_id', 'project_category_name', 'dropdown'); ?> 
    </div>

    <div class="inputitem">
        <p class="label"> <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label> </p>
        <?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => 'textarea_data' . $error['about']), set_value('about')) ?>
    </div>

    <div class="inputitem">
        <p class="label"> <label for="booked_cash" class="<?= $error['booked_cash'] ?>"><?= $this->lang->line('label_booked_cash') ?></label> </p>
        <?= form_input(array('name' => 'booked_cash', 'id' => 'booked_cash', 'class' => 'input_data' . $error['booked_cash']), set_value('booked_cash')) ?>
    </div>

    <div class="inputitem">
        <p class="label"> <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label> </p>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => 'input_data_date' . $error['from']), set_value('from')) ?>
    </div>

    <div class="inputitem">
        <p class="label"> <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label> </p>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => 'input_data_date' . $error['to']), set_value('to')) ?>
    </div>

    <div class="inputitem">
        <?php echo '<p class="button_edit">';
        echo anchor('projects/', $this->lang->line('to_projects'));
        echo '</p>'; ?>
    </div>

    <div class="inputitem">
    <?= form_submit(array('type' => 'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_add_project')) ?>
    </div>
<?= form_close() ?>
</div>