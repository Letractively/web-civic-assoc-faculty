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
                                WHERE user_username = '".$param['username']."' AND
                                      user_password = '".sha1($param['password'])."' AND
                                      user_active   = 1
                              ");   
        return $q->row();
    }
    
    public function project_state( $project_id )
    {
        $q = $this->db->query(" SELECT project_active
                                FROM projects
                                WHERE project_id = $project_id
                              ");
        
        return $q->row()->project_active;
    }
    
    public function get_page($view)
    {
        $q = $this->db->query(" SELECT page_$view
                                FROM pages
                                WHERE page_$view = page_$view
                              ");
        
        return $q->row();
    }
    
    public function EventRowsInCategory($table, $id, $event_cat)
    {
        if ($event_cat == 0)
            return $this->rows($table, $id);
        else
        {
            $q = $this->db->query(" SELECT $id
                                    FROM $table
                                    WHERE event_event_category_id = $event_cat
                                  ");
            return $q->num_rows();
        }
    }
    /*******************************************************/
    
    /*
        * get_study_programs
        * 
        * Funkcia vrati vsetky polozky z databazy
        * 
        * @access      public
        * @return      array of objects
        */
    public function get_study_programs($grid = false)
    {
        $q = $this->db->query(" SELECT * 
                                FROM study_programs
                              ");
        if ($grid == true) return $q;
		else return $q->result();    
    }
    
    /*
     * get_degrees
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_degrees($grid = false, $per_page = 0, $cur_page = 0 )
    {
        $q = $this->db->query(" SELECT d.degree_id, d.degree_name, d.degree_grade
                                FROM degrees d
                                LIMIT $cur_page, $per_page
                              ");
        if ($grid == true) return $q;
		else return $q->result();
    }
    
    /*
     * get_project_categories
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_project_categories($grid = false)
    {
           $q = $this->db->query(" SELECT *
                                    FROM project_categories
                                  ");
            if ($grid == true) return $q;
		else return $q->result();
    }
    
    /*
     * get_email_types
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_email_types($grid = false)
    {
            $q = $this->db->query(" SELECT *
                                    FROM email_types
                                  ");
            if ($grid == true) return $q;
		else return $q->result();
    }
    
    /*
     * get_event_categories
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
    public function get_event_categories($grid = false)
    {
            $q = $this->db->query(" SELECT *
                                    FROM event_categories
                                  ");
            if ($grid == true) return $q;
		else return $q->result();
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
        if ($role == 0)
            $q = $this->db->query(" SELECT  u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                            u.user_email, u.user_phone, u.user_degree_year, 
                                            sp.study_program_name, d.degree_name, u.user_postcode 
                                    FROM users u
                                    LEFT JOIN degrees d ON (u.user_degree_id = d.degree_id)
                                    LEFT JOIN study_programs sp ON (u.user_study_program_id = sp.study_program_id)
                                  ");
	else
            $q = $this->db->query(" SELECT  u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                            u.user_email, u.user_phone, u.user_degree_year, 
                                            sp.study_program_name, d.degree_name, u.user_postcode 
                                    FROM users u
                                    LEFT JOIN degrees d ON (u.user_degree_id = d.degree_id)
                                    LEFT JOIN study_programs sp ON (u.user_study_program_id = sp.study_program_id)
                                    WHERE u.user_role=$role
                                  ");
            return $q->result();
    }
	
	/*
     *  Funkcia vytvori filtracne podmienky pre correspondence
     */
    public function get_users_filter($values)
    {
        //array_debug($values);
        $this->db->select('u.user_id, u.user_name, u.user_surname, u.user_email,
                           d.degree_name, sp.study_program_name, 
                           u_e_e.user_email_evidence_date, u_e_e.user_email_evidence_email_type_id')
                 ->from('user_email_evidence u_e_e');
        
        $this->db->join('users u', 'u_e_e.user_email_evidence_user_id = u.user_id','right');
        $this->db->join('degrees d', 'u.user_degree_id = d.degree_id');
        $this->db->join('study_programs sp', 'u.user_study_program_id = sp.study_program_id');
		
        //Generator pre where podmienky na studijny program
        if( isset($values['study']) )
        {
            if ( count($values['study']) > 1)
            {
                $studies = array();
                foreach ($values['study'] as $key => $value) 
                {
                    array_push($studies, $value);
                }
                $this->db->where_in('u.user_study_program_id', $studies);
            }
            else
                $this->db->where('u.user_study_program_id', $values['study'][0]);
        }
        
        //Generator pre where podmienky na stupen studia
        if( isset($values['grade']) )
        {
            if ( count($values['grade']) > 1)
            {
                $grades = array();
                foreach ($values['grade'] as $key => $value) 
                {
                    array_push($grades, $value);
                }
                $this->db->where_in('d.degree_grade', $grades);
            }
            else
                $this->db->where('d.degree_grade', $values['grade'][0]);
        }
        
        //Generator pre where podmienky na rok ukoncenia studia
        if( isset($values['degree_year']) )
        {
            if ( count($values['degree_year']) > 1)
            {
                $degrees = array();
                foreach ($values['degree_year'] as $key => $value) 
                {
                    array_push($degrees, $value);
                }
                $this->db->where_in('u.user_degree_year', $degrees);
            }
            else
                $this->db->where_in('u.user_degree_year', $values['degree_year'][0]);     
        }	
		
	// 1 - viac ako tyzden
	// 2 - viac ako mesiac
	// 3 - viac ako 3 mesiace
	// 4 - viac ako pol roka
	// 5 - viac ako rok
	if( isset($values['period']) )
	{
            if ( count($values['period']) > 1)
            {
                $checkDates = array();
                foreach ($values['period'] as $key => $value)
                {
                    array_push($checkDates, $this->returnDate($value));
                }
                foreach ($checkDates as $date) 
                {   
                    $this->db->where('u_e_e.user_email_evidence_date <=', $date);
                }
            }
            else
                $this->db->where('u_e_e.user_email_evidence_date <', $this->returnDate($values['period'][0]));
	}
		
	// perioda sa viace k typu emailu, ktory chce user posiela
	// typ emailu zistis cez $values['email_type_id'] - IDcko do tabulky email_types
        
        // 1 - admin
	// 2 - clen
	// 3 - potencionalny clen
	if( isset($values['user_type']) )
	{
            if ( count($values['user_type']) > 1)
            {
                $roles = array();
                foreach ($values['user_type'] as $key => $value) 
                {
                    array_push($roles, $value);
                }
                $this->db->where_in('u.user_role', $roles);
            }
            else 
            {
                $this->db->where('u.user_role', $values['user_type'][0]);    
            }
	}
        
        $this->db->group_by('u.user_id');
        $query = $this->db->get();
	
        $result = $query->result();
        if( isset($values['payment_time']) )
            return $this->selecter->get_users_filter_on_payments($result, $values['payment_time']);
        else
        {
            $query->free_result();
            return $result;  
        }
     //array_debug($result);
    }
    
    public function get_users_filter_on_payments($users, $payments_value)
    {
        $lastPayments = array();
        foreach ($users as $user)
        {
            array_push($lastPayments, $this->get_payments_lastpaid($user->user_id));
        }
        
        $this->db   ->select('u.user_id, u.user_name, u.user_surname, u.user_email,
                           d.degree_name, sp.study_program_name, 
                          ')
                    ->from('users u');
        $this->db   ->join('degrees d', 'u.user_degree_id = d.degree_id');
        $this->db   ->join('study_programs sp', 'u.user_study_program_id = sp.study_program_id');
        
        $userIDS = array();
        foreach ($payments_value as $value) 
        {
            switch ($value) 
            {
                case 1:
                    foreach ($lastPayments as $value) 
                    {
                        if( isset($value->payment_paid_sum) )
                        {
                           if($value->payment_paid_sum >= $value->payment_total_sum)
                           {
                               array_push($userIDS, $value->user_id);
                           }
                        }         
                    }
                    break;
                case 2:
                    foreach ($lastPayments as $value) 
                    {
                        if( isset($value->payment_paid_sum) )
                        {
                           if($value->payment_paid_sum < $value->payment_total_sum)
                           {
                               array_push($userIDS, $value->user_id);
                           }
                        }         
                    }
                    break;
            }
        }
        
        $this->db->where_in('user_id',$userIDS);
        $query = $this->db->get();
	$result = $query->result();
        $query->free_result();
        return $result;
    }
    
    private function returnDate($id)
    {
        $date = '';
        /*$lastDate = date("Y-m-d H:i:s");
        $timeStamp = strtotime($lastDate);*/

        switch ($id) 
        {
            case 1:
                /*$timeStamp -= 24 * 60 * 60 * 7;
                $date = date("Y-m-d  H:i:s", $timeStamp);*/
                $date = date("Y-m-d  H:i:s", strtotime("-1 week", strtotime(date("Y-m-d  H:i:s"))));
                break;
            case 2:
                /*$timeStamp -= 24 * 60 * 60 * 30;
                $date = date("Y-m-d  H:i:s", $timeStamp);*/
                $date = date("Y-m-d  H:i:s", strtotime("-1 month", strtotime(date("Y-m-d  H:i:s"))));
                break;
            case 3:
                /*$timeStamp -= 24 * 60 * 60 * 30 * 3;
                $date = date("Y-m-d  H:i:s", $timeStamp);*/
                $date = date("Y-m-d  H:i:s", strtotime("-3 month", strtotime(date("Y-m-d  H:i:s"))));
                break;
            case 4:
                /*$timeStamp -= 24 * 60 * 60 * 30 * 6;
                $date = date("Y-m-d  H:i:s", $timeStamp);*/
                $date = date("Y-m-d  H:i:s", strtotime("-6 month", strtotime(date("Y-m-d  H:i:s"))));
                break;
            case 5:
                /*$timeStamp -= 24 * 60 * 60 * 30 * 12;
                $date = date("Y-m-d  H:i:s", $timeStamp);*/
                $date = date("Y-m-d  H:i:s", strtotime("-1 year", strtotime(date("Y-m-d  H:i:s"))));
                break;
        }
        return $date;
    }
    
    /*public function get_user($study_ids, $degrees, $degree_years)
    {
            $q = $this->db->query(" 
                                    SELECT tab.user_id, tab.user_name, tab.user_surname, 
                                           tab.degree_name AS user_degree, 
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
    }*/
    
    public function get_event_detail($event_id)
    {
        $q = $this->db->query(" SELECT eec.event_event_category_id AS event_category_id, 
		                       ec.event_category_name AS event_category, 
	                               eec.event_name, eec.event_about,
                                       eec.event_from, eec.event_to,
		                       eec.event_priority, eec.user_id,
		                       CONCAT(CONCAT(eec.user_name,' '),eec.user_surname) AS event_author, eec.event_created
                                FROM event_categories ec
	                         JOIN
		                  (SELECT *
		                   FROM events e
		                   LEFT OUTER JOIN users u ON (e.event_author_id=u.user_id)) eec 
                                  ON (ec.event_category_id=eec.event_event_category_id)
                                WHERE eec.event_id=$event_id;");
        return $q->result();
    }
    
    
    public function get_events( $per_page = 0, $cur_page = 0, $cat_id = 0, $grid = false )
    {
       if($cat_id != 0){
        $q = $this->db->query("SELECT   e.event_id, e.event_about, e.event_name, e.event_created, e.event_from, e.event_to,
                                        ec.event_category_id, ec.event_category_name, event_priority
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               WHERE ec.event_category_id = '".$cat_id."'
                               ORDER BY e.event_priority DESC, e.event_created DESC
                               LIMIT $cur_page, $per_page
                               ");
        if ($grid == true) return $q;
		else return $q->result();
        }
    
        else
        {
         $q = $this->db->query("SELECT  e.event_id, e.event_about, e.event_name, e.event_created, e.event_from, e.event_to,
                                        ec.event_category_id, ec.event_category_name, event_priority
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               ORDER BY e.event_priority DESC, e.event_created DESC
                               LIMIT $cur_page, $per_page
                               ");
         if ($grid == true) return $q;
		else return $q->result();
       }
    }
    
    public function get_events_newest( $per_page = 0, $cur_page = 0, $cat_id, $grid = false )
    {
       if($cat_id != 0){
        $q = $this->db->query("SELECT   e.event_id, e.event_about, e.event_name, e.event_created, e.event_from, e.event_to,
                                        ec.event_category_id, ec.event_category_name, event_priority
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               WHERE ec.event_category_id = '".$cat_id."'
                               ORDER BY e.event_created DESC
                               LIMIT $cur_page, $per_page
                               ");
        if ($grid == true) return $q;
		else return $q->result();
        }
    
        else
        {
         $q = $this->db->query("SELECT  e.event_id, e.event_about, e.event_name, e.event_created, e.event_from, e.event_to,
                                        ec.event_category_id, ec.event_category_name, event_priority
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               ORDER BY e.event_created DESC
                               LIMIT $cur_page, $per_page
                               ");
         if ($grid == true) return $q;
		else return $q->result();
       }
    }
    
    public function get_events_prior( $per_page = 0, $cur_page = 0, $cat_id, $grid = false )
    {
       if($cat_id != 0){
        $q = $this->db->query("SELECT   e.event_id, e.event_about, e.event_name, e.event_created, e.event_from, e.event_to,
                                        ec.event_category_id, ec.event_category_name, event_priority
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               WHERE ec.event_category_id = '".$cat_id."'
                               ORDER BY e.event_priority ASC, e.event_created DESC, e.event_name ASC
                               LIMIT $cur_page, $per_page
                               ");
        if ($grid == true) return $q;
		else return $q->result();
        }
    
        else
        {
         $q = $this->db->query("SELECT  e.event_id, e.event_about, e.event_name, e.event_created, e.event_from, e.event_to,
                                        ec.event_category_id, ec.event_category_name, event_priority
                               FROM events e
                               JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                               ORDER BY e.event_priority ASC, e.event_created DESC, e.event_name ASC
                               LIMIT $cur_page, $per_page
                               ");
         if ($grid == true) return $q;
		else return $q->result();
       }
    }
    
    public function get_lecturers()
    {
            $q = $this->db->query(" SELECT user_id, user_name, user_surname
                                    FROM users
                                    WHERE user_role=4
                                  ");
            return $q->result();
    }
    
    public function get_lecturer_times($ex_event_id,$user_id)
    {
            $q = $this->db->query(" SELECT e.excursion_time_from, e.excursion_time_to, 
                                           e.excursion_time_id
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
   
    
    public function get_posts( $per_page = 0, $cur_page = 0, $unpublished = false )
    {
        if($unpublished == true)
        {
            $q = $this->db->query("SELECT ppm.post_id, ppm.post_title, ppm.post_content, ppm.post_author_id, ppm.post_priority, 
                                          ppm.post_date, ppm.post_modifie_author_id, ppm.post_published, u.user_name as modifier_name, 
                                          u.user_surname as modifier_surname, ppm.post_modifie_date, us.user_name as author_name,
                                          us.user_surname as author_surname
                                   FROM (SELECT *
                                         FROM posts p
                                         LEFT JOIN post_modifies pm ON (p.post_id=pm.post_modifie_post_id)
                                         ORDER BY pm.post_modifie_date DESC
                                        ) ppm
                                   LEFT JOIN users u ON (ppm.post_modifie_author_id=u.user_id)
                                   LEFT JOIN users us ON(ppm.post_author_id = us.user_id)
                                   WHERE ppm.post_published = 1
                                   GROUP BY ppm.post_id
                                   ORDER BY ppm.post_date DESC
                                   LIMIT $cur_page, $per_page
                                  ");
        }
        else
        {
            $q = $this->db->query("SELECT ppm.post_id, ppm.post_title, ppm.post_content, ppm.post_author_id, ppm.post_priority, 
                                          ppm.post_date, ppm.post_modifie_author_id, ppm.post_published, u.user_name as modifier_name, 
                                          u.user_surname as modifier_surname, ppm.post_modifie_date, us.user_name as author_name,
                                          us.user_surname as author_surname
                                   FROM (SELECT *
                                         FROM posts p
                                         LEFT JOIN post_modifies pm ON (p.post_id=pm.post_modifie_post_id)
                                         ORDER BY pm.post_modifie_date DESC
                                        ) ppm
                                   LEFT JOIN users u ON (ppm.post_modifie_author_id=u.user_id)
                                   LEFT JOIN users us ON(ppm.post_author_id = us.user_id)
                                   GROUP BY ppm.post_id
                                   ORDER BY ppm.post_date DESC
                                   LIMIT $cur_page, $per_page
                                  ");
        }
             return $q->result();
    }
    
    public function get_post_detail($post_id)
    {
             $q = $this->db->query("SELECT p.post_title, p.post_content, p.post_author_id, 
                                           p.post_date, pm.post_modifie_author_id, pm.post_modifie_date,
                                           u.user_name as author_name, u.user_surname as author_surname,
                                           us.user_name as modifie_name, us.user_surname as modifie_surname
                                    FROM  posts p
                                    LEFT JOIN post_modifies pm ON (p.post_id = pm.post_modifie_post_id)
                                    JOIN users u ON (p.post_author_id = u.user_id)
                                    LEFT JOIN users us ON (pm.post_modifie_author_id = us.user_id)
                                    WHERE p.post_id=$post_id
                                    ORDER BY pm.post_modifie_date DESC
                                     ");
             return $q->row();
    }
    
    
    public function get_post_modifiers($post_id)
    {
            $q = $this->db->query(" SELECT u.user_id, u.user_name, u.user_surname, 
                                           pm_p.post_modifie_date,pm_p.post_modifie_id
                                    FROM users u
                                    JOIN
                                     (SELECT *
                                       FROM post_modifies pm
                                       JOIN posts p ON (pm.post_modifie_post_id=p.post_id)) pm_p 
                                       ON (u.user_id=pm_p.post_modifie_author_id)
                                    WHERE pm_p.post_id = $post_id
                                     ");
             return $q->result();
    }
    
    public function get_projects($cat_id)
    {
		if ($cat_id == 0)
		{
			$q = $this->db->query("SELECT  p.project_name, pc.project_category_id, pc.project_category_name, p.project_booked_cash, p.project_date_from, 
                                            p.project_date_to, sum(pi.project_item_price) AS project_spended_cash,
                                            pi.project_item_id, p.project_id, p.project_active
                                    FROM project_items pi
                                    RIGHT JOIN projects p ON (pi.project_item_project_id = p.project_id)
                                    JOIN project_categories pc ON (p.project_project_category_id = pc.project_category_id)
                                    GROUP BY p.project_id
                                    ORDER BY p.project_active DESC
                                  ");
		}
		else
		{
                $q = $this->db->query("SELECT  p.project_name, pc.project_category_name, p.project_booked_cash, p.project_date_from, 
                                            p.project_date_to, sum(pi.project_item_price) AS project_spended_cash,
                                            pi.project_item_id, p.project_id, pc.project_category_id, p.project_active
                                    FROM project_items pi
                                    RIGHT JOIN projects p ON (pi.project_item_project_id = p.project_id)
                                    JOIN project_categories pc ON (p.project_project_category_id = pc.project_category_id)
                                    WHERE p.project_project_category_id = $cat_id
                                    GROUP BY p.project_id
                                    ORDER BY p.project_active DESC
                                  ");
		}
        return $q->result();
    }
    
    public function get_category_detail($cat_id)
    {
         $q = $this->db->query(" SELECT fin_from.*, SUM(fin_trans_to.fin_category_transaction_cash) AS transaction_cash_to
                                 FROM 
                                    (SELECT p_c.project_category_cash, p_c.project_category_id, p_c.project_category_name, 
                                            SUM(fin_trans_from.fin_category_transaction_cash) AS transaction_cash_from
                                     FROM project_categories p_c
                                     LEFT JOIN fin_category_transactions fin_trans_from ON (p_c.project_category_id = fin_trans_from.fin_category_transaction_cat_from_id)
                                     WHERE project_category_id = $cat_id) fin_from
                                 LEFT JOIN fin_category_transactions fin_trans_to ON (fin_from.project_category_id = fin_trans_to.fin_category_transaction_cat_to_id)       
                               ");
            return $q->row();   
    }
    
    public function get_project_items( $project_id, $grid = false )
    {
            $q = $this->db->query(" SELECT piu.project_item_name, piu.project_item_price,
                                           u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                           piu.project_item_date, piu.project_item_id
                                    FROM project_items piu
                                    JOIN users u on (piu.project_item_user_id = u.user_id)
                                    WHERE piu.project_item_project_id=$project_id
                                  ");
            if ($grid == true) return $q;
		else return $q->result();
    }
    
    public function get_project_detail($project_id)
    {
            $q = $this->db->query(" SELECT p.project_name, p.project_about, p.project_priority, 
                                           p.project_project_category_id, p.project_booked_cash, 
                                           sum(pi.project_item_price) AS project_spended_cash,
                                           p.project_date_from, p.project_date_to, p.project_active
                                    FROM project_items pi
                                    JOIN projects p ON (pi.project_item_project_id=p.project_id)
                                    WHERE project_id=$project_id
                                  ");
            return $q->result();
    }
    
    public function get_project_categories_total_cash()
    {
            $q = $this->db->query(" SELECT sum(project_category_cash) AS total_sum
                                    FROM project_categories
                                  ");
            return $q->row()->total_sum;
    }
	
	public function get_payment_detail($payment_id)
	{
		$q = $this->db->query("SELECT * FROM payments WHERE payment_id = $payment_id");
		$payment = get_object_vars($q->row(1));
		if ($payment != null)
		{
			$q = $this->db->query("SELECT * FROM fin_redistributes fr WHERE fr.fin_redistribute_payment_id = $payment_id");
			$redistributes = $q->result();
			foreach ($redistributes as $r)
			{
				//$payment['categories'] = array();
				$payment['categories'][$r->fin_redistribute_project_category_id] = $r->fin_redistribute_ratio;
			}
		}
		return $payment;
	}
    
    public function get_payments($user_id, $grid = false)
    {
        if($user_id == 0){
            $q = $this->db->query(" SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                    FROM payments p
                                    LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                  ");
            if ($grid == true) return $q;
			else return $q->result();
        }   
        else {
        $q = $this->db->query(" SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                    FROM payments p
                                    LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                    WHERE u.user_id = $user_id
                                  ");
            if ($grid == true) return $q;
			else return $q->result();
        }
    }
    
     public function get_payments_lastpaid($user_id)
     {
         $q = $this->db->query("
                                    SELECT p.payment_type, p.payment_paid_sum, p.payment_paid_time, 
                                           p.payment_total_sum, p.payment_id, u.user_id
                                      FROM payments p
                                      LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE u.user_id = $user_id AND p.payment_type = 1
                                      ORDER BY p.payment_paid_time DESC                            
                                  ");
            return $q->row();
    }
    
    public function get_payments_nopaid($user_id, $grid = false)
    {
        if($user_id==0){
            $q = $this->db->query("
                                    SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE p.payment_paid_sum<p.payment_total_sum
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        } 
        else{
        $q = $this->db->query("
                                    SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE u.user_id=$user_id AND p.payment_paid_sum<p.payment_total_sum
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        }
            if ($grid == true) return $q;
			else return $q->result();
    }
    
    public function get_payments_paid($user_id, $grid = false)
    {
        if($user_id==0){
            $q = $this->db->query("
                                    SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE p.payment_paid_sum>=p.payment_total_sum
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        }
        else{
        $q = $this->db->query("
                                    SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                          p.payment_paid_sum, p.payment_paid_time, p.payment_id
                                      FROM payments p
                                      LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                       WHERE (u.user_id=$user_id) AND (p.payment_paid_sum>=p.payment_total_sum)
                                      ORDER BY p.payment_paid_time DESC
                                   
                                  ");
        }
            if ($grid == true) return $q;
			else return $q->result();
    }
    
    public function get_transactions($pr_cat_id)
    {
        $q1 = $this->db->query("(SELECT 
                                       tmp.project_category_name AS fin_category_transaction_from, ppc.project_category_name AS fin_category_transaction_to,
                                       tmp.category_transaction_cash, tmp.project_category_id, tmp.fin_category_transaction_id, fin_category_transaction_cat_to_id,
                                       fin_category_transaction_cat_from_id
                                FROM
                                (SELECT *, SUM(fct.fin_category_transaction_cash) AS category_transaction_cash
                                FROM fin_category_transactions fct
                                LEFT JOIN project_categories pc 
                                     ON (fct.fin_category_transaction_cat_from_id=pc.project_category_id)
                                
                                WHERE pc.project_category_id=$pr_cat_id
                                    GROUP BY fct.fin_category_transaction_cat_to_id) tmp
                                    JOIN project_categories ppc ON (tmp.fin_category_transaction_cat_to_id=ppc.project_category_id))
                             UNION
                                  ( SELECT  
                                       ppc.project_category_name AS fin_category_transaction_to, tmp.project_category_name AS fin_category_transaction_from,
                                       tmp.category_transaction_cash, tmp.project_category_id, tmp.fin_category_transaction_id, fin_category_transaction_cat_to_id,
                                       fin_category_transaction_cat_from_id
                                FROM
                                (SELECT *, SUM(fct.fin_category_transaction_cash) AS category_transaction_cash
                                FROM fin_category_transactions fct
                                LEFT JOIN project_categories pc 
                                     ON (fct.fin_category_transaction_cat_to_id=pc.project_category_id)
                                WHERE pc.project_category_id=$pr_cat_id
                                    GROUP BY fct.fin_category_transaction_cat_from_id) tmp
                                    JOIN project_categories ppc ON (tmp.fin_category_transaction_cat_from_id=ppc.project_category_id))");
     
   
            return $q1->result();
    }
    
    public function get_user_detail($user_id)
    {
        $q = $this->db->query(" SELECT *
                                FROM users u
                                LEFT JOIN study_programs sp ON (u.user_study_program_id=sp.study_program_id) 
                                LEFT JOIN degrees d ON (u.user_degree_id=d.degree_id)
                                WHERE u.user_id=$user_id       
                               ");
        return $q->result();
    }
    
    public function get_fin_redistribution($payment_id,$pr_cat_id)
    {
        $q = $this->db->query(" SELECT *
                                FROM fin_redistributes
                                WHERE fin_redistribute_payment_id=$payment_id AND fin_redistribute_project_category_id$pr_cat_id      
                               ");
        return $q->result();
    }
}

/* End of file selecter.php */
/* Location: ./application/models/selecter.php */