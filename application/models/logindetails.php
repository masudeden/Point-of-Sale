<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logindetails extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function login($username,$password){ 
        $pass=  md5($password);
        $this->db->select()->from('users')->where('username',$username)->where('password',$pass);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }        
    }
	
	function user_validation($username,$password) {
		
		$username = $this->security->xss_clean($username);
        $password = md5($this->security->xss_clean($password));	
		
		// Prep the query
        $this->db->where('username', $username);
        $this->db->where('password', $password);
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


    function loginid($username,$password){ 
        $pass=  md5($password);
        $this->db->select()->from('users')->where('username',$username)->where('password',$pass);
        $sql=$this->db->get();
        foreach ($sql->result() as $row){
           return $row->guid;
        }        
    }
    function is_in_active_branches($Uid){                
        $this->db->select()->from('users_x_branches')->where('user_id',$Uid);
        $sql_b=  $this->db->get();
        $data=array();
        $value=0;
        foreach ($sql_b->result() as $brow){
            $data[]=$brow->branch_id ;
        }
        for($i=0;$i<count($data);$i++){
           $this->db->select()->from('branches')->where('guid',$data[$i])->where('active_status',1);
           $sql=  $this->db->get();
           if($sql->num_rows()>0){
               $value=$value+1;
           }else{
               $value=$value+0;
           }
        }
        return $value;
    }
    function check_admin($id){
        $this->db->select()->from('users')->where('guid',$id)->where('user_type',2);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function check_user_is_active_or_not($id){
        $this->db->select()->from('users_x_branches')->where('user_id',$id)->where('user_active',0)->where('user_delete ',0);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
