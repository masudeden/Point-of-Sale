<?php

class Supplier extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('customers.* ,customer_category.guid as c_guid,customer_category.category_name as c_name,customers_payment_type.guid as p_guid,customers_payment_type.type as type')->from('customers')->where('customers.branch_id',$branch)->where('customers.active_status',0)->where('customers.delete_status',0);
                $this->db->join('customer_category', 'customers.category_id=customer_category.guid','left');
                $this->db->join('customers_payment_type', 'customers.payment=customers_payment_type.guid','left');
                $this->db->or_like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
        
    }
    function edit_supplier($guid){
                $this->db->select('suppliers.* ,supplier_contacts.guid as c_guid,supplier_contacts.address as c_address,supplier_contacts.city as c_city,supplier_contacts.state as c_state,supplier_contacts.country as c_country,supplier_contacts.zip as c_zip ,supplier_contacts.email as c_email,supplier_contacts.phone as c_phone')->from('suppliers')->where('suppliers.guid',$guid);
                $this->db->join('supplier_contacts', 'supplier_contacts.supplier=suppliers.guid','left');
               
                   
                $query=$this->db->get();
                return $query->result(); 
    }
    function add_contact($guid,$address,$city,$state,$country,$zip,$email,$phone){
        $this->db->insert('supplier_contacts',array('supplier'=>$guid,'address'=>$address,'city'=>$city,'state'=>$state,'country'=>$country,'zip'=>$zip,'email'=>$email,'phone'=>$phone));
        $id=$this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('supplier_contacts',array('guid'=>  md5('supplier_conatct'.$id)));
    }
    function update_suplier_contact($guid,$address,$city,$state,$country,$zip,$phone,$email){
        $this->db->where('guid',$guid);
        $this->db->update('suppliers',array('address1'=>$address,'city'=>$city,'state'=>$state,'zip'=>$zip,'country'=>$country,'email'=>$email,'phone'=>$phone));
    }
    function delete_conatct($guid){
        $this->db->where('supplier',$guid);
        $this->db->delete('supplier_contacts');
    }
}
?>
