<?php
class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('purchase_order.*,grn.delete_status as grn_delete_status,grn.grn_no,grn.active_status as grn_active_status,grn.guid as grn_guid,grn.grn_status as grn_active, grn.date as grn_date,grn.grn_no ,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
                $this->db->from('grn')->where('purchase_order.branch_id',$branch)->where('purchase_order.active_status',1)->where('purchase_order.delete_status',0)->where('grn.delete_status',0);
                $this->db->join('purchase_order', 'purchase_order.guid=grn.po AND grn.delete_status=0','left');
                $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id AND purchase_order.guid=grn.po','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                    if($row['grn_delete_status']==0){
                    $row['grn_date']=date('d-m-Y',$row['grn_date']);
                    $data[]=$row;
                    }
                }
                return $data; 
        
    }
    function search_purchase_order($like,$branch){
        $this->db->select('purchase_order.*,suppliers.guid as s_guid,suppliers.address1,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('purchase_order')->where('purchase_order.branch_id',$branch)->where('purchase_order.order_status',1)->where('purchase_order.grn_status',0)->where('purchase_order.active_status',1)->where('purchase_order.delete_status',0);
        $or_like=array('po_no'=>$like);
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id ','left');
        $this->db->or_like($or_like); 
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
              
            if($row['exp_date'] >= strtotime(date("Y/m/d"))){  
                
            
            $row['po_date']=date('d-m-Y',$row['po_date']);

            $row['exp_date']=date('d-m-Y',$row['exp_date']);

           

             $data[]=$row;
            }

        }
         return $data;
               
        
    }
  
    
    
    function search_items($search,$bid,$guid,$limit){
        $this->db->select('purchase_order_items.*,items_setting.purchase,items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,brands.name as b_name,items_department.department_name as d_name,items_category.category_name as c_name,items.name,items.guid as i_guid,items.code,items.image,items.tax_Inclusive,items.tax_id,')->from('purchase_order_items')->where('purchase_order_items.order_id',$guid);
        $this->db->join('items', 'items.guid=purchase_order_items.item','left');
        $this->db->join('items_category', 'items.category_id=items_category.guid','left');
        $this->db->join('items_setting', 'items.guid=items_setting.item_id AND items_setting.purchase=1','left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_order_items.item",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid ",'left');
        $this->db->join('brands', 'items.brand_id=brands.guid','left');
        $this->db->join('items_department', 'items.depart_id=items_department.guid','left');
        $sql=  $this->db->get();
         return $sql->result();;
     
     
     }
    function get_purchase_order($guid){
        $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_order_items.discount_per as dis_per ,purchase_order_items.discount_amount as item_dis_amt ,purchase_order_items.tax as dis_amt ,purchase_order_items.tax as order_tax,purchase_order_items.item ,purchase_order_items.quty ,purchase_order_items.free,purchase_order_items.guid as o_i_guid ,purchase_order_items.received_quty ,purchase_order_items.received_free ,purchase_order_items.cost ,purchase_order_items.sell ,purchase_order_items.mrp,purchase_order_items.guid as o_i_guid ,purchase_order_items.amount ,purchase_order_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('purchase_order')->where('purchase_order.guid',$guid);
        $this->db->join('purchase_order_items', 'purchase_order_items.order_id = purchase_order.guid AND purchase_order_items.delete_status=0','left');
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
 
 
    function purchase_order_cancel($po,$items_order_guid,$items_old_quty,$items_old_free,$items_free,$items_quty){
        $this->db->select()->from('purchase_order_items')->where('guid',$items_order_guid);
        $sql=$this->db->get();
        $quty;
        $free;
        foreach ($sql->result() as $row){
            $quty=$row->quty;
            $free=$row->free;
        }
        if($items_quty>$quty){
            return FALSE;
        }
        if($items_free>$free){
            return FALSE;
        }
        $this->db->where('guid',$items_order_guid);
        $this->db->update('purchase_order_items',array('quty'=>$quty-$items_quty,'free'=>$free-$items_free));
                
            
    }
    
}
?>
