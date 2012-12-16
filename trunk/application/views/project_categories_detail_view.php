<?php
    $obj = $this->selecter->get_category_detail($project_category_id);
    //array_debug($obj);
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
    //$field = $this->selecter->id($project_category_id,'events','event_id');
    //array_debug($programs) 
    ?>
</div>

<?= form_open("project_categories/add_transaction") ?>
    <div class="inputitem">
        <label for="from" class=""><?= $this->lang->line('label_from') ?>:</label>
        <?= $obj->project_category_name; ?>
        <?= form_hidden('from', $project_category_id); ?>
    </div>
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?>:</label>
        <?= gen_dropdown('to', set_value('event_category_id'),$this->selecter->get_event_categories(),'event_category_id','event_category_name'); ?>     
    </div>
    <div class="inputitem">
        <label for="cash" class="<?= $error['cash'] ?>"><?= $this->lang->line('label_cash') ?>:</label>
        <?= form_input(array('name' => 'cash', 'id' => 'cash', 'class' => ''.$error['cash']), set_value('cash')) ?>
    </div>   
    
    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('btn_add_trans')) ?>
    </div>
<?= form_close() ?>

 <?php
    $this->load->library('grid');
    
    $grid = new Grid();
    
    //array_debug($this->selecter->get_transactions($project_category_id));
    
    if( $grid->bind($this->selecter->get_transactions($project_category_id), 'fin_category_transaction_id') )
    {
        $grid->header('project_category_id')->editable = false;
        $grid->header('project_category_id')->visible = false;
        $grid->header('fin_category_transaction_id')->editable = false;
        $grid->header('fin_category_transaction_id')->visible = false;
        
        $grid->header('fin_category_transaction_from')->text = $this->lang->line('label_from');
        $grid->header('fin_category_transaction_to')->text = $this->lang->line('label_to');
        $grid->header('category_transaction_cash')->text = $this->lang->line('label_cash');


        $grid->display();
    }
    echo '<br />';
    
    $grid1 = new Grid();
   
    //array_debug($this->selecter->get_projects($project_category_id));
    
   if(  $grid1->bind($this->selecter->get_projects($project_category_id), 'project_id') )
   {
		$grid1->header('project_id')->editable = false;
		$grid1->header('project_id')->visible = false;

		$grid1->header('project_name')->text = $this->lang->line('label_name');
		$grid1->header('project_booked_cash')->text = $this->lang->line('label_capital');
		$grid1->header('project_spended_cash')->text = $this->lang->line('label_spend');
		$grid1->header('project_date_from')->text = $this->lang->line('label_date_from');
		$grid1->header('project_date_to')->text = $this->lang->line('label_date_to');

		$grid1->header('project_name')->set_anchor('projects/detail', 'project_id');

		$grid1->display();
   }
?>
