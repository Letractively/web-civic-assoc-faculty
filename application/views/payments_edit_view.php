<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>

<div id="content_wrapper">
	<?= form_open("payments/add") ?>
	
	<?php
		$totalRows = $this->selecter->UsersInDatabase('users', 'user_id', 0);
		$users = $this->selecter->get_users($totalRows,0,0);
		$userlist = array();
		if ($this->userdata->is_admin())
		{
			foreach ($users as $user)
			{
				$userlist[] = array(
					'id' => $user->user_id,
					'name' => $user->user_name
				);
			}
		}
		else
		{
			$userID = $this->userdata->get_user_id();
			$userlist[] = array('id' => $userID, 'name' => $this->userdata->full_name($userID));
		}
		
		$payment_types = array(
			array('id' => '1', 'value' => $this->lang->line('payment_type_account')),
			array('id' => '2', 'value' => $this->lang->line('payment_type_voluntary'))
		);
		
		?>
			<span>Používateľ:</span>
			<?= gen_dropdown('user_id', $payment_user_id, $userlist, 'id', 'name', 'dropdown','id="user_id" onchange="changeFilter(this);"'); ?>
			
			<span>Typ platby:</span>
			<?= gen_dropdown('payment_type', $payment_type, $payment_types, 'id', 'value', 'dropdown','id="payment_type" onchange="changeFilter(this);"'); ?>
			
			<span>Suma:</span>
			<input name="sum" type="text" value="<?=$payment_total_sum?>" class="input_data_date" />
			<span>€</span>
			
			<span>VS:</span>
			<input name="vs" type="text" value="<?=$payment_vs?>" class="input_data_date" />
		<?php
		
		   $obj = $this->selecter->get_project_categories();
		   
		   echo '<table class="inputitem">';
				echo '<tr><th>'.$this->lang->line('table_th_category').'</th><th>'.$this->lang->line('table_th_ratio').'</th></tr>';
				foreach($obj as $o)
				{
					$cat_id = $o->project_category_id;
					echo '<tr>';
						 echo '<td> <label for="categories['.$cat_id.']">';
							 echo $o->project_category_name;
						 echo '</label></td>';
						 echo '<td>'.form_input(array('name' => 'categories['.$cat_id.']', 'value' => 'categories['.$cat_id.']' != null ? 'categories['.$cat_id.']' : 0, 'size'=> 3, 'class' => 'input_data_reg' ), set_value('project_category_'.$cat_id)).'</td>';
					echo '</tr>';
				}
		   echo '</table>';
		?>
			<input type="submit" name="submit" value="Uprav platbu" class="button_submit" />
		<?php
	?>
		
	<?= form_close() ?>
</div>