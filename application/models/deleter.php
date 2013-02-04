<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deleter extends MY_Model
{
        /*
         * remove_degree
         * 
         * Funkcia zmaze z tabulky degrees zaznam a prislusnym zaznamom v tabulke users 
         * nastavi null
         * 
         * @access	public
         * @param degree_id ID-cko titulu ktory sa ma zmazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_degree($degree_id)
        {   
            $this->db->query("DELETE FROM degrees WHERE degree_id=$degree_id");

            if($this->db->affected_rows()>0)
            {
              $this->db->query("UPDATE users 
                                SET user_degree_id=NULL 
                                WHERE user_degree_id=$degree_id");
                return TRUE;
            }
            else
                return FALSE;
        }

        /*
         * remove_email_type
         * 
         * Funkcia vymaze zaznam z tabulky email_types a prisluchajucim polozkam
         * v tabulke user_email_evidence nastavi null
         * 
         * @access	public
         * @param e_type_id ID-cko typu emailu ktory sa ma vymazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_email_type($e_type_id)
        {
            $this->db->query("DELETE FROM email_types WHERE email_type_id=$e_type_id");
            if($this->db->affected_rows()>0){
              $this->db->query("UPDATE user_email_evidence 
                                SET user_email_evidence_email_type_id=NULL 
                                WHERE user_email_evidence_email_type_id=$e_type_id");
                return TRUE;
            }
            else{ return FALSE; }
        }

        /*
         * remove_event
         * 
         * Funkcia vymaze zaznam z tabulky events
         * 
         * @access	public
         * @param ev_id ID-cko eventu ktory sa ma vymazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_event($ev_id)
        {
            $this->db->query("DELETE FROM events WHERE event_id=$ev_id");
            if($this->db->affected_rows()>0)
              return TRUE;
            else
                return FALSE;
        }

        /*
         * remove_event_category
         * 
         * Funkcia vymaze eventovu kategoriu z databazy
         * 
         * @access	public
         * @param ev_cat_id ID-cko prave mazanej kategorie
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
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

        /*
         * remove_payments
         * 
         * Funkcia zmaze zaznam z tabulky payments a k nemu prisluchajuce zaznamy v tabulke fin_redistributes
         * 
         * @access	public
         * @param payment_id ID-cko platby
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_payments($payment_id)
        {
            $this->db->query("DELETE FROM fin_redistributes WHERE fin_redistribute_payment_id=$payment_id");
            $this->db->query("DELETE FROM payments WHERE payment_id=$payment_id");
        }

        /*
         * remove_post
         * 
         * Funkcia vymaze dany prispevok a ak existuju k nemu zaznamy v tabulke 
         * post_modifies tak vymaze aj tie
         * 
         * @access	public
         * @param post_id ID-cko daneho clanku co sa ma vymazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_post($post_id)
        {
            $this->db->query("DELETE FROM post_modifies
                              WHERE post_modifie_post_id=$post_id");  
            $this->db->query("DELETE FROM posts WHERE post_id=$post_id");
            return TRUE;
        }

        /*
         * remove_project
         * 
         * zmaze zaznam z tabulky projects a k nemu prislusne zaznamy z tabulky project_items ak existuju
         * 
         * @access	public
         * @param pr_id ID-cko projektu
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_project($pr_id)
        {
            $this->db->query("DELETE FROM project_items WHERE project_item_project_id=$pr_id"); 
            $this->db->query("DELETE FROM projects WHERE project_id=$pr_id");    
            return TRUE;
        }

        /*
         * remove_project_category
         * 
         * Funkcia vymaze  Projektovu kategoriu z databazy
         * 
         * @access	public
         * @param pr_cat_id ID-cko prave mazanej kategorie
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_project_category($pr_cat_id)
        {
            $categories = $this->db->query(" SELECT project_category_id 
                                             FROM project_categories
                                             WHERE project_category_id != $pr_cat_id
                                           ");
            $totalCategories = $categories->num_rows;

            $q = $this->db->query(" SELECT project_category_cash 
                                    FROM project_categories
                                    WHERE project_category_id = $pr_cat_id
                                  ");
            $totalAmount = $q->row()->project_category_cash;
            $q->free_result();

            $onePieceOfRatio = round($totalAmount / $totalCategories, 2);

            $checkSum = $totalCategories * $onePieceOfRatio;

            foreach ($categories->result() as $category) 
            {
                $cashPerCategory = $onePieceOfRatio*1;
                $this->db->query("  UPDATE project_categories
                                    SET project_category_cash = project_category_cash+$cashPerCategory
                                    WHERE project_category_id = $category->project_category_id
                                 ");
            }

            if($checkSum != $totalAmount)
            {
                $balance = $totalAmount - $checkSum;
                $randomCategory = rand( 1, $totalCategories );

                $this->db->query("  UPDATE project_categories
                                    SET project_category_cash = project_category_cash+$balance
                                    WHERE project_category_id = $randomCategory
                                 ");
            }

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
            else
                return FALSE;
        }

        /*
         * remove_project_item
         * 
         * Zmaze zaznam z tabulky project_items
         * 
         * @access	public
         * @param pr_item_id ID-cko project itemu ktory sa ma zmazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
        public function remove_project_item($pr_item_id)
        {
            $this->db->query("DELETE FROM project_items WHERE project_item_id=$pr_item_id");
            if($this->db->affected_rows()>0){
              return TRUE;
            }
            else{ return FALSE; }
        }

        /*
         * remove_study_program
         * 
         * Funkcia vymaze zaznam z tabulky study_programs a prislusnym hodnotam v users nastavi null
         * 
         * @access	public
         * @param study_pr_id ID-cko studijneho programu ktory sa ma zmazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
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

        /*
         * remove_user
         * 
         * Funkcia vymaze pouzivatela zo systemu
         * 
         * @access	public
         * @param user_id ID pouzivatela ktory sa ma vymazat
         * @return Vrati boolean ci sa odstranil dany zaznam
         * 
         */
         public function remove_user($user_id)
         {
              $this->db->query("INSERT INTO user_cleans (user_clean_date) VALUES (CURRENT_TIMESTAMP)");
              $id= $this->db->insert_id();

              $this->db->query("DELETE FROM payments
                                WHERE payment_user_id=$user_id AND payment_accepted = 0");
              
              $this->db->query("UPDATE payments
                                SET payment_user_id = NULL
                                WHERE payment_user_id=$user_id AND payment_accepted = 1");

              $this->db->query("DELETE FROM user_email_evidence
                                WHERE user_email_evidence_user_id=$user_id");


              $this->db->query("UPDATE events
                                SET event_author_id=NULL 
                                WHERE event_author_id=$user_id");

              $this->db->query("UPDATE project_items
                                SET project_item_user_id=NULL 
                                WHERE project_item_user_id=$user_id");
              $this->db->query("UPDATE posts
                                SET post_author_id=NULL 
                                WHERE post_author_id=$user_id");
              $this->db->query("UPDATE post_modifies
                                SET post_modifie_author_id=NULL 
                                WHERE post_modifie_author_id=$user_id");
              
              $this->db->query("DELETE FROM users WHERE user_id=$user_id");
        }
}

/* End of file deleter.php */
/* Location: ./application/models/deleter.php */