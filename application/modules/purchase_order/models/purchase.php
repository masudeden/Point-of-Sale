<?php

class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('purchase_order.* ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
             
                $this->db->from('purchase_order')->where('purchase_order.branch_id',$branch)->where('purchase_order.delete_status',0);
                $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
   
    function count($branch){
        $this->db->select()->from('purchase_order')->where('branch_id',$branch)->where('active_status',1)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
   
    function search_items($search,$branch){
          $this->db->select('items.* ,items_category.guid as c_guid,items_category.category_name as c_name,brands.guid as b_guid,brands.name as b_name,items_department.department_name as d_name')->from('items')->where('items.branch_id',$branch)->where('items.active_status',1)->where('items.delete_status',1);
                $this->db->join('items_category', 'items.category_id=items_category.guid','left');
                $this->db->join('brands', 'items.brand_id=brands.guid','left');
                $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
               // $this->db->join('supplier', 'stock.supplier=supplier.id','left');
                $like=array('items.name'=>$search,'items.code'=>$search,'items.barcode'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result();
    }
    
    
    function serach_items($search,$bid,$guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,suppliers_x_items.*')->from('suppliers_x_items')->where('suppliers_x_items.delete_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.active_status',1)->where('suppliers_x_items.active',0)->where('suppliers_x_items.deactive_item',0)->where('suppliers_x_items.item_active',0)->where('items.branch_id',$bid)->where('items.active_status',1)->where('items.delete_status',1);
         $this->db->join('items', "items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."' ",'left');
         $this->db->join('items_category', 'items.category_id=items_category.guid','left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=suppliers_x_items.item_id AND suppliers_x_items.supplier_id='".$guid."'",'left');
         $this->db->join('brands', 'items.brand_id=brands.guid','left');
         $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
          $like=array('items.guid'=>$search,'items.name'=>$search,'items.code'=>$search,'items_category.category_name'=>$search,'brands.name'=>$search,'items_department.department_name'=>$search);
                $this->db->or_like($like); 
               // $this->db->like('suppliers_x_items.supplier_id',$guid); 
         $sql=  $this->db->get();
         return $sql->result();
     
     }
     function get_purchase_order($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_order_items.discount_per as dis_per ,purchase_order_items.discount_amount as item_dis_amt ,purchase_order_items.tax as dis_amt ,purchase_order_items.tax as order_tax,purchase_order_items.item ,purchase_order_items.quty ,purchase_order_items.free ,purchase_order_items.cost ,purchase_order_items.sell ,purchase_order_items.mrp,purchase_order_items.guid as o_i_guid ,purchase_order_items.amount ,purchase_order_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('purchase_order')->where('purchase_order.guid',$guid);
         $this->db->join('purchase_order_items', "purchase_order_items.order_id = purchase_order.guid  AND  purchase_order_items.delete_status=0",'left');
         $this->db->join('items', "items.guid=purchase_order_items.item AND purchase_order_items.order_id='".$guid."' AND purchase_order_items.delete_status=0",'left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
         $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_order_items.order_id='".$guid."'  AND purchase_order_items.delete_status=0",'left');
         $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=purchase_order.supplier_id AND suppliers_x_items.item_id=purchase_order_items.item AND purchase_order_items.order_id='".$guid."'  AND purchase_order_items.delete_status=0",'left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          $row['po_date']=date('d-m-Y',$row['po_date']);
       
          $row['exp_date']=date('d-m-Y',$row['exp_date']);
         
          $row['date']=date('d-m-Y',$row['date']);
         
          $data[]=$row;
         }
         return $data;
     }
     function delete_order_item($guid){      
          $this->db->where('guid',$guid);
          $this->db->update('purchase_order_items',array('delete_status'=>1));
     }
     function approve_order($guid){
         $this->db->where('guid',$guid);
         $this->db->update('purchase_order',array('order_status'=>1));
        
     }
     function  check_approve($guid){
          $this->db->select()->from('purchase_order')->where('guid',$guid)->where('order_status',1);
            $sql=  $this->db->get();
            if($sql->num_rows()>0){
               return FALSE;
            }else{
                return TRUE;
            }
            
     }
    
}
?>
