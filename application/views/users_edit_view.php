<?php
    $obj = $this->selecter->get_user_detail($user_id);
    echo validation_errors();
    
?>
<?php
    if($obj[0]->user_role == 2){
        echo 'člen';
        echo form_open("users/edit");
        echo '<div class="inputitem">
                <label for="username" class="'.$error['username'].'">'.$this->lang->line('label_username').'</label>'.
                form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username', $obj[0]->user_username))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="name" class="'.$error['name'].'">'.$this->lang->line('label_name').'</label>'.
                form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name', $obj[0]->user_name))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="surname" class="'.$error['surname'].'">'.$this->lang->line('label_surname').'</label>'.
                form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname', $obj[0]->user_surname))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="password" class="'.$error['password'].'">'.$this->lang->line('label_password').'</label>'.
                form_input(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password', $obj[0]->user_password))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="email" class="'.$error['email'].'">'.$this->lang->line('label_email').'</label>'.
                form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email', $obj[0]->user_email))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="phone" class="'.$error['phone'].'">'.$this->lang->line('label_phone').'</label>'.
                form_input(array('name' => 'phone', 'id' => 'phone', 'class' => ''.$error['phone']), set_value('phone', $obj[0]->user_phone))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="study_program_id" class="'.$error['study_program_id'].'">'.$this->lang->line('label_study_program_id').'</label>'.
                gen_dropdown('study_program_id', set_value('study_program_id', $obj[0]->study_program_id),$this->selecter->get_study_programs(),'study_program_id','study_program_name')
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="degree_id" class="'.$error['degree_id'].'">'.$this->lang->line('label_degree_id').'</label>'.
                gen_dropdown('degree_id', set_value('degree_id', $obj[0]->degree_id),$this->selecter->get_degrees(),'degree_id','degree_name')
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="place_of_birth" class="'.$error['place_of_birth'].'">'.$this->lang->line('label_place_of_birth').'</label>'.
                form_input(array('name' => 'place_of_birth', 'id' => 'place_of_birth', 'class' => ''.$error['place_of_birth']), set_value('place_of_birth', $obj[0]->user_place_of_birth))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="postcode" class="'.$error['postcode'].'">'.$this->lang->line('label_postcode').'</label>'.
                form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => ''.$error['postcode']), set_value('postcode', $obj[0]->user_postcode))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="degree_year" class="'.$error['degree_year'].'">'.$this->lang->line('label_degree_year').'</label>'.
                form_dropdown('user_degree_year', $years, set_value('user_degree_year_id', $obj[0]->user_degree_year),'user_degree_year_id','user_degree_year')
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="vs_box" class="'.$error['vs_box'].'">'.$this->lang->line('label_vs_box').'</label>'.
                form_checkbox()
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="postcode" class="'.$error['postcode'].'">'.$this->lang->line('label_postcode').'</label>'.
                form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => ''.$error['postcode']), set_value('postcode', $obj[0]->user_postcode))
              .'</div>';
        
        echo '<div class="inputitem">'.
                form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit'))
              .'</div>';
        
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
        
        echo form_close();
    }
    else if ($obj[0]->user_role == 3){
        echo 'návštevník exkurzie';
        echo form_open("users/edit");
        echo '<div class="inputitem">
                <label for="username" class="'.$error['username'].'">'.$this->lang->line('label_username').'</label>'.
                form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username', $obj[0]->user_username))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="name" class="'.$error['name'].'">'.$this->lang->line('label_name').'</label>'.
                form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name', $obj[0]->user_name))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="surname" class="'.$error['surname'].'">'.$this->lang->line('label_surname').'</label>'.
                form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname', $obj[0]->user_surname))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="password" class="'.$error['password'].'">'.$this->lang->line('label_password').'</label>'.
                form_input(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password', $obj[0]->user_password))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="email" class="'.$error['email'].'">'.$this->lang->line('label_email').'</label>'.
                form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email', $obj[0]->user_email))
              .'</div>';
        
        echo '<div class="inputitem">'.
                form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit'))
              .'</div>';
        
        echo form_close();
    }
    else if ($obj[0]->user_role == 4){
        echo 'prednášajúci';
        
        echo form_open("users/edit");
        echo '<div class="inputitem">
                <label for="username" class="'.$error['username'].'">'.$this->lang->line('label_username').'</label>'.
                form_input(array('name' => 'username', 'id' => 'username', 'class' => ''.$error['username']), set_value('username', $obj[0]->user_username))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="name" class="'.$error['name'].'">'.$this->lang->line('label_name').'</label>'.
                form_input(array('name' => 'name', 'id' => 'name', 'class' => ''.$error['name']), set_value('name', $obj[0]->user_name))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="surname" class="'.$error['surname'].'">'.$this->lang->line('label_surname').'</label>'.
                form_input(array('name' => 'surname', 'id' => 'surname', 'class' => ''.$error['surname']), set_value('surname', $obj[0]->user_surname))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="password" class="'.$error['password'].'">'.$this->lang->line('label_password').'</label>'.
                form_input(array('name' => 'password', 'id' => 'password', 'class' => ''.$error['password']), set_value('password', $obj[0]->user_password))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="email" class="'.$error['email'].'">'.$this->lang->line('label_email').'</label>'.
                form_input(array('name' => 'email', 'id' => 'email', 'class' => ''.$error['email']), set_value('email', $obj[0]->user_email))
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="degree_id" class="'.$error['degree_id'].'">'.$this->lang->line('label_degree_id').'</label>'.
                gen_dropdown('degree_id', set_value('degree_id', $obj[0]->degree_id),$this->selecter->get_degrees(),'degree_id','degree_name')
              .'</div>';
        
        echo '<div class="inputitem">
                <label for="degree_year" class="'.$error['degree_year'].'">'.$this->lang->line('label_degree_year').'</label>'.
                form_dropdown('degree_year', $years, set_value('degree_year_id', $obj[0]->user_degree_year))
              .'</div>';
        
        echo '<div class="inputitem">'.
                form_submit(array('type'=>'submit', 'name' => 'submit'), $this->lang->line('button_edit'))
              .'</div>';
        
        echo form_close();
    }    
    
?>
