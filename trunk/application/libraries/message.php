<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message
{
        public $type    = '';
        public $image   = '';
        public $buttons = 0;
        public $class   = '';
        public $langs   = array();

        /*
         * __construct
         * 
         * Konštruktor triedy
         * 
         */
        public function __construct(){}
        
        /*
         * load_lang
         * 
         * Metoda nacita jazykove popisky pre tlacidla
         * 
         * @param lang_array Vstupom je pole jazykovych popiskov, pole obsahuje jeden alebo dva lang popisky
         * 
         */
        private function load_lang($lang_array)
        {
            foreach($lang_array as $lang)
            {
                array_push($this->langs, $lang);
            }
        }
        
        /*
         * generate_buttons
         * 
         * Metoda vygeneruje ovladacie buttony do message
         * 
         * @param type Typ spravy, na jeho zaklade sa vygeneruju vhodne buttony
         * 
         */
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
        
        /*
         * set_title
         * 
         * Funkcia nastavi titulok pre správu
         * 
         * @param title Titulok ktory sa ma zobrazit
         * 
         */
        private function set_title( $title )
        {
            echo $title;
        }
        
        /*
         * set_image
         * 
         * Funkcia nastavi piktogrami do spravy
         * 
         * @param type Typ o aku spravu sa jedna
         * 
         */
        private function set_image( $type )
        {
            switch ($type) {
                case 'delete':
                    echo '<img src="'.base_url().'assets/img/confirm_delete.png" id="confirm_image" />';
                    break;
                case 'inform':
                    echo '<img src="'.base_url().'assets/img/confirm_inform.png" id="confirm_image" />';
                    break;
            }
        }
        
        /*
         * set_class
         * 
         * Funkcia nastavi meno triedy odkial bola volana
         * 
         * @param suffix url fragment
         * 
         */
        private function set_class( $suffix )
        {
            $result = explode('/', $suffix);
            $this->class = $result[0];
        }
        
        /*
         * set_text
         * 
         * Funkcia nastavi text, ktory sa ma zobrazit v tele spravy
         * 
         * @param text Text ktory sa ma vypisat
         * 
         */
        private function set_text( $text )
        {
            echo '<p>'.$text.'</p>';
        }
        
        /*
         * generate_message
         * 
         * Metoda vygeneruje spravu
         * 
         * @param type Typ spravy
         * @param text Text, ktory sa ma vypisat
         * @param suffix Url fragment
         * @param title Titulok spravy
         * @param langs Jazykove popisky pre buttony
         * 
         */
        public function generate_message( $type, $text, $suffix, $title, $langs )
        {
            $this->set_class($suffix);
            echo '<div id="confirm_message">';
            $this->load_lang($langs);
            
                $this->set_title($title);
                $this->set_image($type);
                $this->set_text($text);
                if( $type == 'inform')
                {
                    $this->generate_buttons($type);
                }
                else
                {
                    echo '<form accept-charset="utf-8" method="post" action="'.base_url().$suffix.'">';
                        $this->generate_buttons($type);
                    echo '</form>';
                }
            echo '</div>';
        }
}