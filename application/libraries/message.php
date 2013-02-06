<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Alumni FMFI
 * 
 * Aplikacia na spravu OZ Alumni FMFI
 *
 * @package		AlumniFMFI
 * @author		Tutifruty Team
 * @link		http://kempelen.ii.fmph.uniba.sk
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 *  Message class
 *
 * @package		AlumniFMFI
 * @subpackage          Libraries
 * @category            Message
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------


class Message
{
        public $type    = '';
        public $image   = '';
        public $buttons = 0;
        public $class   = '';
        public $langs   = array();

        /**
         * Constructor
         */
        public function __construct(){}
        
        /**
         * load_lang
         * 
         * Metoda nacita jazykove popisky pre tlacidla
         * 
         * @access	private
         * @param       array $lang_array Vstupom je pole jazykovych popiskov, pole obsahuje jeden alebo dva lang popisky
         * @return      void
         */
        private function load_lang($lang_array)
        {
            foreach($lang_array as $lang)
            {
                array_push($this->langs, $lang);
            }
        }
        
        /**
         * generate_buttons
         * 
         * Metoda vygeneruje ovladacie buttony do message
         * 
         * @access	private
         * @param       string $type Typ spravy, na jeho zaklade sa vygeneruju vhodne buttony
         * @return      void
         */
        private function generate_buttons( $type )
        {
            switch ( $type ) {
                case 'delete':
                    $this->buttons = 2;
                    $this->type = 'delete';
                    for($i = 0; $i < $this->buttons; $i++)
                    {
                        echo '<input class="yes_no_buttons" type="submit" name="submit_action" value="'.$this->langs[$i].'">';
                    }
                    break;
                 case 'inform':
                    $this->buttons = 1;
                    $this->type = 'inform';
                    echo '<a href="'.base_url().$this->class.'">'.$this->langs[0].'</a>';
                    break;   
            }
        }
        
        /**
         * set_title
         * 
         * Funkcia nastavi titulok pre správu
         * 
         * @access	private
         * @param       string $title Titulok ktory sa ma zobrazit
         * @return      void
         */
        private function set_title( $title )
        {
            echo $title;
        }
        
        /**
         * set_image
         * 
         * Funkcia nastavi piktogrami do spravy
         * 
         * @access	private
         * @param       string $type Typ o aku spravu sa jedna
         * @return      void
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
        
        /**
         * set_class
         * 
         * Funkcia nastavi meno triedy odkial bola volana
         * 
         * @access	private
         * @param       string $suffix url fragment
         * @return      void
         */
        private function set_class( $suffix )
        {
            $result = explode('/', $suffix);
            $this->class = $result[0];
        }
        
        /**
         * set_text
         * 
         * Funkcia nastavi text, ktory sa ma zobrazit v tele spravy
         * 
         * @access	private
         * @param       string $text Text ktory sa ma vypisat
         * @return      void
         */
        private function set_text( $text )
        {
            echo '<p class="set_text">'.$text.'</p>';
        }
        
        /**
         * generate_message
         * 
         * Metoda vygeneruje spravu
         * 
         * @access	public
         * @param       string $type Typ spravy
         * @param       string $text Text, ktory sa ma vypisat
         * @param       string $suffix Url fragment
         * @param       string $title Titulok spravy
         * @param       array $langs Jazykove popisky pre buttony
         * @return      object Objekt typu sprava
         */
        public function generate_message( $type, $text, $suffix, $title, $langs )
        {
            $this->set_class($suffix);
			echo '<br /> <div id=content_wrapper_small>';
				echo '<div id="confirm_message">';
				$this->load_lang($langs);
				
					echo '<p class="set_image">'; $this->set_image($type); echo '</p>';
					echo '<p class="set_title">'; $this->set_title($title); echo '</p>';
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
			echo '</div>';
        }
}