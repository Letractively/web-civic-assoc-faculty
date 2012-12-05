<?php
    $obj = $this->selecter->get_posts();
    
    array_debug($obj);
    
    //$date = datetime($o->post_modifie_date, FALSE);
    //$time = time_withou_seconds(datetime($o->post_modifie_date, TRUE));

    foreach($obj as $o)
    {
?>
        <div class="post_title">
            <?= anchor('posts/detail/'.$o->post_id,$o->post_title) ?>
        </div>

        <div class="post_content">
            <?= $o->post_content ?>  
        </div>

        
        <?php
            if($o->post_modifie_author_id == TRUE && $o->post_modifie_date == TRUE)
            {
                echo '<div class="post_modifie_info">';
                    echo '<span>'.$this->lang->line('last_update').':</span>';
                    echo anchor('users/detail/'.$o->post_modifie_author_id, $o->modifier_name.' '.$o->modifier_surname).', ';
                    echo datetime($o->post_modifie_date, FALSE).' '.time_withou_seconds(datetime($o->post_modifie_date, TRUE));
                echo '</div>';
            }
            else
            {
                echo '<div class="post_add_info">';
                    echo '<span>'.$this->lang->line('added_by').':</span>';
                    echo anchor('users/detail/'.$o->post_author_id, $o->author_name.' '.$o->author_surname).', ';
                    echo $o->post_date;
                echo '</div>';
            }
    }
?>
