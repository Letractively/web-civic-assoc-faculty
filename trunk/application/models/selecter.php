<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selecter extends MY_Model
{
    /************NEODSTRANOVAT!!!!!!!*******matej********/
    public function id($id, $table, $column)
    {
        $q = $this->db->query(" SELECT * 
                                FROM $table
                                WHERE $column = $id
                              ");
        return $q->row();
    }
    
    public function get_login( $param )
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
        $q = $this->db->query(" SELECT d.degree_id, d.degree_name
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
        
    
    public function get_event_detail($event_id)
    {
        $q = $this->db->query(" SELECT eec.event_event_category_id AS event_category_id, 
		                       ec.event_category_name AS event_category, 
	                               eec.event_name, eec.event_about,
                                       eec.event_from, eec.event_to,
		                       eec.event_priority, eec.event_author_id,
		                       eec.user_name||' '||eec.user_surname AS event_author, eec.event_created
                                FROM event_categories ec
	                         JOIN
		                  (SELECT *
		                   FROM events e
		                   LEFT OUTER JOIN users u ON (e.event_author_id=u.user_id)) eec 
                                  ON (ec.event_category_id=eec.event_event_category_id)
                                WHERE eec.event_id=$event_id;");
        return $q->result();
    }
    
    
    public function get_events($cat_id)
    {
       if($cat_id !=0){
        $q = $this->db->query("SELECT e.event_name, e.event_from, e.event_to
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               WHERE ec.event_category_id = '".$cat_id."'
                               ORDER BY e.event_priority
                               ");
        return $q->result();
        }
    
        else
        {
         $q = $this->db->query("SELECT e.event_name, e.event_from, e.event_to, ec.event_category_name
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               ORDER BY e.event_priority
                               ");
         return $q->result();
       }
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
             $q = $this->db->query("SELECT ppm.post_id, ppm.post_title, ppm.post_content, ppm.post_author_id, 
                                           ppm.post_date, ppm.post_modifie_author_id, u.user_name as modifier_name, 
                                           u.user_surname as modifier_surname, ppm.post_modifie_date, us.user_name as author_name,
                                           us.user_surname as author_surname
                                    FROM (SELECT *
                                          FROM posts p
                                          LEFT JOIN post_modifies pm ON (p.post_id=pm.post_modifie_post_id)) ppm
                                          LEFT JOIN users u ON (ppm.post_modifie_author_id=u.user_id)
                                          LEFT JOIN users us ON(ppm.post_author_id = us.user_id)
                                    ORDER BY ppm.post_date
                                     ");
             return $q->result();
    }
    
    public function get_post_detail($post_id)
    {
             $q = $this->db->query("SELECT p.post_title, p.post_content, p.post_author_id, 
                                           p.post_date, pm.post_modifie_author_id, pm.post_modifie_date,
                                           u.user_name as author_name, u.user_surname as author_surname,
                                           us.user_name as modifie_name, us.user_surname as modifie_surname
                                    FROM post_modifies pm
                                    JOIN posts p ON (pm.post_modifie_post_id=p.post_id)
                                    JOIN users u ON (p.post_author_id = u.user_id)
                                    LEFT JOIN users us ON (pm.post_modifie_author_id = us.user_id)
                                    WHERE p.post_id=$post_id
                                     ");
             return $q->result();
    }
    
    public function get_post_modifiers($post_id)
    {
            $q = $this->db->query(" SELECT u.user_id, u.user_name, u.user_surname, pm_p.post_modifie_date,pm_p.post_modifie_id
                                    FROM users u
                                    JOIN
                                     (SELECT *
                                       FROM post_modifies pm
                                       JOIN posts p ON (pm.post_modifie_post_id=p.post_id)) pm_p 
                                       ON (u.user_id=pm_p.post_modifie_author_id)
                                    WHERE pm_p.post_id=$post_id
                                     ");
             return $q->result();
    }
    
    public function get_projects($cat_id)
    {
            $q = $this->db->query(" SELECT p.project_id, p.project_name,
                                           p.project_booked_cash, 
                                           sum(pi.project_item_price) AS project_spended_cash,
                                           p.project_date_from, p.project_date_to
                                    FROM project_items pi
                                    JOIN projects p ON (pi.project_item_project_id=p.project_id)
                                    WHERE p.project_project_category_id=$cat_id
                                  ");
            return $q->result();
    }
    
    public function get_category_detail($cat_id)
    {
         $q = $this->db->query(" SELECT project_category_name, project_category_cash, 
                                        SUM(fct1.fin_category_transaction_cash) AS transaction_cash_from,
                                        SUM(fct2.fin_category_transaction_cash) AS transaction_cash_to
                                 FROM project_categories pc
                                 JOIN fin_category_transactions fct1 ON (pc.project_category_id=fct1.fin_category_transaction_cat_from_id)
                                 JOIN fin_category_transactions fct2 ON (pc.project_category_id=fct2.fin_category_transaction_cat_to_id)
                                 WHERE project_category_id=$cat_id       
                                  ");
            return $q->result();   
    }
    
    public function get_project_items($project_id)
    {
            $q = $this->db->query(" SELECT piu.project_item_name, piu.project_item_price,piu.user_id, piu.user_name, piu.user_surname, piu.project_item_date
                                    FROM projects p
                                    JOIN
                                     (SELECT *
                                      FROM project_items pi
                                      JOIN users u ON (pi.project_item_user_id=u.user_id)) piu
                                      ON (p.project_id=piu.project_item_project_id)
                                    WHERE p.project_id=$project_id
                                  ");
            return $q->result();
    }
    
    public function get_project_detail($project_id)
    {
            $q = $this->db->query(" SELECT p.project_name, p.project_about, p.project_priority, 
                                           p.project_project_category_id, p.project_booked_cash, 
                                           sum(pi.project_item_price) AS project_spended_cash,
                                           p.project_date_from, p.project_date_to
                                    FROM project_items pi
                                    JOIN projects p ON (pi.project_item_project_id=p.project_id)
                                    WHERE project_id=$project_id
                                  ");
            return $q->result();
    }
    
    public function get_project_categories_total_cash()
    {
            $q = $this->db->query(" SELECT sum(project_category_cash)
                                    FROM project_categories
                                  ");
            return $q->result();
    }
    
    public function get_payments($user_id)
    {
        if($user_id==0){
            $q = $this->db->query(" SELECT u.user_name, u.user_surname, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                    FROM payments p
                                    JOIN users u ON (p.payment_user_id=u.user_id)
                                  ");
            return $q->result();
        }   
        else {
        $q = $this->db->query(" SELECT u.user_name, u.user_surname, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                    FROM payments p
                                    JOIN users u ON (p.payment_user_id=u.user_id)
                                    WHERE u.user_id=$user_id
                                  ");
            return $q->result();
        }
    }
    
     public function get_payments_lastpaid($user_id)
     {
         $q = $this->db->query("
                                    SELECT p.payment_paid_sum, p.payment_paid_time, p.payment_total_sum  
                                      FROM payments p
                                      JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE u.user_id=$user_id 
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
            return $q->row(1);
    }
    
    public function get_payments_nopaid($user_id)
    {
        if($user_id==0){
            $q = $this->db->query("
                                    SELECT u.user_name, u.user_surname, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE p.payment_paid_sum<p.payment_total_sum
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        } 
        else{
        $q = $this->db->query("
                                    SELECT u.user_name, u.user_surname, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE u.user_id=$user_id AND p.payment_paid_sum<p.payment_total_sum
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        }
            return $q->result();
    }
    
    public function get_payments_paid($user_id)
    {
        if($user_id==0){
            $q = $this->db->query("
                                    SELECT u.user_name, u.user_surname, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE p.payment_paid_sum>=p.payment_total_sum
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        }
        else{
        $q = $this->db->query("
                                    SELECT u.user_name, u.user_surname, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE (u.user_id=$user_id) AND (p.payment_paid_sum>=p.payment_total_sum)
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        }
            return $q->result();
    }
    
    public function get_transactions($pr_cat_id)
    {
        $q = $this->db->query(" 
                              ");
            return $q->result();
    }
    
    public function get_user_detail($user_id)
    {
        $q = $this->db->query(" SELECT *
                                FROM users u
                                JOIN study_programs sp ON (u.user_study_program_id=sp.study_program_id) 
                                JOIN degrees d ON (u.user_degree_id=d.degree_id)
                                WHERE u.user_id=$user_id       
                               ");
        return $q->result();
    }
}

/* End of file selecter.php */
/* Location: ./application/models/selecter.php */