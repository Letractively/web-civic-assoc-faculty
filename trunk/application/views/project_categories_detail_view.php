<?php
    $obj = $this->selecter->get_category_detail($project_category_id);
    array_debug($obj);
?>

<div class="project_category_name">
    <?= $this->lang->line('pr_cat_label').': '.$obj->project_category_name ?>  
</div>

<?= $this->lang->line('pr_cat_stats'); ?>
<div class="project_category_cash">
    <?= $this->lang->line('pr_cat_cur_state'); ?>:<?= $obj->project_category_cash ?> <br />
    <?= $this->lang->line('pr_cat_move_from'); ?>:<?= $obj->transaction_cash_from ?> <br />
    <?= $this->lang->line('pr_cat_move_to'); ?>:<?= $obj->transaction_cash_to ?>
</div>
Transakcie
<div class="errors">
    <?php echo validation_errors();
    $field = $this->selecter->id($event_id,'events','event_id');
    //array_debug($programs) 
    ?>
</div>

<?= form_open("events/edit") ?>
    Odkiaľ:
    <div class="inputitem">
        <label for="event_categories_id" class="<?= $error['event_categories_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label>
        <?= gen_dropdown('event_categories_id', set_value('event_categories_id', $field->event_event_category_id),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>
    </div>
    Kam:
    <div class="inputitem">
        <label for="event_categories_id" class="<?= $error['event_categories_id'] ?>"><?= $this->lang->line('label_event_category_id') ?></label>
        <?= gen_dropdown('event_categories_id', set_value('event_categories_id'),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>     
    </div>
    Koľko:
    <div class="inputitem">
        <label for="" class="<?= $error[''] ?>"><?= $this->lang->line('label_') ?></label>
        <?= form_input(array('name' => '', 'id' => '', 'class' => ''.$error['']), set_value('')) ?>
    </div>   
    
    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('')) ?>
    </div>
<?= form_close() ?>

 <?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    array_debug($this->selecter->get_transactions(1));
    
    $grid->bind($this->selecter->get_transactions(1), 'pr_cat_id');
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    $grid->header('pr_cat_id')->editable = false;
    	
    $grid->display();
    
    echo '<br />';
    
    $grid1 = new Grid();
    
    array_debug($this->selecter->get_projects(1));
    
    $grid1->bind($this->selecter->get_projects(1), 'cat_id');
    
    $grid1->add_url = "{$this->router->class}/add";
    $grid1->edit_url = "{$this->router->class}/edit";
    $grid1->remove_url = "{$this->router->class}/delete";
    
    $grid1->header('cat_id')->editable = false;
    	
    $grid1->display();
?>
