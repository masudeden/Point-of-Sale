<?php

class Customer extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('customers.* ,customer_category.guid as c_guid,customer_category.category_name as c_name,customers_payment_type.guid as p_guid,customers_payment_type.type as type')->from('customers')->where('customers.branch_id',$branch)->where('customers.active_status',0)->where('customers.delete_status',0);
                $this->db->join('customer_category', 'customers.category_id=customer_category.guid','left');
                $this->db->join('customers_payment_type', 'customers.payment=customers_payment_type.guid','left');
              
               // $this->db->join('supplier', 'stock.supplier=supplier.id','left');
                $this->db->limit($end,$start); 
               //$this->db->order_by($order);
               // $this->db->like('stage',$stage);
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
}
?>
