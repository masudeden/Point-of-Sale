<?php

class posnic_model extends CI_model{
    function __construct() {
        parent::__construct();
         if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
             
         }
    }
   
    function get_data_as_result_array_admin($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result_array();
  }
  function get_data_as_result_array_user($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('branch_id',$bid)->where('active_status',0);
        $sql=  $this->db->get();
        return $sql->result_array();
  }
    function get_data_as_result_admin($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
  }
  function get_data_as_result_user($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('branch_id',$bid)->where('active_status',0);
        $sql=  $this->db->get();
        return $sql->result();
  }
  function get_data_count_for_admin($bid,$table){
            $this->db->where('delete_status',0);        
            $this->db->where('branch_id',$bid);         
            $this->db->from($table);
            return $this->db->count_all_results();
      
  }
  function get_data_count_for_user($bid,$table){
            $this->db->where('delete_status',0);        
            $this->db->where('active_status',0);        
            $this->db->where('branch_id',$bid);         
            $this->db->from($table);
            return $this->db->count_all_results();
  }
    function get_data_for_admin_with_limit($limit, $start,$table,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get($table);
                return $query->result();
    }
    function get_data_for_user_with_limit($limit, $start,$table,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);  
                $this->db->where('active_status',0); 
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get($table);
                return $query->result();
    }
    function get_data_array_for_admin_with_limit($limit, $start,$table,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get($table);
                return $query->result_array();
    }
    function get_data_array_for_user_with_limit($limit, $start,$table,$bid){
                $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);  
                $this->db->where('active_status',0); 
                $this->db->where('branch_id',$bid); 
                $query = $this->db->get($table);
                return $query->result_array();
    }
    function check_unique_data($data,$module,$bid){
        $this->db->select()->from($module)->where($data)->where('branch_id',$bid)->where('delete_status',0);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function update($module,$value,$where){
        $this->db->where($where);
        $this->db->update($module,$value);
    }
    function add($module,$value,$branch){
       $this->db->insert($module,$value);
       $id=$this->db->insert_id();
       $this->db->where('id',$id);
       $this->db->update($module,$branch);
       $orderid=md5($id.$module);
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update($module,$value);
    }
    function deactive($guid,$module,$branch){
        $data=array('active'=>1);
        $this->db->where('guid',$guid);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function active($guid,$module,$branch){
        $data=array('active'=>0);
        $this->db->where('guid',$guid);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function restore($guid,$module,$branch){
        $data=array('active_status'=>0);
        $this->db->where('guid',$guid);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function admin_delete($guid,$module,$branch,$uid){
        $data=array('active_status'=>1,'delete_status'=>1,'deleted_by'=>$uid);
        $this->db->where('guid',$guid);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function user_delete($guid,$module,$branch,$uid){
        $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where('guid',$guid);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
}
?>
