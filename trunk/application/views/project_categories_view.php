 <?= $this->lang->line('label_together').': '.$this->selecter->get_project_categories_total_cash(); ?>

<?php
    $this->load->library('grid');

    $grid = new Grid();
    
    $grid->bind($this->selecter->get_project_categories(), 'project_category_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('project_category_id')->editable = false;
    $grid->header('project_category_cash')->editable = false;
    
    $grid->header('project_category_id')->visible = false;
    
    $grid->header('project_category_name')->text = $this->lang->line('label_name');
    $grid->header('project_category_cash')->text = $this->lang->line('label_capital');
    
	
    $grid->display();
?>
