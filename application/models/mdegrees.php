<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MDegrees extends MY_Model
{
    public function all()
    {
        $q = $this->db->query(" SELECT * 
                                FROM degrees
                              ");
        return $q->result();
    }
}

/* End of file degrees.php */
/* Location: ./application/models/degrees.php */