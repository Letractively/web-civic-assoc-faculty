<?php $obj = $this->selecter->get_user_detail($user_id); ?>
<div id="content_wrapper_small">
    <?php
    if ($this->userdata->is_admin()) {
        echo '<p class="project_label">';
        echo $this->lang->line('label_state') . ': ';
        echo '<span class="user_rank">';
        switch ($obj[0]->user_role) {
            case 1:
                echo $this->lang->line('admin');
                break;
            case 2:
                echo $this->lang->line('oz_member');
                break;
            case 3:
                echo $this->lang->line('po_member');
                break;
        }
        echo '</span>';
        echo '</p>';
    }
    ?>    
    <div class="inputitem">
        <span class="user_detail_label"><?= $this->lang->line('label_name'); ?>: </span>
<?= $obj[0]->user_name . ' ' . $obj[0]->user_surname; ?>
    </div>

<?php if ($obj[0]->user_degree_year != ''): ?>
        <div class="inputitem">
            <span class="user_detail_label"><?= $this->lang->line('label_degree_year'); ?>: </span>    
    <?= $obj[0]->user_degree_year ?>  
        </div>
        <?php endif; ?>

    <?php if ($obj[0]->user_study_program_id != ''): ?>
        <div class="inputitem">
            <span class="user_detail_label">
    <?= $this->lang->line('label_study_program_id') . ': '; ?>
            </span>
                <?= $obj[0]->study_program_name; ?>
        </div>
        <?php endif; ?>

    <?php if ($this->userdata->is_admin() || $user_id == $this->userdata->get_user_id()): ?>
        <div class="inputitem">
            <span class="user_detail_label"><?= $this->lang->line('button_login'); ?>: </span>
    <?= $obj[0]->user_username ?>  
        </div>
        <div class="inputitem">
            <span class="user_detail_label"><?= $this->lang->line('label_email'); ?>: </span>
    <?= $obj[0]->user_email ?>  
        </div>
        <div class="inputitem">
            <span class="user_detail_label"><?= $this->lang->line('label_phone'); ?>: </span>
    <?= $obj[0]->user_phone ?>  
        </div>
        <div class="inputitem">
            <span class="user_detail_label"><?= $this->lang->line('label_place_of_birth'); ?>: </span>
    <?= $obj[0]->user_place_of_birth ?>  
        </div>
        <div class="inputitem">
            <span class="user_detail_label"><?= $this->lang->line('label_postcode'); ?>: </span>
    <?= $obj[0]->user_postcode ?>  
        </div>       
        <?php endif; ?>

    <?php
    if ( $this->userdata->is_admin() || $user_id == $this->userdata->get_user_id() ) {
        $this->load->library('grid');
        $grid = new Grid();
        $totalPays = $this->selecter->rows('payments', 'payment_id');
        $userNoPaidPayments = array();
        
        $limit = 0;
        foreach($this->selecter->get_payments_nopaid($totalPays, 0, $user_id, true)->result() as $payment)
        {
            if($payment->payment_type == 2)
                if( $limit < 5 )
                {
                    array_push($userNoPaidPayments, $payment);
                    $limit++;
                }
                else
                    break;
        }
        
        if ($grid->bind($userNoPaidPayments, 'payment_id')) {
            $grid->header('payment_id')->editable = false;
            $grid->header('payment_type')->editable = false;
            $grid->header('payment_paid_sum')->editable = false;
            $grid->header('user_id')->editable = false;
            $grid->header('user_name')->editable = false;
            $grid->header('payment_paid_time')->editable = false;

            $grid->header('payment_id')->visible = false;
            $grid->header('payment_type')->visible = false;
            $grid->header('payment_paid_sum')->visible = false;
            $grid->header('user_id')->visible = false;
            $grid->header('user_name')->visible = false;

            $grid->header('payment_vs')->text = $this->lang->line('label_vs');
            $grid->header('payment_total_sum')->text = $this->lang->line('label_total_sum');
            $grid->header('payment_paid_time')->text = $this->lang->line('label_pay_date');

            $grid->header('payment_paid_time')->set_datetime("Y-m-d H:i:s", "d.m.Y H:i");

            $grid->display();
        }

        if ($this->userdata->is_exempted($user_id)) {
            echo '<div class="inputitem"><p>' . $this->lang->line('pay_unlimited') . '</p></div>';
            echo '<p class="button_edit">' . anchor('payments/add', $this->lang->line('payments')) . '</p>';
        } else {
            $lp = $this->selecter->get_payments_lastpaid($user_id);
            $date = datetime($lp->payment_paid_time, FALSE);
            $dayAndMonth = day_month($date);
            $year = year($date) + 1;

            if (date("Y-m-d", time() - (365 * 86400)) <= $lp->payment_paid_time) 
            {
                if ($lp->payment_paid_sum <= 5 && $lp->payment_paid_sum <= $lp->payment_total_sum)
                    echo '<div class="inputitem"><strong>' . $this->lang->line('wtg_fee') . '</strong></div>';
                else
                    echo '<div class="inputitem">' . $this->lang->line('pay_limited_in') . ': <strong>' . $dayAndMonth . '.' . $year . '</strong></div>';

                if ($user_id == $this->userdata->get_user_id() && $lp->payment_paid_sum >= $lp->payment_total_sum)
                    echo '<p class="button_edit">' . anchor('payments/add', $this->lang->line('entry_free')) . '</p>';
            }
            else if (date("Y-m-d", time() - (365 * 86400)) > $lp->payment_paid_time) {
                echo '<div class="inputitem">' . $this->lang->line('pay_limited_out') . ': <strong>' . $dayAndMonth . '.' . $year . '</strong></div>';
                echo '<div class="inputitem">' . $this->lang->line('acc_enabled_until') . ': <strong>31.12.' . $year . '</strong></div>';
                if ($user_id == $this->userdata->get_user_id())
                    echo '<p class="button_edit">' . anchor('payments/add', $this->lang->line('entry_fee')) . '</p>';
            }
        }
    }
    ?>

    <?php if ($this->userdata->is_admin() || $user_id == $this->userdata->get_user_id()): ?>
        <p class="button_back">
        <?= anchor('users/edit/' . $obj[0]->user_id, $this->lang->line('edit_item')); ?> 
        </p>
    <?php endif; ?>

    <p class="button_back">
    <?= anchor('users/', $this->lang->line('to_users')); ?>
    </p>

</div>