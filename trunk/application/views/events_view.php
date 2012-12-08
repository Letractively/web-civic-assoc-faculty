<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_events(0));
    //array_debug($priorities);

    if( $grid->bind($this->selecter->get_events($event_id), 'event_id') )
    {
        $grid->header('event_id')->editable = false;
        
        $grid->header('event_id')->visible = false;
        $grid->header('event_about')->visible = false;
        $grid->header('event_created')->visible = false;
        $grid->header('event_category_name')->visible = false;
        $grid->header('event_priority')->visible = false;
        
        $grid->display();
    }
     
    if($event_id != 0)
        echo anchor('events/index/', $this->lang->line('back_to_event_categories'));
?>
