<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
    public function __construct()
    {
	parent::__construct();
    }
    
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
}