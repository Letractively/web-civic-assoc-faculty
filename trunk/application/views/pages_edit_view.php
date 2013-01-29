<div id="content_wrapper_large">
    <div class="errors">
        <?php 
            echo validation_errors();  
            $field = $this->selecter->id('page_'.$page, 'pages', 'page_'.$page);
        ?>
    </div>
    
    <?php
        echo '<div>';
            foreach($buttons as $i)
            {
                echo $i;
            }
        echo '</div>';
        $row = 'page_'.$page;
        js_insert_bbcode('pages/edit', 'textarea');
        echo form_open('pages/edit/'.$page);
            echo form_textarea(array('name' => 'page_text', 'id' => 'textarea', 'class' => 'textarea_data2'.$error['page_text']), set_value('page_text', $field->$row));
			echo '<br /> <br />';
            echo form_submit(array('type'=>'submit', 'name' => 'submit', 'class' => 'button_submit'), $this->lang->line('edit_page'));
        echo form_close();
    ?>
</div>