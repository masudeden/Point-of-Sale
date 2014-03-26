<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_groups extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_user_groups(){
        $this->db->select()->from('user_groups');
        $sql=$this->db->get();
        return $sql->result(); 
    }
    function set_user_groups($id,$depa_id,$branch_id){
        $this->db->select()->from('user_groups')->where('guid',$depa_id);
            $sql=$this->db->get();
            foreach ($sql->result() as $row) {
                $name= $row->group_name ;
            }
        $this->db->select()->from('user_groups')->where('guid',$depa_id);
            $sql=$this->db->get();
            foreach ($sql->result() as $row) {
                $name= $row->group_name ;
            }
        $data=array('user_id'=>$id,
                    'depart_name'=>$name,
                    'user_group_id'=>$depa_id,
                    'branch_id'=>$branch_id);
       $this->db->insert('users_x_user_groups',$data);
       $id1=$this->db->insert_id();
       $orderid=md5($id1.'usergroup');
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id1);
       $this->db->update('users_x_user_groups',$value);
       return $guid;
    }
    function get_user_depart($id){
        $this->db->select()->from('users_x_user_groups')->where('user_id',$id);
        $sql=  $this->db->get();
       
            return $sql->result();
    }
    function get_all_user_depart($id){
        $this->db->select()->from('users_x_user_groups')->where('user_id',$id);
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result() as $row)
            {
                
             $data[$j] = $row->depart_name;
             $j++;
            }
            return $data;
    }
    function get_all_user_groupsg(){
        $this->db->select()->from('user_groups');
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result() as $row)
            {
                
             $data[$j] = $row->group_name;
             $j++;
            }
            return $data;
    
}
function delete_user_depart($id){
    $this->db->where('user_id',$id);
    $this->db->delete('users_x_user_groups');
}
function get_user_groups_count($branch){
   $this->db->where('branch_id',$branch);
   $this->db->where('active_status',1);
   $this->db->from('user_groups_x_branches');
   return $this->db->count_all_results();
}
 public function get_user_groups_details($limit,$start,$brnch) {
        $this->db->limit($limit, $start);  
        $this->db->where('branch_id',$brnch);
        $this->db->where('active_status',1);
        $query = $this->db->get('user_groups_x_branches');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }          
   }
   function get_user_groups_admin_count($branch){
            $this->db->where('branch_id ',$branch);
            $this->db->where('delete_status',0);
            $this->db->from('user_groups');
            return $this->db->count_all_results();
   }
   function get_user_groups_admin_details($limit,$start,$branch){
       $this->db->limit($limit, $start); 
       $this->db->where('delete_status',0);
       $this->db->where('branch_id ',$branch);
        $query = $this->db->get('user_groups');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
   }
   function  add_user_groups($depart,$bid){
       $data=array('group_name'=>$depart,
                   'branch_id'=>$bid
           );
       $this->db->insert('user_groups',$data);
       $id=$this->db->insert_id();
       $orderid=md5($id.$mode);
       $guid=str_replace(".", "", "$orderid");
       
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update('user_groups',$value);
       return $guid;
       
   }
   function set_branch_user_groups($id,$branch_id){
       $data=array('branch_id'=>$branch_id,
                    'user_group_id'=>$id);
                $this->db->insert('user_groups_x_branches',$data);
   }
   function delete_user_groups($id){
       $data=array('active_status'=>0);
       $this->db->where('id',$id);             
       $this->db->update('user_groups',$data);
       $this->db->where('user_group_id',$id);             
       $this->db->update('users_x_user_groups',$data);
       $this->db->where('user_group_id ',$id);             
       $this->db->update('user_groups_x_branches',$data);
             
   }
   function delete_items_permission($id){
        $this->db->where('user_group_id',$id);
        $this->db->delete('item_x_page_permissions');
   }
   function delete_users_permission($id){
        $this->db->where('user_group_id',$id);        
        $this->db->delete('user_x_page_x_permissions');
   }
   function delete_branchCI_permission($id){
        $this->db->where('user_group_id',$id);        
        $this->db->delete('branchCI_per');
   }
    function delete_depart_permission($id){
        $this->db->where('user_group_id',$id);        
        $this->db->delete('user_groups_x_page_x_permissions');
   }
   function delete_depart_branch($id){
       $this->db->where('user_group_id',$id);
       $this->db->delete('user_groups_x_branches');
   }
   function get_user_deprtment($id){
       $this->db->select()->from('user_groups_x_branches')->where('branch_id',$id);
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result() as $row) {
                $this->db->select()->from('user_groups')->where('guid',$row->user_group_id);
                $sql=  $this->db->get();
              
                foreach ($sql->result() as $row) {            
             $data[$j] = $row->group_name  ;
            
            } $j++;
        }
            return $data;
       
   }
   function get_user_deprtment_id($id){
       $this->db->select()->from('user_groups_x_branches')->where('branch_id',$id);
        $sql=  $this->db->get();
        $j=0;
        foreach ($sql->result() as $row) {
                $this->db->select()->from('user_groups')->where('guid',$row->user_group_id);
                $sql=  $this->db->get();
              
                foreach ($sql->result() as $row) {            
             $data[$j] = $row->guid  ;
            
            } $j++;
        }
            return $data;
       
   }
   function get_user_seleted_depa($d_id){
       $this->db->select()->from('user_groups')->where('guid',$d_id);
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
             $data = $row->group_name  ;            
            }
            return $data;
   }
   function get_seleted_user_groups_details($id){
       $this->db->select()->from('user_groups')->where('guid',$id);
       $sql=$this->db->get();
       return $sql->result();
   }
    function update_user_groups($id,$depart){
       $data=array('group_name'=>$depart);
       $this->db->where('guid',$id);
       $this->db->update('user_groups',$data);       
       $value=array('depart_name'=>$depart);
       $this->db->where('user_group_id',$id);
       $this->db->update('users_x_user_groups',$value);
   }
   function activate_user_groups($id){
       $data=array('active_status'=>1);
       $this->db->where('id',$id);             
       $this->db->update('user_groups',$data);
       $this->db->where('user_group_id',$id);             
       $this->db->update('users_x_user_groups',$data);
       $this->db->where('user_group_id ',$id);             
       $this->db->update('user_groups_x_branches',$data);
   }
   function deactivate_user_groups($id){
        $data=array('active_status'=>0);
       $this->db->where('id',$id);             
       $this->db->update('user_groups',$data);
       $this->db->where('user_group_id',$id);             
       $this->db->update('users_x_user_groups',$data);
       $this->db->where('user_group_id ',$id);             
       $this->db->update('user_groups_x_branches',$data);
   }
   function delete_user_groups_for_admin($id){
       $data=array('delete_status'=>1,'active_status'=>0);
       $this->db->where('id',$id);             
       $this->db->update('user_groups',$data);
       $this->db->where('user_group_id',$id);             
       $this->db->update('users_x_user_groups',$data);
       $this->db->where('user_group_id ',$id);             
       $this->db->update('user_groups_x_branches',$data);
   }
   function get_modules_permission($bid){
        $this->db->select()->from('modules_x_branches')->where('branch_id',$bid)->where('active_status',1)->where('delete_status',0);
        $sql=$this->db->get();
        $data=array();
        foreach ($sql->result() as $row){
            $this->db->select()->from('modules')->where('guid',$row->module_id);
            $val=$this->db->get();
            foreach ($val->result() as $mod){
                $data[]=$mod->module_name;
            }
        }
        return $data;
   }
   function get_user_groups_based_on_branch($bid){
       echo "<option></optin>";
      
   }
}
?>
