   <div class="inputitem">
        <!--<label for="project_category_id" class="<?= $error['project_category_id'] ?>"><?= $this->lang->line('label_project_category_id') ?></label>-->
        <?= gen_dropdown('project_category_id', set_value('project_category_id'),$this->selecter->get_project_categories(),'project_category_id','project_category_name'); ?> 
   </div>

<?php
        $this->load->library('grid');

        $grid = new Grid();

        //array_debug($this->selecter->get_projects(1));

        $grid->bind($this->selecter->get_project_items(1), 'cat_id');

        $grid->add_url = "{$this->router->class}/add";
        $grid->edit_url = "{$this->router->class}/edit";
        $grid->remove_url = "{$this->router->class}/delete";

        $grid->header('cat_id')->editable = false;


        $grid->display();
    ?>
