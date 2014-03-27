<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logindetails extends CI_Model{
    function __construct() {
        parent::__construct();
    }
	
	function user_validation($username,$password) {
		
		$username = $this->security->xss_clean($username);
        $password = md5($this->security->xss_clean($password));	
		
		// Prep the query
        $this->db->where('username', $username)
                 ->where('password', $password);
        // Run the query
        $query = $this->db->get('users');
        // Let's check if there are any results
		$error_msg = '';
        if($query->num_rows == 1)
        {
            // If there is a user, then create session data
            $row = $query->row(1,'array');
			if($row['active_status'] == 0)
				return 'user_not_active';
			else if($row['delete_status'] == 1)
				return 'user_deleted';
			else if	(!$this->user_has_active_branch($row['guid']))
				return 'user_has_nobranch';
			else {
				$this->session->set_userdata($row);
            	return true;
			}
        }
        // If the previous process did not validate
        // then return false.
       return 'up_invalid';
		
	} //End Login Validation Function 
	
	function user_has_active_branch($user_guid) {
		
		$this->db->select('count(*) as count')
         		 ->from('users_x_branches')
        		 ->where('users_x_branches.user_id', $user_guid)
		 		 ->where('users_x_branches.branch_id IN (SELECT branches.guid from branches WHERE branches.active_status = 1 AND branches.delete_status = 0 )', NULL, FALSE);
		$query = $this->db->get();
		$count =  $query->row(1,'array'); // Getting row as associated array. 
		if( $count > 0)					// User has atleast one active brance
			return true;
		else 
			return false;
	}
	
	function user_active_status($user_guid) {
		$check = $this
				 ->db
				 ->where('active', '1')
				 ->where('dep_code', $this->input->post('code'))
				 ->get('users');

		  if ($check->num_rows() > 0) {
			return false;
		  }else {
			return true;
		  } 
		
	}
}
?>
