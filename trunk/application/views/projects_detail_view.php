<?php
    $obj = $this->selecter->get_project_detail($project_id);
    //array_debug($obj);
?>

<div id="content_wrapper">
	<div class="project_name">
		<span class="project_label"> Projekt: </span> <?= $obj[0]->project_name ?>
	</div>

	<div class="project_about">
		<?= $obj[0]->project_about ?>  
	</div>
	<div class="project_priority">
		<span class="project_label"> Priorita: </span> <?= $obj[0]->project_priority ?>  
	</div>

	<div class="project_booked_cash">
	   <span class="project_label"> Rozpočet: </span>
		 <b> <?= $obj[0]->project_booked_cash ?>€ </b>,
		minuté 
		<span class="cash_spend"> <?= $obj[0]->project_spended_cash ?>€ </span>,
		ostáva 
		<span class="cash_remain"> <?php echo $obj[0]->project_booked_cash - $obj[0]->project_spended_cash; ?>€ </span>
	</div>

	<div class="post_modifie_info">
		<span class="project_label"> Trvanie: </span>
		od:
		<?php 
			echo datetime($obj[0]->project_date_from, FALSE);
			echo ' - ';
			echo datetime($obj[0]->project_date_to, FALSE);
		?>
	   
	</div>

	<?php
            if( $this->userdata->is_admin() )
            {
		$this->load->library('grid');
			
		$grid = new Grid();

		if( $grid->bind($this->selecter->get_project_items($project_id), 'project_item_id') )
		{
			$grid->header('project_item_id')->visible = false;
			$grid->header('user_id')->visible = false;
			$grid->header('project_item_date')->set_datetime('Y-m-d');

                        $grid->header('project_item_name')->text = $this->lang->line('label_item');
                        $grid->header('project_item_price')->text = $this->lang->line('label_price');
                        $grid->header('project_item_date')->text = $this->lang->line('label_date');
                        $grid->header('user_name')->text = $this->lang->line('label_user_name');
                        $grid->header('user_surname')->text = $this->lang->line('label_user_surname');
                        
			$grid->display();
		}
            }
	?>
	
	<br />
	
	<?php
            if( $this->userdata->is_admin() )
            {
                echo '<p class="button_edit">'; echo anchor("projects/edit/{$project_id}", $this->lang->line('anchor_edit_project')); echo '</p>';
		echo '<p class="button_delete">'; echo anchor("projects/delete/{$project_id}", $this->lang->line('anchor_delete_project')); echo '</p>';
            }
		echo '<p class="button_back">'; echo anchor('projects/', $this->lang->line('to_projects')); echo '</p>';
		
	?>
</div>