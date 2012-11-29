<script type="text/javascript" charset="UTF-8">

	function FilterType(name,text)
	{
		this.name = name;
		this.text = text;
	}
	
	function Option(id,value)
	{
		this.id = name;
		this.value = text;
	}
	
	var filter_types = [
		new FilterType('study','odbor'),
		new FilterType('grade','stupeò vzdelania'),
		new FilterType('degree_year','rok ukonèenia')
	];
	
	var filter_types_options = new Array();
	filter_types_options['study'] = [
		new Option(0,'ain'),
		new Option(2,'in'),
		new Option(5,'fyz'),
		new Option(8,'mat')
	];
	filter_types_options['grade'] = [
		new Option(1,'1. stupen'),
		new Option(2,'2. stupen'),
		new Option(3,'3. stupen')
	];
	filter_types_options['degree_year'] = [
		new Option(1990,'1990'),
		new Option(1991,'1991'),
		new Option(1992,'1992')
	];

	function changeFilterType(id)
	{
	}
	
	function removeAllChild(elem)
	{
	}
	
	function addFilterItem()
	{
	}
	
	function removeFilterItem(elem)
	{
	}

</script>

<?php
?>

<div class="errors">
    <?php echo validation_errors();         
    //array_debug($programs) ?>
</div>
<?= form_open("correspondence/review") ?>
    <div class="inputitem">
        <label for="correspondence_subject" class="<?= $error['correspondence_subject'] ?>"><?= $this->lang->line('label_correspondence_subject') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'correspondence_subject', 'class' => ''.$error['correspondence_subject']), set_value('correspondence_subject')) ?>
    </div>

    <div class="inputitem">
        <label for="correspondence_content" class="<?= $error['correspondence_content'] ?>"><?= $this->lang->line('label_correspondence_content') ?></label>
        <?= form_textarea(array('name' => 'correspondence_content', 'id' => 'correspondence_content', 'class' => ''.$error['correspondence_content']), set_value('correspondence_content')) ?>
    </div>

    <div class="inputitem">
        <label for="email_type_id" class="<?= $error['email_type_id'] ?>"><?= $this->lang->line('label_email_type_id') ?></label>
        <?= gen_dropdown('email_type_id', set_value('email_type_id'),$this->selecter->get_email_types(),'email_type_id','email_type_name'); ?>
    </div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_correspondence')) ?>
    </div>
<?= form_close() ?>
