<script type="text/javascript" charset="UTF-8">
	var base_url = '<?=base_url()?>';

	function changeFilter(sender)
	{
		var event_sort = document.getElementById('event_sort');
		var event_category = document.getElementById('event_category');
		var url = event_sort.options[event_sort.selectedIndex].value;
		var cat_id = event_category.options[event_category.selectedIndex].value;
		window.location = base_url+url+'/'+cat_id;
	}
</script>

<div id="grid_wrapper">
	<?php
		if( $this->userdata->is_admin() )
		{
			echo '<p class="button_edit">'; echo anchor('event_categories/', $this->lang->line('to_event_categories')); echo '</p>';
		}
	?>
	
	<?php
		$event_sorters = array(
			array('id' => 'events', 'value' => $this->lang->line('events_all')),
			array('id' => 'events/newest', 'value' => $this->lang->line('events_newest')),
			array('id' => 'events/prior', 'value' => $this->lang->line('events_prior'))
		);
		
		$event_cats = $this->selecter->get_event_categories();
		$event_cats[] = array('event_category_id' => 0, 'event_category_name' => $this->lang->line('events_all'));
	?>
	<span> Usporiadať: </span>
		<?= gen_dropdown('event_sort', $event_sorters[$flag]['id'], $event_sorters, 'id', 'value', 'dropdown','id="event_sort" onchange="changeFilter(this);"'); ?>
	<span> Vybrať z kategórie: </span>
		<?= gen_dropdown('event_category', $event_cat_id, $event_cats, 'event_category_id', 'event_category_name', 'dropdown', 'id="event_category" onchange="changeFilter(this);"'); ?>
		
	<?php
		$this->load->library('grid');
		
		$grid = new Grid();
		$method = '';
		
		switch ($flag)
		{
			case 0:
				if ( $grid->bind($this->selecter->get_events($event_cat_id), 'event_id') )
					$method = 'get_events';
				break;
			case 1:
				if ( $grid->bind($this->selecter->get_events_newest($event_cat_id), 'event_id') )
				$method = 'get_events_newest';
				break;
			case 2:
				if ( $grid->bind($this->selecter->get_events_prior($event_cat_id), 'event_id') )
				$method = 'get_events_prior';
				break;
		}
		
		if( $method != '' )
		{
			$grid->header('event_id')->editable = false;
			$grid->header('event_id')->visible              = false;
			$grid->header('event_about')->visible           = false;
			//$grid->header('event_created')->visible         = false;
			$grid->header('event_category_name')->text = $this->lang->line('label_catname');
			$grid->header('event_priority')->visible        = false;
			$grid->header('event_name')->set_anchor('events/detail', 'event_id');
			$grid->header('event_name')->text   = $this->lang->line('label_name');
			$grid->header('event_from')->set_datetime();
			$grid->header('event_from')->text   = $this->lang->line('label_from');
			$grid->header('event_to')->set_datetime();
			$grid->header('event_to')->text     = $this->lang->line('label_to');
                        
                        //$grid->add_url = "{$this->router->class}/add";
                        //$grid->edit_url = "{$this->router->class}/edit";
                        $grid->remove_url = "{$this->router->class}/delete";
		}

		$grid->display();		
		/*if($event_cat_id != 0)
			{ echo '<p class="button_edit">'; echo anchor('events/', $this->lang->line('back_to_event_categories')); echo '</p>'; }*/
		if( $this->userdata->is_admin() )
                {
                    echo '<p class="button_edit">'; echo anchor('events/add', $this->lang->line('anchor_add')); echo '</p>';
                }
		
		
	?>
</div>
