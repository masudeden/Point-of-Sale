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
                $this->db->where('active',0);
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
    function get_two_values($value1,$value2,$table,$where,$bid){
        $this->db->select($value1,$value2)->from($table);
        if(count($where)>0){
         $this->db->where($where);   
        }
        $this->db->where('branch_id',$bid);
        $sql=$this->db->get();
        return $sql->result();
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
    function add($module,$value,$branch,$uid){
       $this->db->insert($module,$value);
       $id=$this->db->insert_id();
       $this->db->where('id',$id);
       $this->db->update($module,$branch);
       $orderid=md5($id.$module);
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid,'added_by'=>$uid);
       $this->db->where('id',$id);
       $this->db->update($module,$value);
       return $guid;
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
    function deactive_where($where,$module,$branch){
        $data=array('active'=>1);
        $this->db->where($where);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function active_where($where,$module,$branch){
        $data=array('active'=>0);
        $this->db->where($where);
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
    function admin_where_delete($where,$module,$branch,$uid){
        $data=array('active_status'=>1,'delete_status'=>1,'deleted_by'=>$uid);
        $this->db->where($where);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function user_delete($guid,$module,$branch,$uid){
        $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where('guid',$guid);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function user_where_delete($where,$module,$branch,$uid){
        $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where($where);
        $this->db->where('branch_id',$branch);
        $this->db->update($module,$data);
    }
    function module_result($table,$bid){
        $this->db->select()->from($table)->where('delete_status',0)->where('active_status',0)->where('active',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function module_result_where($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('active_status',0)->where('active',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function posnic_module_all_where($table,$where,$bid){
        $this->db->select()->from($table)->where('delete_status',0)->where('active_status',0)->where($where)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function module_result_array_where($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('active_status',0)->where('active',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result_array();
    }
    function module_result_one_array_where($table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('active_status',0)->where('active',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result_array();
    }
    function module_result_one_field_where($field,$table,$where,$bid){
        $this->db->select()->from($table)->where($where)->where('delete_status',0)->where('active_status',0)->where('active',0)->where('branch_id',$bid);
         $sql=  $this->db->get();
        $data;
    foreach ($sql->result() as $row){
            $data=$row->$field   ;
    }
    return $data;
    }
    function posnic_like_data($table,$where,$name,$branch){
        $this->db->select()->from($table)->like($where)->where('branch_id',$branch)->where('active',0)->where('active_status',0)->where('delete_status',0);
        $sql=  $this->db->get();
        $data=array();
    foreach ($sql->result() as $row){
            $data[]=$row->$name   ;
    }
    return $data;
    }
    function posnic_or_like($table,$like,$branch){
        $this->db->select()->from($table)->or_like($like)->where('branch_id',$branch)->where('delete_status',0);
        $sql=$this->db->get();
        return $sql->result();
    }
    function module_result_admin($table,$bid){
        $this->db->select()->from($table)->where('delete_status',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function module_result_user($table,$bid){
        $this->db->select()->from($table)->where('delete_status',0)->where('active_status',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function posnic_module_like($table,$where,$branch){
         $this->db->select()->from($table)->like($where)->where('branch_id',$branch)->where('active',0)->where('active_status',0)->where('delete_status',0);
         $sql=  $this->db->get();
         $data=array();
         $j=0;
    foreach ($sql->result() as $row){
             $data[$j] = $row;
             $j++; 
    }
    return $data;
    }
    function posnic_join_like($table1,$table2,$like,$where,$branch){
        
          $this->db->select()->from($table1)->like($like);    
          $where=$where."AND $table2.branch_id ='".$branch." '";
          $this->db->join($table2, "$where".'','left');
          $this->db->group_by("$table2".'.guid');
         
          $sql=$this->db->get();
              $data=array();
                    $j=0;
               foreach ($sql->result() as $row){
                        $data[$j] = $row;
                                                   $j++; 
               }
               return $data;
    }
    function posnic_data_table_with_join($end,$start,$table1,$table2,$join_where,$branch,$order,$like,$where){
        $this->db->select()->from($table1);  
        $this->db->limit($end,'0'); 
        if($where!=null){
        $this->db->where($where);
        }
        //$this->db->where('users.guid <>',2);
        $this->db->or_like($like);
        $join_where=$join_where."AND $table2.branch_id ='".$branch." ' AND $table2.delete_status=0";
        $this->db->join($table2, "$join_where".'','left');
        
          $query=$this->db->get();
             return $query->result_array();
            
    }
    function data_table_count($table,$branch){
        $this->db->select()->from($table)->where('branch_id',$branch)->where('delete_status',0);
        $sql=  $this->db->get();
        return  $sql->num_rows();
    }
    function posnic_module_active($id,$table,$branch){
        $this->db->where('guid',$id);
        $this->db->update($table,array('active'=>0));
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        return $report;
    }
    function posnic_module_deactive($id,$table,$branch){
        $this->db->where('guid',$id);
        $this->db->update($table,array('active'=>1));
        $report = array();
        $report['error'] = $this->db->_error_number();
        $report['message'] = $this->db->_error_message();
        return $report;
    }
    function get_module_details_for_update($guid,$table){
        $this->db->select()->from($table)->where('guid',$guid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function posnic_data_table($end,$start,$order,$like,$table,$branch){
         $this->db->select()->from($table)->where('branch_id',$branch)->where('delete_status',0);  
         $this->db->limit($end,$start); 
         $this->db->order_by($order);
         $this->db->or_like($like);     
         $query=$this->db->get();
         return $query->result_array();
    }
    function add_module($module,$value,$branch){
       $this->db->insert($module,$value);
       $id=$this->db->insert_id();
       $this->db->where('id',$id);
       $orderid=md5($id.$module);
       $guid=str_replace(".", "", "$orderid");
       $value=array('guid'=>$guid);
       $this->db->where('id',$id);
       $this->db->update($module,$branch);
       $this->db->update($module,$value);
       return $guid;
        
    }
    
}
?>
