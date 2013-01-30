<?php $obj = $this->selecter->get_category_detail($project_category_id); array_debug($obj);?>

<div id="grid_wrapper">
    <span class="project_category_label"> <?= $this->lang->line('pr_cat_label') . ': <span class="project_name">' . $obj->project_category_name . '</span>'; ?>  </span> 

    <div class="project_category_cash">
        <p> 
            <span class="project_category_label"> <?= $this->lang->line('pr_cat_stats'); ?> <br /> </span>
            <span class="project_category_labels"> <?= $this->lang->line('pr_cat_cur_state'); ?>
                : <strong> <?php
if ($obj->project_category_cash == '')
    echo '0';
else
    echo $obj->project_category_cash;
?> €</strong><br /> 
            </span>
            <span class="project_category_labels"> <?= $this->lang->line('pr_cat_move_from'); ?>
                : <span class="cash_from"> <?php
if ($obj->transaction_cash_from == '')
    echo '0';
else
    echo $obj->transaction_cash_from;
?> €</span> <br />
            </span>
            <span class="project_category_labels"> <?= $this->lang->line('pr_cat_move_to'); ?>
                : <span class="cash_to"> <?php
                    if ($obj->transaction_cash_to == '')
                        echo '0';
                    else
                        echo $obj->transaction_cash_to;
?> €</span> 
            </span>
        </p>
    </div>

    <div class="project_category_labels">
        <span class="project_category_label"> Transakcie </span>
    </div>

    <div class="errors">
    <?php
    echo validation_errors();
    ?>
    </div>

<?= form_open("project_categories/add_transaction") ?>
    <div class="inputitem">
        <label for="from"><?= $this->lang->line('label_from') ?>:</label>
        <b> <?= $obj->project_category_name; ?> </b>
<?= form_hidden('from', $project_category_id); ?>
    </div>
    <div class="inputitem">
        <label for="to" ><?= $this->lang->line('label_to') ?>:</label>
<?= gen_dropdown('to', set_value('project_category_id'), $this->selecter->get_project_categories(), 'project_category_id', 'project_category_name', 'dropdown'); ?>     
    </div>
    <div class="inputitem">
        <label for="cash" ><?= $this->lang->line('label_cash') ?>:</label>
    <?= form_input(array('name' => 'cash', 'id' => 'cash', 'class' => 'input_data'), set_value('cash')) ?>€
    </div>   

    <div class="inputitem">
    <?= form_hidden('pr_cat', $project_category_id); ?>
    <?= form_submit(array('type' => 'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('btn_add_trans')) ?>
    </div>
    <?= form_close() ?>

    <?php
    $this->load->library('grid');

    $grid = new Grid();

    //array_debug($this->selecter->get_transactions($project_category_id));

    if ($grid->bind($this->selecter->get_transactions($project_category_id), 'fin_category_transaction_id')) {
        $grid->header('project_category_id')->editable = false;
        $grid->header('fin_category_transaction_id')->editable = false;

        $grid->header('project_category_id')->visible = false;
        $grid->header('fin_category_transaction_id')->visible = false;
        $grid->header('fin_category_transaction_cat_to_id')->visible = false;
        $grid->header('fin_category_transaction_cat_from_id')->visible = false;

        $grid->header('fin_category_transaction_from')->text = $this->lang->line('label_from');
        $grid->header('fin_category_transaction_to')->text = $this->lang->line('label_to');
        $grid->header('category_transaction_cash')->text = $this->lang->line('label_cash');

        $grid->header('category_transaction_cash')->set_numformat('{2:,: } €');

        $grid->header('fin_category_transaction_from')->set_anchor('project_categories/detail', 'fin_category_transaction_cat_from_id');
        $grid->header('fin_category_transaction_to')->set_anchor('project_categories/detail', 'fin_category_transaction_cat_to_id');

        $grid->display();
    }
    echo '<br />';

    $grid1 = new Grid();

    //array_debug($this->selecter->get_projects($project_category_id));
        $this->load->helper('project_categories');
        $project_categories = $this->selecter->get_projects($project_category_id, true);
        $inputData = updateProjectDetailData($project_categories);
        
        if ($grid1->bind($inputData, 'project_id')) 
        {
        $grid1->header('project_id')->editable = false;

        $grid1->header('project_id')->visible = false;
        $grid1->header('project_item_id')->visible = false;
        $grid1->header('project_category_id')->visible = false;
        $grid1->header('project_category_name')->visible = false;

        $grid1->header('project_name')->text = $this->lang->line('label_name');
        $grid1->header('project_booked_cash')->text = $this->lang->line('label_capital');
        $grid1->header('project_spended_cash')->text = $this->lang->line('label_spend');
        $grid1->header('project_date_from')->text = $this->lang->line('label_date_from');
        $grid1->header('project_date_to')->text = $this->lang->line('label_date_to');

        $grid1->header('project_booked_cash')->set_numformat('{2:,: } €');
        $grid1->header('project_spended_cash')->set_numformat('{2:,: } €');

        $grid1->header('project_date_from')->set_datetime('Y-m-d');
        $grid1->header('project_date_to')->set_datetime('Y-m-d');

        $grid1->header('project_name')->set_anchor('projects/detail', 'project_id');

        $grid1->header('project_active')->text = $this->lang->line('label_state');


        $grid1->add_url = "projects/add";
        $grid1->add_mode = "external";
        $grid1->edit_url = "projects/edit";
        $grid1->edit_mode = "external";
        $grid1->remove_url = "projects/delete";
    }
    $grid1->display();
    ?>
    <div class="inputitem">
        <p class="button_delete"> <?= anchor("projects_categories/delete/$project_category_id", 'Zmazať') ?> </p>
        <p class="button_back"> <?= anchor('projects', $this->lang->line('anchor_back')); ?> </p>
    </div>
</div>