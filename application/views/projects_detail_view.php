<?php
    $obj = $this->selecter->get_project_detail(1);
    array_debug($obj);
?>
Projekt:
<div class="project_name">
    <?= $obj[0]->project_name ?>
</div>

<div class="project_about">
    <?= $obj[0]->project_about ?>  
</div>
Priorita:
<div class="project_priority">
    <?= $obj[0]->project_priority ?>  
</div>
Rozpočet:
<div class="project_booked_cash">
    <?= $obj[0]->project_booked_cash ?> ,
    minuté 
    <?= $obj[0]->project_spended_cash ?> ,
    ostáva 
    <?= $obj[0]->TO_DO____________________ ?> 
</div>
Trvanie:
<div class="post_modifie_info">
    od:
    <?= $obj[0]->project_date_from ?> 
    do:
    <?= $obj[0]->project_date_to ?> 
</div>

<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_project_items(1));
    
    $grid->bind($this->selecter->get_project_items(1), 'project_id');
    	
    $grid->display();


?>