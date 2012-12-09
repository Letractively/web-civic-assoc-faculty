<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Io extends MY_Controller
{
    
    /*
     * Constructor
     * 
     * @return      void
     * 
     */
    function __construct() 
    {
        parent::__construct();
        
        $data = array(
            'title' 		=> ''   //Title na aktualnej stranke
        );
            
        $this->data = array_merge($this->data, $data);
    }
    
    public function import()
    {
        
    }
    
    public function export()
    {
        //$this->load->dbutil();
        //$query = $this->db->query("SELECT * from users");
        //echo $this->dbutil->csv_from_result($query); 
       // $this->load->view('container', $this->data);
    }
}

/* End of file io.php */
/* Location: ./application/controllers/io.php */