<?php
class Item_setting extends CI_Model{
    function __construct() {
        parent::__construct();
    }
   
    function get_item_setting(){
        $this->db->select()->from('items_settings');
        $sql=  $this->db->get();
        return $sql->result();
    }
    function get_setting($id){
        $this->db->select()->from('items_settings')->where('item_id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function update($id,$min,$max,$tax,$allow_negative,$purchase_return,$purchase,$salses_return,$sale,$bid){
        $data=array('min_q'=>$min,
                    'max_q'=>$max,
                    'sales'=>$sale,
                    'purchase'=>$purchase, 	
                    'salses_return'=>$salses_return, 	
                    'purchase_return'=>$purchase_return,
                    'allow_negative'=>$allow_negative, 	
                    'tax_inclusive'=>$tax, 	
                    'updated_by'=>$bid);
        $this->db->where('id',$id);
        $this->db->update('items_settings',$data);
    }
    function get_code(){
        $this->db->select()->from('item_upc_ean_code');
        $sql=  $this->db->get();
        return $sql->result();
    }
    function get_item_details($id){
        $this->db->select()->from('items')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function set_code_for_item($code,$id,$bid){
        $data=array('code'=>$code,'item_id'=>$id,'branch_id'=>$bid);
        $this->db->insert('item_upc_ean_code',$data);
        $value=array('code_status'=>1);
        $this->db->where('id',$id);        
        $this->db->update('items',$value);
    }
    function check_code($code,$id){
        $this->db->select()->from('item_upc_ean_code')->where('code',$code)->where('branch_id',$id)->where('delete_status',0);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function get_item_details_for_edit($id){
        $this->db->select()->from('item_upc_ean_code')->where('item_id',$id)->where('delete_status',0);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function check_code_for_update($code,$id,$bid){
          $this->db->select()->from('item_upc_ean_code')->where('item_id <>',$id)->where('code',$code)->where('branch_id',$bid)->where('delete_status',0);
        $sql=  $this->db->get();
        if($sql->num_rows()>0){
            return FALSE;
        }else{
            return TRUE;
        }
    }
    function update_code_for_item($code,$id,$bid){
        $data=array('code'=>$code);
        $this->db->where('item_id',$id);
        $this->db->where('delete_status',0);
        $this->db->update('item_upc_ean_code',$data);
        
    }
}
?>
