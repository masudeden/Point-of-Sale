<?php
class Payment extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get($end,$start,$like,$branch){
                $this->db->select('payment.*,suppliers.first_name ,suppliers.company_name ');
                $this->db->from('payment')->where('payment.branch_id',$branch)->where('payment.type','debit');
                $this->db->join('suppliers', 'suppliers.guid=payment.supplier_id','left');
                $this->db->limit($end,$start); 
                $this->db->or_like($like);     
                $query=$this->db->get();
                $data=array();
                foreach ($query->result_array() as $row){
                 
                    $row['date']=date('d-m-Y',$row['payment_date']);
                    $data[]=$row;
                   
                }
                return $data; 
        
    }
    function search_grn_order($like,$branch){
        $this->db->select('direct_grn.*,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name');
        $this->db->from('direct_grn')->where('direct_grn.branch_id',$branch)->where('direct_grn.invoice_status',0)->where('direct_grn.order_status',1)->where('direct_grn.active_status',1)->where('direct_grn.delete_status',0);
        $or_like=array('grn_no'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->join('suppliers', 'suppliers.guid=direct_grn.supplier_id AND direct_grn.invoice_status=0 ','left');

        $this->db->or_like($or_like);     
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){
            $row['grn_date']=date('d-m-Y',$row['grn_date']);
          
             $data[]=$row;

        }
        
        // get data from grn
        
        $this->db->select('grn.guid,grn.grn_no,grn.date as grn_date ,grn.po,purchase_order.supplier_id,suppliers.guid as s_guid');
        $this->db->from('grn')->where('grn.branch_id',$branch)->where('grn.grn_status',1)->where('grn.invoice_status',0)->where('grn.delete_status',0);
        $or_like=array('grn_no'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->join('purchase_order', 'purchase_order.guid=grn.po AND grn.invoice_status=0 ','left');
        $this->db->join('suppliers', 'suppliers.guid=purchase_order.supplier_id ','left');
        $this->db->or_like($or_like);     
        $sql=$this->db->get();
       
        foreach($sql->result_array() as $row){
            $row['grn_date']=date('d-m-Y',$row['grn_date']);
            $data[]=$row;
        }
         return $data;
               
      


    }
   
  
  
   
    
    function count($branch){
        $this->db->select()->from('purchase_invoice')->where('branch_id',$branch);
        $sql=  $this->db->get();
        return $sql->num_rows();
    }
    
   
      function get_direct_grn($guid){
         $this->db->select('items.tax_Inclusive ,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,direct_grn.*,direct_grn_items.discount_per as dis_per ,direct_grn_items.discount_amount as item_dis_amt ,direct_grn_items.tax as dis_amt ,direct_grn_items.tax as order_tax,direct_grn_items.item ,direct_grn_items.quty ,direct_grn_items.free ,direct_grn_items.cost ,direct_grn_items.sell ,direct_grn_items.mrp,direct_grn_items.guid as o_i_guid ,direct_grn_items.amount ,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('direct_grn')->where('direct_grn.guid',$guid);
         $this->db->join('direct_grn_items', 'direct_grn_items.order_id = direct_grn.guid ','left');
         $this->db->join('items', "items.guid=direct_grn_items.item AND direct_grn_items.order_id='".$guid."' ",'left');
         $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=direct_grn_items.item  ",'left');
         $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=direct_grn_items.item  ",'left');
         $this->db->join('suppliers', "suppliers.guid=direct_grn.supplier_id AND direct_grn_items.order_id='".$guid."' ",'left');
         $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=direct_grn.supplier_id AND suppliers_x_items.item_id=direct_grn_items.item AND direct_grn_items.order_id='".$guid."'  ",'left');
         $sql=  $this->db->get();
         $data=array();
         foreach($sql->result_array() as $row){
             
          $row['grn_date']=date('d-m-Y',$row['grn_date']);
       
      
         
          $data[]=$row;
         }
         return $data;
    }
    function get_goods_receiving_note($guid){
        $this->db->select('grn.date as grn_date,grn.note as grn_note,grn.remark as grn_remark,grn.grn_no,grn_x_items.guid as grn_items_guid,grn_x_items.quty as rece_quty,grn_x_items.free as rece_free,items.tax_Inclusive ,grn.po,tax_types.type as tax_type_name,taxes.value as tax_value,taxes.type as tax_type,suppliers_x_items.quty as item_limit,suppliers.guid as s_guid,suppliers.first_name as s_name,suppliers.company_name as c_name,suppliers.address1 as address,purchase_order.*,purchase_order_items.discount_per as dis_per ,purchase_order_items.discount_amount as item_dis_amt ,purchase_order_items.tax as dis_amt ,purchase_order_items.tax as order_tax,purchase_order_items.item ,purchase_order_items.quty ,purchase_order_items.free,purchase_order_items.guid as o_i_guid ,purchase_order_items.received_quty ,purchase_order_items.received_free ,purchase_order_items.cost ,purchase_order_items.sell ,purchase_order_items.mrp,purchase_order_items.guid as o_i_guid ,purchase_order_items.amount ,purchase_order_items.date,items.guid as i_guid,items.name as items_name,items.code as i_code')->from('grn')->where('grn.guid',$guid);
        $this->db->join('purchase_order', 'grn.po=purchase_order.guid','left');
        $this->db->join('grn_x_items', 'grn_x_items.grn=grn.guid','left');
        $this->db->join('purchase_order_items', 'purchase_order_items.order_id = purchase_order.guid AND grn_x_items.item=purchase_order_items.item AND purchase_order_items.delete_status=0','left');
        $this->db->join('items', "items.guid=purchase_order_items.item AND items.guid=grn_x_items.item AND purchase_order_items.order_id=purchase_order.guid AND purchase_order_items.delete_status=0",'left');
        $this->db->join('taxes', "items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('tax_types', "taxes.type=tax_types.guid AND items.tax_id=taxes.guid AND items.guid=purchase_order_items.item  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('suppliers', "suppliers.guid=purchase_order.supplier_id AND purchase_order_items.order_id=purchase_order.guid  AND purchase_order_items.delete_status=0",'left');
        $this->db->join('suppliers_x_items', "suppliers_x_items.supplier_id=purchase_order.supplier_id AND suppliers_x_items.item_id=purchase_order_items.item AND purchase_order_items.order_id='".$guid."'  AND purchase_order_items.delete_status=0",'left');
        $sql=  $this->db->get();
        $data=array();
        foreach($sql->result_array() as $row){             
            $row['po_date']=date('d-m-Y',$row['po_date']);       
            $row['grn_date']=date('d-m-Y',$row['grn_date']);       
            $row['exp_date']=date('d-m-Y',$row['exp_date']);         
            $row['date']=date('d-m-Y',$row['date']);         
            $data[]=$row;
        }
        return $data;
    }
    function direct_grn_invoice_status($grn){
        $this->db->where('guid',$grn);
        $this->db->update('direct_grn',array('invoice_status'=>1));
    }
    function grn_invoice_status($grn){
        $this->db->where('guid',$grn);
        $this->db->update('grn',array('invoice_status'=>1));
    }
    /* get payable invoice auto suggestion
    function start      */
    function  serach_invoice($like){
        $this->db->select('supplier_payable.guid as p_guid,supplier_payable.invoice_id,supplier_payable.amount, supplier_payable.paid_amount, purchase_invoice.*, suppliers.first_name as name,suppliers.company_name as company,suppliers.address1 as address')->from('purchase_invoice')->where('purchase_invoice.branch_id',  $this->session->userdata['branch_id']);
        $this->db->join('suppliers', 'suppliers.guid=purchase_invoice.supplier_id ','left');  
        $this->db->join('supplier_payable', 'suppliers.guid=purchase_invoice.supplier_id AND supplier_payable.invoice_id=purchase_invoice.guid','left');  
        $or_like=array('invoice'=>$like,'suppliers.company_name'=>$like,'suppliers.first_name'=>$like);
        $this->db->or_like($or_like);     
        $this->db->limit($this->session->userdata['data_limit']);
        $sql=$this->db->get();
        return $sql->result();
    }
    /* function end*/
    /*
     * add new supplier payment
     * function start     */
    function save_payment($payment,$amount,$date,$memo,$code){
        $this->db->select()->from('supplier_payable')->where('guid',$payment);
        $sql=  $this->db->get();
        $total;
        $paid;
        $supplier;
        foreach ($sql->result() as $row){
            $total=$row->amount; // get total amount
            $paid=$row->paid_amount; // get paid amount
           $supplier=$row->supplier_id; // get paid amount
        }
        $balance=$total-$paid;
       
        if($amount > $balance){ // check wheather payment amount is valid or not, if it is invalid return false
           return FALSE; 
        } 
        $payment_status=0;
        if($total==($amount+$paid)){
            $payment_status=1;
        }
        $this->db->where('guid',$payment);
        $this->db->update('supplier_payable',array('payment_status'=>$payment_status,'paid_amount'=>$amount+$paid)); // update paid amount to supplier payable
        
        $data=array('type'=>'debit','invoice_id'=>$payment,'supplier_id'=>$supplier,'memo'=>$memo,'amount'=>$amount,'payment_date'=>$date,'added_date'=>strtotime(date("Y/m/d")),'branch_id'=>  $this->session->userdata['branch_id'],'added_by'=>  $this->session->userdata['guid']);
        $this->db->insert('payment',$data);
        $id=  $this->db->insert_id();
        $this->db->where('id',$id);
        $this->db->update('payment',array('guid'=>md5($id.$supplier.$payment)));
         return TRUE; 
    }
    /*
     *  fucntion end */ 
}
?>
