<?php

    array_debug($this->selecter->get_posts());
    array_debug($this->selecter->get_events(0));
    
    $counter = 0;
    foreach ($this->selecter->get_events(0) as $event) 
    {
        if($counter < 3)
        {
            echo '<div class="post" id='.$event->event_id.'>';
                echo $event->event_name.'<br />';
                echo perex_from_content($event->event_about).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else
            break;
    }
    
    $counter = 0;
    foreach ($this->selecter->get_posts() as $post) 
    {
        if($counter < 3)
        {
            echo '<div class="event" id='.$post->post_id.'>';
                echo $post->post_title.'<br />';
                echo perex_from_content($post->post_content).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else
            break;
    }
   
?>
