<?php

class Tax extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function data_table($end,$start,$like,$branch){
                $this->db->select('tax_commodity.*,taxes.value as tax_value,taxes_area.name as taxes_area_name,tax_types.type as tax_type, taxes.guid as tax_guid')->from('tax_commodity')->where('tax_commodity.branch_id',$branch)->where('tax_commodity.delete_status',0);
                $this->db->join('taxes', 'tax_commodity.tax= taxes.guid','left');
                $this->db->join('taxes_area', 'tax_commodity.tax_area= taxes_area.guid','left');
                $this->db->join('tax_types', 'taxes.type= tax_types.guid','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
    function edit_customer($guid){
                $this->db->select('customers.* ,customer_category.guid as c_guid,customer_category.category_name as c_name,customers_payment_type.guid as p_guid,customers_payment_type.type as type')->from('customers')->where('customers.guid',$guid);
                $this->db->join('customer_category', 'customers.category_id=customer_category.guid','left');
                $this->db->join('customers_payment_type', 'customers.payment=customers_payment_type.guid','left');
                   
                $query=$this->db->get();
                return $query->result_array(); 
    }
}
?>
