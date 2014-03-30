<?php

class Branch extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_branch(){
            $this->db->select()->from('branches')->where('delete_status',0);
            $sql=  $this->db->get();
            return $sql->result();  
            
    }
    function delete_user_branch($id){
        $this->db->where('user_id',$id);
        $this->db->delete('users_x_branches');
    }
    function set_branch($id,$branch_id){
            $this->db->select()->from('branches')->where('guid',$branch_id);
            $sql=$this->db->get();
            foreach ($sql->result() as $row) {
                $name= $row->store_name ;
                $branch_guid=$row->guid;
            }
            
               
            $data=array('user_id'=>$id,
                    'branch_name'=>$name,
                    'branch_id'=>$branch_guid);                       
                    $this->db->insert('users_x_branches',$data);
                    $id1=$this->db->insert_id();
       $orderid=md5($id1.'branch');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id1);
       $this->db->update('users_x_branches',$value);
              
                    
    }
    function get_user_branch($id){
            $this->db->select()->from('users_x_branches')->where('user_id',$id);
            $sql=  $this->db->get();
            $j=0;
       foreach ($sql->result() as $row) {                
            $data[$j] = $row->branch_name 	 ;
            $j++;
            }
            return $data;
            
    }
    function get_selected_branch($id){
         $this->db->select()->from('users_x_branches')->where('user_id',$id);
         $sql=  $this->db->get();
         return $sql->result();               
    }
    function get_selected_branch_for_view(){
         $this->db->select()->from('users_x_branches')->where('delete_status',0);;
         $sql=  $this->db->get();
         return $sql->result();             
    }
    function get_selected_branch_for_user_view(){
         $this->db->select()->from('users_x_branches')->where('active_status',1)->where('delete_status',0);
         $sql=  $this->db->get();
         return $sql->result(); 
    }
    function get_all_branch(){
        $this->db->select()->from('branches');
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result() as $row) {                
             $data[$j] = $row->store_name ;
             $j++;
             }
             return $data;
    }
    function delete_user_branches($id){
        $this->db->where('user_id',$id);
        $this->db->delete('users_x_branches');
    }
    function get_user_branches($id){
       $this->db->select()->from('users_x_branches')->where('user_id',$id);
       $sql=  $this->db->get();
       return $sql->result();
       
   }
   function get_user_branch_id_list($id){
        $this->db->select()->from('users_x_branches')->where('user_id',$id);
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result() as $row) {                
             $data[$j] = $row->branch_id  ;
             $j++;
             }
             return $data;
   }
   function get_user_for_branch($id){
       $this->db->select('branches.*')->from('branches');
       $this->db->join('users_x_branches','users_x_branches.branch_id = branches.guid AND users_x_branches.user_id="'.$id.'"','left');
       $sql=$this->db->get();
       return $sql->result();
       
   }
   function get_user_seleted_branch($data){
          $this->db->select()->from('branches')->where('guid',$data);
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->store_name   ;            
            } 
            return $data;
   }
   function get_user_default_branch($id){
       $this->db->select()->from('users')->where('id',$id);
       $data="";
                 $sql=  $this->db->get();              
                 foreach ($sql->result() as $row) {            
             $data = $row->default_branch   ;            
                } 
            return $data; 	
   }
   function get_users_default_branch($id){
       $this->db->select()->from('users_x_branches')->where('id',$id);
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->branch_name    ;            
            } 
            return $data; 
   }
   function check_deaprtment_is_already($depart,$branch){
       $this->db->select()->from('user_groups')->where('branch_id',$branch)->where('group_name',$depart);
       $sql=  $this->db->get();
       if($sql->num_rows()>0){
           return TRUE;
       }else{
           return FALSE;
       }
   }
   function check_deaprtment_is_already_for_update($depart,$branch,$id){
      $this->db->select()->from('user_groups')->where('branch_id',$branch)->where('group_name',$depart)->where('guid <>',$id);
       $sql= $this->db->get();       
       if($sql->num_rows()>0){
           return TRUE;
       }else{
           return FALSE;
       } 
   }
   function branchcount($id){
       $this->db->where('active_status',1); 
       $this->db->where('delete_status',0);
       $this->db->where('user_id',$id);
       $this->db->from('users_x_branches');
       
       return $this->db->count_all_results();      
   }
   function get_branch_details($limit, $start,$id) {
        $this->db->limit($limit, $start);   
        $this->db->where('active_status',1);
        $this->db->where('delete_status',0);
        $this->db->where('user_id',$id);
        $query = $this->db->get('users_x_branches');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
          return false;
   }
   function branchcount_for_admin(){           
            $this->db->where('delete_status',0);
            $this->db->from('branches');
            return $this->db->count_all_results();
   }
   function get_branch_details_for_admin($limit, $start) {
        $this->db->limit($limit, $start);   
        $this->db->where('delete_status',0);
        $query = $this->db->get("branches");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
            }
            return false;
   }
   function get_branch_details_for_edit($id){
        $this->db->select()->from('branches')->where('id',$id);
        $sql=$this->db->get();
        return $sql->result();
   }
   function update_branch_details($id,$name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website){
        $data=array('store_name'=>$name,
                    'store_city '=>$city	,
                    'store_state'=>$state,	
                    'store_zip'=>$zip,
                    'store_country'=>$country,
                    'store_website'=>$website,
                    'store_phone'=>$phone,
                    'store_email'=>$email,
                    'store_fax'=>$fax,
                    'store_tax1'=>$tax1,
                    'store_tax2'=>$tax2 );
        $this->db->where('id',$id);
        $this->db->update('branches',$data);
   }
   function add_new_branch($name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website){
        $data=array('store_name'=>$name,
                    'store_city '=>$city	,
                    'store_state'=>$state,	
                    'store_zip'=>$zip,
                    'store_country'=>$country,
                    'store_website'=>$website,
                    'store_phone'=>$phone,
                    'store_email'=>$email,
                    'store_fax'=>$fax,
                    'store_tax1'=>$tax1,
                    'store_tax2'=>$tax2 );        
        $this->db->insert('branches',$data);
        $id=$this->db->insert_id();
       return $id; 
   }
   function set_added_branch_for_user($id,$name,$uid){
       $data=array('branch_id'=>$id,'branch_name'=>$name,'user_id'=>$uid);
       $this->db->insert('users_x_branches',$data);
   }
   function delete_branch($id,$u_id){
       $value=array('deleted_by'=>$u_id,'active_status '=>1);
       $this->db->where('id',$id);
       $this->db->update('branches',$value);
       $data=array('active_status '=>1);
       $this->db->where('branch_id',$id);
       $this->db->update('users_x_branches',$data);
   }
   function delete_branch_for_admin($id){
       $data=array('active_status '=>1,'delete_status'=>1);
       $this->db->where('id',$id);
       $this->db->update('branches',$data);       
       $this->db->where('branch_id',$id);
       $this->db->update('users_x_branches',$data);
   }
   
   //This function checks where user had permission for given branch id
   function check_user_branch_active($branch_id,$user_id){
	   $this->db->select()->from('users_x_branches')->where('branch_id',$branch_id)->where('user_id',$user_id);
	   $sql=$this->db->get();
	   if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
   }
   
   function select_any_active_branch($user_id){                
        $this->db->select()->from('users_x_branches')->where('user_id',$user_id);
        $sql=  $this->db->get();
        $data="";
        foreach ($sql->result() as $brow){
            $data=$brow->branch_id;
        }       
        return $data;
    }
    function get_active_user_branches($id){
        $this->db->select('branches.*');
        $this->db->from('branches');  
        $this->db->join('users_x_branches', " users_x_branches.branch_id= branches.guid ",'left');
        $this->db->where('users_x_branches.user_active ',1);
        $this->db->where('users_x_branches.user_id',$id);
        $query=$this->db->get();
        return $query->result();
       
    }
    function activate_branch($id){
        $data=array('active_status'=>1);
        $this->db->where('id',$id);
        $this->db->update('branches',$data);
        
        $this->db->where('branch_id',$id);
        $this->db->update('users_x_branches',$data);
    }
    function deactivate_branch($id){
        $data=array('active_status'=>0);
        $this->db->where('id',$id);
        $this->db->update('branches',$data);
        
        $this->db->where('branch_id',$id);
        $this->db->update('users_x_branches',$data);
    }
    function set_user_groups_branches($dep_id,$id,$name,$uid){
        $data=array('branch_id '=>$id,
            'user_group_id '=>$dep_id,
            'user_id'=>$uid,
            'depart_name'=>$name);
        $this->db->insert('users_x_user_groups',$data);
    }
    function user_groups_x_branches($bid,$did){
      //  $data=array('branch_id '=>$bid,
       //     'user_group_id'=>$did);
       // $this->db->insert('user_groups_x_branches',$data);
    }
    function branch_for_admin(){
        $this->db->select()->from('users_x_branches');
        $sql=$this->db->get();
        $data=FALSE;
        foreach ($sql->result() as $row){
            $data=$row->branch_id;
        }
        return $data;
    }
    function get_user_for_branch_admin(){
       $this->db->select()->from('branches')->where('delete_status',0)->where('active_status',1);
       $sql=$this->db->get();
       return $sql->result();
    }
}
?>
