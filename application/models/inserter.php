<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inserter extends MY_Model
{
    /*
     * insert_into_fin_redistributes
     * 
     * Funkcia zaeviduje poziadavku navstevnika ako maju byt prerozdelene jeho
     * peniaze
     * 
     * @access      private
     * @param       integer
     * @param       array
     * @return      boolean
     */
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
   
    public function add_degree($values)
    {
        array_debug($values);
        $this->db->query("INSERT INTO degrees
                          (degree_name, degree_grade)
                          VALUES ('".$values['degree_name']."','".$values['degree_grade']."')
                        "); 
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_email_log($email_typ_id, $user_ids)
    {
       foreach($user_ids as $user_id){
         $this->db->query("INSERT INTO user_email_evidence
                           (user_email_evidence_email_type_id, user_email_evidence_user_id, user_email_evidence_date)
                           VALUES ('".$email_typ_id."','".$user_id."', NOW())
                         ");
       }
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_email_type($values)
    {
        $this->db->query("INSERT INTO email_types
                           (email_type_name)
                           VALUES ('".$values['email_type_name']."')
                         ");
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_event($values)
    {
         $this->db->query("INSERT INTO events
                           (event_author_id, event_event_category_id, event_priority, event_name, event_from, event_to, event_about)
                           VALUES ('".$this->session->userdata('user')."','".$values['event_category_id']."','".$values['priority']."','".$values['name']."',
                                   '".  date( format_datetime($values['from']) )."', '".date( format_datetime($values['to']) )."','".$values['about']."')
                         ");
     if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_event_category($values)
    {
        $this->db->query("INSERT INTO event_categories
                           ( event_category_name)
                           VALUES ('".$values['event_category_name']."')
                         ");
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    /*public function add_lecturer_times($ex_event_id, $user_id, $values)
    {
      $this->db->query("INSERT INTO excursion_times
                           (excursion_time_excursion_event_id, excursion_lecturer_id, excursion_time_from, excursion_time_to)
                           VALUES ('".$ex_event_id."','".$user_id."','".$values['from']."','".$values['to']."')
                         ");
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }*/
    
    public function add_payments($values)
    {
        $this->db->query("INSERT INTO payments
                           ( payment_vs, payment_user_id, payment_total_sum, payment_paid_sum)
                           VALUES ('".$values['vs']."','".$values['user_id']."','".$values['total_sum']."','".$values['paid_sum']."')
                         ");
     if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_post( $values )
    {
        if( !isset($values['foo']) && $values['post_published'] == '1' )
            $checked = '1';
        else
            $checked = '0';
        $this->db->query("INSERT INTO posts
                           ( post_priority, post_title, post_author_id, post_content, post_published )
                           VALUES ( '".$values['priority']."', '".$values['title']."', 
                                    '".$this->session->userdata('user')."', '".$values['content']."', '".$checked."'
                                   )
                         ");
        if( $this->db->affected_rows() > 0 )
            return TRUE;
        else
            return FALSE;
    }
    
    public function add_project($values)
    {
      $this->db->query("INSERT INTO projects
                           ( project_name, project_about, project_priority, project_project_category_id, project_booked_cash, project_from, project_to)
                           VALUES ('".$values['name']."','".$values['about']."','".$values['priority']."','".$values['project_category_id']."','".$values['booked_cash']."','".$values['from']."','".$values['to']."')
                         ");
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_project_category($values)
    {
        $this->db->query("INSERT INTO project_categories
                           ( project_category_name, project_category_cash)
                           VALUES ('".$values['project_category_name']."','".$values['project_category_cash']."')
                         ");
       if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_project_item($pr_id, $values)
    {
       $this->db->query("INSERT INTO project_items
                           (project_item_project_id, project_item_name, project_item_price, project_item_user_id,project_item_date)
                           VALUES ('".$pr_id."','".$values['name']."','".$values['price']."','".$values['user_id']."','".date('Y-m-d')."')
                         ");
       if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_register($param)
    {
        $this->db->query("  INSERT INTO users 
                            (user_name, user_surname, user_role, user_username, user_password, user_email, user_phone, user_active,
                            user_study_program_id, user_degree_id, user_place_of_birth, user_postcode, user_degree_year)
                            VALUES
                            ('".$param['name']."', '".$param['surname']."', 2, '".$param['username']."',
                             '".sha1($param['password'])."', '".$param['email']."', '".$param['phone']."',
                             0, '".$param['study_program_id']."', '".$param['degree_id']."', 
                             '".$param['place_of_birth']."', '".$param['postcode']."', '".$param['degree_year']."')
                         ");
        
        $user_id = $this->db->insert_id();

        $this->db->query("  INSERT INTO payments
                            (payment_vs, payment_total_sum, payment_user_id)
                            VALUES
                            ('".$this->input->post('vs')."','".$this->input->post('total_sum')."', '".$user_id."')
                         ");
        
		$q = 'INSERT INTO fin_redistributes (fin_redistribute_user_id, fin_redistribute_project_category_id, fin_redistribute_ratio) VALUES ';
		$first = true;
		foreach ($param['categories'] as $cat_id => $ratio)
		{
			if (!$first) $q .= ', ';
			$q .= "('".$user_id."', '".$cat_id."', '".$ratio."')";
			$first = false;
		}
		$q .= ';';
		
		return $this->db->query($q);
    }
    
    public function add_study_program($values)
    {
        $this->db->query("INSERT INTO study_programs
                           (study_program_name)
                           VALUES ('".$values['study_program_name']."')
                         ");
     if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_transaction($values)
    {
        $this->db->query("INSERT INTO fin_category_transactions
                           ( fin_category_transaction_cat_from_id, fin_category_transaction_cat_to_id, 
                             fin_category_transaction_cash)
                           VALUES ('".$values['from']."','".$values['to']."','".$values['cash']."')
                         ");
     if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function add_user($values)
    {

    }
}   
    

/* End of file inserter.php */
/* Location: ./application/models/inserter.php */