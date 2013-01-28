<?php
    $this->load->library('grid');
    $grid = new Grid();
    
    if( $grid->bind($this->selecter->get_degrees(true),'degree_id') )
    {
        $grid->header('degree_id')->editable = false;
        $grid->header('degree_id')->visible = false;
        $grid->header('degree_name')->text = $this->lang->line('label_name');
        $grid->header('degree_grade')->text = $this->lang->line('label_grade');
        $grid->add_url = "{$this->router->class}/add";
        $grid->edit_url = "{$this->router->class}/edit";
        $grid->remove_url = "{$this->router->class}/delete";
    }
	
	echo '<div id="grid_wrapper">';
		$grid->display();
	echo '</div>';
?>