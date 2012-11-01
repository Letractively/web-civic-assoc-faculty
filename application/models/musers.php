<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MUsers extends MY_Model
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
       
    public function registration($param, $logger)
    {
        
        $this->db->query("  INSERT INTO users 
                            (user_name, user_surname, user_username, user_password, user_email, user_phone,
                            user_study_program_id, user_degree_id, user_place_of_birth_id, user_postcode, user_degree_year)
                            VALUES
                            ('".$param['name']."','".$param['surname']."','".$param['username']."',
                             '".sha1($param['password'])."','".$param['email']."','".$param['phone']."',
                             '".$param['study_program_id']."','".$param['degree_id']."','".$param['place_of_birth_id']."',
                             '".$param['postcode']."','".$param['degree_year']."')
                         ");
        $this->logger($logger);
        $q = $this->db->query("SELECT user_id FROM users");
        
        $row = $q->last_row();
        
        $this->db->query("  INSERT INTO payments
                            (payment_vs, payment_total_sum, payment_user_id)
                            VALUES
                            ('".$this->input->post('vs')."','".$this->input->post('total_sum')."', '".$row->user_id."')
                         ");
        
        $p_categories_ratios = array();
        
        for($i = 1; $i <=6; $i++)
        {
            if( $this->input->post('project_category_'.$i) != '' )
                $p_categories_ratios[$i] = $this->input->post('project_category_'.$i);
            else
                $p_categories_ratios[$i] = 0;
        }
        
        return $this->insert_into_fin_redistributes($row->user_id, $p_categories_ratios);
    }
    
    private function insert_into_fin_redistributes($user_id, $array)
    {
        foreach($array as $key => $value)
        {
            $this->db->query("  INSERT INTO fin_redistributes
                                (fin_redistribute_user_id, fin_redistribute_project_category_id, fin_redistribute_ratio)
                                VALUES
                                ('".$user_id."','".$key."','".$value."')
                             ");
        }
        
        return TRUE;
    }
}

/* End of file musers.php */
/* Location: ./application/models/musers.php */