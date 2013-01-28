<div id="grid_wrapper">
	<p class="project_label"> <?= $this->lang->line('label_together').': '.$this->selecter->get_project_categories_total_cash().' €'; ?> </p>

	<?php
		$this->load->library('grid');

		$grid = new Grid();
		
		if( $grid->bind($this->selecter->get_project_categories(true), 'project_category_id') )
		{
                    $grid->add_url = "{$this->router->class}/add";
                    $grid->edit_url = "{$this->router->class}/edit";
                    $grid->remove_url = "{$this->router->class}/delete";

                    $grid->header('project_category_id')->editable = false;
                    $grid->header('project_category_cash')->editable = false;
                    $grid->header('project_category_cash')->set_numformat('{2:,: } €');
                    $grid->header('project_category_id')->visible = false;

                    $grid->header('project_category_name')->text = $this->lang->line('label_name');
                    $grid->header('project_category_cash')->text = $this->lang->line('label_capital');

                    $grid->header('project_category_name')->set_anchor('project_categories/detail', 'project_category_id');
                }
		$grid->display();
		echo '<p class="button_back">'; echo anchor(base_url()."projects", $this->lang->line('anchor_back')); echo '</p>';
	?>
</div>