<div id="content_wrapper_large">
	<?php
            if($this->userdata->is_admin())
                $obj = $this->selecter->get_posts($c_pagination['per_page'], $c_pagination['cur_page']);
            else
            {
                $obj = $this->selecter->get_posts($c_pagination['per_page'], $c_pagination['cur_page'], true);
            }
                
            echo pagination($pagination);	
            foreach($obj as $o)
            {
	?>
                    <p>
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
                            if($this->userdata->is_admin())
                            {
                                echo '<br /><span class="link_text"><strong>';
                                    echo $this->lang->line('published').': </strong>';
                                    if($o->post_published == 1)
                                        echo $this->lang->line('confirm_yes');
                                    else
                                        echo $this->lang->line('confirm_no');
                                echo '</span>';
                            }
                        echo '<br /> <br /> <p class="separator"></p> </div>';
                     }
                     else
                     {
                        echo '<div class="post_add_info">';
                            echo '<span class="post_added_by">'.$this->lang->line('added_by').':</span>';
                            echo '<span class="link_text">'; echo anchor('users/detail/'.$o->post_author_id, $o->author_name.' '.$o->author_surname).', '; echo '</span>';
                            echo datetime($o->post_date, FALSE).' '.time_withou_seconds(datetime($o->post_date, TRUE));
                            if($this->userdata->is_admin())
                            {
                                echo '<br /><span class="link_text"><strong>';
                                    echo $this->lang->line('published').': </strong>';
                                    if($o->post_published == 1)
                                        echo $this->lang->line('confirm_yes');
                                    else
                                        echo $this->lang->line('confirm_no');
                                echo '</span>';
                            }
                        echo '<br /> <br /> <p class="separator"></p> </div>';
                     }
                 echo '</p>';
             }

        if( $this->userdata->is_admin() )
        {
            echo '<p class="button_edit">'; 
                echo anchor('posts/add', $this->lang->line('add_post')); 
            echo '</p>';
        }
	?>
            <?php echo pagination($pagination); ?>
</div>