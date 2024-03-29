<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Alumni FMFI
 * 
 * Aplikacia na spravu OZ Alumni FMFI
 *
 * @package		AlumniFMFI
 * @author		Tutifruty Team
 * @link		http://kempelen.ii.fmph.uniba.sk
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 *  Inserter class
 *
 * @package		AlumniFMFI
 * @subpackage          Models
 * @category            Inserter
 * @author		Tutifruty Team
 */

// ------------------------------------------------------------------------
class Inserter extends MY_Model
{
    /**
     * add_degree
     * 
     * Funkcia prida novy zaznam do tabulky degrees
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
    public function add_degree($values)
    {
        $this->db->query("INSERT INTO degrees
                          (degree_name, degree_grade)
                          VALUES ('".$values['degree_name']."','".$values['degree_grade']."')
                        "); 
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    /**
     * add_email_log
     * 
     * Funkcia prida novy zaznam do tabulky user_email_evidence
     * 
     * @param       integer $email_typ_id ID typu emaila
     * @param       integer $user_ids zoznam IDciek pouzivatelov
     * @return      boolean
     */
    public function add_email_log($email_typ_id, $user_ids)
    {
       foreach($user_ids as $user_id){
         $this->db->query("INSERT INTO user_email_evidence
                           (user_email_evidence_email_type_id, user_email_evidence_user_id)
                           VALUES ('".$email_typ_id."','".$user_id."')
                         ");
       }
      if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    /**
     * add_email_type
     * 
     * Funkcia prida novy zaznam do tabulky email_types
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
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
    
    /**
     * add_event
     * 
     * Funkcia prida novy zaznam do tabulky events
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
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
    
    /**
     * add_event_category
     * 
     * Funkcia prida novy zaznam do tabulky event_categories
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
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
    
    /**
     * add_payments
     * 
     * Funkcia zaeviduje novu platbu do tabulky payments a taktiez vykona zapis
     * do tabulky fin_redistributes kde zapise v akom pomere sa maju rozdelit
     * peniaze od pouzivatelov
     * 
     * @param       array $values
     * @return      boolean
     */
    public function add_payments($values)
    {
        if(isset($values['payment_type']))
        {
            $this->db->query("INSERT INTO payments
                               ( payment_vs, payment_user_id, payment_total_sum, payment_paid_sum, payment_type, payment_accepted)
                               VALUES ('".$values['payment_vs']."','".$values['user_id']."','".$values['total_sum']."','0','".$values['payment_type']."', 0)
                             ");
            $payment_id = $this->db->insert_id();
            foreach($values['categories'] as $key=>$value )
            {
                $this->db->query("INSERT INTO fin_redistributes
                                   (fin_redistribute_payment_id,fin_redistribute_project_category_id, fin_redistribute_ratio)
                                   VALUES ('".$payment_id."', '".$key."', '".$value."')
                                 ");
            }
            if( $this->db->affected_rows() > 0 )
                return TRUE;
            else
                return FALSE;
        }
        else
            return FALSE;
    }
    
    /**
     * add_post
     * 
     * Funkcia prida novy zaznam do tabulky posts
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
    public function add_post( $values )
    {
        $this->db->query("INSERT INTO posts
                           ( post_priority, post_title, post_author_id, post_content, post_published )
                           VALUES ( '".$values['priority']."', '".$values['title']."', 
                                    '".$this->session->userdata('user')."', '".$values['content']."', '".$values['post_published']."'
                                   )
                         ");
        if( $this->db->affected_rows() > 0 )
            return TRUE;
        else
            return FALSE;
    }
    
    /**
     * add_project
     * 
     * Funkcia prida novy zaznam do tabulky projects
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
    public function add_project($values)
    {
      $this->db->query("INSERT INTO projects
                           ( project_name, project_about, project_priority, project_project_category_id, project_booked_cash,project_active, project_date_from, project_date_to)
                           VALUES ('".$values['name']."','".$values['about']."','".$values['priority']."','".$values['project_category_id']."','".$values['booked_cash']."',1,'". format_date($values['from'])."','".format_date($values['to'])."')
                         ");
      if($this->db->affected_rows()>0)
        return TRUE;
      else
          return FALSE;
    }
    
    /**
     * add_project_category
     * 
     * Funkcia prida novy zaznam do tabulky project_categories
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
    public function add_project_category($values)
    {
        $this->db->query("INSERT INTO project_categories
                           ( project_category_name, project_category_cash)
                           VALUES ('".$values['project_category_name']."','0')
                         ");
       if($this->db->affected_rows()>0){ 
        return TRUE;
      }
      else{ return FALSE;}
    }
    
    /**
     * add_project_item
     * 
     * Funkcia prida novy zaznam do tabulky project_items
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
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
    
    /**
     * add_register
     * 
     * Funkcia prida novy zaznam do tabulky users ak sa v nej este nevyskytuje 
     * z pohladu registacie na frontende. Ak sa dany pouzivatel s emailov 
     * adresou uz nachadza v databaze tak sa iba aktualizuju jeho udaje a prida 
     * sa nova platba do tabulky payments a prerozdelenie jeho penazi do tabulky 
     * fin_redistributes.
     * 
     * @param       array $param Vstupne údaje z POSTu
     * @return      boolean
     */
    public function add_register($param)
    {
        $q  = $this->db->query("SELECT user_id FROM users WHERE user_name = '".$param['name']."' AND 
                                                                user_surname = '".$param['surname']."' AND 
                                                                user_email = '".$param['email']."' AND
                                                                user_role = 3");
        $q2 = $this->db->query("SELECT user_username FROM users WHERE user_name = '".$param['name']."' AND 
                                                                user_surname = '".$param['surname']."' AND 
                                                                user_email = '".$param['email']."' AND
                                                                user_role != 3");
        $user_id = 0;
        if( $q->num_rows() > 0)
        {
            $this->db->query("UPDATE users 
                                SET user_username='".$param['username']."',
                                    user_name='".$param['name']."',
                                    user_password='".sha1($param['password'])."',
                                    user_surname='".$param['surname']."',
                                    user_email='".$param['email']."',
                                    user_phone='".$param['phone']."',
                                    user_study_program_id='".$param['study_program_id']."',
                                    user_degree_id='".$param['degree_id']."',
                                    user_place_of_birth='".$param['place_of_birth']."',
                                    user_postcode='".$param['postcode']."',
                                    user_role='2',
                                    user_degree_year='".$param['degree_year']."',
                                    user_activated = NULL
                                WHERE user_id='".$q->row()->user_id."'");
            $user_id = $q->row()->user_id;
        }   
        else
        {
            if($q2->row()->user_email != $param['email'])
            {
                $this->db->query("  INSERT INTO users 
                                (user_name, user_surname, user_role, user_username, user_password, user_email, user_phone,
                                user_study_program_id, user_degree_id, user_place_of_birth, user_postcode, user_degree_year)
                                VALUES
                                ('".$param['name']."', '".$param['surname']."', 2, '".$param['username']."',
                                 '".sha1($param['password'])."', '".$param['email']."', '".$param['phone']."',
                                 '".$param['study_program_id']."', '".$param['degree_id']."', 
                                 '".$param['place_of_birth']."', '".$param['postcode']."', '".$param['degree_year']."')
                             ");
                $user_id = $this->db->insert_id();
            }
            else
                return FALSE;
        }   
            $this->db->query("  INSERT INTO payments
                                (payment_vs, payment_total_sum, payment_user_id, payment_type)
                                VALUES
                                ('".$this->input->post('vs')."','".$this->input->post('total_sum')."', '".$user_id."', 1)
                             ");
            $payment_id = $this->db->insert_id();
            $q = 'INSERT INTO fin_redistributes (fin_redistribute_payment_id, fin_redistribute_project_category_id, fin_redistribute_ratio) VALUES ';
            $first = true;
            foreach ($param['categories'] as $cat_id => $ratio)
            {
            	if (!$first) $q .= ', ';
            	$q .= "('".$payment_id."', '".$cat_id."', '".$ratio."')";
		$first = false;
            }
            $q .= ';';
		
            return $this->db->query($q);
    }
    
    /**
     * add_study_program
     * 
     * Funkcia prida novy zaznam do tabulky study_programs
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
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
    
    /**
     * add_transaction
     * 
     * Funkcia prida novy zaznam do tabulky fin_category_transactions
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
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
    
    /**
     * add_user
     * 
     * Funkcia sluzi na manualne pridanie noveho zaznam do tabulky users ak sa 
     * v nej este nevyskytuje z administratorskeho rozhrania. Ak sa dany 
     * s emailov adresou uz nachadza v databaze tak sa iba aktualizuju jeho udaje 
     * prida sa nova platba do tabulky payments a prerozdelenie jeho penazi do 
     * tabulky fin_redistributes. Uzivatel taktiez moze byt oslobodeny od platenia
     * clenskeho v pripade ak tak ucini administrator stranky. V takom pripade sa
     * pridanie zaznamu do payments a fin_redistributes ignoruje.
     * 
     * @param       array $values Vstupne údaje z POSTu
     * @return      boolean
     */
    public function add_user( $values )
    {
        $q  = $this->db->query("SELECT user_id FROM users WHERE user_name = '".$param['name']."' AND 
                                                                user_surname = '".$param['surname']."' AND 
                                                                user_email = '".$param['email']."' AND
                                                                user_role = 3");
        $q2 = $this->db->query("SELECT user_username FROM users WHERE user_name = '".$param['name']."' AND 
                                                                user_surname = '".$param['surname']."' AND 
                                                                user_email = '".$param['email']."' AND
                                                                user_role != 3");$user_id = 0;
        $is_exempted = 0;
        
        if( $q->num_rows() > 0 )
        {
            $this->db->query("UPDATE users 
                                SET user_username='".$values['username']."',
                                    user_name='".$values['name']."',
                                    user_password='".sha1($values['password'])."',
                                    user_surname='".$values['surname']."',
                                    user_email='".$values['email']."',
                                    user_phone='".$values['phone']."',
                                    user_study_program_id='".$values['study_program_id']."',
                                    user_degree_id='".$values['degree_id']."',
                                    user_place_of_birth='".$values['place_of_birth']."',
                                    user_postcode='".$values['postcode']."',
                                    user_role='2',
                                    user_degree_year='".$values['degree_year']."',
                                    user_activated = NULL  
                                WHERE user_id='".$q->row()->user_id."'");
            $user_id = $q->row()->user_id;
        }
        else
        {
            if( $q2->row()->user_email != $values['email'] )
            {
                switch( $values['role'] )
                {
                    case 1:
                        $is_exempted = 1;
                        break;
                    case 2:
                        if( !isset($values['checkbox']) )
                            $is_exempted = 1;
                        break;
                }

                $this->db->query("  INSERT INTO users 
                                (user_name, user_surname, user_role, user_username, user_password, user_email, user_phone,
                                user_study_program_id, user_degree_id, user_place_of_birth, user_postcode, user_degree_year,
                                user_exempted)
                                VALUES
                                ('".$values['name']."', '".$values['surname']."','".$values['role']."', '".$values['username']."',
                                 '".sha1($values['password'])."', '".$values['email']."', '".$values['phone']."',
                                 '".$values['study_program_id']."', '".$values['degree_id']."', 
                                 '".$values['place_of_birth']."', '".$values['postcode']."', '".$values['degree_year']."',
                                 '".$is_exempted."')
                             ");

                $user_id = $this->db->insert_id();
            }
            else
            {
                return FALSE;
            }
        }
        
        if( $values['checkbox'] == 1 )
        {
            $this->db->query("  INSERT INTO payments
                                (payment_vs, payment_total_sum, payment_user_id, payment_type)
                                VALUES
                                ('".$values['vs']."','".$values['total_sum']."', '".$user_id."', 1)
                             ");
            
            $payment_id = $this->db->insert_id();
            $q = 'INSERT INTO fin_redistributes (fin_redistribute_payment_id, fin_redistribute_project_category_id, fin_redistribute_ratio) VALUES ';
		$first = true;
		foreach ($values['categories'] as $cat_id => $ratio)
		{
			if (!$first) $q .= ', ';
			$q .= "('".$payment_id."', '".$cat_id."', '".$ratio."')";
			$first = false;
		}
		$q .= ';';
		
		return $this->db->query($q);
        }
        else
            if( $this->db->affected_rows() > 0 ) 
                return TRUE;
            else
                return FALSE;
    }
}   
    

/* End of file inserter.php */
/* Location: ./application/models/inserter.php */