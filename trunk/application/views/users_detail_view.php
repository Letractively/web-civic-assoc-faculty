<?php
    $obj = $this->selecter->get_user_detail($user_id);
    array_debug($obj);
?>
<div class="user_role">
    <?= $obj[0]->user_role ?>  
</div>
Login:
<div class="user_username">
    <?= $obj[0]->user_username ?>  
</div>
Meno:
<div class="user_name">
    <?= $obj[0]->user_name ?>&nbsp;
    <?= $obj[0]->user_surname ?>
</div>
E-mail:
<div class="user_email">
    <?= $obj[0]->user_email ?>  
</div>

Študijný program:
<div class="user_study_program">
    <?= $obj[0]->user_study_program ?>  
</div>

Rok ukončenia štúdia:
<div class="user_degree_year">
    <?= $obj[0]->user_degree_year ?> ,
</div>

Miesto narodenia:
<div class="user_place_of_birth">
    <?= $obj[0]->user_place_of_birth ?> 
</div>

PSČ:
<div class="user_postcode">
    <?= $obj[0]->user_postcode ?> 
</div>

<?php
    if(get_payments_lastpaid($user_id))
?>
