<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message
{
        public $type    = '';
        public $image   = '';
        public $buttons = 0;
        public $class   = '';
        public $langs   = array();

        public function __construct()
        {
	}
        
        private function load_lang($lang_array)
        {
            foreach($lang_array as $lang)
            {
                array_push($this->langs, $lang);
            }
        }
        
        private function generate_buttons( $type )
        {
            switch ( $type ) {
                case 'delete':
                    $this->buttons = 2;
                    $this->type = 'delete';
                    for($i = 0; $i < $this->buttons; $i++)
                    {
                        echo '<input type="submit" name="submit_action" value="'.$this->langs[$i].'">';
                    }
                    break;
                 case 'inform':
                    $this->buttons = 1;
                    $this->type = 'inform';
                    echo '<a href="'.base_url().$this->class.'">'.$this->langs[0].'</a>';
                    break;   
            }
        }
        
        private function set_title( $title )
        {
            echo $title;
        }
        
        private function set_image( $type )
        {
            switch ($type) {
                case 'delete':
                    echo '<img src="'.base_url().'/assets/img/confirm_delete.png" id="confirm_image" />';
                    break;
                case 'inform':
                    echo '<img src="'.base_url().'/assets/img/confirm_inform.png" id="confirm_image" />';
                    break;
            }
        }
        
        private function set_class( $suffix )
        {
            $result = explode('/', $suffix);
            $this->class = $result[0];
        }
        
        private function set_text( $text )
        {
            echo '<p>'.$text.'</p>';
        }
        
        public function generate_message( $type, $text, $suffix, $title, $langs )
        {
            $this->set_class($suffix);
            echo '<div id="confirm_message">';
            $this->load_lang($langs);
            
                $this->set_title($title);
                $this->set_image($type);
                $this->set_text($text);
                echo '<form accept-charset="utf-8" method="post" action="'.base_url().$suffix.'">';
                    $this->generate_buttons($type);
                echo '</form>';
            echo '</div>';
        }
}