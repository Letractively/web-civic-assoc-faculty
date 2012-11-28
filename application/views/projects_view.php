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
