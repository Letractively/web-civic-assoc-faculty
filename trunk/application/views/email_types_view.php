<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    if( $grid->bind($this->selecter->get_email_types(true), 'email_type_id') )
    {
        $grid->add_url = "{$this->router->class}/add";
        $grid->edit_url = "{$this->router->class}/edit";
        $grid->remove_url = "{$this->router->class}/delete";

        $grid->header('email_type_id')->editable = false;
        $grid->header('email_type_id')->visible = false;
        $grid->header('email_type_name')->text = $this->lang->line('label_name');
    }
	
	echo '<div id="grid_wrapper">';
		$grid->display();
	echo '</div>';
?>
