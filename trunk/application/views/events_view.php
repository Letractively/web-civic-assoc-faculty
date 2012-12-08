<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    array_debug($this->selecter->get_events(0));
    array_debug($priorities);

    if( $grid->bind($this->selecter->get_events($event_id), 'event_id') )
    {
        $grid->add_url = "{$this->router->class}/add";
        $grid->edit_url = "{$this->router->class}/edit";
        $grid->remove_url = "{$this->router->class}/delete";
        $grid->header('event_category_name')->component->type = "combobox";
        $grid->header('event_category_name')->component->bind( $this->selecter->get_event_categories(), "event_category_id", "event_category_name");
        $grid->header('event_priority')->component->type = "combobox";
        $grid->header('event_priority')->component->bind($priorities, 'id', 'value');
        $grid->header('event_id')->editable = false;
        $grid->display();
    }
     
    if($event_id != 0)
        echo anchor('events/index/', $this->lang->line('back_to_event_categories'));
?>
