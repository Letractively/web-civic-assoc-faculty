<div id="content_wrapper_small">

	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>

	<?= form_open("payments/add") ?>
	
            <?php
		$totalRows = $this->selecter->UsersInDatabase('users', 'user_id', 0);
		$users = $this->selecter->get_users($totalRows,0,0);
		$userlist = array();
		if ( $this->userdata->is_admin() )
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
                        $userName = $this->userdata->full_name($userID);
		}
		
		$payment_types = array(
			array('id' => '1', 'value' => $this->lang->line('payment_type_account')),
			array('id' => '2', 'value' => $this->lang->line('payment_type_voluntary'))
		);
		
	?>
			<div class="inputitem">	
				<span class="label"> Používateľ: </span>
				<?php
								if( $this->userdata->is_admin() )
									echo gen_dropdown('user_id', 0, $userlist, 'id', 'name', 'dropdown','id="user_id" onchange="changeFilter(this);"'); 
								else
								{
									echo form_input(array('name' => 'user', 'value' => $userName,'disabled'=>'disabled')); 
									echo form_hidden('user_id', $userID);
								}
				?>
			</div>
			
			<div class="inputitem">	
				<span class="label"> Typ platby: </span>
				<?php
					if( $this->userdata->is_admin() ) 
					{    
						echo gen_dropdown('payment_type', 1, $payment_types, 'id', 'value', 'dropdown','id="payment_type" onchange="changeFilter(this);"');
						echo '<div class="inputitem"> <span class="label">'.$this->lang->line('label_total_sum').':</span>';
						echo form_input(array('name' => 'total_sum', 'type' => 'text', 'class' => 'input_data_date'),  set_value('total_sum'));
						echo '<span class="label"> €</span> </div>';
					}
					else
					{
						$userActivationDate = explode(' ', $this->userdata->get_user_activated_time($userID));
                                                $lp = $this->selecter->get_payments_lastpaid($userID);
                            
                              
						/*if( $lp->payment_paid_sum < $lp->payment_total_sum)
							redirect(base_url ());*/
						if( date("Y-m-d", time() - (365 * 86400)) <=  $userActivationDate[0])
						{
							//if( $lp->payment_paid_sum >= $lp->payment_total_sum )
							//{
								echo form_input(array('name' => 'payment', 'value' => $this->lang->line('payment_type_voluntary'),'disabled'=>'disabled'));
								echo form_hidden('payment_type', 2);
								echo '<div class="inputitem"> <span class="label">'.$this->lang->line('label_total_sum').':</span>';
								echo form_input(array('name' => 'total_sum', 'type' => 'text', 'class' => 'input_data_date'),  set_value('total_sum',1));
								echo '<span class="label"> €</span> </div>';
							//}
						}
						else if( date("Y-m-d", time() - (365 * 86400)) >  $userActivationDate[0])
						{
							echo form_input(array('name' => 'payment', 'value' => $this->lang->line('payment_type_account'),'disabled'=>'disabled'));
							echo form_hidden('payment_type', 1);
							echo '<div class="inputitem"> <span class="label">'.$this->lang->line('label_total_sum').':</span>';
							echo form_input(array('name' => 'total_sum', 'type' => 'text', 'class' => 'input_data_date'),  set_value('total_sum',5));
							echo '<span class="label"> €</span> </div>';
						}      
					}
				?>
			</div>

			<div class="inputitem">
				<span class="label"> <?= $this->lang->line('label_vs'); ?>:</span>
				<?= form_input(array('name' => 'payment_vs', 'type' => 'text', 'class' => 'input_data_date'),  set_value('payment_vs')); ?>
			</div>
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
				echo '<td>'.form_input(array('name' => 'categories['.$cat_id.']', 'value' => '1', 'size'=> 3, 'class' => 'input_data_reg' ), set_value('project_category_'.$cat_id)).'</td>';
                            echo '</tr>';
			}
		   echo '</table>';
		?>
		
		<div class="inputitem">
			<br />		
			<?= form_submit( array('type' => 'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('payment_add') ); ?>
		</div>
		
	<?= form_close() ?>
</div>