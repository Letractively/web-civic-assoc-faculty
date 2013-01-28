<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Updater extends MY_Model
{
    public function edit_degree($degree_id, $values)
    {
        $this->db->query("UPDATE degrees SET degree_name='".$values['degree_name']."',
                                              degree_grade='".$values['degree_grade']."'
                          WHERE degree_id=$degree_id");
      if($this->db->affected_rows() > 0){
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_email_type($e_type_id, $values)
    {
          $this->db->query("UPDATE email_types SET email_type_name='".$values['email_type_name']."'
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
                              event_from='".date( format_datetime($values['from']) )."', 
                              event_to='".date( format_datetime($values['to']) )."', 
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
                          SET event_category_name='".$values['event_category_name']."'
                          WHERE event_category_id=$ev_cat_id");
        
      if($this->db->affected_rows() > 0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_payments_payment($payment_id, $values)
    {
        $this->db->query("UPDATE payments
                          SET payment_paid_sum='".$values['payment_paid_sum']."'
                          WHERE payment_id=$payment_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_page_text($page_name, $values)
    {
        $text = $values['page_text'];
        $column = 'page_'.$page_name;
        $this->db->query("  UPDATE pages
                            SET ".$column."='".$text."'
                            WHERE '".$column."'='".$column."'
                         ");
        if($this->db->affected_rows()>0)
           return TRUE;
        else
            return FALSE; 
    }
    
    public function edit_payments($payment_id, $values)
    {
         $this->db->query("UPDATE payments
                           SET payment_vs='".$values['vs']."', 
                               payment_user_id='".$values['user_id']."', 
                               payment_total_sum='".$values['suma']."', 
                               payment_type='".$values['payment_type']."'
                           WHERE payment_id=$payment_id
                         ");
        $payment_id = $this->db->insert_id();
        foreach($values['categories'] as $key=>$value ){
            $this->db->query("UPDATE fin_redistribution
                               SET fin_redistribute_ratio='".$value."'
                               WHERE fin_redistribute_payment_id=$payment_id AND fin_redistribute_project_category_id='".$key."'
                             ");}
        if($this->db->affected_rows()>0){ 
           return TRUE;
          }
        else{ return FALSE;} 
    }
    
     public function edit_post($post_id, $values)
    {
        if( !isset($values['foo']) && $values['post_published'] == '0' )
            $checked = '1';
        else
            $checked = '0';
        $this->db->query("UPDATE posts
                          SET post_priority='".$values['priority']."',
                              post_title='".$values['title']."',
                              post_content='".$values['content']."',
                              post_published='".$checked."'
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
                              project_date_from='".format_date($values['from'])."',
                              project_date_to='".format_date($values['to'])."'
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
                          SET project_category_name='".$values['project_category_name']."',
                              project_category_cash='".$values['project_category_cash']."'
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
                              project_item_date='".date('Y-m-d')."'
                          WHERE project_item_id=$pr_item_id
                              ");
        
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_study_program($study_pr_id, $values)
    {
          $this->db->query("UPDATE study_programs SET study_program_name='".$values['study_program_name']."'
                            WHERE study_program_id=$study_pr_id");
      if($this->db->affected_rows()>0){
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    public function edit_user($user_id, $values)
    {
          if($values['password'] != '')
          {
              $this->db->query("UPDATE users 
                                SET user_password=sha1('".$values['password']."')
                                WHERE user_id = '".$user_id."'");
          }    
          $this->db->query("UPDATE users 
                            SET user_username='".$values['username']."',
                                user_name='".$values['name']."',
                                user_surname='".$values['surname']."',
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