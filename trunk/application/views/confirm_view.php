<?php
    $message = new Message();
    if( $type == 'inform')
    {
        $text = $m_text;
    }
    else 
    {
        $text = $this->lang->line('confirm_'.$type.'_question');
    }
    $message->generate_message( $type, $text, 
                                $method, $this->lang->line('confirm_'.$type.'_title'), 
                                $langs);
?>
