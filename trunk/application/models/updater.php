<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updater extends MY_Model
{
    public function edit_degree($degree_id, $values)
    {
        $this->db->query("UPDATE degrees SET degree_name='".$values['name']."',
                                              degree_grade='".$values['grade']."'
                          WHERE degree_id=$degree_id");
      if($this->db->affected_rows()>0){
      return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_email_type($e_type_id, $values)
    {
          $this->db->query("UPDATE email_types SET email_type_name='".$values['name']."'
                            WHERE email_type_id=$e_type_id");
      if($this->db->affected_rows()>0){
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_event($ev_id, $values)
    {
        $this->db->query("UPDATE events 
                          SET event_event_category_id='".$values['event_category_id']."', 
                              event_priority='".$values['priority']."', 
                              event_name='".$values['name']."',
                              event_from='".format_date($values['from']).' '.$values['from_time'].':00'."', 
                              event_to='".format_date($values['to']).' '.$values['to_time'].':00'."', 
                              event_about='".$values['about']."'
                          WHERE event_id=$ev_id");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_event_category($ev_cat_id, $values)
    {
        $this->db->query("UPDATE event_categories
                          SET event_category_name='".$values."'
                          WHERE event_category_id=$ev_cat_id");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
     public function edit_lecturer_time($lec_time_id, $values)
    {
          $this->db->query("UPDATE excursion_times
                            SET excursion_time_excursion_event_from='".$values['from']."',
                                excursion_time_excursion_event_to='".$values['to']."'
                            WHERE excursion_time_id=$lec_time_id");
      if($this->db->affected_rows()>0){
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_payments($payment_id, $values)
    {
        $this->db->query("UPDATE payments
                          SET payment_vs='".$values['vs']."',
                              payment_user_id='".$values['user_id']."',
                              payment_total_sum='".$values['total_sum']."',
                              payment_paid_sum='".$values['paid_sum']."'
                          WHERE payment_id=$payment_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
     public function edit_post($post_id, $values)
    {
        $this->db->query("UPDATE posts
                          SET post_priority='".$values['priority']."',
                              post_title='".$values['title']."',
                              post_content='".$values['content']."'
                          WHERE post_id=$post_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        $this->db->query("INSERT INTO post_modifies
                          (post_modifie_post_id, post_modifie_author_id)
                          VALUES ('".$post_id."','".$this->session->userdata('user')."')
                        "); 
      }
      else{ return FALSE;}
    }
    
    public function edit_project($pr_id, $values)
    {
        $this->db->query("UPDATE projects
                          SET project_name='".$values['name']."',
                              project_about='".$values['about']."',
                              project_priority='".$values['priority']."',
                              project_project_category_id='".$values['project_category_id']."',
                              project_booked_cash='".$values['booked_cash']."',
                              project_from='".$values['from']."',
                              project_to='".$values['to']."'
                          WHERE project_id=$pr_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_project_category($pr_cat_id, $values)
    {
        $this->db->query("UPDATE project_categories
                          SET project_category_name='".$values['name']."',
                              project_category_cash='".$values['cash']."'
                          WHERE project_category_id=$pr_cat_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_project_closed($pr_id)
    {
        $this->db->query("UPDATE projects
                          SET project_active='0'
                          WHERE project_id=$pr_id");
    }

        public function edit_project_item($pr_item_id, $values)
    {
        $this->db->query("UPDATE project_items
                          SET project_item_name='".$values['name']."',
                              project_item_price='".$values['price']."',
                              project_item_user_id='".$values['user_id']."',
                              project_item_date='".$values['date']."',
                          WHERE project_item_id=$pr_item_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_study_program($study_pr_id, $values)
    {
          $this->db->query("UPDATE study_programs SET study_program_name='".$values['name']."'
                            WHERE study_program_id=$study_pr_id");
      if($this->db->affected_rows()>0){
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_user($user_id, $values)
    {
          $this->db->query("UPDATE users 
                            SET user_username='".$values['username']."',
                                user_name='".$values['name']."',
                                user_surname='".$values['surname']."',
                                user_password='".$values['password']."',
                                user_email='".$values['email']."',
                                user_phone='".$values['phone']."',
                                user_study_program_id='".$values['study_program_id']."',
                                user_degree_id='".$values['degree_id']."',
                                user_place_of_birth='".$values['place_of_birth']."',
                                user_postcode='".$values['postcode']."',
                                user_degree_year='".$values['degree_year']."'
                            WHERE user_id=$user_id");
          $this->db->query("UPDATE payments
                            SET payment_vs='".$values['vs']."'
                            WHERE payment_user_id=$user_id");
      if($this->db->affected_rows()>0){
        return TRUE;
      }
      else{ return FALSE;}
    }
}

/* End of file updater.php */
/* Location: ./application/models/updater.php */