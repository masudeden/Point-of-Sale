<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Receiving_items extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_items($bid){
        $this->db->select()->from('items_x_branchs')->where('active_status',0)->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function get_item_details($bid){
        $this->db->select()->from('items')->where('branch_id',$bid);
        $sql=  $this->db->get();
        return $sql->result();
    }
    function get_selected_item_details($data){
        
        $this->db->select()->from('items')->like('code',$data)->where('active_status',0)->where('branch_id',0);
        $sql=  $this->db->get();
        $details=array();
        $cost=array();
        $dis=array();
        $sell=array();
        $id=array();
        foreach ($sql->result() as $row){
            $details[]=$row->code;
            $dis[]=$row->description ;            
            $id[]=$row->id;
            $sell[]=$row->selling_price;
            $cost[]=$row->cost_price;
        }
        $sasi[0]=$details;
        $sasi[1]=$dis;
        
        $sasi[2]=$id;
        $sasi[3]=$sell;
        $sasi[4]=$cost;
        
        return $sasi;
        
    }
}
