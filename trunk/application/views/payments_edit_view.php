<div id="content_wrapper_small">

	<div class="errors">
		<?php 
			echo validation_errors();  
			$object = $payment_object;
		?>
	</div>

	<?= form_open("payments/edit/".$pay_id) ?>
	
	<?php
                $userID = $object['payment_user_id'];
		$userlist[] = array('id' => $userID, 'name' => $this->userdata->full_name($userID));
		
		$payment_types = array(
			array('id' => '1', 'value' => $this->lang->line('payment_type_account')),
			array('id' => '2', 'value' => $this->lang->line('payment_type_voluntary'))
		);
		
		?>
		<div class="inputitem">	
			<span class="label"><?= $this->lang->line('label_user_id'); ?>: </span>
			<?= gen_dropdown('user_id', $userID, $userlist, 'id', 'name', 'dropdown','id="user_id" onchange="changeFilter(this);" disabled=disabled'); ?>
                        <?= form_hidden('user_id', $userID); ?>
                </div>

		<div class="inputitem">
			<span class="label"><?= $this->lang->line('label_paidtype'); ?>: </span>
			<?= gen_dropdown('payment_type', $object['payment_type'], $payment_types, 'id', 'value', 'dropdown','id="payment_type" onchange="changeFilter(this);" disabled=disabled'); ?>
                </div>

                <div class="inputitem">
			<span class="label"><?= $this->lang->line('label_vs'); ?>: </span>
			<input name="vs" type="text" value="<?= $object['payment_vs']?>" class="input_data_date" disabled="disabled" />
		</div>
    
		<div class="inputitem">
			<span class="label"><?= $this->lang->line('label_total_sum'); ?>: </span>
			<input name="total_sum" type="text" value="<?= $object['payment_total_sum']; ?>" class="input_data_date" disabled="disabled" />
			<span>€</span>
		</div>
    
                <div class="inputitem">
			<span class="label"><?= $this->lang->line('label_paid_sum'); ?>: </span>
                        <?php if( $this->userdata->is_admin() ): ?>
                            <input name="payment_paid_sum" type="text" value="<?= $object['payment_paid_sum']; ?>" class="input_data_date" />
			<?php else: ?>
                            <input name="payment_paid_sum" type="text" value="<?= $object['payment_paid_sum']; ?>" class="input_data_date" disabled="disabled" />
                        <?php endif; ?>
                        <span>€</span>
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
                                                 if( $this->userdata->is_admin() && $userID != $this->userdata->get_user_id() )
                                                    echo '<td>'.form_input(array(   'disabled'=>'disabled',
                                                                                    'name' => 'categories['.$cat_id.']', 
                                                                                    'size'=> 3, 
                                                                                    'class' => 'input_data_reg' 
                                                                                ), set_value('project_category_'.$cat_id, $object['categories'][$cat_id])).'</td>';
                                                 else
                                                     if($object['payment_paid_sum'] < $object['payment_total_sum'])
                                                        echo '<td>'.form_input( array(  'name'  => 'categories['.$cat_id.']', 
                                                                                        'size'=> 3, 
                                                                                        'class' => 'input_data_reg' 
                                                                                     ), set_value('project_category_'.$cat_id, $object['categories'][$cat_id])).'</td>';
                                        echo '</tr>';
				}
		   echo '</table>';
		?>
		<div class="inputitem">
			<br />
			<input type="submit" name="submit" value="Uprav platbu" class="button_submit" />
                        <?php if($this->userdata->is_admin()): ?>
                            <input type="submit" name="payment_accepted" value="Uhradená" class="button_submit" />
                        <?php endif; ?>
		</div>
    <?= form_close() ?>
</div>