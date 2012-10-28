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
        <?= form_dropdown('study_program', $programs, set_value('study_program_id'), 'id="study_program"') ?>
    </div>
    <div class="inputitem">
        <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label>
        <?= form_dropdown('degree', $degrees, set_value('degree_id'), 'id="degree"') ?>
    </div>
    <div class="inputitem">
        <label for="place_of_birth_id" class="<?= $error['place_of_birth_id'] ?>"><?= $this->lang->line('label_place_of_birth_id') ?></label>
        <?= form_dropdown('place_of_birth', $places, set_value('place_of_birth_id'),'id="places"') ?>
    </div>
    <div class="inputitem">
        <label for="postcode_id" class="<?= $error['postcode_id'] ?>"><?= $this->lang->line('label_postcode_id') ?></label>
        <?= form_dropdown('postcode', $postcodes, set_value('postcode_id'), 'id="postcodes"') ?>
    </div>
    <div class="inputitem">
        <label for="degree_year_id" class="<?= $error['degree_year_id'] ?>"><?= $this->lang->line('label_degree_year_id') ?></label>
        <?= form_dropdown('year', $years, set_value('degree_year_id'), 'id="degree_year"') ?>
    </div>
    <div class="inputitem">
        <?= form_submit(array('name' => 'submit'), $this->lang->line('button_register')) ?>
    </div>
<?= form_close() ?>