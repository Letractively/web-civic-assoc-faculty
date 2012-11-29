<?php
    $this->load->library('grid');
    $grid = new Grid();
?>    
    <div id="paid_navig">
        <ul>
            <li><?= anchor('payments/index',$this->lang->line('payment_all')) ?></li>
            <li><?= anchor('payments/paid',$this->lang->line('payment_paid')) ?></li>
            <li><?= anchor('payments/nopaid',$this->lang->line('payment_nopaid')) ?></li>
        </ul>
    </div>
 
<?php
    if( $flag == 0 )
    {
        $grid->bind($this->selecter->get_payments($pay_id), 'payment_id');
        $grid->header('payments_id')->editable = false;
    }
    elseif ( $flag == 1 ) 
    {
        $grid->bind($this->selecter->get_payments_paid($pay_id), 'payment_id');
        $grid->header('payments_id')->editable = false;
    }
    elseif( $flag == 2 )
    {
        $grid->bind($this->selecter->get_payments_nopaid($pay_id), 'payment_id');
        $grid->header('payments_id')->editable = false;
    }
    
    
    
    $grid->add_url = "{$this->router->class}/add";
    $grid->edit_url = "{$this->router->class}/edit";
    $grid->remove_url = "{$this->router->class}/delete";
    
    
    
	
    $grid->display();
?>
