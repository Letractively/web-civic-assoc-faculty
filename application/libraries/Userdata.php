<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userdata
{
        /*
         * __construct
         * 
         * Konstruktor
         * 
         */
        public function __construct()
        {
            $this->CI =& get_instance();
        }
        
        /*
         * roles
         * 
         * Funkcia vrati vsetky pouzivatelske role pouzivane v aplikacii
         * 
         * @param all ak je true tak nastavi aj default rolu na 0-ty index
         * @return array of array
         */
        public function roles( $all = TRUE )
	{	
		$this->roles = array(
			1 => $this->CI->lang->line('admin'),
			2 => $this->CI->lang->line('oz_member'),
			3 => $this->CI->lang->line('po_member'),
                        4 => $this->CI->lang->line('me_inactive'),
		);
		
		if( $all )
		{
			$this->roles[0] = $this->CI->lang->line('all');
			ksort($this->roles);
		}
		
		return $this->roles;
	}
        
        /*
         * is_logged
         * 
         * Funkcia vrati boolean ci je alebo nieje prihlaseny pouzivatel
         * 
         * @return boolean
         * 
         */
        public function is_logged()
	{
		$logged_in = $this->CI->session->userdata('logged_in');

		if( $logged_in )
			$user_id = $this->CI->session->userdata('user');

		return ( @$user_id > 0 ) ? $user_id : FALSE;
	}
	
        /*
         * is_admin
         * 
         * Funkcia vrati boolean ci je alebo nieje prihlaseny pouzivatel admin
         * 
         * @return boolean
         * 
         */
	public function is_admin()
	{
		$logged_in = $this->CI->session->userdata('logged_in');

		if( $logged_in )
			$admin = $this->CI->session->userdata('admin');

		return ( @$admin ) ? $admin : FALSE;
	}
        
        /*
         * get_role 
         * 
         * Funkcia vrati pozivatelsku rolu pouzivatela z jeho ID
         * 
         * @param user_id ID pouzivatela
         * @return integer
         * 
         */
        public function get_role( $user_id )
        {
            $query =    $this->CI->db->query("  SELECT user_role
                                                FROM users
                                                WHERE user_id = '".$user_id."'");
            return $query->row()->user_role;   
        }
        
        /*
         * get_role 
         * 
         * Funkcia vrati pozivatelsku rolu pouzivatela z jeho ID
         * 
         * @param user_id ID pouzivatela
         * @return integer
         * 
         */
        public function get_role_name( $role_number )
        {
            $roleName = '';
            switch($role_number)
            {
                case 1:
                    $roleName = $this->CI->lang->line('admin');
                    break;
                case 2:
                    $roleName = $this->CI->lang->line('oz_member');
                    break;
                case 3:
                    $roleName = $this->CI->lang->line('po_member');
                    break;
            }
            return $roleName;  
        }
        
        /*
         * full_name
         * 
         * Funkcia vrati cele meno pouzivatela na zaklade jeho id
         * 
         * @param user_id ID pouzivatela ktoreho meno ma vratit
         * @return string
         * 
         */
        public function full_name( $user_id )
        {
            $query =    $this->CI->db->query("  SELECT CONCAT(CONCAT(user_name,' '),user_surname) as name
                                                FROM users
                                                WHERE user_id = '".$user_id."'");
            return $query->row()->name;   
        }
        
        /*
         * get_user_id
         * 
         * Funkcia vrati ID aktualne prihlaseneho pouzivatela
         * 
         * @return integer
         * 
         */
        public function get_user_id()
        {
            if( $this->is_logged() )
            {
                return $this->CI->session->userdata('user');
            }
            else
                return 0;
        }
        
        /*
         * is_ecempted
         * 
         * Funkcia zisti ci je user s danym ID oslobodeny od platby
         * 
         * @param user_id ID-pouzivatela
         * 
         */
        public function is_exempted( $user_id )
        {
            $query =    $this->CI->db->query("  SELECT user_exempted
                                                FROM users
                                                WHERE user_id = '".$user_id."'");
            if ($query->row()->user_exempted == 0)
                return false;
            else
                return true;
        }
        
        /*
         * get_user_activated_time
         * 
         * Funkca vrati cas kedy user uhradil poslednu platbu
         * 
         * @param user_id ID pouzivatela
         * 
         */
        public function get_user_activated_time( $user_id )
        {
            $query =    $this->CI->db->query("  SELECT user_activated
                                                FROM users
                                                WHERE user_id = '".$user_id."'");
            
            return $query->row()->user_activated;
        }
        
        /*
         * root_email
         * 
         * Funkcia vrati email hlavneho administratora
         * 
         */
        public function root_email()
        {
            $query =    $this->CI->db->query("  SELECT user_email
                                                FROM users
                                                WHERE user_username = 'root'");
            
            return $query->row()->user_email;
        }
}