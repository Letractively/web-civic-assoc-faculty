<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUsers extends CI_Model
{
    
    public function check_login( $email )
    {
        $q = $this->db->query(" SELECT user_email 
                                FROM musers 
                                WHERE user_email='".$email."'
                              ");
        
        if( $q->num_rows() > 0)
            return FALSE;
        else
            return TRUE;
    }
       
    public function registration()
    {
        $this->db->query("  INSERT INTO users 
                            (user_name, user_surname, user_username, user_password, user_email, user_phone,
                            user_study_program_id, user_degree_id, user_place_of_birth_id, user_postcode, user_degree_year)
                            VALUES
                            ('".$this->input->post('name')."','".$this->input->post('surname')."','".$this->input->post('username')."',
                             '".sha1($this->input->post('password'))."','".$this->input->post('email')."','".$this->input->post('phone')."',
                             '".$this->input->post('study_program_id')."','".$this->input->post('degree_id')."','".$this->input->post('place_of_birth_id')."',
                             '".$this->input->post('postcode')."','".$this->input->post('degree_year')."')
                         ");
        
        return TRUE;
    }
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */