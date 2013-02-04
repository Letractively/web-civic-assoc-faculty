<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selecter extends MY_Model
{
        /*
         * get_category_detail
         * 
         * Funkcia vrati detailne informacie o projektovej kategorie
         * 
         * @access	public
         * @param cat_id ID ID-kategorie ktorej podrobnosti chceme ziskat
         * @return Vrati objekt typu detajl projektovej kategorie
         * 
         */
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

        /*
         * get_degrees
         * 
         * Funkcia vrati vsetky polozky z tabulky degrees
         * 
         * @access	public
         * @param       grid Ci budu udaje v gride alebo nie
         * @return      Vrati array of objects titulov
         * 
         */
        public function get_degrees($grid = false)
        {
            $q = $this->db->query(" SELECT d.degree_id, d.degree_name, d.degree_grade
                                    FROM degrees d
                                  ");
            if ($grid == true) 
                return $q;
            else 
                return $q->result();
        }

        /*
         * get_email_types
         * 
         * Funkcia vrati vsetky polozky z databazy
         * 
         * @access	public
         * @param       grid Ci budu udaje v gride alebo nie
         * @return      Vrati array of objects emailovych typov
         * 
         */
        public function get_email_types($grid = false)
        {
            $q = $this->db->query(" SELECT *
                                    FROM email_types
                                  ");
            if ($grid == true) 
                return $q;
            else 
                return $q->result();
        }

        /*
         * get_event_categories
         * 
         * Funkcia vrati vsetky polozky z databazy
         * 
         * @access	public
         * @param       grid Ci budu udaje v gride alebo nie
         * @return      Vrati array of objects eventovych kategorii
         * 
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
         * get_event_detail
         * 
         * Funkcia vrati podrobne informacie o danom evente
         * 
         * @access	public
         * @param       event_id ID-eventu o ktorom chceme ziskat detajl
         * @return      Vrati objekt typu detajl udalosti
         * 
         */
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
            return $q->row();
        }
        
        /*
         * get_events
         * 
         * Funkcia vrati vsetky eventy danej kategorie z databazy
         * 
         * @access	public
         * @param       per_page Pocet udalosti kolko sa ich ma zobrazit na stranu
         * @param       cur_page Aktualna strana
         * @param       cat_id ID-cko kategorie ktorej eventy chceme zobrazit
         * @param       grid Ci budu udaje v gride alebo nie
         * @return      Vrati array of objects udalosti
         * 
         */
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
                                   LEFT OUTER JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                                   ORDER BY e.event_priority DESC, e.event_created DESC
                                   LIMIT $cur_page, $per_page
                                   ");
             if ($grid == true) return $q;
                    else return $q->result();
           }
        }
        
        /*
         * get_events_newest
         * 
         * Funkcia vrati vsetky eventy danej kategorie z databazy usporiadane od najnovsich po najstarsie
         * 
         * @access	public
         * @param       per_page Pocet udalosti kolko sa ich ma zobrazit na stranu
         * @param       cur_page Aktualna strana
         * @param       cat_id ID-cko kategorie ktorej eventy chceme zobrazit
         * @param       grid Ci budu udaje v gride alebo nie
         * @return      Vrati array of objects najnovsich udalosti
         * 
         */
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
                                   LEFT OUTER JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                                   ORDER BY e.event_created DESC
                                   LIMIT $cur_page, $per_page
                                   ");
             if ($grid == true) return $q;
                    else return $q->result();
           }
        }

        /*
         * get_events_prior
         * 
         * Funkcia vrati vsetky eventy danej kategorie z databazy usporiadane podla priority od najvyssej po najnizsiu
         * 
         * @access	public
         * @param       per_page Pocet udalosti kolko sa ich ma zobrazit na stranu
         * @param       cur_page Aktualna strana
         * @param       cat_id ID-cko kategorie ktorej eventy chceme zobrazit
         * @param       grid Ci budu udaje v gride alebo nie
         * @return      Vrati array of objects udalosti podla priority
         * 
         */
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
                                   LEFT OUTER JOIN event_categories ec ON(e.event_event_category_id=ec.event_category_id)
                                   ORDER BY e.event_priority ASC, e.event_created DESC, e.event_name ASC
                                   LIMIT $cur_page, $per_page
                                   ");
             if ($grid == true) return $q;
                    else return $q->result();
           }
        }

        /*
         * get_fin_redistribution
         * 
         * Funkcia ziska z DB vsetky informacie o tom ako maju byt prerozdelene 
         * peniaze
         * 
         * @access	public
         * @param       payment_id ID-platby ktorej sa to tyka
         * @param       pr_cat_id ID-cko kategorie
         * @return      Vrati array of objects financnej redistribucie penazi
         * 
         */
        public function get_fin_redistribution($payment_id,$pr_cat_id)
        {
            $q = $this->db->query(" SELECT *
                                    FROM fin_redistributes
                                    WHERE fin_redistribute_payment_id=$payment_id AND fin_redistribute_project_category_id$pr_cat_id      
                                   ");
            return $q->result();
        }
        
        /*
         * get_login
         * 
         * Funkcia ziska ID a rolu prihlasovaneho pouzivatela
         * 
         * @access	public
         * @param       param Informacie vratene POST-om
         * @return      Vrati objekt typu pouzivatel(user_id,user_role)
         * 
         */
        public function get_login( $param )
        {
            $q = $this->db->query(" SELECT user_id, user_role
                                    FROM users
                                    WHERE user_username = '".$param['username']."' AND
                                          user_password = '".sha1($param['password'])."'
                                  ");   
            return $q->row();
        }
        
        /*
         * get_page
         * 
         * Funkcia ziska zobrazovani text na danej podstranke
         * 
         * @access	public
         * @param       view nazov podstranky
         * @return      Vrati objekt typu page
         * 
         */
        public function get_page($view)
        {
            $q = $this->db->query(" SELECT page_$view
                                    FROM pages
                                    WHERE page_$view = page_$view
                                  ");

            return $q->row();
        }

        /*
         * get_payment_detail
         * 
         * Funkcia ziska vsetky informacie o detajle platby
         * 
         * @access	public
         * @param       payment_id ID-cko platby ktorej udaje chceme ziskat
         * @return      Vrati objekt typu detajl platby
         * 
         */
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
                    $payment['categories'][$r->fin_redistribute_project_category_id] = $r->fin_redistribute_ratio;
		}
            }
            return $payment;
	}
    
        /*
         * get_payments
         * 
         * Funkcia vrati vsetky platby alebo vsteky platby daneho usera
         * 
         * @access	public
         * @param       per_page Pocet platieb zobrazenych na stranu
         * @param       cur_page Aktualna strana
         * @param       user_id ID-cko pouzivatela ktoreho platby chceme ziskat
         * @param       grid Default false. Ci chceme udaje zobrazit v gride alebo nie
         * @return      Vrati array of objects platieb
         * 
         */
        public function get_payments( $per_page = 0, $cur_page = 0, $user_id, $grid = false)
        {
            if($user_id == 0){
                $q = $this->db->query(" SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                              p.payment_paid_sum, p.payment_paid_time, p.payment_id, p.payment_accepted
                                        FROM payments p
                                        LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                        LIMIT $cur_page, $per_page
                                      ");
                if ($grid == true) 
                    return $q;
                else 
                    return $q->result();
            }   
            else 
            {
                $q = $this->db->query(" SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                                  p.payment_paid_sum, p.payment_paid_time, p.payment_id, p.payment_accepted
                                            FROM payments p
                                            LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                            WHERE u.user_id = $user_id
                                            LIMIT $cur_page, $per_page
                                          ");
                    if ($grid == true) 
                        return $q;
                    else 
                        return $q->result();
            }
        }

        /*
         * get_payments_lastpaid
         * 
         * Funkcia vrati poslednu platbu daneho usera
         * 
         * @access	public
         * @param       user_id ID usera ktoreho platbu chceme ziskat
         * @return      Vrati objekt typu posledna uhradena clenska platba
         * 
         */
         public function get_payments_lastpaid($user_id)
         {
             $q = $this->db->query("
                                        SELECT p.payment_type, p.payment_paid_sum, p.payment_paid_time, 
                                               p.payment_total_sum, p.payment_id, u.user_id, p.payment_accepted
                                          FROM payments p
                                          LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                           WHERE u.user_id = $user_id AND p.payment_type = 1
                                          ORDER BY p.payment_paid_time DESC                            
                                      ");
                return $q->row();
        }

        /*
         * get_payments_nopaid
         * 
         * Funkcia vrati vsetky nezaplatene platby alebo vsteky nezaplatene platby daneho usera
         * 
         * @access	public
         * @param       per_page Pocet platieb zobrazenych na stranu
         * @param       cur_page Aktualna strana
         * @param       user_id ID-cko pouzivatela ktoreho platby chceme ziskat
         * @param       grid Default false. Ci chceme udaje zobrazit v gride alebo nie
         * @return      Vrati array of objects nezaplatenych platieb
         * 
         */
        public function get_payments_nopaid( $per_page = 0, $cur_page = 0, $user_id, $grid = false )
        {
            if($user_id==0){
                $q = $this->db->query("
                                        SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                              p.payment_paid_sum, p.payment_paid_time, p.payment_id, p.payment_accepted
                                          FROM payments p
                                          LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                           WHERE p.payment_paid_sum<p.payment_total_sum
                                          ORDER BY p.payment_paid_time DESC
                                          LIMIT $cur_page, $per_page

                                      ");
            } 
            else{
            $q = $this->db->query("       SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                              p.payment_paid_sum, p.payment_paid_time, p.payment_id, p.payment_accepted
                                          FROM payments p
                                          LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                           WHERE u.user_id=$user_id AND p.payment_paid_sum<p.payment_total_sum
                                          ORDER BY p.payment_paid_time DESC
                                          LIMIT $cur_page, $per_page
                                      ");
            }
                if ($grid == true) return $q;
                            else return $q->result();
        }

        /*
         * get_payments_paid
         * 
         * Funkcia vrati vsetky zaplatene platby alebo vsteky zaplatene platby daneho usera
         * 
         * @access	public
         * @param       per_page Pocet platieb zobrazenych na stranu
         * @param       cur_page Aktualna strana
         * @param       user_id ID-cko pouzivatela ktoreho platby chceme ziskat
         * @param       grid Default false. Ci chceme udaje zobrazit v gride alebo nie
         * @return      Vrati array of objects zaplatenych platieb
         * 
         */
        public function get_payments_paid( $per_page = 0, $cur_page = 0, $user_id, $grid = false )
        {
            if($user_id==0)
            {
                $q = $this->db->query("
                                        SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                              p.payment_paid_sum, p.payment_paid_time, p.payment_id, p.payment_accepted
                                          FROM payments p
                                          LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                          WHERE p.payment_paid_sum>=p.payment_total_sum
                                          ORDER BY p.payment_paid_time DESC
                                          LIMIT $cur_page, $per_page
                                      ");
            }
            else
            {
            $q = $this->db->query("
                                        SELECT CONCAT(CONCAT(u.user_name,' '),u.user_surname) AS user_name, u.user_id, p.payment_type, p.payment_vs, p.payment_total_sum,
                                              p.payment_paid_sum, p.payment_paid_time, p.payment_id, p.payment_accepted
                                          FROM payments p
                                          LEFT JOIN users u ON (p.payment_user_id=u.user_id)
                                          WHERE (u.user_id=$user_id) AND (p.payment_paid_sum>=p.payment_total_sum)
                                          ORDER BY p.payment_paid_time DESC
                                          LIMIT $cur_page, $per_page
                                      ");
            }
            if ($grid == true) 
                return $q;
            else 
                return $q->result();
        }
    
        /*
         * get_post_detail
         * 
         * Funkcia vrati detail o danom prispevku
         * 
         * @access	public
         * @param       post_id ID prispevku ktoreho deily chceme ziskat
         * @return      Vrati objekt typu detajl prispevku
         * 
         */
        public function get_post_detail($post_id)
        {
                 $q = $this->db->query("SELECT p.post_title, p.post_content, p.post_author_id, p.post_published,
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

        /*
         * get_post_modifiers
         * 
         * Funkcia vrati vsetkych pouzivatelov ktori modifikovali dani prispevok
         * 
         * @access	public
         * @param       post_id ID prispevku ktorych modifikatorov chceme ziskat
         * @return      Vrati array of objects modifikatorov daneho prispevku
         * 
         */
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

        /*
         * get_posts
         * 
         * Funkcia vrati vsetky prispevky
         * 
         * @access	public
         * @param       per_page Pocet prispevkov zobrazenych na stranu
         * @param       cur_page Aktualna strana
         * @param       unpublished Default false. Ziskavame publikovane alebo nepublikovane clanky
         * @return      Vrati array of objects vsetkych prispevkov
         * 
         */
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
    
        /*
         * get_project_categories
         * 
         * Funkcia vrati vsetky projektove kategorie z databazy
         * 
         * @access	public
         * @return      Vrati array of objects projektovych kategorii
         */
        public function get_project_categories($grid = false)
        {
               $q = $this->db->query("  SELECT p_c.project_category_id, p_c.project_category_name, p_c.project_category_cash, proj.booked_cash
                                        FROM(
                                            SELECT project_project_category_id, sum(project_booked_cash) AS booked_cash
                                            FROM projects
                                            WHERE project_active = 1
                                            GROUP BY(project_project_category_id)
                                        ) proj
                                        RIGHT JOIN project_categories p_c ON (proj.project_project_category_id = p_c.project_category_id)
                                      ");
                if ($grid == true) return $q;
                    else return $q->result();
        }

        /*
         * get_project_categories_total_cash
         * 
         * Funkcia vrati celkovu sumu na kategoriach
         * 
         * @access	public
         * @return      Vrati objekt typu suma na projektovej kategorii
         * 
         */
        public function get_project_categories_total_cash()
        {
                $q = $this->db->query(" SELECT sum(project_category_cash) AS total_sum
                                        FROM project_categories
                                      ");
                return $q->row()->total_sum;
        }
        
        /*
         * get_project_detail
         * 
         * Funkcia vrati vsetky informacie o danom projekte
         * 
         * @access	public
         * @param       project_id ID projektu ktoreho informacie chceme
         * @return      Vrati objekt typu detajl projektu
         * 
         */
        public function get_project_detail($project_id)
        {
                $q = $this->db->query(" SELECT p.project_name, p.project_about, p.project_priority, 
                                               p.project_project_category_id, p.project_booked_cash, 
                                               sum(pi.project_item_price) AS project_spended_cash,
                                               p.project_date_from, p.project_date_to, p.project_active,
                                               p_c.project_category_name
                                        FROM project_items pi
                                        RIGHT JOIN projects p ON (pi.project_item_project_id=p.project_id)
                                        LEFT JOIN project_categories p_c ON (p.project_project_category_id = p_c.project_category_id)
                                        WHERE project_id=$project_id
                                      ");
                return $q->result();
        }

        /*
         * get_project_items
         * 
         * Funkcia vrati vsetky polozky ktore sa viazu na dany projekt
         * 
         * @access	public
         * @param       project_id ID projektu
         * @param       grid Default false, zalezi kam chceme vysledok zobrazit
         * @return      Vrati array of objects projektovych poloziek
         * 
         */
        public function get_project_items( $project_id, $grid = false )
        {
                $q = $this->db->query(" SELECT piu.project_item_name, piu.project_item_price,
                                               u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                               piu.project_item_date, piu.project_item_id
                                        FROM project_items piu
                                        LEFT JOIN users u on (piu.project_item_user_id = u.user_id)
                                        WHERE piu.project_item_project_id=$project_id
                                      ");
                if ($grid == true) 
                    return $q;
                else 
                    return $q->result();
        }
    
        /*
         * get_projects
         * 
         * Funkcia vrati vsetky projekty danej kategorie
         * 
         * @access	public
         * @param       cat_id ID-kategorie
         * @param       grid Default false, pojednava ci sa maju zobrazit do gridu
         * @return      Vrati array of objects projektov
         * 
         */
        public function get_projects($cat_id, $grid = false)
        {
                    if ($cat_id == 0)
                    {
                            $q = $this->db->query("SELECT  p.project_name, pc.project_category_id, pc.project_category_name, p.project_booked_cash, p.project_date_from, 
                                                p.project_date_to, sum(pi.project_item_price) AS project_spended_cash,
                                                pi.project_item_id, p.project_id, p.project_active
                                        FROM project_items pi
                                        RIGHT JOIN projects p ON (pi.project_item_project_id = p.project_id)
                                        LEFT OUTER JOIN project_categories pc ON (p.project_project_category_id = pc.project_category_id)
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
            if ($grid == true) return $q;
                    else return $q->result();
        }

        /*
         * get_study_programs
         * 
         * Funkcia vrati vsetky polozky z databazy
         * 
         * @access	public
         * @param       grid default false, hovori otocm ci sa maju polozky zobrazit do gridu
         * @return      array of objects studijnych programov
         * 
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
         * get_transactions
         * 
         * Funkcia vrati vsetky tranzakcie ktore boli vykonane and danou kategoriou
         * 
         * @access	public
         * @param       pr_cat_id ID kateogire ktorej sa to tyka
         * @return      Vrati array of objects tranzakcii na kategoriach
         * 
         */
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

        /*
         * get_user_detail
         * 
         * Funkcia vrati vsetky informacie o danom pouzivatelovi
         * 
         * @access	public
         * @param       user_id ID pouzivatela
         * @return      Vrati array of object detajlu na pouzivatela
         * 
         */
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
    
        /*
         * get_users
         * 
         * Funkcia vrati vsetky polozky z databazy z tabulky pouzivatelov
         * 
         * @access	public
         * @param       per_page celkovy pocet zaznamov
         * @param       cur_page aktualna strana
         * @param       role Pouzivatelska rola
         * @param       grid Defaultne je false. Hovori o tom ci sa maju udaje zobrazit do gridu
         * @return      Vrati array of objects pouzivatelov
         * 
         */
        public function get_users( $per_page = 0, $cur_page = 0, $role, $grid = false )
        {
            $user_role = 0;
            
            switch($role)
            {
                case 1:
                    $user_role = 1;
                    break;
                case 2:
                    $user_role = 2;
                    break;
                case 3:
                    $user_role = 3;
                    break;
                case 4:
                    $q = $this->db->query(" SELECT  u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                                u.user_email, u.user_phone, u.user_degree_year, 
                                                sp.study_program_name, d.degree_name, u.user_postcode 
                                        FROM users u
                                        LEFT JOIN degrees d ON (u.user_degree_id = d.degree_id)
                                        LEFT JOIN study_programs sp ON (u.user_study_program_id = sp.study_program_id)
                                        WHERE u.user_activated = '0000-00-00 00:00:00' AND u.user_exempted = 0
                                        LIMIT $cur_page, $per_page
                                      ");
                    break;
                case 5:
                    $actualDateTime = date("Y-m-d  H:i:s");
                    $q = $this->db->query(" SELECT  u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                                u.user_email, u.user_phone, u.user_degree_year, 
                                                sp.study_program_name, d.degree_name, u.user_postcode 
                                        FROM users u
                                        LEFT JOIN degrees d ON (u.user_degree_id = d.degree_id)
                                        LEFT JOIN study_programs sp ON (u.user_study_program_id = sp.study_program_id)
                                        WHERE u.user_activated >= '".$actualDateTime."' AND u.user_exempted = 0 AND u.user_activated != '0000-00-00 00:00:00' 
                                        LIMIT $cur_page, $per_page
                                      ");
                    break;
                default:
                    $q = $this->db->query(" SELECT  u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                                u.user_email, u.user_phone, u.user_degree_year, 
                                                sp.study_program_name, d.degree_name, u.user_postcode 
                                        FROM users u
                                        LEFT JOIN degrees d ON (u.user_degree_id = d.degree_id)
                                        LEFT JOIN study_programs sp ON (u.user_study_program_id = sp.study_program_id)
                                        LIMIT $cur_page, $per_page
                                      ");
                    break;
            }
            if($role == 1 || $role == 2 || $role == 3)
                $q = $this->db->query(" SELECT  u.user_id, CONCAT(CONCAT(u.user_name,' '), u.user_surname) as user_name, 
                                                u.user_email, u.user_phone, u.user_degree_year, 
                                                sp.study_program_name, d.degree_name, u.user_postcode 
                                        FROM users u
                                        LEFT JOIN degrees d ON (u.user_degree_id = d.degree_id)
                                        LEFT JOIN study_programs sp ON (u.user_study_program_id = sp.study_program_id)
                                        WHERE u.user_role=$user_role
                                        LIMIT $cur_page, $per_page
                                      ");
            if ($grid == true) 
                return $q;
                    else 
                return $q->result();
        }
        
        /*
         * get_users_filter
         * 
         * Funkcia vrati userom ktori vzhovuju filtracnzm podmienkam
         * 
         * @access	public
         * @param       values Informacie ktoru vrati POST
         * @return      Vrati array of objects vyfiltrovanych pouzivatelov
         * 
         */
        public function get_users_filter($values)
        {
            $this->db->select('u.user_id, u.user_name, u.user_surname, u.user_email,
                               d.degree_name, sp.study_program_name, 
                               u_e_e.user_email_evidence_date, u_e_e.user_email_evidence_email_type_id')
                     ->from('user_email_evidence u_e_e');

            $this->db->join('users u', 'u_e_e.user_email_evidence_user_id = u.user_id','right');
            $this->db->join('degrees d', 'u.user_degree_id = d.degree_id','left');
            $this->db->join('study_programs sp', 'u.user_study_program_id = sp.study_program_id','left');

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
                if( $result != array() )
                    return $this->selecter->get_users_filter_on_payments($result, $values['payment_time']);
                else
                    return null;
            else
            {
                $query->free_result();
                return $result;  
            }
        }
        
        /*
         * get_users_filter_on_payments
         * 
         * Funkcia vrati vyfiltrovanych userov nazakalde ci uhradili alebo neuhradili clensky poplatok
         * 
         * @access	public
         * @param       users Array of objects pouzivatelov
         * @param       paymenent_value Suma penazi
         * @return      Vrati array of objects vyfiltrovanych pouzivatelov aj s platbami
         * 
         */
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
            foreach ( $payments_value as $value ) 
            {
                switch ( $value ) 
                {
                    case 1:
                        foreach ( $lastPayments as $value ) 
                        {
                            if( isset( $value->payment_paid_sum ) )
                            {
                               if( $value->payment_paid_sum >= $value->payment_total_sum )
                               {
                                   array_push( $userIDS, $value->user_id );
                               }
                            }         
                        }
                        break;
                    case 2:
                        foreach ( $lastPayments as $value ) 
                        {
                            if( isset( $value->payment_paid_sum ) )
                            {
                               if( $value->payment_paid_sum < $value->payment_total_sum )
                               {
                                   array_push( $userIDS, $value->user_id );
                               }
                            }         
                        }
                        break;
                }
            }

            if( $userIDS != array() )
            {
                $this->db->where_in('user_id',$userIDS);
                $query = $this->db->get();
                $result = $query->result();
                $query->free_result();
                return $result;
            }
            else
                return null;
            
        }
        
        
        /*
         * PaymentsInDatabase
         * 
         * Funkcia vrati pocet zaznamov z platieb daneho typu zaplatene, nezaplatene, vsetky
         * 
         * @access	public
         * @param       table Nazov tabulky
         * @param       id ID zaznamu platby
         * @param       user_id ID pouzivatela
         * @param       pay_type Typ platby
         * @return      Vrati pocet platieb danheo usera
         * 
         */
        public function PaymentsInDatabase( $table, $id, $user_id, $pay_type )
        {
            $totalPays = $this->rows($table, $id);
            if ($pay_type == 0)
               return count($this->get_payments ($totalPays, 0, $user_id));
            else if($pay_type == 1)
               return count($this->get_payments_paid($totalPays, 0, $user_id));
            else if($pay_type == 2)
               return count($this->get_payments_nopaid($totalPays, 0, $user_id));
        }           
}

/* End of file selecter.php */
/* Location: ./application/models/selecter.php */