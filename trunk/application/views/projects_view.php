<div id="content_wrapper">  
   
   <div class="inputitem">
        <!--<p class="label"> <?//= $error['project_id'] ?>"><?//= $this->lang->line('label_project_id') ?> </p>-->
        <?= gen_dropdown('project_category_id', set_value('project_category_id'),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?> 
   </div>

	<?php
		//array_debug($this->selecter->get_projects(1));
	
        $this->load->library('grid');

        $grid = new Grid();

        $grid->bind($this->selecter->get_projects(1), 'project_id');

        $grid->add_url = "{$this->router->class}/add";
        $grid->edit_url = "{$this->router->class}/edit";
        $grid->remove_url = "{$this->router->class}/delete";

        $grid->header('project_id')->editable = false;

        $grid->display();
    ?>
</div>
