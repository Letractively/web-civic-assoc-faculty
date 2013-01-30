<script type="text/javascript" charset="UTF-8">
	var base_url = '<?=base_url()?>';

	function changeFilter(sender)
	{
		var id = sender.options[sender.selectedIndex].value;
		window.location = base_url+'projects/index/'+id;
	}
</script>

<div id="content_wrapper_medium">  
        <?php if( $this->userdata->is_admin() ): ?>
	<p class="project_label">
		<span class="link_text"> <?= anchor('project_categories', $this->lang->line('anchor_project_categories')); ?> </span>
	</p>
        <?php endif; ?> 

   <div class="inputitem">
        <!--<p class="label"> <?//= $error['project_id'] ?>"><?//= $this->lang->line('label_project_id') ?> </p>-->
		<?php
			$pr_cats = $this->selecter->get_project_categories();
			$pr_cats[] = array('project_category_id' => 0, 'project_category_name' => $this->lang->line('caption_all'));
		?>
		
        <span class="project_label"> Zobraziť: </span>
		<?= gen_dropdown('project_category', $category_id, $pr_cats,'project_category_id', 'project_category_name', 'dropdown', 'onchange="changeFilter(this);"'); ?>
		<br /> <br />
   </div>

	<?php
        //echo $category_id;
	//	array_debug($this->selecter->get_projects($category_id));
		
        $this->load->library('grid');

        $grid = new Grid();
        $this->load->helper('project_categories');
        
        if ($grid->bind(updateProjCatDetailData($this->selecter->get_projects($category_id)), 'project_id'))
		{
			$grid->header('project_id')->visible = false;
			$grid->header('project_item_id')->visible = false;
                        $grid->header('project_category_id')->visible = false;

			$grid->header('project_name')->text = $this->lang->line('label_name');
			$grid->header('project_date_from')->text = $this->lang->line('label_from');
			$grid->header('project_category_name')->text =  $this->lang->line('label_category_name');
                        $grid->header('project_active')->text =  $this->lang->line('label_state');
                        $grid->header('project_booked_cash')->text =  $this->lang->line('label_booked_cash');
                        $grid->header('project_date_to')->text =  $this->lang->line('label_to');
                        $grid->header('project_spended_cash')->text =  $this->lang->line('label_spended_cash');
                        
                        if( $this->userdata->is_admin() )
                        {
                            $grid->header('project_category_name')->set_anchor("project_categories/detail", 'project_category_id');
			}
                        $grid->header('project_name')->set_anchor("{$this->router->class}/detail", 'project_id');
			$grid->header('project_booked_cash')->set_numformat('{2:,: } €');
			$grid->header('project_date_from')->set_datetime('Y-m-d');
			$grid->header('project_date_to')->set_datetime('Y-m-d');
			$grid->header('project_spended_cash')->set_numformat('{2:,: } €');
                        $grid->header('project_id')->editable = false;
                                
                        if( $this->userdata->is_admin() )
                        {
                            $grid->add_url = "{$this->router->class}/add";
                            $grid->add_mode = "external";
                            $grid->edit_url = "{$this->router->class}/edit";
                            $grid->edit_mode = "external";
                            $grid->remove_url = "{$this->router->class}/delete";
                        }
			$grid->display();
		}
		echo '<br />';
             
               
                if( $this->userdata->is_admin() )
                {
                    echo '<p class="button_back">'; 
                        echo anchor('projects/add', 'Pridať nový projekt'); 
                    echo '</p>';
                }
    ?>
</div>
