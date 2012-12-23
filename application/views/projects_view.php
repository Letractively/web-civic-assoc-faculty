<script type="text/javascript" charset="UTF-8">
	var base_url = '<?=base_url()?>';

	function changeFilter(sender)
	{
		var id = sender.options[sender.selectedIndex].value;
		window.location = base_url+'projects/index/'+id;
	}
</script>

<div id="content_wrapper">  
   
   <div class="inputitem">
        <!--<p class="label"> <?//= $error['project_id'] ?>"><?//= $this->lang->line('label_project_id') ?> </p>-->
		<?php
			$pr_cats = $this->selecter->get_project_categories();
			$pr_cats[] = array('project_category_id' => 0, 'project_category_name' => $this->lang->line('caption_all'));
		?>
        <?= gen_dropdown('project_category', $category_id, $pr_cats,'project_category_id', 'project_category_name', '', 'onchange="changeFilter(this);"'); ?>
		<?= anchor('project_categories', $this->lang->line('anchor_project_categories')); ?>
   </div>

	<?php
		//array_debug($this->selecter->get_projects(1));
		
        $this->load->library('grid');

        $grid = new Grid();

        if ($grid->bind($this->selecter->get_projects($category_id), 'project_id'))
		{
			$grid->header('project_id')->visible = false;
			$grid->header('project_item_id')->visible = false;

			$grid->header('project_name')->text = $this->lang->line('label_name');
			$grid->header('project_name')->set_anchor("{$this->router->class}/detail", 'project_id');
			$grid->header('project_category_name')->text =  $this->lang->line('label_category_name');
			$grid->header('project_category_name')->set_anchor("project_categories/detail", 'project_id');
			$grid->header('project_booked_cash')->text =  $this->lang->line('label_booked_cash');
			$grid->header('project_booked_cash')->set_numformat('{2:,: } €');
			$grid->header('project_date_from')->text = $this->lang->line('label_from');
			$grid->header('project_date_from')->set_datetime('Y-m-d');
			$grid->header('project_date_to')->text =  $this->lang->line('label_to');
			$grid->header('project_date_to')->set_datetime('Y-m-d');
			$grid->header('project_spended_cash')->text =  $this->lang->line('label_spended_cash');
			
			$grid->add_url = "{$this->router->class}/add";
			$grid->add_mode = "external";
			$grid->edit_url = "{$this->router->class}/edit";
			$grid->edit_mode = "external";
			$grid->remove_url = "{$this->router->class}/delete";

			$grid->header('project_id')->editable = false;

			$grid->display();
		}
    ?>
</div>
