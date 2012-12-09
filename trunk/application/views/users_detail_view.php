<?php
    $obj = $this->selecter->get_user_detail($user_id);
    array_debug($obj);
?>
<?php
    if($obj[0]->user_role == 2){
        echo 'člen';
    }
    else if ($obj[0]->user_role == 3){
        echo 'návštevník exkurzie';
    }
    else if ($obj[0]->user_role == 4){
        echo 'prednášajúci';
    }    
    
?>
<div class="user_username">
    Login: <?= $obj[0]->user_username ?>  
</div>

<div class="user_name">
    Meno: <?= $obj[0]->user_name ?>&nbsp;
          <?= $obj[0]->user_surname ?>
</div>

<div class="user_email">
    E-mail: <?= $obj[0]->user_email ?>  
</div>
<?php
    if($obj[0]->user_role == 2){
        echo '<br /><div class="study_program_name">Študijný program: '.$obj[0]->study_program_name.'</div>';
        echo '<div class="user_degree_year">Rok ukončenia štúdia: '.$obj[0]->user_degree_year.'</div>';
        echo '<div class="user_place_of_birth">Miesto narodenia: '.$obj[0]->user_place_of_birth.'</div>';
        echo '<div class="user_postcode">PSČ: '.$obj[0]->user_postcode.'</div>';
        
        echo anchor('users/edit/'.$obj[0]->user_id,$this->lang->line('edit_item'));
        
        $lp = $this->selecter->get_payments_lastpaid($user_id);
        $date = datetime($lp->payment_paid_time, FALSE);
        //array_debug($lp);

      
        if(date('Y+1-m-d') <  $lp->payment_paid_time){
            echo '<br />Členstvo platné do: '.$dm = day_month($date).'.'.$year = year($date)+1;
        }
        else{
            echo '<br />Členské vypršalo: '.$dm = day_month($date).'.'.$year = year($date)+1;
            echo '<br />V prípade neúhrady registrácia platná do: 31.12.'.$year = year($date)+1;
            
            echo form_open('payments/add');
                $pay= $this->selecter->get_payments($user_id);
                echo '<div class="inputitem">';
                echo    '<label for="vs">'.$this->lang->line('label_vs').'</label>';
                echo    form_input(array('name' => 'vs', 'id' => 'vs', ), set_value('vs', $pay[0] -> payment_vs));
                echo '</div>';
                
                echo '<div class="inputitem">';
                echo    '<label for="total_sum">'.$this->lang->line('label_total_sum').'</label>';
                echo    form_input(array('name' => 'total_sum', 'id' => 'total_sum', ), set_value('total_sum', 5)).'€';
                echo '</div>';
                
            echo form_close();
        }
        
  
    }
    else if ($obj[0]->user_role == 3){
        echo anchor('users/edit/'.$obj[0]->user_id,$this->lang->line('edit_item'));  
        echo '<br /><br />Prihlásenia na exkurzie:<br />';
        
        $ex = $this->selecter->get_excursions_for_visitor($user_id);
        foreach ($ex as $e){
            echo anchor('excursion_event/detail/'.$e->excursion_event_id, $e->excursion_event_name).', ';
            echo $e->booked_excursion_number_of_visitors.'<br />';
        }
    }
    else if ($obj[0]->user_role == 4){
        echo '<div class="user_email">Titul: '.$obj[0]->degree_name.'</div> <br />';
        
        echo anchor('users/edit/'.$obj[0]->user_id,$this->lang->line('edit_item'));  
        echo '<br /><br />Registrované prednášky:<br />';
        
        $lect = $this->selecter->get_excursions_for_lecturer($user_id);
        foreach ($lect as $l){
            echo anchor('excursion_event/detail/'.$l->excursion_event_id, $l->excursion_event_name).', ';
            echo $l->excursion_time_from.'-'.$l->excursion_time_to.'<br />';
        }
    }    
    
?>

