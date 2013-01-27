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
			<span>Používateľ:</span>
			<?php
                            if( $this->userdata->is_admin() )
                                echo gen_dropdown('user_id', 0, $userlist, 'id', 'name', 'dropdown','id="user_id" onchange="changeFilter(this);"'); 
                            else
                            {
                                echo form_input(array('name' => 'user', 'value' => $userName,'disabled'=>'disabled')); 
                                echo form_hidden('user_id', $userID);
                            }
                        ?>
                        <span>Typ platby:</span>
			<?php
                            if( $this->userdata->is_admin() ) 
                            {    
                                echo gen_dropdown('payment_type', 1, $payment_types, 'id', 'value', 'dropdown','id="payment_type" onchange="changeFilter(this);"');
                                echo '<span>'.$this->lang->line('label_total_sum').':</span>';
                                    echo form_input(array('name' => 'total_sum', 'type' => 'text', 'class' => 'input_data_date'),  set_value('total_sum'));
                                echo '<span>€</span>';
                            }
                            else
                            {
                                $lp = $this->selecter->get_payments_lastpaid($userID);
                                if( $lp->payment_paid_sum < $lp->payment_total_sum)
                                    redirect(base_url ());
                                else if( date("Y-m-d", time() - (365 * 86400)) <=  $lp->payment_paid_time )
                                {
                                    if( $lp->payment_paid_sum >= $lp->payment_total_sum )
                                    {
                                        echo form_input(array('name' => 'payment', 'value' => $this->lang->line('payment_type_voluntary'),'disabled'=>'disabled'));
                                        echo form_hidden('payment_type', 2);
                                        echo '<span>'.$this->lang->line('label_total_sum').':</span>';
                                        echo form_input(array('name' => 'total_sum', 'type' => 'text', 'class' => 'input_data_date'),  set_value('total_sum',1));
                                        echo '<span>€</span>';
                                    }
                                }
                                else if( date("Y-m-d", time() - (365 * 86400)) >  $lp->payment_paid_time )
                                {
                                    echo form_input(array('name' => 'payment', 'value' => $this->lang->line('payment_type_account'),'disabled'=>'disabled'));
                                    echo form_hidden('payment_type', 1);
                                    echo '<span>'.$this->lang->line('label_total_sum').':</span>';
                                    echo form_input(array('name' => 'total_sum', 'type' => 'text', 'class' => 'input_data_date'),  set_value('total_sum',5));
                                    echo '<span>€</span>';
                                }      
                            }
                        ?>
			
			<span><?= $this->lang->line('label_vs'); ?>:</span>
                        <?= form_input(array('name' => 'payment_vs', 'type' => 'text', 'class' => 'input_data_date'),  set_value('payment_vs')); ?>
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
		<?= form_submit( array('type' => 'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('payment_add') ); ?>
		
	<?= form_close() ?>
</div>