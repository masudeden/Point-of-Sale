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
            $this->db->from('customers_payment_type');
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
}
?>
