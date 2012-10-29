<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUsers extends CI_Model
{
    
    public function check_login( $email )
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
        $q = $this->db->query("SELECT user_id FROM users");
        
        $row = $q->last_row();
        
        $this->db->query("  INSERT INTO payments
                            (payment_vs, payment_total_sum, payment_user_id)
                            VALUES
                            ('".$this->input->post('vs')."','".$this->input->post('total_sum')."', '".$row->user_id."')
                         ");
        
        /*$p_categories_ratios = array();
        
        for($i = 5; $i <=1; $i++)
        {
            if( $this->input->post('project_category_'.$i) != '' )
            {
                array_push($p_categories_ratios, $this->input->post('project_category_'.$i));
            }
        }*/
        
        //$this->insert_into_fin_redistributes($q->user_id, $p_categories_ratios);
        /*$this->db->query("  INSERT INTO fin_redistributes
                            (fin_redistribute_user_id, fin_redistribute_project_category_id, fin_redistribute_ratio)
                            VALUES
                            ('".$q->user_id."','".."','".$this->input->post('')."')
                         ");*/   
        
        return $q->last_row();
    }
    
    private function insert_into_fin_redistributes($user_id, $array)
    {
        echo 'bic';
    }
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */