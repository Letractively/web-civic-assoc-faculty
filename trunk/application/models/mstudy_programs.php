<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MStudy_programs extends CI_Model
{
    public function all()
    {
        $q = $this->db->get('study_programs');
        return $q->result();
    }
}

/* End of file study_programs.php */
/* Location: ./application/models/study_programs.php */