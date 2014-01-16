<?php

class Core_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function item_setting($guid,$branch){
        $data=array('item_id'=>$guid,
            'branch_id'=>$branch);
        $this->db->insert('items_setting',$data);
        $id=$this->db->insert_id();
        $orderid=md5($id.'items_setting');
        $guid=str_replace(".", "", "$orderid");
        $value=array('guid'=>$guid);
        $this->db->where('id',$id);
        $this->db->update('items_setting',$value);
    }
    
    
    function delete_item_setting($guid,$bid){
        $data=array('active_status'=>1,'delete_status'=>1);
        $this->db->where('item_id',$guid);
        $this->db->where('branch_id',$bid);
        $this->db->update('items_setting',$data);
        
            
        }
    function restore_item_setting($guid,$bid){
        $data=array('active_status'=>0,'delete_status'=>0);
        $this->db->where('item_id',$guid);
        $this->db->where('barnch_id',$bid);
        $this->db->update('items_setting',$data);
        
        
            
        }
    function suppliers_x_items($id,$bid,$mrp,$supplier,$selling_price,$cost_price){
            $data=array('item_id'=>$id,'mrp'=>$mrp,'supplier_id'=>$supplier,'price'=>$selling_price,'cost'=>$cost_price,'branch_id'=>$bid);
            $this->db->insert('suppliers_x_items',$data);
            
    }
   function posnic_join_like($table,$bid){
       
         $this->db->select()->from('suppliers_x_items');
         
         $this->db->join('items', "$table".'.item_id=items.guid AND suppliers_x_items.active = 0','left');
          $this->db->group_by("items".'.guid');
         $sql=  $this->db->get();
          $j=0;
        $data=array();
    foreach ($sql->result() as $row){
           $data[$j] = array(
                                          'label' =>$row->code ,
                                          'desc' =>$row->description,                                          
                                          'cost' =>$row->cost,                                          
                                          'sell' =>$row->price ,                                          
                                          'mrp' =>$row->mrp,                                          
                                          'id'=>$row->guid
                                );			
                                        $j++; 
    }
    return $data;
    }
    function user_fetch_array($like,$start,$end,$sOrder){
        $this->db->select();
         $this->db->limit($start,$end);       
        $this->db->order_by($sOrder);
        $this->db->or_like($like);
        
      
                 
                $query = $this->db->get('ajax');
                return $query->result_array();
    }
      function posnic_data_table($start,$end,$table2,$table1,$join_where,$branch,$uid,$order,$like){
        
        $this->db->select(' users.*, users.active  as user_active , users_x_branchs.emp_id as emp_id')->from($table1 );  
        $this->db->limit($start,$end);  
        $this->db->order_by($order);
        $this->db->where('users.guid <>',$uid);
        $this->db->where('users.user_type <>',2 );
        $this->db->where('users_x_branchs.user_active ',0 );
        
        $this->db->or_like($like);
        $join_where=$join_where."AND  $table1.delete_status=0 AND users.user_type!=2 and users_x_branchs.branch_id ='".$branch."'";
        $this->db->join($table2, "$join_where".'','left');
        $query=$this->db->get();
        return $query->result_array();
            
    }
    function items_data_table($end,$start,$order,$like){
                $this->db->select('items.* ,items_category.guid as c_guid,items_category.category_name as c_name,brands.guid as b_guid,brands.name as b_name')->from('items');
                $this->db->join('items_category', 'items.category_id=items_category.guid','left');
                $this->db->join('brands', 'items.brand_id=brands.guid','left');
               // $this->db->join('supplier', 'stock.supplier=supplier.id','left');
                $this->db->limit($end,$start); 
               //$this->db->order_by($order);
               // $this->db->like('stage',$stage);
                $this->db->like($like);     
                $query=$this->db->get();
                return $query->result_array(); 
    }
                                    
}
?>
