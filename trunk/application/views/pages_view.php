<div id="content_wrapper_large">
    <?php 
        $pageContent = $this->selecter->get_page($page);
        //array_debug($pageContent);
        $row = 'page_'.$page;
        echo parse_bbcode($pageContent->$row);
		echo '<br /> <br />';
        
        if( $this->userdata->is_admin() )
        {
            echo '<p class="button_back">'; 
                echo anchor('pages/edit/'.$page, $this->lang->line('edit_page')); 
            echo '</p>';
        }
    ?>
</div>