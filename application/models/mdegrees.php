<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MDegrees extends CI_Model
{
    public function all()
    {
        $q = $this->db->get('degrees');
        return $q->result();
    }
}

/* End of file degrees.php */
/* Location: ./application/models/degrees.php */