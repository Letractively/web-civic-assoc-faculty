<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MDegrees extends CI_Model
{
    public function all()
    {
        $q = $this->db->query(" SELECT * 
                                FROM mdegrees
                              ");
        return $q->result();
    }
}

/* End of file degrees.php */
/* Location: ./application/models/degrees.php */