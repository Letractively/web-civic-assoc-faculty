<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
        /*
         * Constructor
         * 
         * @access      private
         * @return      void
         */
        public function __construct()
        {
            parent::__construct();
        }

        /*
         * logger
         * 
         * Funkcia vykonava logovanie udalosti, ktore sa stali s databazou do jednej
         * samostatnej tabulky v databaze
         * 
         * @access      public
         * @param       array
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
            return TRUE;
        }
        
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
        
        public function is_activated( $param )
        {
            $answer = FALSE;
            $q = $this->db->query(" SELECT user_id
                                    FROM users
                                    WHERE user_username = '".$param['username']."' AND
                                          user_password = '".sha1($param['password'])."' AND
                                          user_active   = 0
                                  ");   
            if($q->num_rows > 0)
                $answer = FALSE;
            else
                $answer = TRUE;
            return $answer;
        }
        
        public function rows( $table, $id )
        {
            $q = $this->db->query(" SELECT $id
                                    FROM $table
                                  ");
            return $q->num_rows();
        }
}