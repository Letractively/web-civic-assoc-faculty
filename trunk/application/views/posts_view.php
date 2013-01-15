<div id="content_wrapper">
	<?php
            $obj = $this->selecter->get_posts();
		
            //array_debug($obj);
            //$date = datetime($o->post_date, FALSE);
            //$time = time_withou_seconds(datetime($o->post_date, TRUE));
            //array_debug($time);
		
            foreach($obj as $o)
            {
                if( $o->post_published == 1 || $this->userdata->is_admin() )
                {
	?>
                    <div class="post_title">
                        <?= anchor('posts/detail/'.$o->post_id,$o->post_title) ?>
                    </div>

                    <div class="post_content">
                        <?= perex_from_content($o->post_content) ?>...  
                    </div>
        <?php
                    if($o->post_modifie_author_id == TRUE && $o->post_modifie_date == TRUE)
                    {
                        echo '<div class="post_modifie_info">';
                            echo '<span class="post_last_update">'.$this->lang->line('last_update').':</span>';
                            echo '<span class="link_text">'; echo anchor('users/detail/'.$o->post_modifie_author_id, $o->modifier_name.' '.$o->modifier_surname).', '; echo '</span>';
                            echo datetime($o->post_modifie_date, FALSE).' '.time_withou_seconds(datetime($o->post_modifie_date, TRUE));
                        echo '<br /> <br /> <p class="separator"></p> </div>';
                     }
                     else
                     {
                        echo '<div class="post_add_info">';
                            echo '<span class="post_added_by">'.$this->lang->line('added_by').':</span>';
                            echo '<span class="link_text">'; echo anchor('users/detail/'.$o->post_author_id, $o->author_name.' '.$o->author_surname).', '; echo '</span>';
                            echo datetime($o->post_date, FALSE).' '.time_withou_seconds(datetime($o->post_date, TRUE));
                        echo '<br /> <br /> <p class="separator"></p> </div>';
                     }
                 }
             }

        if( $this->userdata->is_admin() )
        {
            echo '<p class="button_edit">'; 
                echo anchor('posts/add', $this->lang->line('add_post')); 
            echo '</p>';
        }
	?>
</div>