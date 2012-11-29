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
	
	var filter_types_options = new Array(); // nahrad konstanty udajmi z databazy
	filter_types_options['study'] = [
		new Pair(0,'ain'),
		new Pair(2,'in'),
		new Pair(5,'fyz'),
		new Pair(8,'mat')
	];
	filter_types_options['grade'] = [
		new Pair(1,'1. stupen'),
		new Pair(2,'2. stupen'),
		new Pair(3,'3. stupen')
	];
	filter_types_options['degree_year'] = [
		new Pair(1990,'1990'),
		new Pair(1991,'1991'),
		new Pair(1992,'1992')
	];
	
	function createCombobox(name, options)
	{
		var new_combo = document.createElement('select');
		if (name != '') new_combo.setAttribute('name', name);
		
		for (var i = 0; i < options.length; ++i)
		{
			var new_option = document.createElement('option');
			new_option.setAttribute('name', options[i].id);
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
			new_option.setAttribute('name', options[i].id);
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
		new_filter_type.setAttribute('onchange', 'changeComboboxOptions(this.parentNode.childNodes[1], this.options[this.selectedIndex].getAttribute("name"), filter_types_options[ this.options[this.selectedIndex].getAttribute("name") ])');
		
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
	
	<div id="filter" class="inputitem">
		<div id="btn_add" onclick="addFilterItem()">pridaj</div>
	</div>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_correspondence')) ?>
    </div>
<?= form_close() ?>
