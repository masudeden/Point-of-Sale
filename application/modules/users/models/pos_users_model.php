<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pos_users_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    
    function pos_users_count($id,$branch){       
            $this->db->where('emp_id <>',$id);
            $this->db->where('user_delete ',0);
            $this->db->where('user_active',0);        
            $this->db->where('branch_id ',$branch);         
            $this->db->from('users_x_branchs');
            return $this->db->count_all_results()-1;
        
    }
     public function get_pos_users_details($limit,$start,$id,$branch) {
            $this->db->limit($limit, $start);
            $this->db->where('emp_id <>',$id);
            $this->db->where('user_delete ',0);
            $this->db->where('user_active',0);        
            $this->db->where('branch_id ',$branch); 
       $query = $this->db->get('users_x_branchs');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
          return false;  
   }
   function deactive_pos_users($id){
       $value=array('active'=>1); 
       $this->db->where('guid',$id);
       $this->db->update('users',$value);
   }
   function active_pos_users($id){
       $value=array('active'=>0); 
       $this->db->where('guid',$id);
       $this->db->update('users',$value);
   }
   function get_user_details_for_user($id){
            $this->db->select()->from('users')->where('id <>',$id)->where('user_type <>',2);
            $sql=$this->db->get();
            return $sql->result();   
   }
   function pos_users_count_for_admin($branch){  
            $this->db->where('branch_id ',$branch);
            $this->db->where('user_delete',0);
            $this->db->from('users_x_branchs');
            return $this->db->count_all_results();
   }
   function get_pos_users_details_for_admin($limit, $start,$branch) {
            $this->db->limit($limit, $start);   
            $this->db->where('branch_id',$branch);
            $this->db->where('user_delete',0);
            $query = $this->db->get('users_x_branchs');
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
   function get_file_name($upload_data){
       echo $upload_data['0'];
       foreach ($upload_data as $item => $value){    
     if($item=='file_name'){
        echo $value;                
    }    
    }
   }
   function update_pos_users($age,$sex,$id,$first_name,$last_name,$emp_id,$address,$city,$state,$zip,$country,$email,$phone,$dob,$image_name){
       $data=array(
           'age'=>$age,
           'sex'=>$sex,
           'user_id' =>$emp_id,	          	
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

       $this->db->where('guid',$id);
       $this->db->update('users',$data);
   }
   function delete_pos_users($id,$deleted_by,$branch){          
       $value=array('user_active'=>1,'deleted_by'=>$deleted_by);
       $this->db->where('emp_id',$id); 
       $this->db->where('branch_id',$branch);
       $this->db->update('users_x_branchs',$value);       
   }
   function delete_pos_users_for_admin($id,$branch){       
       $this->db->where('emp_id',$id); 
       $value=array('user_active'=>1,'user_delete'=>1);
       $this->db->where('branch_id',$branch);
       $this->db->update('users_x_branchs',$value);
   }
   function adda_new_pos_users($dob,$created_by,$sex,$age,$first_name,$last_name,$emp_id,$password,$address,$city,$state,$zip,$country,$email,$phone,$image_name){
            
       $pass=md5($password);
       $data=array(
           'created_by'=>$created_by,
           'sex' =>$sex,
           'age'=>$age,
           'user_id' =>$emp_id,	
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
       function user_checking($email,$emp_id,$dob){
       $this->db->select()->from('users')->where('email',$email)->or_where('user_id',$emp_id);
       $sql=$this->db->get();
       if($sql->num_rows()>0){
               return TRUE;
       }else{
               return FALSE;
       }
       }
       function activate_user($id,$branch){                
                $value=array('user_active'=>0);
                $this->db->where('emp_id',$id); 
                $this->db->where('branch_id',$branch);
                $this->db->update('users_x_branchs',$value);
       }
       function deactivate_user($id,$branch){                   
                $value=array('user_active'=>1);
                $this->db->where('emp_id',$id);
                $this->db->where('branch_id',$branch);                
                $this->db->update('users_x_branchs',$value);
       }
       function delete_user_for_admin($id,$branch){                
                $value=array('user_delete'=>1,'user_active'=>1);
                $this->db->where('emp_id',$id);
                $this->db->where('branch_id',$branch);
                $this->db->update('users_x_branchs',$value);
       }
}
?>
