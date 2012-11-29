<?php
    $obj = $this->selecter->get_posts();
    
    //array_debug($obj);
    
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

        <div class="post_add_info">
            <span>Pridal:</span>
            <?php 
                echo $o->author_name.' '.$o->author_surname.', ';
                echo $o->post_date;
            ?> 
        </div>

        <div class="post_modifie_info">
            <?php 
                if($o->post_modifie_author_id == TRUE || $o->post_modifie_date == TRUE)
                {
                    echo '<span>Posledná úprava:</span>';
                    echo $o->modifier_name.' '.$o->modifier_surname.', ';
                }
                if($o->post_modifie_date)
                {
                    echo datetime($o->post_modifie_date, FALSE).' '.time_withou_seconds(datetime($o->post_modifie_date, TRUE));
                } 
            ?> 
        </div>
<?
    }
?>
