<script>
    function zobrazSkryj(idecko)
    {
        el = document.getElementById(idecko).style; 
        el.display = (el.display == 'block')?'none':'block';
        
        if(document.getElementById('checkbox').value == 0)
        {
            document.getElementById('checkbox').value = 1;
        }    
        else if(document.getElementById('checkbox').value == 1)
        {
            document.getElementById('checkbox').value = 0;
        }
    }
    
    function hidecheckbox(id, form)
    {
        el = document.getElementById(id).style; 
        el2 = document.getElementById(form).style; 
        checkbox = document.getElementById('checkbox');
        
        switch(document.getElementById('role').value)
        {
            case '2':
                el.display = (el.display == 'none')?'block':'none';
                el2.display = (el.display == 'block')?'none':'block';
                break;
            case '-1':
            case '1':
            case '3':
                el.display = (el.display == 'block')?'none':'none';
                el2.display = (el.display == 'block')?'none':'none';
                checkbox.value = 0;
                checkbox.checked = false;
                break;
        }
    }
</script>
<div id="content_wrapper_small">
	<?php
		$obj = $this->selecter->get_user_detail($user_id);
                $numberOfDegrees = $this->selecter->rows('degrees', 'degree_id');
		echo validation_errors();
        ?>        
                <p class="project_label">
                    Štatút: 
                    <span class="user_rank"><?= $this->userdata->get_role_name($obj[0]->user_role); ?></span>
		</p>
		<?= form_open("users/edit/".$user_id); ?>
                    <div class="inputitem">
                        <p class="label">
                            <label for="username" class="<?= $error['username']; ?>"><?= $this->lang->line('label_username'); ?></label>					
                        </p>
                        <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => 'input_data'.$error['username']), set_value('username', $obj[0]->user_username)); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="name" class="<?= $error['name']; ?>"><?= $this->lang->line('label_name'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name', $obj[0]->user_name)); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="surname" class="<?= $error['surname']; ?>"><?= $this->lang->line('label_surname'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => 'input_data'.$error['surname']), set_value('surname', $obj[0]->user_surname)); ?>
                    </div>                   
                    
                    <!-- Nove heslo -->
                    <div class="inputitem">
			<p class="label"> <label for="password" ><?= $this->lang->line('label_password') ?></label> </p>
			<?= form_password(array('name' => 'password', 'id' => 'password', 'class' => 'input_data'), set_value('password')) ?>
                    </div>
                    
                    <!-- Opakovanie noveho hesla -->
                    <div class="inputitem">
                            <p class="label"> <label for="password_again" ><?= $this->lang->line('label_password_again') ?></label> </p>
                            <?= form_password(array('name' => 'password_again', 'id' => 'password_again', 'class' => 'input_data'), set_value('password_again')) ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="email" class="<?= $error['email']; ?>"><?= $this->lang->line('label_email'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => 'input_data'.$error['email']), set_value('email', $obj[0]->user_email)); ?>
                    </div>
                    
                        <div class="inputitem">
                            <p class="label">
                                <label for="phone" class="<?= $error['phone']; ?>"><?= $this->lang->line('label_phone'); ?></label>
                            </p>
                            <?php if (isset($obj[0]->user_phone)): ?>
                                <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => 'input_data'.$error['phone']), set_value('phone', $obj[0]->user_phone)); ?>
                            <?php else: ?>
                                <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => 'input_data'.$error['phone']), set_value('phone')); ?>
                            <?php endif; ?>
                        </div>
                    
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="study_program_id" ><?= $this->lang->line('label_study_program_id'); ?></label>
                        </p>
                        <?= gen_dropdown('study_program_id', set_value('study_program_id',$obj[0]->study_program_id), $this->selecter->get_study_programs(), 'study_program_id', 'study_program_name', 'dropdown'); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="degree_id" ><?= $this->lang->line('label_degree_id'); ?></label>
                        </p>
                        <?= gen_dropdown('degree_id', set_value('degree_id'), $this->selecter->get_degrees(false,$numberOfDegrees,0), 'degree_id', 'degree_name', 'dropdown'); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="place_of_birth" class="<?= $error['place_of_birth']; ?>"><?= $this->lang->line('label_place_of_birth'); ?></label>
                        </p>
                        <?php if (isset($obj[0]->user_place_of_birth)): ?>
                            <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => 'input_data'.$error['place_of_birth']), set_value('place_of_birth', $obj[0]->user_place_of_birth)); ?>
                        <?php else: ?>
                                <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => 'input_data'.$error['place_of_birth']), set_value('place_of_birth')); ?>
                            <?php endif; ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="postcode" class="<?= $error['postcode']; ?>"><?= $this->lang->line('label_postcode'); ?></label>
                        </p>
                        <?php if (isset($obj[0]->user_postcode)): ?>
                             <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'input_data'.$error['postcode']), set_value('postcode', $obj[0]->user_postcode)); ?>
                        <?php else: ?>
                                <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'input_data'.$error['postcode']), set_value('postcode')); ?>
                            <?php endif; ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="degree_year" class="<?= $error['degree_year']; ?>"><?= $this->lang->line('label_degree_year'); ?></label>
                        </p>
                        <?= form_dropdown('degree_year', $years, set_value('degree_year_id', $obj[0]->user_degree_year), 'class="dropdown_year"'); ?>
                    </div>
                    
                    <?php 
                        if( $this->userdata->is_admin() )
                        {
                            $roles = array( '-1' => '', 
                                            '1'=>$this->lang->line('admin'), 
                                            '2'=>$this->lang->line('oz_member'),
                                            '3'=>$this->lang->line('po_member')
                                          );
                            echo '<div class="inputitem">';
                                echo '<p class="label"><label for="role" >'.$this->lang->line('label_role').'</label></p>';
                                echo form_dropdown('role', $roles, set_value('role',$obj[0]->user_role), 'id="role" class="dropdown_year" onchange="hidecheckbox(\'payments\',\'oddil1\')" style="cursor: pointer"');
                            echo '</div>';
                        }
                    ?>
                    
                    <?php
                        echo '<div class="inputitem" id="payments" style="display: none"><strong>'.$this->lang->line('entry_fee').'</strong>';
                            echo form_checkbox(array("id"=>"checkbox","name"=>"checkbox","style"=>"cursor: pointer", "onchange" =>"zobrazSkryj('oddil1')"), 0);
                        echo '</div>';
                        
                        echo '<div id="oddil1" class="skryvany" style="display: none">';
                            echo '<div class="inputitem">';
                                echo '<p class="label"> <label for="vs">'.$this->lang->line('label_vs').'</label> </p>';
                                echo form_input(array('name' => 'vs', 'id' => 'vs', 'class' => 'input_data' ), set_value('vs'));
                            echo '</div>';

                            echo '<div class="inputitem">';
                                echo '<p class="label"> <label for="total_sum">'.$this->lang->line('label_total_sum').'</label></p>';
                                echo form_input(array('name' => 'total_sum', 'id' => 'total_sum', 'class' => 'input_data_date' ), set_value('total_sum', 5)).' €';
                            echo '</div>';

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
                            
                            echo '<div class="inputitem">';
                                echo '<p class="label"> <label for="email_message">'.$this->lang->line('email_message').'</label></p>';
                                echo form_textarea(array('name' => 'email_message', 'id' => 'email_message', 'class' => 'textarea_data5' ), set_value('email_message', $this->lang->line('default_email')));
                            echo '</div>';
                        echo '</div>';
                    ?><br />
                    
                    <div class="inputitem">
                        <?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_sub_edit'), $this->lang->line('button_edit')); ?>	
						<span class="button_back"> <?php echo anchor('users/', $this->lang->line('to_users')); ?> </span>
                    </div>
                <?= form_close(); ?>
   
</div>
