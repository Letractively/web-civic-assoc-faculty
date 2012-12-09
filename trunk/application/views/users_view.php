<?php
    $this->load->library('grid');
    $grid = new Grid();
?>  
<div id="paid_navig">
        <ul>
            <li><?= anchor('users/members',$this->lang->line('oz_member')) ?></li>
            <li><?= anchor('users/visitors',$this->lang->line('ex_member')) ?></li>
            <li><?= anchor('users/lecturers',$this->lang->line('lecturer')) ?></li>    
            <li><?= anchor('users/index',$this->lang->line('admin')) ?></li>
        </ul>
</div>
<?php
    
    if( $flag == 0 )
    {
        if( !$grid->bind($this->selecter->get_payments_nopaid(0), 'payment_id') )
        {
            $grid->header('user_id')->editable = false;
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->text = $this->lang->line('label_name');
            $grid->header('user_surname')->text = $this->lang->line('label_surname'); 
            $grid->header('user_email')->text = $this->lang->line('label_email'); 
            $grid->header('user_degree')->text = $this->lang->line('label_degree'); 
            $grid->header('user_study_program')->text = $this->lang->line('label_study_program');
            $grid->header('user_degree_year')->text = $this->lang->line('label_degree_year'); 
            //$grid->header('user_study_program')->text = $this->lang->line('label_date');
        }          
    }
    elseif ( $flag == 1 ) 
    {
        if( !$grid->bind($this->selecter->get_excursions_for_visitor(0) ,'user_id') )
        {
            $grid->header('user_id')->editable = false;
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->text = $this->lang->line('label_name');
            $grid->header('user_surname')->text = $this->lang->line('label_surname'); 
            $grid->header('user_email')->text = $this->lang->line('label_email'); 
//            $grid->header('user_degree')->text = $this->lang->line('label_paid_sum'); 
//            $grid->header('user_study_program')->text = $this->lang->line('label_date');
            
            
        }
    }
    elseif( $flag == 2 )
    {
        if( !$grid->bind($this->selecter->get_excursions_for_lecturer(0),'user_id') )
        {
            $grid->header('user_id')->editable = false;
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->text = $this->lang->line('label_name');
            $grid->header('user_surname')->text = $this->lang->line('label_surname'); 
            $grid->header('user_email')->text = $this->lang->line('label_email'); 
            $grid->header('user_degree')->text = $this->lang->line('label_degree');
        }
    }
    elseif( $flag == 3 )
    {
        if( !$grid->bind($this->selecter->get_users(2),'user_id') )
        {
            $grid->header('user_id')->editable = false;
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->text = $this->lang->line('label_name');
            $grid->header('user_surname')->text = $this->lang->line('label_vs'); 
            $grid->header('user_email')->text = $this->lang->line('label_surname');    
        }
    }
    
    
//        $grid->header('payment_id')->editable = false;
//        $grid->header('payment_id')->visible = false;
//        $grid->header('name')->text = $this->lang->line('label_user_id');
//        $grid->header('payment_vs')->text = $this->lang->line('label_vs'); 
//        $grid->header('payment_total_sum')->text = $this->lang->line('label_total_sum'); 
//        $grid->header('payment_paid_sum')->text = $this->lang->line('label_paid_sum'); 
//        $grid->header('payment_paid_time')->text = $this->lang->line('label_date'); 
        
        $grid->add_url = "{$this->router->class}/add";
        $grid->edit_url = "{$this->router->class}/edit";
        $grid->remove_url = "{$this->router->class}/delete";
        $grid->display();
   
?>
<!--ak flag je 0 tak zavolas get_payments_nopad(0)
flag1 = get_excursions_for_visitor(0)
flag2 = get_excursions_for_lecturer(0)
flag3 = get_users(2)-->