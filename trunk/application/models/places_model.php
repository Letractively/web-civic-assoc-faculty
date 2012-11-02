<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Places_model extends MY_Model
{
    /*
     * all
     * 
     * Funkcia vrati vsetky polozky z databazy
     * 
     * @access      public
     * @return      array of objects
     */
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