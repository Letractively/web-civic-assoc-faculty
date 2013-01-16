<div id="grid_wrapper">
	<div class="grid_link_text">
		<span class="grid_label"> Zoradit podla: </span>
		<ul>
			<li><?= anchor('events', $this->lang->line('events_all')); ?></li>
			<li><?= anchor('events/newest', $this->lang->line('events_newest')); ?></li>
			<li><?= anchor('events/prior', $this->lang->line('events_prior')); ?></li>
		</ul>
	</div>
		
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
		if($event_cat_id != 0)
			{ echo '<p class="button_edit">'; echo anchor('events/', $this->lang->line('back_to_event_categories')); echo '</p>'; }
		if( $this->userdata->is_admin() )
                {
                    echo '<p class="button_edit">'; echo anchor('events/add', $this->lang->line('anchor_add')); echo '</p>';
                    echo '<p class="button_edit">'; echo anchor('event_categories/', $this->lang->line('to_event_categories')); echo '</p>';
                }
		
		
	?>
</div>
