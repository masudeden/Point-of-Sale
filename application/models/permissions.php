<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Permissions extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function set_modules_permission($mode,$data,$depart_id,$branch_id){
         $data=array('permission'=>$data,
                    'depart_id'=>$depart_id,
                    'branch_id'=>$branch_id);
       $this->db->insert($mode,$data);
       
      
    }
  
    
    function update_items_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('item_x_page_permissions',$data);
        
    }
    function update_users_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('user_x_page_x_permissions',$data);
        
    }
    function update_depart_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('user_groups_x_page_x_permissions',$data);
        
    }
     function update_branchCI_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('branch_x_page_x_permissions',$data);
        
    }
    function update_suppliers_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('suppliers_x_page_permissions',$data);
        
    }
    function update_customers_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('customers_x_page_x_permissions',$data);
        
    }
    function update_item_kites_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('items_kits_x_page_x_permissions',$data);
        
    }
    function update_sales_permission($item,$depart_id,$branch_id){
        $data=array('permission'=>$item);
        $this->db->where('depart_id ',$depart_id)->where('branch_id',$branch_id); 
        $this->db->update('sales_x_page_x_permission',$data);
        
    }
    
    function get_users_permission($id,$bid){
         $this->db->select()->from('users_x_page_x_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
            return $data; 
    }
    function get_items_permission($id,$bid){
         $this->db->select()->from('items_x_page_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
    function get_depart_permission($id,$bid){
         $this->db->select()->from('user_groups_x_page_x_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
    function get_branchCI_permission($id,$bid){
         $this->db->select()->from('branch_x_page_x_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
    function get_suppliers_permissions($id,$bid){
         $this->db->select()->from('suppliers_x_page_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
    function get_customers_permission($id,$bid){
         $this->db->select()->from('customers_x_page_x_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
    function get_item_kites_permission($id,$bid){
         $this->db->select()->from('items_kits_x_page_x_permissions')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
    function get_sales_permission($id,$bid){
         $this->db->select()->from('sales_x_page_x_permission')->where('depart_id ',$id)->where('branch_id',$bid); 	 
                $sql=  $this->db->get();              
                foreach ($sql->result() as $row) {            
                $data = $row->permission    ;            
            } 
                return $data; 
    }
}
?>
