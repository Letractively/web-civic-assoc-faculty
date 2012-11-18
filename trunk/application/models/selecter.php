<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selecter extends MY_Model
{
    public function get_user( $param )
    {
        $q = $this->db->query(" SELECT user_id, user_role
                                FROM users
                                WHERE user_email = '".$param['email']."' AND
                                      user_password = '".sha1($param['password'])."'
                              ");   
        return $q->row();
    }
    /*
        * get_study_programs
        * 
        * Funkcia vrati vsetky polozky z databazy
        * 
        * @access      public
        * @return      array of objects
        */
    public function get_study_programs()
    {
        $q = $this->db->query(" SELECT * 
                                FROM study_programs
                              ");
        return $q->result();
        
    }
    
    /*
     * get_degrees
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_degrees()
    {
        $q = $this->db->query(" SELECT d.degree_id
                                FROM degrees d
                              ");
        return $q->result();
    }
    
    /*
     * count_project_categories
     * 
     * Funkcia vrati pocet projektovych kategorii z databazy. Nevyhnutne pre
     * vygenerovanie spravneho poctu form_input na formulari
     * 
     * @access      public
     * @return      integer
     */
    public function count_project_categories()
    {
            $q = $this->db->query(" SELECT project_category_id
                                    FROM project_categories
                                  ");
            return $q->num_rows();
    }
    
    /*
     * get_project_categories
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_project_categories()
    {
           $q = $this->db->query(" SELECT *
                                    FROM project_categories
                                  ");
            return $q->result();
    }
    
    /*
     * get_email_types
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_email_types()
    {
            $q = $this->db->query(" SELECT *
                                    FROM email_types
                                  ");
            return $q->result();
    }
    
    /*
     * get_event_categories
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_event_categories()
    {
            $q = $this->db->query(" SELECT *
                                    FROM event_categories
                                  ");
            return $q->result();
    }
    
    /*
     * get_users
     * 
     * Funkcia vrati vsetky polozky z databazy podla roly
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_users($role)
    {
            $q = $this->db->query(" SELECT ud.user_id, ud.user_name, ud.user_surname, ud.user_email, sp.study_program_name, ud.degree_name, ud.user_postcode 
                                    FROM study_programs sp
                                    JOIN 
                                       (SELECT *
                                        FROM users u
                                        JOIN degrees d ON (u.user_degree_id=d.degree_id)) ud ON (sp.study_program_id=ud.user_study_program_id)
                                    WHERE user_role=$role
                                  ");
            return $q->result();
    }
    
    public function get_user_detail($user_id)
    {
            $q = $this->db->query(" SELECT *
                                    FROM users
                                    WHERE user_id=$user_id
                                  ");
            return $q->result();
    }
    
    public function get_user($study_ids, $degrees, $degree_years)
    {
            $q = $this->db->query(" 
                                    SELECT tab.user_name, tab.user_surname, tab.degree_name AS user_degree, 
                                           tab.study_program_name AS user_study_program, 
                                           uee.user_email_evidence_date, tab.user_email
                                    FROM user_email_evidence uee
                                    JOIN 
                                    (SELECT *
                                     FROM study_programs sp
                                     JOIN
                                        (SELECT * 
                                         FROM users u
                                         JOIN degrees d ON (u.user_degree_id=d.degree_id)) ud 
                                              ON (sp.study_program_id=ud.user_study_program_id) ) tab 
                                         ON (uee.user_email_evidence_user_id=tab.user_id) 
                                     WHERE  tab.user_degree_id=$degrees AND tab.user_degree_year=$degree_years AND tab.user_study_program_id=$study_ids
                                  ");
            return $q->result();
    }
        
    public function get_nopaid_payments($user_id)
    {
        
    }
    
    public function get_event_detail($event_id)
    {
        $q = $this->db->query(" SELECT eec.event_event_category_id AS event_category_id, eec.event_category_name AS event_category, 
                                       eec.event_name, eec.event_about,
                                       eec.event_from, eec.event_to,
                                       eec.event_priority, eec.event_author_id,
                                       u.user_name||' '||u.user_surname AS event_author, eec.event_created
                                FROM users u
                                JOIN
                                (SELECT *
                                 FROM events e
                                 JOIN event_categories ec ON (e.event_event_category_id=ec.event_category_id)) eec ON (u.user_id=eec.event_author_id)
                                 WHERE eec.event_id=$event_id");
        return $q->result();
    }
    
    
    public function get_events($cat_id)
    {
        $q = $this->db->query("SELECT e.event_name, e.event_from, e.event_to
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               WHERE ec.event_category_id=$cat_id
                               ");
        return $q->result();
    }
    
    public function get_excursion_events($user_id)
    {
        
    }
   
    
    //public function get_excursion_events($excursion_id){}
    public function get_excursion_event_free($excursion_event_id)
    {
        
    }
    
    public function get_excursion_detail($excursion_id)
    {
        
    }
      
    public function get_excursion_event_detail($ex_event_id)
    {
        
    }
    
    public function get_lecturers()
    {
            $q = $this->db->query(" SELECT user_id, user_name||' '||user_surname AS user_name
                                    FROM users
                                    WHERE user_role=4
                                  ");
            return $q->result();
    }
    
    public function get_lecturer_times($ex_event_id,$user_id)
    {
            $q = $this->db->query(" SELECT e.excursion_time_from, e.excursion_time_to
                                    FROM users u
                                    JOIN
                                     (SELECT *
                                      FROM excursion_times et
                                      JOIN  excursion_events ee ON (et.excursion_time_excursion_id=ee.excursion_event_id)) e
                                      ON (u.user_id=e.excursion_time_lecturer_id)
                                    WHERE e.excursion_event_id=$ex_event_id AND u.user_id=$user_id
                                  ");
            return $q->result();
    }
   
    
    public function get_posts()
    {
             $q = $this->db->query("SELECT p.post_title, p.post_content, p.post_author_id, 
                                           p.post_date, pm.post_modifie_author_id, pm.post_modifie_date
                                    FROM post_modifies pm
                                    JOIN posts p ON (pm.post_modifie_post_id=p.post_id)
                                     ");
             return $q->result();
    }
    
    public function get_post_detail($post_id)
    {
        
    }
    
    public function get_post_modifiers($post_id)
    {
        
    }
    
    public function get_projects($cat_id)
    {
        
    }
    
    public function get_category_detail($cat_id)
    {
            $q = $this->db->query(" SELECT project_category_name, project_category_cash, transaktion_cash_from, transaction_cash_to
                                    FROM email_types
                                  ");
            return $q->result();
    }
    
    public function get_project_items($project_id)
    {
        
    }
    
    public function get_project_detail($project_id)
    {
        
    }
    
   
    
}

/* End of file selecter.php */
/* Location: ./application/models/selecter.php */