<script type="text/javascript" charset="UTF-8">

	function Pair(id,value)
	{
		this.id = id;
		this.value = value;
	}
	
	var filter_types = [
		new Pair('study','odbor'),
		new Pair('grade','stupeň vzdelania'),
		new Pair('degree_year','rok ukončenia')
	];
	
	var filter_types_options = new Array();
	
	filter_types_options['study'] = [
	<?php
		$study_programs = $this->selecter->get_study_programs();
		$first = true;
		foreach ($study_programs as $study_program)
		{
			if ($first == false) echo ','."\n";
			echo "new Pair('$study_program->study_program_id', '$study_program->study_program_name')";
			$first = false;
		}
	?> ];
	
	filter_types_options['grade'] = [
		new Pair(1,'1. stupen'),
		new Pair(2,'2. stupen'),
		new Pair(3,'3. stupen')
	];
	
	filter_types_options['degree_year'] = [
	<?php
		$first = true;
		foreach(array_reverse($years) as $index => $value)
		{
			if ($first == false) echo ','."\n";
			echo "new Pair($value, '$value')";
			$first = false;
		}
	?>
	];

	function createCombobox(name, options)
	{
		var new_combo = document.createElement('select');
		if (name != '') new_combo.setAttribute('name', name);
		
		for (var i = 0; i < options.length; ++i)
		{
			var new_option = document.createElement('option');
			new_option.setAttribute('value', options[i].id);
			new_option.innerHTML = options[i].value;
			new_combo.appendChild(new_option);
		}
		
		return new_combo;
	}
	
	function removeAllChild(elem)
	{
		while (elem.childNodes.length > 0)
			elem.removeChild(elem.childNodes[0]);
	}
	
	function changeComboboxOptions(combobox, name, options)
	{
		removeAllChild(combobox);
		combobox.setAttribute('name', name+'[]');
			
		for (var i = 0; i < options.length; ++i)
		{
			var new_option = document.createElement('option');
			new_option.setAttribute('value', options[i].id);
			new_option.innerHTML = options[i].value;
			combobox.appendChild(new_option);
		}
	}
	
	function createActiveText(text)
	{
		var new_label = document.createElement('span');
		new_label.setAttribute('onclick', 'removeFilterItem(this)');
		new_label.innerHTML = text;
		return new_label;
	}
	
	function addFilterItem()
	{
		var root = document.getElementById('filter');
		
		var new_filter_elem = document.createElement('div');
		new_filter_elem.setAttribute('class', 'filter_row');
		
		var new_filter_type = createCombobox('', filter_types);
		new_filter_type.setAttribute('class', 'filter_type');
		new_filter_type.setAttribute('onchange', 'changeComboboxOptions(this.parentNode.childNodes[1], this.options[this.selectedIndex].getAttribute("value"), filter_types_options[ this.options[this.selectedIndex].getAttribute("value") ])');
		
		var new_filter_value = createCombobox('study[]', filter_types_options['study']);
		new_filter_value.setAttribute('class', 'filter_value');
		
		var new_filter_remove = createActiveText('zmaž');
		new_filter_remove.setAttribute('class', 'filter_remove');
		
		new_filter_elem.appendChild(new_filter_type);
		new_filter_elem.appendChild(new_filter_value);
		new_filter_elem.appendChild(new_filter_remove);
		
		//root.appendChild(new_filter_elem);
		root.insertBefore(new_filter_elem, document.getElementById('btn_add'));
	}
	
	function removeFilterItem(elem)
	{
		elem.parentNode.parentNode.removeChild(elem.parentNode);
	}

</script>

<?php
?>

<div class="errors">
    <?php echo validation_errors();         
    //array_debug($programs) ?>
</div>
<?= form_open("correspondence") ?>
    <div class="inputitem">
        <label for="correspondence_subject" class="<?= $error['correspondence_subject'] ?>"><?= $this->lang->line('label_correspondence_subject') ?></label>
        <?= form_input(array('name' => 'correspondence_subject', 'id' => 'correspondence_subject', 'class' => ''.$error['correspondence_subject']), set_value('correspondence_subject')) ?>
    </div>

    <div class="inputitem">
        <label for="correspondence_content" class="<?= $error['correspondence_content'] ?>"><?= $this->lang->line('label_correspondence_content') ?></label>
        <?= form_textarea(array('name' => 'correspondence_content', 'id' => 'correspondence_content', 'class' => ''.$error['correspondence_content']), set_value('correspondence_content')) ?>
    </div>

    <div class="inputitem">
        <label for="email_type_id"><?= $this->lang->line('label_email_type_id') ?></label>
        <?= gen_dropdown('email_type_id', set_value('email_type_id'),$this->selecter->get_email_types(),'email_type_id','email_type_name'); ?>
    </div>
	
    <div id="filter" class="inputitem">
        <div id="btn_add" onclick="addFilterItem()"><?= $this->lang->line('button_filter_add'); ?></div>
    </div>
    
    <span id="hideShow"><?= $this->lang->line('correspondence_review'); ?></span>
    <div>
        TU BUDE GRID
    </div>
    
    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_correspondence')) ?>
    </div>
<?= form_close() ?>