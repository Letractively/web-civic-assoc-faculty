<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Degrees_model extends MY_Model
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
                                FROM degrees
                              ");
        return $q->result();
    }
}

/* End of file degrees.php */
/* Location: ./application/models/degrees.php */