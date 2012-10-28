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
        $data = array(
            'user_name'                 => $this->input->post('name'),
            'user_surname'              => $this->input->post('surname'),
            'user_password'             => $this->input->post('password'),
            'user_email'                => $this->input->post('email'),
            'user_phone'                => $this->input->post('phone'),
            'user_study_program_id'     => $this->input->post('study_program_id'),
            'user_degree_id'            => $this->input->post('degree_id'),
            'user_place_of_birth_id'    => $this->input->post('place_of_birth_id'),
            'user_postcode_id'          => $this->input->post('postcode_id'),
            'user_degree_year_id'       => $this->input->post('degree_year_id')
        );
        
        return $this->insert('musers', $data);
    }
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */