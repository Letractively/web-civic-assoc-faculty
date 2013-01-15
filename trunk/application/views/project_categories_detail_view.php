<?php
    $obj = $this->selecter->get_category_detail($project_category_id);
    //array_debug($obj);set_numformat('{2:,: } €');
?>

<div id="grid_wrapper">
	<span class="project_category_label"> <?= $this->lang->line('pr_cat_label').': <span class="project_name">'.$obj->project_category_name ?> </span> </span> 
	
	<div class="project_category_cash">
		<p> 
			<span class="project_category_label"> <?= $this->lang->line('pr_cat_stats'); ?> <br /> </span>
			<span class="project_category_labels"> <?= $this->lang->line('pr_cat_cur_state'); ?>: <b> <?= $obj->project_category_cash;?> € </b> <br /> </span>
			<span class="project_category_labels"> <?= $this->lang->line('pr_cat_move_from'); ?>: <span class="cash_from"> <?= $obj->transaction_cash_from ?> € <br /> </span> </span>
			<span class="project_category_labels"> <?= $this->lang->line('pr_cat_move_to'); ?>: <span class="cash_to"> <?= $obj->transaction_cash_to ?> € </span> </span>
		</p>
	</div>
	
	<div class="project_category_labels">
		<span class="project_category_label"> Transakcie </span>
	</div>
	
	<div class="errors">
		<?php echo validation_errors();
		//$field = $this->selecter->id($project_category_id,'events','event_id');
		//array_debug($programs) 
		?>
	</div>

	<?= form_open("project_categories/add_transaction") ?>
		<div class="inputitem">
			<label for="from" class=""><?= $this->lang->line('label_from') ?>:</label>
			<b> <?= $obj->project_category_name; ?> </b>
			<?= form_hidden('from', $project_category_id); ?>
		</div>
		<div class="inputitem">
			<label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?>:</label>
			<?= gen_dropdown('to', set_value('event_category_id'),$this->selecter->get_event_categories(),'event_category_id','event_category_name', 'dropdown'); ?>     
		<div class="inputitem">
			<label for="cash" class="<?= $error['cash'] ?>"><?= $this->lang->line('label_cash') ?>:</label>
			<?= form_input(array('name' => 'cash', 'id' => 'cash', 'class' => 'input_data'.$error['cash']), set_value('cash')) ?>€

		</div>   
		
		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('btn_add_trans')) ?>
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
                        $grid->header('category_transaction_cash')->set_numformat('{2:,: } €');

			$grid->display();
		}
		echo '<br />';
		
		$grid1 = new Grid();
	   
		//array_debug($this->selecter->get_projects($project_category_id));
		
	   if(  $grid1->bind($this->selecter->get_projects($project_category_id), 'project_id') )
	   {
			$grid1->header('project_id')->editable = false;
			$grid1->header('project_id')->visible = false;
			$grid1->header('project_item_id')->visible = false;

			$grid1->header('project_name')->text = $this->lang->line('label_name');
			$grid1->header('project_booked_cash')->text = $this->lang->line('label_capital');
			$grid1->header('project_spended_cash')->text = $this->lang->line('label_spend');

                        $grid1->header('project_booked_cash')->set_numformat('{2:,: } €');
			$grid1->header('project_spended_cash')->set_numformat('{2:,: } €');
                        
                        $grid1->header('project_date_from')->text = $this->lang->line('label_date_from');
			$grid1->header('project_date_to')->text = $this->lang->line('label_date_to');

			$grid1->header('project_name')->set_anchor('projects/detail', 'project_id');

			$grid1->display();
	   }
	?>
	<div class="inputitem">
		<p class="button_delete"> <?= anchor("projects_categories/delete/$project_category_id", 'Zmazať') ?> </p>
	</div>
</div>