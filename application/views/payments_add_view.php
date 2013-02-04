<?php
	$this->load->model('selecter');
	
	function object_to_array($arr_of_obj)
	{
		$res = array();
		foreach ($arr_of_obj as $obj)
			$res[] = get_object_vars($obj);
		return $res;
	}
	
	if ( $this->userdata->is_admin() )
	{
		$users = object_to_array( $this->selecter->get_users_for_add_payments() );
		/*$indexedUsers = array();
		foreach ($users as $user)
			$indexedUsers[$user['id']] = $user;*/
	?>
	<script type="text/javascript" charset="UTF-8">
		var base_url = '<?=base_url()?>';
		
		function User(id,name,account,voluntary)
		{
			this.id = id;
			this.name = name;
			this.account = account;
			this.voluntary = voluntary;
		}
		
		var label_account = '<?=$this->lang->line('payment_type_account')?>';
		var label_voluntary = '<?=$this->lang->line('payment_type_voluntary')?>';
		
		var users = new Array();
		<?php
			foreach ($users as $user)
				echo 'users['.$user['id'].'] = new User('.$user['id'].',"'.$user['name'].'",'.$user['account'].','.$user['voluntary'].');'."\n";
		?>
		
		function createOption(index,text)
		{
			var op = document.createElement("option");
			op.text = text;
			op.value = index;
			return op;
		}

		function changeUser(sender)
		{
			var id = sender.options[sender.selectedIndex].value;
			var userdata = users[id];
			
			var combo_type = document.getElementById('payment_type');
			combo_type.options.length = 0;

			if (userdata.account == 1)
			{
				var o = createOption('1', label_account);
				combo_type.add(o);
			}
			if (userdata.voluntary == 1)
			{
				var o = createOption('2', label_voluntary);
				combo_type.add(o);
			}
		}
	</script>
	<?php
	}
?>

<div id="content_wrapper_small">

	<div class="errors">
		<?php echo validation_errors(); ?>
	</div>

	<?= form_open("payments/add") ?>
	
    <?php
		if ( !$this->userdata->is_admin() )
		{
			$userID = $this->userdata->get_user_id();
            $userName = $this->userdata->full_name($userID);
		}
	?>
			<div class="inputitem">	
				<span class="label"> Používateľ: </span>
				<?php
					if( $this->userdata->is_admin() )
						echo gen_dropdown('user_id', 0, $users, 'id', 'name', 'dropdown','id="user_id" onchange="changeUser(this);"'); 
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
						$payment_types = array();
						if ($users[0]['account'] == 1) $payment_types [] = array('id' => '1', 'value' => $this->lang->line('payment_type_account'));
						if ($users[0]['voluntary'] == 1) $payment_types [] = array('id' => '2', 'value' => $this->lang->line('payment_type_voluntary'));
						
						echo gen_dropdown('payment_type', 1, $payment_types, 'id', 'value', 'dropdown','id="payment_type" ');
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