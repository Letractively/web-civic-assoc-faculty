<?php

    //array_debug($this->selecter->get_posts());
    //array_debug($this->selecter->get_events(0));
    echo '<br />';
    
    $counter = 0;
    foreach ($this->selecter->get_events(0) as $event) 
    {
        if($counter < 3 && $event->event_priority == 5)
        {
            echo '<div class="post" id='.$event->event_id.'>';
                echo $event->event_name.'<br />';
                echo perex_from_content($event->event_about).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $event->event_priority == 4)
        {
            echo '<div class="post" id='.$event->event_id.'>';
                echo $event->event_name.'<br />';
                echo perex_from_content($event->event_about).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $event->event_priority == 3)
        {
            echo '<div class="post" id='.$event->event_id.'>';
                echo $event->event_name.'<br />';
                echo perex_from_content($event->event_about).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $event->event_priority == 2)
        {
            echo '<div class="post" id='.$event->event_id.'>';
                echo $event->event_name.'<br />';
                echo perex_from_content($event->event_about).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $event->event_priority == 1)
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
    
    echo '<hr>';
    
    $counter = 0;
    foreach ($this->selecter->get_posts() as $post) 
    {
        if($counter < 3 && $post->post_priority == 5)
        {
            echo '<div class="event" id='.$post->post_id.'>';
                echo $post->post_title.'<br />';
                echo perex_from_content($post->post_content).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $post->post_priority == 4)
        {
            echo '<div class="event" id='.$post->post_id.'>';
                echo $post->post_title.'<br />';
                echo perex_from_content($post->post_content).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $post->post_priority == 3)
        {
            echo '<div class="event" id='.$post->post_id.'>';
                echo $post->post_title.'<br />';
                echo perex_from_content($post->post_content).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $post->post_priority == 2)
        {
            echo '<div class="event" id='.$post->post_id.'>';
                echo $post->post_title.'<br />';
                echo perex_from_content($post->post_content).'...<br />';
                echo '<br />';
            echo '</div>'; 
            $counter++;
        }
        else if($counter < 3 && $post->post_priority == 1)
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
