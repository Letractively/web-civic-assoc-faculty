 <div class="errors">
    <?php 
        echo validation_errors();     
     ?>
</div>

<div id="form_wrapper">
	<?= form_open("auth/registration") ?>
		<div class="inputitem">
			<p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
			<?= form_input(array('name' => 'name', 'id' => 'name', 'class' => 'input_data'.$error['name']), set_value('name')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="surname" class="<?= $error['surname'] ?>"><?= $this->lang->line('label_surname') ?></label> </p>
			<?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => 'input_data'.$error['surname']), set_value('surname')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label> </p>
			<?= form_input(array('name' => 'username', 'id' => 'username', 'class' => 'input_data'.$error['username']), set_value('username')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?></label> </p>
			<?= form_password(array('name' => 'password', 'id' => 'password', 'class' => 'input_data'.$error['password']), set_value('password')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="password_again" class="<?= $error['password_again'] ?>"><?= $this->lang->line('label_password_again') ?></label> </p>
			<?= form_password(array('name' => 'password_again', 'id' => 'password_again', 'class' => 'input_data'.$error['password_again']), set_value('password_again')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label> </p>
			<?= form_input(array('name' => 'email', 'id' => 'email', 'class' => 'input_data'.$error['email']), set_value('email')) ?> 
		</div>
		<div class="inputitem">
			<p class="label"> <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label> </p>
			<?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => 'input_data'.$error['phone']), set_value('phone')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="study_program_id" class="<?= $error['study_program_id'] ?>"><?= $this->lang->line('label_study_program_id') ?></label> </p>
			<?= gen_dropdown('study_program_id', set_value('study_program_id'), $this->selecter->get_study_programs(), 'study_program_id', 'study_program_name'); ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label> </p>
			<?= gen_dropdown('degree_id', set_value('degree_id'), $this->selecter->get_degrees(), 'degree_id', 'degree_name'); ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="place_of_birth" class="<?= $error['place_of_birth'] ?>"><?= $this->lang->line('label_place_of_birth') ?></label> </p>
			<?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => 'input_data'.$error['place_of_birth']), set_value('plac-e_of_birth')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="postcode" class="<?= $error['postcode'] ?>"><?= $this->lang->line('label_postcode') ?></label> </p>
			<?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'input_data'.$error['postcode']), set_value('postcode')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="degree_year" class="<?= $error['degree_year'] ?>"><?= $this->lang->line('label_degree_year') ?></label> </p>
			<?= form_dropdown('degree_year', $years, set_value('degree_year_id')) ?>
		</div>
	 
		<div class="inputitem">
			<p class="label"> <label for="total_sum" class=" <?= $error['total_sum'] ?>"><?= $this->lang->line('label_total_tum') ?></label> </p>
			<?= form_input(array('name' => 'total_sum', 'id' => 'total_sum', 'class'=>'input_data'.$error['total_sum']), set_value('total_sum')) ?>
		</div>
		<div class="inputitem">
			<p class="label"> <label for="vs" class=" <?= $error['vs'] ?>"><?= $this->lang->line('label_vs') ?></label> </p>
			<?= form_input(array('name' => 'vs', 'id' => 'vs', 'class'=>'input_data'.$error['vs']), set_value('vs')) ?>
		</div>

		<?php
		   $obj = $this->selecter->get_project_categories();
		   
		   $i = 1;
		   echo '<table class="inputitem">';
				echo '<tr><th>'.$this->lang->line('table_th_category').'</th><th>'.$this->lang->line('table_th_ratio').'</th></tr>';
				foreach($obj as $o)
				{
					echo '<tr>';
						 echo '<td> <label for="project_category_'.$i.'">';
							 echo $o->project_category_name;
						 echo '</label></td>';
						 echo '<td>'.form_input(array('name' => 'project_category_'.$i, 'id' => 'project_category_'.$i, 'size'=> 3, 'class' => 'input_data_reg' ), set_value('project_category_'.$i)).'</td>';
					echo '</tr>';
					$i++;
				}
		   echo '</table>';
		?>

		<div class="inputitem">
			<?= form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('button_register')) ?>
		</div>
	<?= form_close() ?>
</div>