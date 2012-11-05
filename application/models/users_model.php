<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
    /*
     * check_unique_email
     * 
     * Funkcia strontroluje ci sa uz dany email nenachadza v databaze
     * 
     * @access      public
     * @param       string
     * @return      boolean
     */
    public function check_unique_email( $email )
    {
        $q = $this->db->query(" SELECT user_email 
                                FROM users 
                                WHERE user_email='".$email."'
                              ");
        
        if( $q->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
    }
       
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */