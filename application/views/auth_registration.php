<div class="errors">
    <?php echo validation_errors(); ?>
</div>

<?= form_open("auth/registration") ?>
    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?>
    </div>
    <div class="inputitem">
        <label for="surname" class="<?= $error['surname'] ?>"><?= $this->lang->line('label_surname') ?></label>
        <?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname')) ?>
    </div>
    <div class="inputitem">
        <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
        <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username')) ?>
    </div>
    <div class="inputitem">
        <label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?></label>
        <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password')) ?>
    </div>
    <div class="inputitem">
        <label for="password_again" class="<?= $error['password_again'] ?>"><?= $this->lang->line('label_password_again') ?></label>
        <?= form_password(array('name' => 'password_again', 'id' => 'password_again', 'class' => ''.$error['password_again']), set_value('password_again')) ?>
    </div>
    <div class="inputitem">
        <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
        <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email')) ?>
    </div>
    <div class="inputitem">
        <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label>
        <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone')) ?>
    </div>
    <div class="inputitem">
        <label for="study_program_id" class="<?= $error['study_program_id'] ?>"><?= $this->lang->line('label_study_program_id') ?></label>
        <?= form_dropdown('study_program_id', $programs, set_value('study_program_id')) ?>
    </div>
    <div class="inputitem">
        <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label>
        <?= form_dropdown('degree_id', $degrees, set_value('degree_id')) ?>
    </div>
    <div class="inputitem">
        <label for="place_of_birth_id" class="<?= $error['place_of_birth_id'] ?>"><?= $this->lang->line('label_place_of_birth_id') ?></label>
        <?= form_dropdown('place_of_birth_id', $places, set_value('place_of_birth_id')) ?>
    </div>
    <div class="inputitem">
        <label for="postcode" class="<?= $error['postcode'] ?>"><?= $this->lang->line('label_postcode') ?></label>
        <?= form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => ''.$error['postcode']), set_value('postcode')) ?>
    </div>
    <div class="inputitem">
        <label for="degree_year" class="<?= $error['degree_year'] ?>"><?= $this->lang->line('label_degree_year') ?></label>
        <?= form_dropdown('degree_year', $years, set_value('degree_year_id')) ?>
    </div>
 
    <div class="inputitem">
        <label for="total_sum" class=" <?= $error['total_sum'] ?>"><?= $this->lang->line('label_total_tum') ?></label>
        <?= form_input(array('name' => 'total_sum', 'id' => 'total_sum', 'class'=>''.$error['total_sum']), set_value('total_sum')) ?>
    </div>
    <div class="inputitem">
        <label for="vs" class=" <?= $error['vs'] ?>"><?= $this->lang->line('label_vs') ?></label>
        <?= form_input(array('name' => 'vs', 'id' => 'vs', 'class'=>''.$error['vs']), set_value('vs')) ?>
    </div>

    <div class="inputitem">
        <label for="project_category_1" class=" <?= $error['project_category_1'] ?>"><?= $this->lang->line('label_project_category_1') ?></label>
        <?= form_input(array('name' => 'project_category_1', 'id' => 'project_category_1', 'size'=> 1, 'class'=>''.$error['project_category_1']), set_value('project_category_1')) ?>
    </div>
    <div class="inputitem">
        <label for="project_category_2" class=" <?= $error['project_category_2'] ?>"><?= $this->lang->line('label_project_category_2') ?></label>
        <?= form_input(array('name' => 'project_category_2', 'id' => 'project_category_2', 'size'=> 1, 'class'=>''.$error['project_category_2']), set_value('project_category_2')) ?>
    </div>
    <div class="inputitem">
        <label for="project_category_3" class=" <?= $error['project_category_3'] ?>"><?= $this->lang->line('label_project_category_3') ?></label>
        <?= form_input(array('name' => 'project_category_3', 'id' => 'project_category_3', 'size'=> 1, 'class'=>''.$error['project_category_3']), set_value('project_category_3')) ?>
    </div>
    <div class="inputitem">
        <label for="project_category_4" class=" <?= $error['project_category_4'] ?>"><?= $this->lang->line('label_project_category_4') ?></label>
        <?= form_input(array('name' => 'project_category_4', 'id' => 'project_category_4', 'size'=> 1, 'class'=>''.$error['project_category_4']), set_value('project_category_4')) ?>
    </div>
    <div class="inputitem">
        <label for="project_category_5" class=" <?= $error['project_category_5'] ?>"><?= $this->lang->line('label_project_category_5') ?></label>
        <?= form_input(array('name' => 'project_category_5', 'id' => 'project_category_5', 'size'=> 1, 'class'=>''.$error['project_category_5']), set_value('project_category_5')) ?>
    </div>
    <div class="inputitem">
        <label for="project_category_6" class=" <?= $error['project_category_6'] ?>"><?= $this->lang->line('label_project_category_6') ?></label>
        <?= form_input(array('name' => 'project_category_6', 'id' => 'project_category_6', 'size'=> 1, 'class'=>''.$error['project_category_6']), set_value('project_category_6')) ?>
    </div>
    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_register')) ?>
    </div>
<?= form_close() ?>