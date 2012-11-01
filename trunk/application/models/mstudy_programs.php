<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MStudy_programs extends MY_Model
{
    public function all()
    {
        $q = $this->db->query(" SELECT * 
                                FROM study_programs
                              ");
        return $q->result();
    }
}

/* End of file study_programs.php */
/* Location: ./application/models/study_programs.php */