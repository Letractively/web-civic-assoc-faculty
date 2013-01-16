<?php
    $obj = $this->selecter->get_user_detail($user_id);
    //array_debug($obj);
?>

<script>
function zobrazSkryj(idecko){
el=document.getElementById(idecko).style; 
el.display=(el.display == 'block')?'none':'block';
}
</script>
<style>
.skryvany {display: none}
</style>

<div id="content_wrapper">
	<?php
		echo '<p class="project_label">';
			echo 'Vaša hodnosť: ';
                        if($obj[0]->user_role == 1){
				echo '<span class="user_rank">'; echo 'Admin'; echo '</span>';
			}
			else if($obj[0]->user_role == 2){
				echo '<span class="user_rank">'; echo 'Člen'; echo '</span>';
			}
			else if ($obj[0]->user_role == 3){
				echo '<span class="user_rank">'; echo 'Potencionálny člen'; echo '</span>';
			}
		echo '</p>';
	?>

	<div class="inputitem">
		<span class="user_detail_label"> Login: </span> <?= $obj[0]->user_username ?>  
	</div>

	<div class="inputitem">
		<span class="user_detail_label"> Meno: </span>
			<?= $obj[0]->user_name ?>&nbsp;
			<?= $obj[0]->user_surname ?>
	</div>

	<div class="inputitem">
		<span class="user_detail_label"> E-mail: </span> <?= $obj[0]->user_email ?>  
	</div>

	<?php
		if($obj[0]->user_role == 2){
			echo '<br /> <div class="inputitem"> <div class="study_program_name">Študijný program: '.$obj[0]->study_program_name.'</div>';
			echo '<div class="user_degree_year">Rok ukončenia štúdia: '.$obj[0]->user_degree_year.'</div>';
			echo '<div class="user_place_of_birth">Miesto narodenia: '.$obj[0]->user_place_of_birth.'</div>';
			echo '<div class="user_postcode">PSČ: '.$obj[0]->user_postcode.'</div> </div>';
			
                        if( $this->userdata->is_admin() )
                        {
                            echo '<p class="button_edit">'; 
                                echo anchor('users/edit/'.$obj[0]->user_id,$this->lang->line('edit_item')); 
                            echo '</p>';
                        }			
			$lp = $this->selecter->get_payments_lastpaid($user_id);
			$date = datetime($lp->payment_paid_time, FALSE);
			//array_debug($lp);
			
			if($lp->payment_paid_time == NULL){
				echo 'Musíte uhradiť členský poplatok 5€';
				echo '<br />';
                                if( $this->userdata->is_admin() )
				{
                                    echo '<a style="cursor: pointer; text-decoration: underline;" onclick="zobrazSkryj(\'oddil1\')">Uhradiť</a>';
                                    echo '<div id="oddil1" class="skryvany">';
                                            echo form_open('payments/add');
                                                    $pay= $this->selecter->get_payments($user_id);
                                                    echo '<div class="inputitem">';
                                                            echo '<p class="label"> <label for="vs">'.$this->lang->line('label_vs').'</label> </p>';
                                                            echo form_input(array('name' => 'vs', 'id' => 'vs', 'class' => 'input_data' ), set_value('vs', $pay[0] -> payment_vs));
                                                    echo '</div>';

                                                    echo '<div class="inputitem">';
                                                            echo '<p class="label"> <label for="total_sum">'.$this->lang->line('label_total_sum').'</label> </p>';
                                                            echo form_input(array('name' => 'total_sum', 'id' => 'total_sum', 'class' => 'input_data_date' ), set_value('total_sum', 5)).'€';
                                                    echo '</div>';

                                                    echo '<div class="inputitem">';
                                                            echo form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_edit'), $this->lang->line('button_add'));
                                                    echo '</div>';
                                            echo form_close();
                                    echo '</div>';
                                }
				echo '<p class="button_back">'; echo anchor('users/', $this->lang->line('to_users')); echo '</p>';
			}
		  
			else if(date('Y+1-m-d') <  $lp->payment_paid_time){
				echo '<br />Členstvo platné do: '.$dm = day_month($date).'.'.$year = year($date)+1;
				echo '<br /><p class="button_back">'; echo anchor('users/', $this->lang->line('to_users')); echo '</p>';
			}
			else{
				echo '<br />Členské vypršalo: '.$dm = day_month($date).'.'.$year = year($date)+1;
				echo '<br />V prípade neúhrady registrácia platná do: 31.12.'.$year = year($date)+1;
				echo '<br />';
                                if( $this->userdata->is_admin() )
				{
                                    echo '<p class="button_edit"><a style="cursor: pointer; " onclick="zobrazSkryj(\'oddil1\')">Uhradiť</a></p>';
                                    echo '<div id="oddil1" class="skryvany">';
                                            echo form_open('payments/add');
                                                    $pay= $this->selecter->get_payments($user_id);
                                                    echo '<div class="inputitem">';
                                                            echo '<p class="label"> <label for="vs">'.$this->lang->line('label_vs').'</label> </p>';
                                                            echo form_input(array('name' => 'vs', 'id' => 'vs', 'class' => 'input_data' ), set_value('vs', $pay[0] -> payment_vs));
                                                    echo '</div>';

                                                    echo '<div class="inputitem">';
                                                            echo '<label for="total_sum">'.$this->lang->line('label_total_sum').'</label>';
                                                            echo form_input(array('name' => 'total_sum', 'id' => 'total_sum', 'class' => 'input_data_date' ), set_value('total_sum', 5)).'€';
                                                    echo '</div>';

                                                    echo '<div class="inputitem">';
                                                            echo form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_edit'), $this->lang->line('button_add'));
                                                    echo '</div>';
                                            echo form_close();
                                    echo '</div>';
                                }
				echo '<p class="button_back">'; echo anchor('users/', $this->lang->line('to_users')); echo '</p>';
			}
	  
		}
		else if ($obj[0]->user_role == 3){
			echo '<p class="button_back">'; echo anchor('users/edit/'.$obj[0]->user_id,$this->lang->line('edit_item')); echo '</p>';
			
	//        echo '<br /><br />Prihlásenia na exkurzie:<br />';
	//        
	//        $ex = $this->selecter->get_excursions_for_visitor($user_id);
	//        foreach ($ex as $e){
	//            echo anchor('excursion_event/detail/'.$e->excursion_event_id, $e->excursion_event_name).', ';
	//            echo $e->booked_excursion_number_of_visitors.'<br />';
	//        }
		}
		else if ($obj[0]->user_role == 4){
			echo '<div class="user_email"> <span class="label"> Titul: </span>'.$obj[0]->degree_name.'</div> <br />';
			
			echo '<p class="button_back">'; echo anchor('users/edit/'.$obj[0]->user_id,$this->lang->line('edit_item')); echo '</p>';  
	//        echo '<br /><br />Registrované prednášky:<br />';
	//        
	//        $lect = $this->selecter->get_excursions_for_lecturer($user_id);
	//        foreach ($lect as $l){
	//            echo anchor('excursion_event/detail/'.$l->excursion_event_id, $l->excursion_event_name).', ';
	//            echo $l->excursion_time_from.'-'.$l->excursion_time_to.'<br />';
	//        }
		}    
		
		
	?>
</div>

