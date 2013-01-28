<div id="content_wrapper_medium">
    <?php
    $this->load->helper('text');
    $totalRows = $this->selecter->EventRowsInCategory('events', 'event_id', 0);

    $counter = 0;
    echo '<div class="auth_view_column">';
    echo '<span class="auth_view_title">';
    echo anchor('events', 'Udalosti');
    echo '</span>';
    foreach ($this->selecter->get_events($totalRows) as $event) {
        if ($counter < 3) {
            echo '<div class="post" id=' . $event->event_id . '>';
            echo '<span class="auth_view_link">';
            echo anchor('events/detail/' . $event->event_id, $event->event_name);
            echo '</span>';
            echo '<br />';
            $string = $event->event_about;
            $string = word_limiter($string, 15);
            echo perex_from_content($string);
            echo '<br />';
            echo '</div>';
            $counter++;
        }
        else
            break;
    }
    echo '</div>';

    $counter = 0;
    echo '<div class="auth_view_column">';
    echo '<span class="auth_view_title">';
    echo anchor('posts', 'Články');
    echo '</span>';
    $numberOfRows = $this->selecter->rows('posts', 'post_id');

    if ($this->userdata->is_admin())
        $posts = $this->selecter->get_posts($numberOfRows, 0);
    else
        $posts = $this->selecter->get_posts($numberOfRows, 0, true);

    foreach ($posts as $post) {
        if ($counter < 3) {
            echo '<div class="event" id=' . $post->post_id . '>';
            echo '<span class="auth_view_link">';
            echo anchor('posts/detail/' . $post->post_id, $post->post_title);
            echo '</span>';
            echo '<br />';
            $string = $post->post_content;
            $string = word_limiter($string, 15);
            echo perex_from_content($string);
            echo '<br />';
            echo '</div>';
            $counter++;
        }
    }
    echo '</div>';
    ?>
</div>