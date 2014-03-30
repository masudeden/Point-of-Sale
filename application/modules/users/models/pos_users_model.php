<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos_users_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function pos_users_count($id,$branch){       
            $this->db->where('user_id <>',$id);
            $this->db->where('admin <>','101');
            $this->db->where('user_delete ',0);
            $this->db->where('user_active',1);        
            $this->db->where('branch_id ',$branch);         
            $this->db->from('users_x_branches');
            return $this->db->count_all_results();
        
    }
     public function get_pos_users_details($limit,$start,$id,$branch) {
            $this->db->limit($limit, $start);
            $this->db->where('user_id <>',$id);
            $this->db->where('user_delete ',0);
            $this->db->where('user_active',1);        
            $this->db->where('branch_id ',$branch); 
       $query = $this->db->get('users_x_branches');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
          return false;  
   }
   function deactive_pos_users($id,$bid){
       $value=array('user_active'=>0); 
       $this->db->where('user_id',$id);
       $this->db->where('branch_id',$bid);
       $this->db->update('users_x_branches',$value);
   }
   function active_pos_users($id,$bid){
       $value=array('user_active'=>1); 
       $this->db->where('user_id',$id);
       $this->db->where('branch_id',$bid);
       $this->db->update('users_x_branches',$value);
   }
   function get_user_details_for_user($id){
            $this->db->select()->from('users')->where('id <>',$id)->where('user_type <>',2);
            $sql=$this->db->get();
            return $sql->result();   
   }
   function pos_users_count_for_admin($branch){  
            $this->db->where('branch_id ',$branch);
            $this->db->where('user_delete',0);
            $this->db->from('users_x_branches');
            return $this->db->count_all_results();
   }
   function get_pos_users_details_for_admin($limit, $start,$branch) {
            $this->db->limit($limit, $start);   
            $this->db->where('branch_id',$branch);
            $this->db->where('user_delete',0);
            $query = $this->db->get('users_x_branches');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
          return false;          
      }
      function get_branch_pos_users_for_admin(){
          $this->db->where('delete_status ',0);
          $this->db->where('user_type <>',2);
          $sql=$this->db->get('users');
          return $sql->result();
      }
   function edit_pos_users($id){
       $this->db->select()->from('users')->where('guid',$id);
        $sql=$this->db->get();       
        return $sql->result();
   }
   function get_user_details($id){
                $this->db->select('users.*,branches.store_name as branch_name,branches.guid as branch_guid,user_groups.group_name,users_x_user_groups.user_group_id')->from('users')->where('users.guid',$id);
                $this->db->join('users_x_user_groups', 'users_x_user_groups.user_id=users.guid','left');
                $this->db->join('user_groups', 'user_groups.guid=users_x_user_groups.user_group_id AND users_x_user_groups.user_id=users.guid','left');
                $this->db->join('branches', 'branches.guid=user_groups.branch_id AND user_groups.guid=users_x_user_groups.user_group_id AND users_x_user_groups.user_id=users.guid','left');
		$sql=$this->db->get();
                $data=array();
                foreach ($sql->result_array() as $row)                    
                {
                    $row['dob']= date('d-m-Y',$row['dob']);
                    $data[]=$row;
                } 
		 return $data;
   }
   function get_file_name($upload_data){
       echo $upload_data['0'];
       foreach ($upload_data as $item => $value){    
     if($item=='file_name'){
        echo $value;                
    }    
    }
   }
   function update_pos_users($blood,$file_name,$age,$sex,$id,$first_name,$last_name,$user_id,$address,$city,$state,$zip,$country,$email,$phone,$dob,$password){
       
       if($password!=""){
           $data=array(
           'blood'=>$blood,
           'image'=>$file_name,
           'age'=>$age,
           'sex'=>$sex,
           'username' =>$user_id,	          	
           'first_name' =>$first_name,           
           'last_name '	=>$last_name,
           'address '=>$address,	
           'city '=>$city,
           'state'=>$state,	
           'zip'=>$zip,	
           'country'=>$country,	
           'email'=>$email,	
           'phone'=>$phone, 		
           'dob'=>$dob,
           'password'=>$password
       );
           
       }else{
              $data=array(
           'blood'=>$blood,
           'image'=>$file_name,
           'age'=>$age,
           'sex'=>$sex,
           'username' =>$user_id,	          	
           'first_name' =>$first_name,           
           'last_name '	=>$last_name,
           'address '=>$address,	
           'city '=>$city,
           'state'=>$state,	
           'zip'=>$zip,	
           'country'=>$country,	
           'email'=>$email,	
           'phone'=>$phone, 		
           'dob'=>$dob,
          
       );
       }

       $this->db->where('guid',$id);
       $this->db->update('users',$data);
   }
   function delete_pos_users($id,$branch){ 
       $this->db->where('user_id',$id); 
       $this->db->where('branch_id',$branch);
       $this->db->delete('users_x_branches');       
   }
   
   function add_new_pos_users($blood,$dob,$created_by,$sex,$age,$first_name,$last_name,$username,$password,$address,$city,$state,$zip,$country,$email,$phone,$image_name){
            
       $pass=md5($password);
       $data=array(
           'created_by'=>$created_by,
           'sex' =>$sex,
           'blood'=>$blood,
           'age'=>$age,
           'username' =>$username,	
           'password' =>$pass, 
           'first_name' =>$first_name,           
           'last_name '	=>$last_name,
           'address '=>$address,	
           'city '=>$city,
           'state'=>$state,	
           'zip'=>$zip,	
           'country'=>$country,	
           'email'=>$email,	
           'phone'=>$phone, 	
           'image'=>$image_name,	
           'dob'=>$dob          	
                             );
       $this->db->insert('users',$data);
       $id=$this->db->insert_id();
       $orderid=md5($id.'user');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update('users',$value);
       return $guid;                        
       }
       function get(){
         return TRUE;
       }
       function user_checking($email,$user_id,$dob,$phone){
       $this->db->select()->from('users')->or_where('email',$email)->or_where('username',$user_id)->or_where('phone',$phone);
       $sql=$this->db->get();
       if($sql->num_rows()>0){
               return TRUE;
       }else{
               return FALSE;
       }
       }
       function user_update_checking($email,$phone,$idd){
       $this->db->select()->from('users');
       $this->db->or_where('email',$email)->or_where('phone',$phone)->where('guid <>',$idd);
       $sql=$this->db->get();
       if($sql->num_rows()>1){
      return TRUE;
          
       }else{
      return FALSE;
       }
      
       }
       function activate_user($id,$branch){                
                $value=array('user_active'=>0);
                $this->db->where('user_id',$id); 
                $this->db->where('branch_id',$branch);
                $this->db->update('users_x_branches',$value);
       }
       function deactivate_user($id,$branch){                   
                $value=array('user_active'=>1);
                $this->db->where('user_id',$id);
                $this->db->where('branch_id',$branch);                
                $this->db->update('users_x_branches',$value);
       }
       function delete_user_for_admin($id,$branch){                
                $value=array('user_delete'=>1,'user_active'=>1);
                $this->db->where('user_id',$id);
                $this->db->where('branch_id',$branch);
                $this->db->update('users_x_branches',$value);
       }
       function get_user_grous($guid){
           
           $this->db->select()->from('user_groups')->where('active_status',1)->where('delete_status',0)->where('branch_id',$guid);
           $sql=  $this->db->get();
           return $sql->result();
       }
       function add_user_groups_for_user($user_groups,$branch,$id){
           $this->db->insert('users_x_user_groups',array('branch_id'=>$branch,'user_group_id'=>$user_groups,'user_id'=>$id));
           
       }
       function add_user_branchs_for_user($user_groups,$id){
           $this->db->insert('users_x_branches',array('branch_id'=>$user_groups,'user_id'=>$id));
           
       }
       function remove_user_groups($deleted_groups,$id){
           $this->db->where('user_group_id',$deleted_groups);
           $this->db->where('user_id',$id);
           $this->db->delete('users_x_user_groups');
       }
}
?>
