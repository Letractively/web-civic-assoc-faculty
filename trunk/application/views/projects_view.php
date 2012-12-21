<div id="content_wrapper">  
   
   <div class="inputitem">
        <!--<p class="label"> <?//= $error['project_id'] ?>"><?//= $this->lang->line('label_project_id') ?> </p>-->
        <?= gen_dropdown('project_category_id', set_value('project_category_id'),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?>
		<?= anchor('project_categories', $this->lang->line('anchor_project_categories')); ?>
   </div>

	<?php
		//array_debug($this->selecter->get_projects(1));
	
        $this->load->library('grid');

        $grid = new Grid();

        $grid->bind($this->selecter->get_projects(1), 'project_id');
		$grid->header('project_id')->visible = false;
		$grid->header('project_item_id')->visible = false;

		$grid->header('project_name')->text = $this->lang->line('label_name');
		$grid->header('project_name')->set_anchor("{$this->router->class}/detail", 'project_id');
		$grid->header('project_booked_cash')->text =  $this->lang->line('label_booked_cash');
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
    ?>
</div>
