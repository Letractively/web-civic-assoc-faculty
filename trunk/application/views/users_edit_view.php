<div class="errors">
    <?php 
        echo validation_errors();  
        $field = $this->selecter->id($user_id,'users','user_id');
    ?>
</div>
<?= form_open("users/edit") ?>
 
    <div class="inputitem">
        <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
        <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username',$field->user_username)) ?>
    </div>

    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name',$field->user_name)) ?>
    </div>
 
    <div class="inputitem">
        <label for="surname" class="<?= $error['surname'] ?>"><?= $this->lang->line('label_surname') ?></label>
        <?= form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname',$field->user_surname)) ?>
    </div>

    <div class="inputitem">
        <label for="password" class="<?= $error['password'] ?>"><?= $this->lang->line('label_password') ?></label>
        <?= form_password(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password',$field->user_password)) ?>
    </div>
 
    <div class="inputitem">
        <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
        <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email',$field->user_email)) ?>
    </div>

    <div class="inputitem">
        <label for="degrees_id" class="<?= $error['degrees_id'] ?>"><?= $this->lang->line('label_degrees_id') ?></label>
        <?= gen_dropdown('degrees_id', set_value('degrees_id',$field->user_degrees_id),$this->selecter->get_event_categories(),'degrees_id','degrees_id'); ?>     
    </div>
 
 

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_event')) ?>
    </div>
<?= form_close() ?>
