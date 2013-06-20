<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Item_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_items(){ // get all item details
        $this->db->select()->from('items');
        $sql=$this->db->get();
        return $sql->result();
    }
    function item_count_for_admin($branch){  
            $this->db->where('branch_id',$branch);
       
            $this->db->where('delete_status',0);
            $this->db->from('items');
            return $this->db->count_all_results();
   }
   function get_item_details_for_admin($limit, $start,$branch) {
               $this->db->limit($limit, $start);            
                $this->db->where('delete_status',0);               
                $this->db->where('branch_id',$branch); 
                $query = $this->db->get('items');
                return $query->result();         
   }
   function pos_item_count($branch){       
            
            $this->db->where('delete_status',0);
            $this->db->where('active_status',0);
            $this->db->where('branch_id ',$branch);         
            $this->db->from('items');
            return $this->db->count_all_results();
        
    }
    function get_item_details($limit,$start,$branch) {
            $this->db->limit($limit, $start);
            $this->db->where('delete_status',0);
            $this->db->where('active_status',0);
            $this->db->where('branch_id ',$branch); 
            $query = $this->db->get('items');
            return $query->result();
        
   }
   function get_selected_branch_for_view(){
         $this->db->select()->from('branchs')->where('delete_status',0)->where('active_status',0);
         $sql=  $this->db->get();
         return $sql->result();             
    }
    function delete_items_for_user($id,$bid,$uid){
        $data=array('active_status '=>1,
                    'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function delete_items_details_in_admin($id,$uid){
        $data=array('active_status '=>1,
                    'delete_status '=>1,
                     'deleted_by'=>$uid);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
        $value=array('delete_status'=>1);
        $this->db->where('item_id',$id);
        $this->db->update('item_upc_ean_code',$value);
    }
    function deactivate_items($id,$uid){
        $data=array('active_status '=>1);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function deactivate_items_by_user($id,$udi){
        $data=array('active_status '=>1,
            'deleted_by'=>$udi);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function to_activate_item($id,$bid){
        $data=array('active_status '=>0);
        $this->db->where('id',$id);        
        $this->db->update('items',$data);
    }
    
   
    function get_category($id){
        $this->db->select()->from('item_category')->where('branch_id',$id);
        $sql=  $this->db->get();
        return $sql->result(); 
    }
    function get_suppier_in_branch($id){
        $this->db->select()->from('suppliers_x_branchs')->where('branch_id',$id)->where('supplier_active',0);
        $sql=  $this->db->get();
        return $sql->result();  
    }
    function get_supplier_details(){
        $this->db->select()->from('suppliers');
        $sql=  $this->db->get();
        return $sql->result(); 
    }
    function get_selected_item($id){
        $this->db->select()->from('items')->where('id',$id);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function update_item($id,$tax,$area,$brand,$code,$barcode,$item_name,$description,$cost,$sellimg,$landing,$mrf,$discount,$start,$end,$location,$category,$suppier){
          $data=array('code'=>$code,	
            'barcode'=>$barcode,
            'category_id'=>$category,           
            'supplier_id'=>$suppier, 	
            'name'=>$item_name,
            'description'=>$description,
            'cost_price'=>$cost,
            'landing_cost'=>$landing,
            'selling_price'=>$sellimg,
            'mrf'=>$mrf,
            'discount_amount'=>$discount,
            'start_date'=>$start,
            'end_date '=>$end,
            'tax_id'=>$tax,
            'tax_area_id'=>$area,            
            'brand_id'=>$brand,            
            'location'=>$location);
        $this->db->where('id',$id);
        $this->db->update('items',$data);
    }
    function add_item($bid,$uid,$tax,$area,$brand,$code,$barcode,$item_name,$description,$cost,$sellimg,$landing,$mrf,$discount,$start,$end,$location,$category,$suppier){
        
        $data=array('code'=>$code,	
            'barcode'=>$barcode,
            'category_id'=>$category,
            'added_by '=>$uid,
            'branch_id'=>$bid,
            'supplier_id'=>$suppier, 	
            'name'=>$item_name,
            'description'=>$description,
            'cost_price'=>$cost,
            'landing_cost'=>$landing,
            'selling_price'=>$sellimg,
            'mrf'=>$mrf,
            'discount_amount'=>$discount,
            'start_date'=>$start,
            'end_date '=>$end,
            'tax_id'=>$tax,
            'tax_area_id'=>$area,
            'branch_id'=>$bid,
            'brand_id'=>$brand,
            
            'location'=>$location);
             $this->db->insert('items',$data);
             return $this->db->insert_id();
               
    }
    function item_setting($tax_in,$id,$bid){
        $data=array('item_id'=>$id,
            'branch_id'=>$bid, 	
            'min_q'=>0,
            'max_q'=>0, 	
            'sales'=>1,
            'purchase'=>1, 	
            'salses_return'=>1, 	
            'purchase_return'=>1, 	
            'allow_negative'=>1, 	
            'tax_inclusive'=>$tax_in);
        $this->db->insert('items_settings',$data);
    }
    function item_supplier($item_id,$cost,$sellimg,$suppier,$Bid,$Uid){
          $data=array('supplier_id'=>$suppier,
              'item_id'=>$item_id,
              'cost'=>$cost,
              'price'=>$sellimg,
              'branch_id'=>$Bid,
              'added_by'=>$Uid);
         $this->db->insert('suppliers_x_items',$data);
    }
    function update_item_supplier($item_id,$cost,$sellimg,$suppier,$Bid,$Uid){
        $data=array('supplier_id'=>$suppier,
              'cost'=>$cost,
              'price'=>$sellimg);
          $this->db->where('item_id',$item_id);
          $this->db->where('branch_id',$Bid);
          $this->db->insert('suppliers_x_items',$data);
    }





    function get_brands_user($bid){
              $this->db->select()->from('brands')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
              $sql=$this->db->get();
              return $sql->result();
          }
          
          function get_tax_for_user($bid){
              $this->db->select()->from('taxes')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
              $sql=$this->db->get();
              return $sql->result();
          }
          
         
          function get_tax_area_for_user($bid){
              $this->db->select()->from('taxes_area')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
              $sql=$this->db->get();
              return $sql->result();
          }
          function check_item($code,$bid){
              $this->db->select()->from('items')->where('code',$code)->where('branch_id',$bid)->where('delete_status',0);
              $sql=  $this->db->get();
              if($sql->num_rows()>0){
                  return FALSE;
              }else{
                  return TRUE;
              }
          }
          function check_item_for_update($code,$id,$bid){
              $this->db->select()->from('items')->where('delete_status',0)->where('id <>',$id)->where('branch_id',$bid)->where('code',$code);
              $sql=  $this->db->get();
              if($sql->num_rows()>0){
                  return FALSE;
              }else{
                  return TRUE;
              }
          }
                                  
                                   
}
?>
