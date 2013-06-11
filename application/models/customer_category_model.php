<?php
class Customer_category_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_customer_cate_count_for_admin($bid){
            $this->db->where('delete_status',0);
            $this->db->where('branch_id ',$bid);         
            $this->db->from('customers_category');
            return $this->db->count_all_results();
    }
    function get_customer_cate_details_for_admin($limit,$start,$branch) {
            $this->db->limit($limit, $start);
            $this->db->where('delete_status',0);
            $this->db->where('branch_id ',$branch); 
            $query = $this->db->get('customers_category');
            return $query->result();
    }
    function get_customer_cate_count_for_user($bid){
            $this->db->where('delete_status',0);
            $this->db->where('active_status',0);
            $this->db->where('branch_id ',$bid);         
            $this->db->from('customers_category');
            return $this->db->count_all_results();
    }
    function get_customer_cate_details_for_user($limit,$start,$branch) {
            $this->db->limit($limit, $start);
            $this->db->where('delete_status',0);
            $this->db->where('active_status',0);
            $this->db->where('branch_id ',$branch); 
            $query = $this->db->get('customers_category');
            return $query->result();
    }
    function get_customer_category_details($id){
        $this->db->select()->from('customers_category')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function check_customer_is_unique_for_update($area,$id,$bid){
        $this->db->select()->from('customers_category')->where('id <>',$id)->where('category_name',$area)->where('branch_id',$bid);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }  else {
            return TRUE;    
        }
    }
    function update_customer($area,$id){
        $data=array('category_name'=>$area);
        $this->db->where('id',$id);
        $this->db->update('customers_category',$data);
    }
     function check_customer_category($cat,$bid){
        $this->db->select()->from('customers_category')->where('branch_id',$bid)->where('category_name',$cat);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function add_category($name,$bid,$uid){
        $data=array('category_name'=>$name,
                    'branch_id'=>$bid,
                    'added_by'=>$uid);
                $this->db->insert('customers_category',$data);
                return $this->db->insert_id();                
    }
   
    function inactive_customer($id){
        $data=array('active_status'=>1);
        $this->db->where('id',$id);
        $this->db->update('customers_category',$data);
    }
    function active_customer($id){
        $data=array('active_status'=>0);
        $this->db->where('id',$id);
        $this->db->update('customers_category',$data);
    }
    function delete_customer_category_for_admin($value,$uid){
        $data=array('active_status'=>1,'delete_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$value);
        $this->db->update('customers_category',$data);
    }
    function delete_customer_category_for_user($id,$uid){
         $data=array('active_status'=>1,'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('customers_category',$data);
    }
   
}
?>