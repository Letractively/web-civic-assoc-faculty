<script type="text/javascript" charset="UTF-8">

	// datova struktura
	function Pair(id,value)
	{
		this.id = id;
		this.value = value;
	}
	
	var review_url = '<?=$this->router->class?>/review';
	
	// typy filtrov, kluc, hodnota
	var filter_types = [
		new Pair('study','odbor'),
		new Pair('grade','stupeň vzdelania'),
		new Pair('degree_year','rok ukončenia')
	];
	
	// kazdemu riadku filtra sem pribudne 
	var filter_types_options = new Array();
	
	// z databazy sa javascriptu vygeneruju mozne studijne programy
	// aby ich js vedel pouzit v danom type filtra
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
	
	// natvrdo stupne vzdelania
	filter_types_options['grade'] = [
		new Pair(1,'1. stupen'),
		new Pair(2,'2. stupen'),
		new Pair(3,'3. stupen')
	];
	
	// z php naplna roky ukoncenia
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
		refreshReviewLink()
	}
	
	// vytvara klikaci text, ktory vie zmazat cely riadok filtra
	function createActiveText(text)
	{
		var new_label = document.createElement('span');
		new_label.setAttribute('onclick', 'removeFilterItem(this)');
		new_label.innerHTML = text;
		return new_label;
	}
	
	// vytvara cely novy riadok filtra
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
		new_filter_value.setAttribute('onchange', 'refreshReviewLink()');
		
		var new_filter_remove = createActiveText('zmaž');
		new_filter_remove.setAttribute('class', 'filter_remove');
		
		new_filter_elem.appendChild(new_filter_type);
		new_filter_elem.appendChild(new_filter_value);
		new_filter_elem.appendChild(new_filter_remove);
		
		root.insertBefore(new_filter_elem, document.getElementById('btn_add'));
		refreshReviewLink()
	}
	
	// maze riadok filtra
	function removeFilterItem(elem)
	{
		elem.parentNode.parentNode.removeChild(elem.parentNode);
		refreshReviewLink()
	}
	
	// refresuje link na zobrazenie zoznamu userov, resp. generuje link pre GET
	function refreshReviewLink()
	{
		var url = review_url;
		
		var filter = document.getElementById('filter').getElementsByTagName('div');
		var first = true;
		for (var i = 0; i < filter.length; ++i)
		{
			if (filter[i].hasAttribute('class') && (filter[i].getAttribute('class') == 'filter_row') )
			{
				var combo_sec = filter[i].getElementsByTagName('select')[1];
				var type = combo_sec.getAttribute('name');
				var val = combo_sec.childNodes[combo_sec.selectedIndex].value;
				if (first) url += '?';
				else url += '&';
				url += type+'='+val;
				first = false;
			}
		}
		
		var link = document.getElementById('review');
		link.setAttribute('href',url);
	}

</script>

<?php
?>

<div class="errors">
    <?php echo validation_errors();         
    //array_debug($programs) ?>
</div>
<div id="form_wrapper">
	<?= form_open("correspondence") ?>
		<div class="inputitem">
			 <p class="label"> <label for="correspondence_subject" class="<?= $error['correspondence_subject'] ?>"><?= $this->lang->line('label_correspondence_subject') ?></label> </p>
			<?= form_input(array('name' => 'correspondence_subject', 'id' => 'correspondence_subject', 'class' => 'input_data'.$error['correspondence_subject']), set_value('correspondence_subject')) ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="correspondence_content" class="<?= $error['correspondence_content'] ?>"><?= $this->lang->line('label_correspondence_content') ?></label> </p>
			<?= form_textarea(array('name' => 'correspondence_content', 'id' => 'correspondence_content', 'class' => 'textarea_data'.$error['correspondence_content']), set_value('correspondence_content')) ?>
		</div>

		<div class="inputitem">
			<p class="label"> <label for="email_type_id"><?= $this->lang->line('label_email_type_id') ?></label> </p>
			<?= gen_dropdown('email_type_id', set_value('email_type_id'),$this->selecter->get_email_types(),'email_type_id','email_type_name'); ?>
		</div>
		
		<div id="filter" class="inputitem">
			<div id="btn_add" onclick="addFilterItem()"><?= $this->lang->line('button_filter_add'); ?></div>
		</div>
		
		<div id="link"><?= anchor($this->router->class.'/review', $this->lang->line('correspondence_review'), 'id="review", target="_blank"'); ?></div>
                
		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit' ), $this->lang->line('button_correspondence')) ?>
		</div>
	<?= form_close() ?>
</div>