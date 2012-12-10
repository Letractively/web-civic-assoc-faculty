<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deleter extends MY_Model
{
    public function remove_degree($degree_id)
    {   
        $this->db->query("DELETE FROM degrees WHERE degree_id=$degree_id");
        
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE users 
                            SET user_degree_id=NULL 
                            WHERE user_degree_id=$degree_id");
            return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_email_type($e_type_id)
    {
        $this->db->query("DELETE FROM email_types WHERE email_type_id=$e_type_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE user_email_evidence SET user_email_evidence_email_type_id=NULL WHERE user_email_evidence_email_type_id=$e_type_id");
            return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_event($ev_id)
    {
        $this->db->query("DELETE FROM events WHERE event_id=$ev_id");
        if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_event_category($ev_cat_id)
    {
        $this->db->query("DELETE FROM event_categories WHERE event_category_id=$ev_cat_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE events 
                            SET event_event_category_id=NULL 
                            WHERE event_event_category_id=$ev_cat_id");
            return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_excursion($ex_id)
    {
        $this->db->query("DELETE FROM excursions WHERE excursion_id=$ex_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE excursion_events 
                            SET excursion_event_excursion_id=NULL 
                            WHERE excursion_event_excursion_id=$ex_id");
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_excursion_event($ex_ev_id)
    {
        $this->db->query("DELETE FROM excursion_events WHERE excursion_event_id=$ex_ev_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE excursion_times
                            SET excursion_time_excursion_event_id=NULL 
                            WHERE excursion_time_excursion_event_id=$ex_ev_id");
          $this->db->query("UPDATE booked_excursions
                            SET booked_excursion_excursion_event_id=NULL 
                            WHERE booked_excursion_excursion_event_id=$ex_ev_id");
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_excursion_event_book($ex_ev_book_id)
    {
        $this->db->query("DELETE FROM booked_excursions WHERE booked_excursion_id=$ex_ev_book_id");
        if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_excursion_event_lecturer($ex_ev_id, $user_id)
    {
        $this->db->query("DELETE FROM  WHERE ");
        if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_excursion_event_visitor($ex_ev_vi_id)
    {
        $this->db->query("DELETE FROM  WHERE ");
        if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_lecturer_time($lec_time_id)
    {
        $this->db->query("DELETE FROM excursion_times WHERE excursion_time_lecturer_id=$lec_time_id");
        if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_payments($payment_id)
    {
        $this->db->query("DELETE FROM payments WHERE payment_id=$payment_id");
       if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_post($post_id)
    {
        $this->db->query("DELETE FROM posts WHERE post_id=$post_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE post_modifies
                            SET post_modifie_post_id=NULL 
                            WHERE post_modifie_post_id=$post_id");  
          return TRUE;
        }
        else{ return FALSE; }
    }
    
    public function remove_project($pr_id)
    {
        $this->db->query("DELETE FROM projects WHERE project_id=$pr_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE project_items
                            SET project_item_project_id=NULL 
                            WHERE project_item_project_id=$pr_id"); 
          return TRUE;
        }
        else{ return FALSE; }
    }
    
     public function remove_project_category($pr_cat_id)
    {
        $this->db->query("DELETE FROM project_categories WHERE project_category_id=$pr_cat_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE projects
                            SET project_project_category_id=NULL 
                            WHERE project_project_category_id=$pr_cat_id");
          $this->db->query("UPDATE history_paids
                            SET history_paids_project_category_id=NULL 
                            WHERE history_paids_project_category_id=$pr_cat_id");
          $this->db->query("UPDATE fin_category_transactions
                            SET fin_category_transaction_cat_from_id=NULL 
                            WHERE fin_category_transaction_cat_from_id=$pr_cat_id");
          $this->db->query("UPDATE fin_category_transactions
                            SET fin_category_transaction_cat_to_id=NULL 
                            WHERE fin_category_transaction_cat_to_id=$pr_cat_id");
          $this->db->query("UPDATE fin_redistributes
                            SET fin_redistribute_project_category_id=NULL 
                            WHERE fin_redistribute_project_category_id=$pr_cat_id");
          return TRUE;
        }
        else{ return FALSE; }
    }
   
     public function remove_project_item($pr_item_id)
    {
        $this->db->query("DELETE FROM project_items WHERE project_item_id=$pr_item_id");
        if($this->db->affected_rows()>0){
          return TRUE;
        }
        else{ return FALSE; }
    }
    
     public function remove_study_program($study_pr_id)
    {
        $this->db->query("DELETE FROM study_programs WHERE study_program_id=$study_pr_id");
        if($this->db->affected_rows()>0){
          $this->db->query("UPDATE users
                            SET user_study_program_id=NULL 
                            WHERE user_study_program_id=$study_pr_id");
          return TRUE;
        }
        else{ return FALSE; }
    }
    
     public function remove_user($user_id)
    {
      //  $tmp = $this->db->query("SELECT user_name, user_surname, user_email, user_birth_date
      //                           FROM users
      //                          WHERE user_id=$user_id");
        $this->db->query("DELETE FROM users WHERE user_id=$user_id");
        
        if($this->db->affected_rows()>0){
        
          $this->db->query("INSERT INTO user_cleans (user_clean_date) VALUES (CURRENT_TIMESTAMP)");
          $id= $this->db->insert_id();
         // $this->db->query("INSERT INTO deleted_users (deleted_user_user_clean_id, deleted_user_name, deleted_user_surname_deleted_user_email, deleted_user_birth_day)
          //                  VALUES ($id, '".$tmp['user_name']."', '".$tmp['user_surname']."', '".$tmp['user_email']."', '".$tmp['birth_date']."')");
          
          $this->db->query("UPDATE payments
                            SET payment_user_id=NULL 
                            WHERE payment_user_id=$user_id");
          $this->db->query("UPDATE fin_redistributes
                            SET fin_redistribute_user_id=NULL 
                            WHERE fin_redistribute_user_id=$user_id");
          $this->db->query("UPDATE user_email_evidence
                            SET user_email_evidence_user_id=NULL 
                            WHERE user_email_evidence_user_id=$user_id");
          $this->db->query("UPDATE events
                            SET event_author_id=NULL 
                            WHERE event_author_id=$user_id");
          $this->db->query("UPDATE projects
                            SET project_user_id=NULL 
                            WHERE project_user_id=$user_id");
          $this->db->query("UPDATE project_items
                            SET project_item_user_id=NULL 
                            WHERE project_item_user_id=$user_id");
          $this->db->query("UPDATE history_paids
                            SET history_paids_user_id=NULL 
                            WHERE history_paids_user_id=$user_id");
          $this->db->query("UPDATE booked_excursions
                            SET booked_excursion_user_id=NULL 
                            WHERE booked_excursion_user_id=$user_id");
          $this->db->query("UPDATE excursion_times
                            SET excursion_time_lecturer_id=NULL 
                            WHERE excursion_time_lecturer_id=$user_id");
          $this->db->query("UPDATE posts
                            SET post_author_id=NULL 
                            WHERE post_author_id=$user_id");
          $this->db->query("UPDATE database_logs
                            SET database_log_user_id=NULL 
                            WHERE database_log_user_id=$user_id");
          $this->db->query("UPDATE post_modifies
                            SET post_modifie_author_id=NULL 
                            WHERE post_modifie_author_id=$user_id");
          return TRUE;
        }
        else{ return FALSE; }
    }
}

/* End of file deleter.php */
/* Location: ./application/models/deleter.php */