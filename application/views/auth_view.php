<?php
    $posts = $this->selecter->get_posts();
    array_debug($posts);
    $events = $this->selecter->get_events(0);
    array_debug($events);
?>
