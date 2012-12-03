<div class="errors">
    <?php 
        echo validation_errors();     
     ?>

</div>

<?= form_open("auth/registration") ?>
    <div class="inputitem">
        <p class="label"> <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="surname" class="<?= $error['surname'] ?>"><?= $this->lang->line('label_surname') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?></label> </p>
        <p class="box"> <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="password_again" class="<?= $error['password_again'] ?>"><?= $this->lang->line('label_password_again') ?></label> </p>
        <p class="box"> <?= form_password(array('name' => 'password_again', 'id' => 'password_again', 'class' => ''.$error['password_again']), set_value('password_again')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="study_program_id" class="<?= $error['study_program_id'] ?>"><?= $this->lang->line('label_study_program_id') ?></label> </p>
        <p class="box"> <?= gen_dropdown('study_program_id', set_value('study_program_id'), $this->selecter->get_study_programs(), 'study_program_id', 'study_program_name'); ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label> </p>
        <p class="box"> <?= gen_dropdown('degree_id', set_value('degree_id'), $this->selecter->get_degrees(), 'degree_id', 'degree_name'); ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="place_of_birth" class="<?= $error['place_of_birth'] ?>"><?= $this->lang->line('label_place_of_birth') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => ''.$error['place_of_birth']), set_value('plac-e_of_birth')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="postcode" class="<?= $error['postcode'] ?>"><?= $this->lang->line('label_postcode') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => ''.$error['postcode']), set_value('postcode')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="degree_year" class="<?= $error['degree_year'] ?>"><?= $this->lang->line('label_degree_year') ?></label> </p>
        <p class="box"> <?= form_dropdown('degree_year', $years, set_value('degree_year_id')) ?> </p>
    </div>
 
    <div class="inputitem">
        <p class="label"> <label for="total_sum" class=" <?= $error['total_sum'] ?>"><?= $this->lang->line('label_total_tum') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'total_sum', 'id' => 'total_sum', 'class'=>''.$error['total_sum']), set_value('total_sum')) ?> </p>
    </div>
    <div class="inputitem">
        <p class="label"> <label for="vs" class=" <?= $error['vs'] ?>"><?= $this->lang->line('label_vs') ?></label> </p>
        <p class="box"> <?= form_input(array('name' => 'vs', 'id' => 'vs', 'class'=>''.$error['vs']), set_value('vs')) ?> </p>
    </div>

    <?php
       $obj = $this->selecter->get_project_categories();
       
       $i = 1;
       echo '<table>';
            echo '<tr><th>'.$this->lang->line('table_th_category').'</th><th>'.$this->lang->line('table_th_ratio').'</th></tr>';
            foreach($obj as $o)
            {
                echo '<tr><div class="inputitem">';
                     echo '<td><label for="project_category_'.$i.'">';
                         echo $o->project_category_name;
                     echo '</label></td>';
                     echo '<td>'.form_input(array('name' => 'project_category_'.$i, 'id' => 'project_category_'.$i, 'size'=> 1 ), set_value('project_category_'.$i)).'</td>';
                echo '</div></tr>';
                $i++;
            }
       echo '</table>';
    ?>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_register')) ?>
    </div>
<?= form_close() ?>