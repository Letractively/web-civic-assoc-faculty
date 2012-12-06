<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userdata
{
        public function __construct()
        {
            $this->CI =& get_instance();
        }
        
        public function roles( $all = TRUE )
	{	
		$this->roles = array(
			1 => $this->CI->lang->line('admin'),
			2 => $this->CI->lang->line('oz_member'),
			3 => $this->CI->lang->line('ex_member'),
			4 => $this->CI->lang->line('lecturer'),
		);
		
		if( $all )
		{
			$this->roles[0] = $this->CI->lang->line('all');
			ksort($this->roles);
		}
		
		return $this->roles;
	}
        
        public function is_logged()
	{
		$logged_in = $this->CI->session->userdata('logged_in');

		if( $logged_in )
			$user_id = $this->CI->session->userdata('user');

		return ( @$user_id > 0 ) ? $user_id : FALSE;
	}
	
	public function is_admin()
	{
		$logged_in = $this->CI->session->userdata('logged_in');

		if( $logged_in )
			$admin = $this->CI->session->userdata('admin');

		return ( @$admin ) ? $admin : FALSE;
	}
        
        public function get_role( $user_id )
        {
            $query =    $this->CI->db->query("  SELECT user_role
                                                FROM users
                                                WHERE user_id = '".$user_id."'");
            return $query->row()->user_role;   
        }
        
        public function full_name( $user_id )
        {
            $query =    $this->CI->db->query("  SELECT CONCAT(CONCAT(user_name,' '),user_surname) as name
                                                FROM users
                                                WHERE user_id = '".$user_id."'");
            return $query->row()->name;   
        }
}