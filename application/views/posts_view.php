<?php
    $obj = $this->selecter->get_posts();
    array_debug($obj);
?>

<div class="post_title">
    <?= $obj[0]->post_title ?>
</div>

<div class="post_content">
    <?= $obj[0]->post_content ?>  
</div>

<div class="post_add_info">
    <span>Pridal:</span>
    <?= $obj[0]->post_author_id ?> ,
    <?= $obj[0]->post_date ?> 
</div>

<div class="post_modifie_info">
    <span>Posledná úprava:</span>
    <?= $obj[0]->post_modifie_author_id ?> ,
    <?= $obj[0]->post_modifie_date ?> 
</div>
<hr>
