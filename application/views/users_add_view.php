<div class="errors">
    <?php 
        echo validation_errors(); 
        $numberOfDegrees = $this->selecter->rows('degrees', 'degree_id');
    ?>
</div>
<script>
    function zobrazSkryj(idecko){
        el = document.getElementById(idecko).style; 
        el.display = (el.display == 'block')?'none':'block';
        
        if(document.getElementById('checkbox').value == 0)
        {
            document.getElementById('checkbox').value = 1;
            document.forms[0].hidden_payment.value = 1;
        }    
        else if(document.getElementById('checkbox').value == 1)
        {
            document.getElementById('checkbox').value = 0;
            document.forms[0].hidden_payment.value = 0;
        }
    }
</script>
<div id="content_wrapper_small">
	<?= form_open("users/add"); ?>
                    <div class="inputitem">
                        <p class="label">
                            <label for="username" class="<?= $error['username']; ?>"><?= $this->lang->line('label_username'); ?></label>					
                        </p>
                        <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => 'input_data'.$error['username']), set_value('username')); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="name" class="<?= $error['name']; ?>"><?= $this->lang->line('label_name'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name')); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="surname" class="<?= $error['surname']; ?>"><?= $this->lang->line('label_surname'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => 'input_data'.$error['surname']), set_value('surname')); ?>
                    </div>                   
                    
                    <!-- Nove heslo -->
                    <div class="inputitem">
			<p class="label"> <label for="password" class="<?= $error['password']; ?>"><?= $this->lang->line('label_password') ?></label> </p>
			<?= form_password(array('name' => 'password', 'id' => 'password', 'class' => 'input_data'.$error['password']), set_value('password')) ?>
                    </div>
                    
                    <!-- Opakovanie noveho hesla -->
                    <div class="inputitem">
                            <p class="label"> <label for="password_again" class="<?= $error['password_again']; ?>"><?= $this->lang->line('label_password_again') ?></label> </p>
                            <?= form_password(array('name' => 'password_again', 'id' => 'password_again', 'class' => 'input_data'.$error['password_again']), set_value('password_again')) ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="email" class="<?= $error['email']; ?>"><?= $this->lang->line('label_email'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => 'input_data'.$error['email']), set_value('email')); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="phone" class="<?= $error['phone']; ?>"><?= $this->lang->line('label_phone'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => 'input_data'.$error['phone']), set_value('phone')); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="study_program_id" ><?= $this->lang->line('label_study_program_id'); ?></label>
                        </p>
                        <?= gen_dropdown('study_program_id', set_value('study_program_id'), $this->selecter->get_study_programs(), 'study_program_id', 'study_program_name', 'dropdown'); ?>
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
                        <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => 'input_data'.$error['place_of_birth']), set_value('place_of_birth')); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="postcode" class="<?= $error['postcode']; ?>"><?= $this->lang->line('label_postcode'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'input_data'.$error['postcode']), set_value('postcode')); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="degree_year" class="<?= $error['degree_year']; ?>"><?= $this->lang->line('label_degree_year'); ?></label>
                        </p>
                        <?= form_dropdown('degree_year', $years, set_value('degree_year_id'), 'class="dropdown_year"'); ?>
                    </div>
                    
                    <?php 
                        if( $this->userdata->is_admin() )
                        {
                            echo '<div class="inputitem">';
                                echo '<p class="label"><label for="role" >'.$this->lang->line('label_role').'</label></p>';
                                echo form_dropdown('role', $this->userdata->roles(false), set_value('role'), 'class="dropdown_year"');
                            echo '</div>';
                        }
                    ?>
                    
                    <?php
                        echo '<div class="inputitem"><strong>'.$this->lang->line('entry_fee').'</strong>';
                            echo form_checkbox(array("id"=>"checkbox","name"=>"checkbox","style"=>"cursor: pointer", "onchange" =>"zobrazSkryj('oddil1')"), 0);
                        echo '</div>';
                        
                        echo '<div id="oddil1" class="skryvany" style="display: none">';
                            echo '<div class="inputitem">';
                                echo '<p class="label"> <label for="vs">'.$this->lang->line('label_vs').'</label> </p>';
                                echo form_hidden('hidden_payment', 0);
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
                        echo '</div>';
                    ?>
                    
                    <div class="inputitem">
                        <?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_sub_edit'), $this->lang->line('button_add')); ?>
                    </div>
                    
                    <div class="inputitem">	
			<p class="button_edit"> <?php echo anchor('users/', $this->lang->line('to_users')); ?> </p>
                    </div>
                <?= form_close(); ?>
</div>