<?php $obj = $this->selecter->get_project_detail($project_id); ?>

<div id="content_wrapper_medium">
	<div class="project_name">
		<span class="project_label"> Projekt: </span> <?= $obj[0]->project_name ?>
	</div>

	<div class="project_about">
		<?= $obj[0]->project_about ?>  
	</div>

	<div class="project_booked_cash">
	   <span class="project_label"> Rozpočet: </span>
		 <strong> <?= $obj[0]->project_booked_cash ?> €</strong>,
		minuté 
		<span class="cash_spend"> 
                    <?php if ($obj[0]->project_spended_cash == '')
                            echo '0';
                          else
                            echo $obj[0]->project_spended_cash; ?> €</span>,
		ostáva 
		<span class="cash_remain"> <?php echo $obj[0]->project_booked_cash - $obj[0]->project_spended_cash; ?> €</span>
	</div>

	<div class="post_modifie_info">
		<span class="project_label"> Trvanie: </span>
		<?php 
			echo datetime($obj[0]->project_date_from, FALSE);
			echo ' - ';
			echo datetime($obj[0]->project_date_to, FALSE);
		?>
	   
	</div>
        <div class="post_modifie_info">
		<span class="project_label"> Rozpracovanosť: </span>
		<?php 
			if( $obj[0]->project_active == 0 )
                            echo $this->lang->line('project_closed');
                        else
                            echo $this->lang->line('project_open');
		?>  
	</div>
        <div class="post_modifie_info">
		<span class="project_label"> Kategória: </span>
		<?php if(isset($obj[0]->project_project_category_id)): ?>
                    <?= anchor('project_categories/detail/'.$obj[0]->project_project_category_id,$obj[0]->project_category_name); ?>  
                <?php endif; ?>
	</div>
	<?php
            if( $this->userdata->is_admin() )
            {
		$this->load->library('grid');
		
                $totalRows = $this->selecter->rows('users','user_id');
                $users_object = $this->selecter->get_users($totalRows,0,0);
   
		$users = array();
		foreach ($users_object as $user_object)
		{
                    $user = get_object_vars($user_object);
                    $user['user_fullname'] = $user['user_name'];
                    $users[] = $user;
		}
                
		$grid = new Grid();
                if( $grid->bind($this->selecter->get_project_items($project_id, true), 'project_item_id') )
		{
			$grid->header('project_item_id')->visible = false;
			$grid->header('user_id')->visible = false;
			$grid->header('project_item_date')->set_datetime('Y-m-d');

                        $grid->header('project_item_name')->text = $this->lang->line('label_item');
                        $grid->header('project_item_price')->text = $this->lang->line('label_price');
                        $grid->header('project_item_date')->text = $this->lang->line('label_date');
                        $grid->header('user_name')->text = $this->lang->line('label_fullname');
                        
                        $grid->header('project_item_price')->set_numformat('{2:,: } €');
                        
                        $grid->header('user_name')->component->type = 'combobox';
			$grid->header('user_name')->component->bind($users, 'user_id', 'user_fullname');
                        
			$grid->display();
		}
            }
	?>
	
	<br />
	
	<?php
            if( $this->userdata->is_admin() )
            {
                if( $obj[0]->project_active == 1 )
                {
                    echo '<p class="button_edit">'; 
                        echo anchor("projects/edit/{$project_id}", $this->lang->line('anchor_edit_project')); 
                    echo '</p>';
                }
		echo '<p class="button_delete">'; echo anchor("projects/delete/{$project_id}", $this->lang->line('anchor_delete_project')); echo '</p>';
               
            }
		echo '<p class="button_back">'; echo anchor('projects/', $this->lang->line('to_projects')); echo '</p>';
		
	?>
</div>