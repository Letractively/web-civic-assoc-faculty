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
		 <?= $obj[0]->project_booked_cash ?>€ ,
		minuté 
		<?= $obj[0]->project_spended_cash ?>€ ,
		ostáva 
		<?php
		echo $obj[0]->project_booked_cash - $obj[0]->project_spended_cash;
		?>€ 
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
		$this->load->library('grid');
			
		$grid = new Grid();

		if( $grid->bind($this->selecter->get_project_items($project_id), 'project_item_id') )
		{
			$grid->header('project_item_id')->visible = false;
			$grid->header('user_id')->visible = false;
			$grid->header('project_item_date')->set_datetime('Y-m-d');

			$grid->display();
		}
	?>
    <?php
		echo anchor("projects/edit/{$project_id}", $this->lang->line('anchor_edit_project'));
		echo anchor("projects/delete/{$project_id}", $this->lang->line('anchor_delete_project'));
        echo anchor('projects/', $this->lang->line('to_projects'));
    ?>
</div>