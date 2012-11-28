<div class="errors">
    <?php echo validation_errors();     
    $field = $this->selecter->get_user_detail($user_id,'users','user_id');
    //array_debug($programs) ?>

</div>

<?= form_open("users/edit") ?>
    <div class="inputitem">
        <label for="role" class="<?= $error['role'] ?>"><?= $this->lang->line('label_role') ?></label>
        <?= form_checkbox('role', $role, set_value('role',$field->user_role),$this->selecter->user_role(),'user_role')?>
    </div>

    <div class="inputitem">
        <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
        <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username', $field->user_username)) ?>
    </div>
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name', $field->user_name)) ?>
    </div>
    <div class="inputitem">
        <label for="surname" class="<?= $error['surname'] ?>"><?= $this->lang->line('label_surname') ?></label>
        <?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname', $field->user_surname)) ?>
    </div>
    <div class="inputitem">
        <label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?></label>
        <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password')) ?>
    </div>
    <div class="inputitem">
        <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
        <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email', $field->user_email)) ?>
    </div>
    <div class="inputitem">
        <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label>
        <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone', $field->user_phone)) ?>
    </div>
    <div class="inputitem">
        <label for="study_program_id" class="<?= $error['study_program_id'] ?>"><?= $this->lang->line('label_study_program_id') ?></label>
        <?= gen_dropdown('study_program_id', $study_programs, set_value('study_program_id',$field->user_study_program_id),$this->selecter->study_program_id(),'user_study_program_id', 'user_study_program_name') ?>
    </div>
    <div class="inputitem">
        <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label>
        <?= gen_dropdown('degree_id', $study_programs, set_value('degree_id',$field->user_degree_id),$this->selecter->user_degree_id(),'user_degree_id', 'user_degree_name') ?>
    </div>
    <div class="inputitem">
        <label for="place_of_birth" class="<?= $error['place_of_birth'] ?>"><?= $this->lang->line('label_place_of_birth') ?></label>
        <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => ''.$error['place_of_birth']), set_value('place_of_birth', $field->user_place_of_birth)) ?>
    </div>
    <div class="inputitem">
        <label for="postcode" class="<?= $error['postcode'] ?>"><?= $this->lang->line('label_postcode') ?></label>
        <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => ''.$error['postcode']), set_value('postcode', $field->user_postcode)) ?>
    </div>
    <div class="inputitem">
        <label for="degree_year" class="<?= $error['degree_year'] ?>"><?= $this->lang->line('label_degree_year') ?></label>
        <?= gen_dropdown('degree_year', $study_programs, set_value('degree_year',$field->user_degree_year),$this->selecter->user_degree_year(),'user_degree_year') ?>
    </div>
    <div class="inputitem">
        <label for="vs" class=" <?= $error['vs'] ?>"><?= $this->lang->line('label_vs') ?></label>
        <?= form_input(array('name' => 'vs', 'id' => 'vs', 'class'=>''.$error['vs']), set_value('vs', $field->user_vs)) ?>
    </div>
    <?php
        for($i = 1; $i <= $numb_proj_cat; $i++)
        {
            echo '<div class="inputitem">';
                echo '<label for="project_category_'.$i.'class="' .$error['project_category_'.$i].'">';
                    echo $this->lang->line('label_project_category_'.$i);
                echo '</label>';
                echo form_input(array('name' => 'project_category_'.$i, 'id' => 'project_category_'.$i, 'size'=> 1, 'class'=>''.$error['project_category_'.$i]), set_value('project_category_'.$i));
            echo '</div>';
        }
    ?>

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit')) ?>
    </div>
<?= form_close() ?>