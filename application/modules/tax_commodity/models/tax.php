<?php
class Tax extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    // tax commodity datas
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
    
    // get all active status
    function get_taxes(){
        $this->db->select('taxes.*,tax_types.type')->from('taxes')->where('taxes.active_status',0);
        $this->db->join('tax_types', 'taxes.type= tax_types.guid','left');
        $sql=$this->db->get();
        return $sql->result();
    }
    
    // Get tax commodity Details for update
    
    function edit_tax_commodity($guid){
        $this->db->select('tax_commodity.*,taxes.value as tax_value,taxes_area.name as taxes_area_name,tax_types.type as tax_type, taxes.guid as tax_guid')->from('tax_commodity')->where('tax_commodity.guid',$guid);
        $this->db->join('taxes', 'tax_commodity.tax= taxes.guid','left');
        $this->db->join('taxes_area', 'tax_commodity.tax_area= taxes_area.guid','left');
        $this->db->join('tax_types', 'taxes.type= tax_types.guid','left');    
        $query=$this->db->get();
        return $query->result_array(); 
    }
}
?>
