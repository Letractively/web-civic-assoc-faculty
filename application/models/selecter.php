<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Selecter extends MY_Model
{
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
        $q = $this->db->query(" SELECT * 
                                FROM degrees
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
    
    public function get_project_categories()
    {
        
    }
    public function get_email_types(){}
    public function get_event_categories(){}
    public function get_users(){}
    public function get_user_detail($user_id){}
    public function get_nopaid_payments($user_id){}
    public function get_events($user_id){}
    public function get_excursion_events($user_id){}
    public function get_event_detail($event_id){}
    //public function get_excursion_events($excursion_id){}
    public function get_excursion_event_free($excursion_event_id){}
    public function get_excursion_detail($excursion_id){}
    public function get_lecturers(){}
    //public function get_lecturers($ex_event_id){}
    public function get_excursion_event_detail($ex_event_id){}
    public function get_posts(){}
    public function get_post_detail($post_id){}
    public function get_post_modifiers($post_id){}
    public function get_projects($cat_id){}
    public function get_category_detail($cat_id){}
    //public function get_project_categories(){}
    public function get_project_items($project_id){}
    public function get_project_detail($project_id){}
    public function get_lecturer_times($user_id){}
}

/* End of file selecter.php */
/* Location: ./application/models/selecter.php */