<script type="text/javascript" charset="UTF-8">
	var base_url = '<?=base_url()?>';

	function changeFilter(sender)
	{
		var user_filter = document.getElementById('user_filter');
		var url = user_filter.options[user_filter.selectedIndex].value;
		window.location = base_url+url;
	}
</script>

<?php
    $this->load->library('grid');
    $grid = new Grid();
    $role = $flag;
?>
 
<div id="grid_wrapper"> 
    <?php
        $user_filters = array();
	if( $this->userdata->is_admin() )
            $user_filters = array(
                array('id' => 'users', 'value' => $this->lang->line('all')),
                array('id' => 'users/admins', 'value' => $this->lang->line('admin')),
                array('id' => 'users/members', 'value' => $this->lang->line('oz_member')),
                array('id' => 'users/potentials', 'value' => $this->lang->line('po_member')),
                array('id' => 'users/innactive', 'value' => $this->lang->line('me_inactive')),
                array('id' => 'users/blocked', 'value' => $this->lang->line('blocked_member'))
            );  
        else
            $user_filters = array(
                array('id' => 'users/members', 'value' => $this->lang->line('oz_member')),
                array('id' => 'users/admins', 'value' => $this->lang->line('admin'))               
            );  
     ?>
        <div class="inputitem">
            <span class="grid_label"> Zobraziť: </span>
            <?php if($flag == 2 && !$this->userdata->is_admin())
                    $flag = 0;
                  echo gen_dropdown('user_filter', $user_filters[$flag]['id'], $user_filters, 'id', 'value', 'dropdown','id="user_filter" onchange="changeFilter(this);"');
            ?>
        </div> <br />
     <?php   
        if( $grid->bind($this->selecter->get_users( $c_pagination['per_page'], $c_pagination['cur_page'], $role, true ), 'user_id') )
	{
            if( $this->userdata->is_admin() )
            {
                $grid->header('user_id')->visible = false;
                
                $grid->header('user_email')->text = $this->lang->line('label_email');
		$grid->header('user_phone')->text = $this->lang->line('label_phone');
		$grid->header('user_degree_year')->text = $this->lang->line('label_degree_year');
		$grid->header('degree_name')->text = $this->lang->line('label_degree_id');
            }
            else
            {
                $grid->all_cols_visible(false);
                
                $grid->header('user_name')->visible = true;
                $grid->header('study_program_name')->visible = true;
                $grid->header('user_degree_year')->visible = true;
            }
            $grid->header('user_name')->set_anchor('users/detail', 'user_id');
            
            $grid->header('user_name')->text = $this->lang->line('label_name');
            $grid->header('study_program_name')->text = $this->lang->line('label_study_program_id');
            $grid->header('user_degree_year')->text = $this->lang->line('label_degree_year');
			$grid->header('user_postcode')->text = $this->lang->line('label_postcode');
            
            if( $this->userdata->is_admin() )
            {	
                $grid->add_url = "users/add";
                $grid->edit_url = "users/edit";
                $grid->remove_url = "users/delete";
                $grid->add_mode = "external";
                $grid->edit_mode = "external";
            }
            
        }
        $grid->display();
        echo pagination($pagination);			
	?>
</div>