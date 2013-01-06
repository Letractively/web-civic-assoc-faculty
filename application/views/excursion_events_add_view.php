<div class="errors">
    <?php echo validation_errors();      
    //array_debug($programs) ?>
</div>
<?= form_open("excursion_events/add") ?>

    <div class="inputitem">
        <label for="name" class="<?= $error['name'] ?>"><?= $this->lang->line('label_name') ?></label>
        <?= form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name')) ?>
    </div>
 
    <div class="inputitem">
        <label for="abstract" class="<?= $error['abstract'] ?>"><?= $this->lang->line('label_abstract') ?></label>
        <?= form_textarea(array('name' => 'abstract', 'id' => 'abstract', 'class' => ''.$error['abstract']), set_value('abstract')) ?>
    </div>
 
    <div class="inputitem">
        <label for="about" class="<?= $error['about'] ?>"><?= $this->lang->line('label_about') ?></label>
        <?= form_textarea(array('name' => 'about', 'id' => 'about', 'class' => ''.$error['about']), set_value('about')) ?>
    </div>
 
<!--od -> do-->
    <div class="inputitem">
        <label for="from" class="<?= $error['from'] ?>"><?= $this->lang->line('label_from') ?></label>
        <?= form_input(array('name' => 'from', 'id' => 'from', 'class' => ''.$error['from']), set_value('from')) ?>
    </div>
 
    <div class="inputitem">
        <label for="to" class="<?= $error['to'] ?>"><?= $this->lang->line('label_to') ?></label>
        <?= form_input(array('name' => 'to', 'id' => 'to', 'class' => ''.$error['to']), set_value('to')) ?>
    </div>
<!--end-->

<!--lokalita-->
    <div class="inputitem">
        <label for="room" class="<?= $error['room'] ?>"><?= $this->lang->line('label_room') ?></label>
        <?= form_input(array('name' => 'room', 'id' => 'room', 'class' => ''.$error['room']), set_value('room')) ?>
    </div>
 
    <div class="inputitem">
        <label for="place" class="<?= $error['place'] ?>"><?= $this->lang->line('label_place') ?></label>
        <?= form_input(array('name' => 'place', 'id' => 'place', 'class' => ''.$error['place']), set_value('place')) ?>
    </div>
<!--end-->

   

    

    

    <div class="inputitem">
        <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add_ex_event')) ?>
    </div>
<?= form_close() ?>