<?php
	$this->load->library('grid');
	$this->load->helper('correspondence');
	
	$grid = new Grid();

        if ($this->selecter->get_users_filter($get) == '')
        {
            echo '<div id="grid_wrapper">';
		echo $this->lang->line('no_result');
            echo '</div>';
        }
        else
        {
            if ( $grid->bind(updateCorUserList($this->selecter->get_users_filter($get)), 'user_id') )
            {
                    $grid->header('user_id')->visible = false;
                    $grid->header('user_name')->text = 'meno';
                    $grid->header('user_name')->set_anchor("users/detail", 'user_id');
                    $grid->header('user_surname')->text = 'priezvisko';
                    $grid->header('user_surname')->set_anchor("users/detail", 'user_id');
                    $grid->header('degree_name')->text = 'titul';
                    $grid->header('study_program_name')->text = 'študijný program';
                    $grid->header('user_email')->text = 'email';
                    $grid->header('user_email_evidence_date')->text = 'Dátum odoslania';
                    $grid->header('user_email_evidence_date')->set_datetime();
                    $grid->header('user_email_evidence_email_type_id')->text = 'Typ emailu';
            }
            echo '<div id="grid_wrapper">';
		$grid->display();
            echo '</div>';
        }
	
?>