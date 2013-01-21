<?php
    $obj = $this->selecter->get_user_detail($user_id);
    array_debug($obj);
?>
<div id="content_wrapper">
<?php
    if( $this->userdata->is_admin() )
    {
        echo '<p class="project_label">';
            echo $this->lang->line('label_state').': ';
            echo '<span class="user_rank">';
                switch($obj[0]->user_role)
                {
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
        <?= $obj[0]->user_name.' '.$obj[0]->user_surname; ?>
    </div>
    
    <?php if( $obj[0]->user_study_program_id != '' ): ?>
        <div class="inputitem">
            <span class="user_detail_label">
                <?= $this->lang->line('label_study_program_id').': '; ?>
            </span>
            <?= $obj[0]->study_program_name; ?>
        </div>
    <?php endif; ?>
    
    <?php if( $this->userdata->is_admin() ): ?>
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
    <?php endif; ?>
</div>