<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Study_programs_model extends MY_Model
{
    public function all()
    {
        /*
        * all
        * 
        * Funkcia vrati vsetky polozky z databazy
        * 
        * @access      public
        * @return      array of objects
        */
        $q = $this->db->query(" SELECT * 
                                FROM study_programs
                              ");
        return $q->result();
    }
}

/* End of file study_programs.php */
/* Location: ./application/models/study_programs.php */