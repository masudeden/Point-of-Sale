<?php
class Purchase extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_purchase_order_user($id){
            $this->db->where('branch_id',$id);
            $this->db->where('active',0);
            $this->db->where('active_status',1);
            $this->db->from('purchase_order');
            return $this->db->count_all_results();
    }
    function get_purchase_order_details_for_user($limit, $start,$branch) {
            $this->db->limit($limit, $start);   
            $this->db->where('branch_id',$branch);
            $this->db->where('active',0);
            $this->db->where('active_status',1);
            $query = $this->db->get('purchase_order');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
           }
          return false;          
   }
   function get_suppliers(){
       $this->db->select()->from('suppliers');
       return $this->db->get();
   }
   function get_selected_branch_for_view(){
       $this->db->select()->from('branches');
       return $this->db->get();
   }
   function get_selected_supplier($data,$bid){
        
        $this->db->select()->from('suppliers')->like('company_name',$data)->where('active_status',1)->where('branch_id',$bid);
        $sql=  $this->db->get();
        $name=array();
        $companany=array();
        $id=array();
        $phone=array();
        $email=array();
        foreach ($sql->result() as $row){
            $name[]=$row->company_name  ;
            $companany[]=$row->first_name  ;            
            $id[]=$row->id;       
            $phone[]=$row->phone;
            $email[]=$row->email;
        }
        $sasi[0]=$name;
        $sasi[1]=$companany;    
        $sasi[2]=$phone;
        $sasi[3]=$email;
        $sasi[4]=$id;       
        return $sasi;        
    }
    function get_selected_item($data,$bid){
        $this->db->select()->from('items')->like('code',$data)->where('active_status',1)->where('branch_id',$bid)->where('delete_status',0);
        $sql=  $this->db->get();
        $name=array();
        $companany=array();
        $id=array();
        $cost=array();
        $sell=array();
        $mrf=array();
        $iname=array();
        foreach ($sql->result() as $row){
            $name[]=$row->code  ;
            $companany[]=$row->description   ;            
            $id[]=$row->id;    
            $cost[]=$row->cost_price ;
            $sell[]=$row->selling_price ;
            $mrf[]=$row->mrf;
            $iname[]=$row->name;
        }
        $sasi[0]=$name;
        $sasi[1]=$companany;        
        $sasi[2]=$id;    
        $sasi[3]=$cost;
        $sasi[4]=$sell;
        $sasi[5]=$mrf;
        $sasi[6]=$iname;
        return $sasi;  
    }
    function get_selected_item_view($id,$bid){
        $this->db->select()->from('items')->where('code',$id)->where('branch_id',$bid)->where('active_status',1);
        $sql=$this->db->get();
        $data=array();
        if($sql->num_rows()>0){
        foreach ($sql->result() as $row){
            $data[0]=$row->code ;
            $data[1]=$row->description ;
            $data[2]=$row->cost_price;
            $data[3]=$row->selling_price ;
            $data[4]=$row->mrf ;
        }
        return $data;
        }else{
            return FALSE;
        }
    }
}
?>
