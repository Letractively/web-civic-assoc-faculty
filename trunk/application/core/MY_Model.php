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
 *  Model class
 *
 * @package		AlumniFMFI
 * @subpackage          Core
 * @category            Model
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------

class MY_Model extends CI_Model
{
        /**
         * Constructor
         */
        public function __construct()
        {
            parent::__construct();
        }
        
        /**
         * EventRowsInCategory
         * 
         * Funkcia vrati pocet eventov v kategorii alebo celkovy pocet eventov
         * 
         * @access      public
         * @param       string $table tabulka event_categories
         * @param       string $id stlpec nad ktorym vykonavam sucet
         * @param       integer $event_cat id-kategorie v ktorej chcem zistit pocet eventov
         * @return      integer Pocet udalosti v kategorii
         */
        public function EventRowsInCategory($table, $id, $event_cat)
        {
            if ($event_cat == 0)
                return $this->rows($table, $id);
            else
            {
                $q = $this->db->query(" SELECT $id
                                        FROM $table
                                        WHERE event_event_category_id = $event_cat
                                      ");
                return $q->num_rows();
            }
        }

        /**
         * exists
         * 
         * Funkcia kontroluje na zaklade vstupnych udajov ci sa dany zaznam nachadza
         * v databaze ak ano vrati TRUE.
         * 
         * @access      public
         * @param       string $table tabulka v ktorej sa kontroluje existencia
         * @param       string $column stlpec nad ktorym sa kontrulje existencia
         * @param       string $id ID-cko zaznamu ktoreho existenciu chcem zistit
         * @return      boolean Existencia daneho zaznamu
         */
        public function exists($table, $column, $id)
        {
            $q = $this->db->query("  SELECT $column
                                     FROM $table
                                WHERE $column = $id
                                ");
            if ($q->num_rows() > 0)
                return TRUE;
            else
                return FALSE;
        }
        
        /**
         * id
         * 
         * Funkcia zisti vsetky udaje o danom zaznamu na zaklade vstupnych
         * parametrov
         * 
         * @access      public
         * @param       string $id ciselna hodnota zaznamu
         * @param       string $table tabulka z ktorej zistujem udaje
         * @param       string $column stlpec nad ktorym zistujem hodnotu
         * @return      object
         */
        public function id($id, $table, $column)
        {
            $q = $this->db->query(" SELECT * 
                                    FROM $table
                                    WHERE $column = $id
                                  ");
            return $q->row();
        }
        
        /**
         * is_activated
         * 
         * Funkcia zisti ci pouzivatel ma aktivny ucet alebo nie
         * 
         * @access      public
         * @param       array Array vstupnych udajov [username] a [password]
         * @return      boolean Aktivacia usera
         */
        public function is_activated( $param )
        {
            $actualYear = Date("Y");
            $answer = FALSE;
            $q = $this->db->query(" SELECT user_activated, user_exempted
                                    FROM users
                                    WHERE user_username = '".$param['username']."' AND
                                          user_password = '".sha1($param['password'])."'
                                  ");
            $exempted = $q->row()->user_exempted;
            $dateArray = explode('-', $q->row()->user_activated);
            
            $userYear = $dateArray[0]+2;
            
            if($actualYear < $userYear || $exempted == 1 )
                $answer = TRUE;
            else
                $answer = FALSE;
            return $answer;
        }
        
        /**
         * logger
         * 
         * Funkcia vykonava logovanie udalosti, ktore sa stali s databazou do jednej
         * samostatnej tabulky v databaze
         * 
         * @access      public
         * @param       array $params Pole údajov ktore sa vlozia do tabulky databse_logs
         * @return      void
         */
        protected function logger($params)
        {
            if(in_array('user_id', $params))
                $this->db->query("  INSERT INTO database_logs
                                    (database_log_user_id, database_log_event)
                                    VALUES
                                    ('".$params['user_id']."','".$params['event']."')
                                ");
            else
                $this->db->query("  INSERT INTO database_logs
                                    (database_log_event)
                                    VALUES
                                    ('".$params['event']."')
                                ");
        }
        
        /**
         * UsersInDatabase
         * 
         * Funkcia vrati pocet userov danej pouzivatelskej roli
         * 
         * @access      public
         * @param       string $table Vstupnym udajom je users
         * @param       string $id lubovolny stlpec z tabulky users nad ktorym sa vykona sucet riadkov
         * @param       integer $role ciselna hodnota pouzivatelskej roli ktorej pocet userov chcem vratit
         * @return      integer Pocet userov v databaze
         */
        public function UsersInDatabase( $table, $id, $role )
        {
            
            if ( $role == 0 )
                return $this->rows($table, $id);
            else if($role == ROLE_INACTIVE)
            {
                $q = $this->db->query(" SELECT $id
                                        FROM $table
                                        WHERE user_activated = '0000-00-00 00:00:00' AND user_exempted = 0
                                      ");
            }
            else if($role == ROLE_BLOCKED)
            {
                $actualDateTime = date("Y-m-d  H:i:s");
                $q = $this->db->query(" SELECT $id
                                        FROM $table
                                        WHERE user_activated >= '".$actualDateTime."' AND user_exempted = 0 AND user_activated != '0000-00-00 00:00:00' 
                                      ");   
            }
            else
                $q = $this->db->query(" SELECT $id
                                        FROM $table
                                        WHERE user_role = $role
                                      ");     
            return $q->num_rows();
        }
        
        /**
         * returnDate
         * 
         * Funkcia vrati casovy udaj na zaklade flagu ktory konkretne sa ma vratit
         * 
         * @access      public
         * @param       intege $flag flag na zaklade ktoreho sa vrati urcity casovy udaj spatneho charakteru
         * @return      date Datum na zaklade vstupneho flagu
         */
        public function returnDate( $flag )
        {
            $date = '';
            switch ($flag) 
            {
                case 1:
                    $date = date("Y-m-d  H:i:s", strtotime("-1 week", strtotime(date("Y-m-d  H:i:s"))));
                    break;
                case 2:
                    $date = date("Y-m-d  H:i:s", strtotime("-1 month", strtotime(date("Y-m-d  H:i:s"))));
                    break;
                case 3:
                    $date = date("Y-m-d  H:i:s", strtotime("-3 month", strtotime(date("Y-m-d  H:i:s"))));
                    break;
                case 4:
                    $date = date("Y-m-d  H:i:s", strtotime("-6 month", strtotime(date("Y-m-d  H:i:s"))));
                    break;
                case 5:
                    $date = date("Y-m-d  H:i:s", strtotime("-1 year", strtotime(date("Y-m-d  H:i:s"))));
                    break;
            }
            return $date;
        }
        
        /**
         * rows
         * 
         * Funkcia vrati pocet zaznamov v tabulke xyz
         * 
         * @access      public
         * @param       string $table Nazov tabulky
         * @param       string $id nazov stlpca nad ktorym sa ma vykonat sucet riadkov v tabulke
         * @return      integer pocet zaznamov v DB
         */
        public function rows( $table, $id )
        {
            $q = $this->db->query(" SELECT $id
                                    FROM $table
                                  ");
            return $q->num_rows();
        }
        
        /**
         * project_state
         * 
         * Funkcia vrati stav v akom sa nachadza projekt
         * 
         * @access      public
         * @param       integer $project_id ID projektu
         * @return      integer Stadium v akom sa nachadza projekt
         */
        public function project_state( $project_id )
        {
            $q = $this->db->query(" SELECT project_active
                                    FROM projects
                                    WHERE project_id = $project_id
                                  ");

            return $q->row()->project_active;
        }
}