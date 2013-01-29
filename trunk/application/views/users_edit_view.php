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
                        <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => 'input_data'.$error['phone']), set_value('phone', $obj[0]->user_phone)); ?>
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
                        <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => 'input_data'.$error['place_of_birth']), set_value('place_of_birth', $obj[0]->user_place_of_birth)); ?>
                    </div>
                    
                    <div class="inputitem">
                        <p class="label">
                            <label for="postcode" class="<?= $error['postcode']; ?>"><?= $this->lang->line('label_postcode'); ?></label>
                        </p>
                        <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'input_data'.$error['postcode']), set_value('postcode', $obj[0]->user_postcode)); ?>
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
                            echo '<div class="inputitem">';
                                echo '<p class="label"><label for="role" >'.$this->lang->line('label_role').'</label></p>';
                                echo form_dropdown('role', $this->userdata->roles(false), set_value('role', $obj[0]->user_role), 'class="dropdown_priority"');
                            echo '</div>';
                        }
                    ?> <br />
                    
                    <div class="inputitem">
                        <?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_sub_edit'), $this->lang->line('button_edit')); ?>	
						<span class="button_back"> <?php echo anchor('users/', $this->lang->line('to_users')); ?> </span>
                    </div>
                <?= form_close(); ?>
   
</div>
