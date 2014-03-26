<?php
class Aclpermissionmodel extends CI_Model
{
    function __construct() {
        parent::__construct();
    }
    function check_user_branch($brnch,$id){
        $this->db->select()->from('users_x_branches')->where('user_id',$id)->where('branch_id ',$brnch);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    function get_admin_permission($mode){
        
    }
    function get_user_modules_permissions($did,$bid,$mod){
       
        $this->db->select('permission')->from('modules_x_permissions')->where('user_group_id',$did)->where('branch_id', $bid)->where('module_id',$mod);
        $query = $this->db->get();
        $value=00001;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
      
        }else{
            return $value;
        }
       
      
    }
    function get_module_name($mod){
         $this->db->select()->from('modules')->where('guid',$mod);
            $val=$this->db->get();
            foreach ($val->result() as $mod){
                return $mod->module_name;
            }
    }
    function get_user_groups($id,$bid){
        $this->db->select()->from('users_x_user_groups')->where('user_id',$id)->where('branch_id',$bid)->where('active_status',1);
        $query = $this->db->get();
        $value=array();
        $i=0;
        foreach ($query->result() as $row) {           
                 $value[] =$row->user_group_id ;  
                 $i++;
                
        }
        return $value;
    }
    function items_permission($did,$bid)
    {
        $this->db->select('permission')->from('item_x_page_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
        $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;        
        }else{
            return $value;
        }
      
    }
    function empl_permission($did,$bid)
    {
        $this->db->select('permission')->from('user_x_page_x_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
        $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
     function user_groups_permission($did,$bid)
    {
        $this->db->select('permission')->from('user_groups_x_page_x_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
        $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
    
    function branchCI_permission($did,$bid)
    {
        $this->db->select('permission')->from('branch_x_page_x_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
         $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
    function user_suppliers_permission($did,$bid)
    {
        $this->db->select('permission')->from('suppliers_x_page_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
         $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
    function customers_permission($did,$bid)
    {
        $this->db->select('permission')->from('customers_x_page_x_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
         $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
    function item_kits_permission($did,$bid)
    {
        $this->db->select('permission')->from('items_kits_x_page_x_permissions')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
         $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
    function sales_permission($did,$bid)
    {
        $this->db->select('permission')->from('sales_x_page_x_permission')->where('user_group_id',$did)->where('branch_id', $bid);
        $query = $this->db->get();
         $value=0000;
        if($query->num_rows()>0){
        foreach ($query->result() as $row) {           
                 $value =$row->permission;           
        }       
        return $value;  
        }else{
            return $value;
        }
    }
}
?>
