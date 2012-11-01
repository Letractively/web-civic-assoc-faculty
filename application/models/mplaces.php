<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MPlaces extends MY_Model
{
    public function all()
    {
        $q = $this->db->query(" SELECT * 
                                FROM place_of_births
                              ");
        return $q->result();
    }
}

/* End of file places.php */
/* Location: ./application/models/places.php */