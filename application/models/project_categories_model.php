<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_categories_model extends MY_Model
{
    
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
}