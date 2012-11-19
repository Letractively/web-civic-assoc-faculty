<?php
    $message = new Message();
    $message->generate_message( $type, $this->lang->line('confirm_'.$type.'_question'), 
                                $method, $this->lang->line('confirm_'.$type.'_title'), 
                                $langs);
?>
