<?php
    $obj = $this->selecter->get_project_detail($project_id);
    array_debug($obj);
?>

<div class="project_name">
    Projekt: <?= $obj[0]->project_name ?>
</div>

<div class="project_about">
    <?= $obj[0]->project_about ?>  
</div>
<div class="project_priority">
    Priorita:<?= $obj[0]->project_priority ?>  
</div>

<div class="project_booked_cash">
   Rozpočet:
     <?= $obj[0]->project_booked_cash ?>€ ,
    minuté 
    <?= $obj[0]->project_spended_cash ?>€ ,
    ostáva 
    <?php
    echo $obj[0]->project_booked_cash - $obj[0]->project_spended_cash;
    ?>€ 
</div>

<div class="post_modifie_info">
    Trvanie:
    od:
    <?php 
        echo datetime($obj[0]->project_date_from, FALSE);
        echo ' - ';
        echo datetime($obj[0]->project_date_to, FALSE);
    ?>
   
</div>

<?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_project_items(1));
    $grid->bind($this->selecter->get_project_items($project_id), 'project_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";

    $grid->header('project_id')->editable = false;
	
    $grid->display();


?>