<div class="errors">
    <?php echo validation_errors();      
    ?>
</div>
<script language="JavaScript">
//here you place the ids of every element you want.
var ids=new Array('a1','a2','a3','a4');
function switchid(id){	
	hideallids();
	showdiv(id);
}
hidediv(ch);
function hideallids(){
	//loop through the array and hide each element by id
	for (var i=0;i<ids.length;i++){
		hidediv(ids[i]);
	}		  
}

function hidediv(id) {
	//safe function to hide an element with a specified id
	if (document.getElementById) { // DOM3 = IE5, NS6
		document.getElementById(id).style.display = 'none';
	}
	else {
		if (document.layers) { // Netscape 4
			document.id.display = 'none';
		}
		else { // IE 4
			document.all.id.style.display = 'none';
		}
	}
}

function showdiv(id) {
	//safe function to show an element with a specified id
		  
	if (document.getElementById) { // DOM3 = IE5, NS6
		document.getElementById(id).style.display = 'block';
	}
	else {
		if (document.layers) { // Netscape 4
			document.id.display = 'block';
		}
		else { // IE 4
			document.all.id.style.display = 'block';
		}
	}
}
</script>
        <label for="oz_member" class="<?= $error['oz_member'] ?>"><?= $this->lang->line('label_oz_member') ?></label>
            <input type="radio" value="1" name="myRadio" onclick="javascript:switchid('a1');" checked="checked"/><br />
        <label for="ex_member" class="<?= $error['ex_member'] ?>"><?= $this->lang->line('label_ex_member') ?></label>
            <input type="radio" value="2" name="myRadio" onclick="javascript:switchid('a2');"/><br />
        <label for="lecturer" class="<?= $error['lecturer'] ?>"><?= $this->lang->line('label_lecturer') ?></label>
            <input type="radio" value="3" name="myRadio" onclick="javascript:switchid('a3');"/><br />
        <label for="admin" class="<?= $error['admin'] ?>"><?= $this->lang->line('label_admin') ?></label>
            <input type="radio" value="4" name="myRadio" onclick="javascript:switchid('a4');"/><br />

<hr/>

	<div id='a1' style="display:block;">
            <?= form_open("users/add")?>
                <div class="inputitem">
                    <?= form_hidden(array('name' => 'role', 'id' => 'role', 'class' => ''.$error['role']), set_value('role',2)) ?>
                </div>
            
                <div class="inputitem">
                    <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
                    <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username')) ?>    
                </div>

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
                    <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
                    <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email')) ?>
                </div>

                <div class="inputitem">
                    <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label>
                    <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone')) ?> 
                </div>

                <div class="inputitem">
                    <label for="study_program_id" class="<?= $error['study_program_id'] ?>"><?= $this->lang->line('label_study_program_id') ?></label>
                    <?= gen_dropdown('study_program_id', set_value('study_program_id'), $this->selecter->get_study_programs(), 'study_program_id', 'study_program_name'); ?> 
                </div>

                <div class="inputitem">
                    <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label>
                    <?= gen_dropdown('degree_id', set_value('degree_id'), $this->selecter->get_degrees(), 'degree_id', 'degree_name'); ?>
                </div>

                <div class="inputitem">
                    <label for="place_of_birth" class="<?= $error['place_of_birth'] ?>"><?= $this->lang->line('label_place_of_birth') ?></label>
                    <?= form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => ''.$error['place_of_birth']), set_value('plac-e_of_birth')) ?>
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
                    <label for="vs_box" class="<?= $error['vs_box'] ?>"><?= $this->lang->line('label_vs_box') ?></label>
                    <input name="tb_choice1" type="checkbox" checked="yes"  />
                </div>
                <div >
                    <label for="vs" class="<?= $error['vs'] ?>"><?= $this->lang->line('label_vs') ?></label>
                    <?= form_input(array('name' => 'vs', 'id' => 'vs', 'class' => ''.$error['vs']), set_value('vs')) ?>
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
                    <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add')) ?>
                </div>
            <?= form_close() ?>
	</div>

	<div id='a2' style="display:none;">
            <?= form_open("users/add")?>
                
                <div class="inputitem">
                    <?= form_hidden(array('name' => 'role', 'id' => 'role', 'class' => ''.$error['role']), set_value('role',3)) ?>
                </div>
            
		<div class="inputitem">
                    <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
                    <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username')) ?>
                </div>

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
                    <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
                    <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email')) ?>
                </div>

                <div class="inputitem">
                    <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label>
                    <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone')) ?> 
                </div>
                <div class="inputitem">
                    <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add')) ?>
                </div>
            <?= form_close() ?>
	</div>

	<div id='a3' style="display:none;">
            <?= form_open("users/add")?>
                <div class="inputitem">
                    <?= form_hidden(array('name' => 'role', 'id' => 'role', 'class' => ''.$error['role']), set_value('role',4)) ?>
                </div>
            
		<div class="inputitem">
                    <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
                    <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username')) ?>
                </div>

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
                    <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
                    <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email')) ?>
                </div>

                <div class="inputitem">
                    <label for="phone" class="<?= $error['phone'] ?>"><?= $this->lang->line('label_phone') ?></label>
                    <?= form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone')) ?> 
                </div>
            
                <div class="inputitem">
                    <label for="degree_id" class="<?= $error['degree_id'] ?>"><?= $this->lang->line('label_degree_id') ?></label>
                    <?= gen_dropdown('degree_id', set_value('degree_id'), $this->selecter->get_degrees(), 'degree_id', 'degree_name'); ?>
                </div>
                <div class="inputitem">
                    <label for="degree_year" class="<?= $error['degree_year'] ?>"><?= $this->lang->line('label_degree_year') ?></label>
                    <?= form_dropdown('degree_year', $years, set_value('degree_year_id')) ?>
                </div>
                <div class="inputitem">
                    <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add')) ?>
                </div>
            <?= form_close() ?>
        </div>

        <div id='a4' style="display:none;">
                <div class="inputitem">
                    <?= form_hidden(array('name' => 'role', 'id' => 'role', 'class' => ''.$error['role']), set_value('role',1)) ?>
                </div>
            
		<div class="inputitem">
                    <label for="username" class="<?= $error['username'] ?>"><?= $this->lang->line('label_username') ?></label>
                    <?= form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username')) ?>
                </div>

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
                    <label for="email" class="<?= $error['email'] ?>"><?= $this->lang->line('label_email') ?></label>
                    <?= form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email')) ?>
                </div>
            
                <div class="inputitem">
                    <?= form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_add')) ?>
                </div>
            <?= form_close() ?>
	</div>