<?php
class Sales_quotation extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='sales_quotation';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        /// echo strtotime(date("Y/m/d"));
    }
    // purchase order data table
    function data_table(){
        $aColumns = array( 'guid','po_no','po_no','c_name','s_name','po_date','total_items','total_amt','active_status','order_status' );	
	$start = "";
			$end="";
		
		if ( $this->input->get_post('iDisplayLength') != '-1' )	{
			$start = $this->input->get_post('iDisplayStart');
			$end=	 $this->input->get_post('iDisplayLength');              
		}	
		$order="";
		if ( isset( $_GET['iSortCol_0'] ) )
		{	
			for ( $i=0 ; $i<intval($this->input->get_post('iSortingCols') ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($this->input->get_post('iSortCol_'.$i)) ] == "true" )
				{
					$order.= $aColumns[ intval( $this->input->get_post('iSortCol_'.$i) ) ]." ".$this->input->get_post('sSortDir_'.$i ) .",";
				}
			}
			
					$order = substr_replace( $order, "", -1 );
					
		}
		
		$like = array();
		
			if ( $_GET['sSearch'] != "" )
		{
		$like =array(
                    'po_no'=>  $this->input->get_post('sSearch'),
                        );
				
			}
					   
			$this->load->model('sales')	   ;
                        
			 $rResult1 = $this->sales->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->sales->count($this->session->userdata['branch_id']);
		
		$iTotal =$iFilteredTotal;
		
		$output1 = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"aaData" => array()
		);
		foreach ($rResult1 as $aRow )
		{
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $aColumns[$i] == "id" )
				{
					$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
				}
				else if ( $aColumns[$i]== 'po_date' )
				{
					/* General output */
					$row[] = date('d-m-Y',$aRow[$aColumns[$i]]);
				}
				else if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					$row[] = $aRow[$aColumns[$i]];
				}
				
			}
				
		$output1['aaData'][] = $row;
		}
                
		
		   echo json_encode($output1);
    }
    
    function  set_seleted_item_suppier($suid){
        $this->session->userdata['supplier_guid']=$suid;
    }
    
   
 
    
  
function save(){      
     if($this->session->userdata['purchase_order_per']['add']==1){
        $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
        $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');                      
        $this->form_validation->set_rules('new_item_id[]', $this->lang->line('new_item_id'), 'required');                      
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_free[]', $this->lang->line('new_item_free'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_mrp[]', $this->lang->line('new_item_mrp'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'required|numeric');                      
        $this->form_validation->set_rules('new_item_discount_per[]', $this->lang->line('new_item_discount_per'), 'numeric');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'numeric');                      
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'numeric');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'required|numeric');                      
           
            if ( $this->form_validation->run() !== false ) {    
                $supplier=  $this->input->post('supplier_guid');
                $expdate=strtotime($this->input->post('expiry_date'));
                $pono= $this->input->post('order_number');
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
  
     
              $value=array('supplier_id'=>$supplier,'exp_date'=>$expdate,'po_no'=>$pono,'po_date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'order_status'=>0,'total_item_amt'=>$total_amount);
              $guid=   $this->posnic->posnic_add_record($value,'purchase_order');
          
                $item=  $this->input->post('new_item_id');
                $quty=  $this->input->post('new_item_quty');
                $cost=  $this->input->post('new_item_cost');
                $free=  $this->input->post('new_item_free');
                $sell=  $this->input->post('new_item_price');
                $mrp=  $this->input->post('new_item_mrp');
                $net=  $this->input->post('new_item_total');
                $per=  $this->input->post('new_item_discount_per');
                $dis=  $this->input->post('new_item_discount');
                $tax=  $this->input->post('new_item_tax');
           
                for($i=0;$i<count($item);$i++){
              
                        $item_value=array('order_id'=>$guid,'discount_per'=>$per[$i],'discount_amount'=>$dis[$i],'tax'=>$tax[$i],'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i]);
                        $this->posnic->posnic_add_record($item_value,'purchase_order_items');
                
                        
                }
                $this->posnic->posnic_master_increment_max('purchase_order')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            if(isset($_POST['purchase_order_guid'])){
      if($this->session->userdata['purchase_order_per']['edit']==1){
        $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
        $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
        $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
        $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
        $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'numeric');                      
        $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'numeric'); 
        
        
        $this->form_validation->set_rules('round_off_amount', $this->lang->line('round_off_amount'), 'numeric');                      
        $this->form_validation->set_rules('discount', $this->lang->line('discount'), 'numeric');                      
        $this->form_validation->set_rules('freight', $this->lang->line('freight'), 'numeric');    
        
        $this->form_validation->set_rules('new_item_quty[]', $this->lang->line('new_item_quty'), 'numeric');                      
        $this->form_validation->set_rules('new_item_cost[]', $this->lang->line('new_item_cost'), 'numeric');                      
        $this->form_validation->set_rules('new_item_free[]', $this->lang->line('new_item_free'), 'numeric');                      
        $this->form_validation->set_rules('new_item_mrp[]', $this->lang->line('new_item_mrp'), 'numeric');                      
      
        $this->form_validation->set_rules('new_item_price[]', $this->lang->line('new_item_price'), 'numeric');                      
        $this->form_validation->set_rules('new_item_discount_per[]', $this->lang->line('new_item_discount_per'), 'numeric');                      
        $this->form_validation->set_rules('new_item_discount[]', $this->lang->line('new_item_discount'), 'numeric');                      
        $this->form_validation->set_rules('new_item_total[]', $this->lang->line('new_item_total'), 'numeric');                      
        $this->form_validation->set_rules('new_item_tax[]', $this->lang->line('new_item_tax'), 'numeric');
        
        
        $this->form_validation->set_rules('items_quty[]', $this->lang->line('items_quty'), 'numeric');                      
        $this->form_validation->set_rules('items_cost[]', $this->lang->line('items_cost'), 'numeric');                      
        $this->form_validation->set_rules('items_free[]', $this->lang->line('items_free'), 'numeric');                      
        $this->form_validation->set_rules('items_mrp[]', $this->lang->line('items_mrp'), 'numeric');                      
        $this->form_validation->set_rules('items_price[]', $this->lang->line('items_price'), 'numeric');                      
        $this->form_validation->set_rules('items_discount_per[]', $this->lang->line('items_discount_per'), 'numeric');                      
        $this->form_validation->set_rules('items_discount[]', $this->lang->line('items_discount'), 'numeric');                      
        $this->form_validation->set_rules('items_total[]', $this->lang->line('items_total'), 'numeric');                      
        $this->form_validation->set_rules('items_tax[]', $this->lang->line('items_tax'), 'numeric');
            if ( $this->form_validation->run() !== false ) {    
                $supplier=  $this->input->post('supplier_guid');
                $expdate=strtotime($this->input->post('expiry_date'));
                $pono= $this->input->post('order_number');
                $podate= strtotime($this->input->post('order_date'));
                $discount=  $this->input->post('discount');
                $discount_amount=  $this->input->post('discount_amount');
                $freight=  $this->input->post('freight');
                $round_amt=  $this->input->post('round_off_amount');
                $total_items=$this->input->post('index');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                $total_amount=  $this->input->post('total_amount');
                $grand_total=  $this->input->post('grand_total');
  
     
              $value=array('supplier_id'=>$supplier,'exp_date'=>$expdate,'po_date'=>$podate,'discount'=>$discount,'discount_amt'=>$discount_amount,'freight'=>$freight,'round_amt'=>$round_amt,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'total_item_amt'=>$total_amount);
              $guid=  $this->input->post('purchase_order_guid');
              $update_where=array('guid'=>$guid);
              $this->posnic->posnic_update_record($value,$update_where,'purchase_order');
          
                $item=  $this->input->post('items_id');
                $quty=  $this->input->post('items_quty');
                $cost=  $this->input->post('items_cost');
                $free=  $this->input->post('items_free');
                $sell=  $this->input->post('items_price');
                $mrp=  $this->input->post('items_mrp');
                $net=  $this->input->post('items_total');
                $per=  $this->input->post('items_discount_per');
                $dis=  $this->input->post('items_discount');
                $tax=  $this->input->post('items_tax');
                for($i=0;$i<count($item);$i++){
               
                         $where=array('order_id'=>$guid,'item'=>$item[$i]);
                        $item_value=array('order_id'=>$guid,'discount_per'=>$per[$i],'discount_amount'=>$dis[$i],'tax'=>$tax[$i],'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i]);
                       $this->posnic->posnic_update_record($item_value,$where,'purchase_order_items');
                
                        
                }
                $delete=  $this->input->post('r_items');
                    for($j=0;$j<count($delete);$j++){
                        $this->load->model('sales');
                        
                         $this->sales->delete_order_item($delete[$j]);
                    }
                    
                $new_item=  $this->input->post('new_item_id');
                $new_quty=  $this->input->post('new_item_quty');
                $new_cost=  $this->input->post('new_item_cost');
                $new_free=  $this->input->post('new_item_free');
                $new_sell=  $this->input->post('new_item_price');
                $new_mrp=  $this->input->post('new_item_mrp');
                $new_net=  $this->input->post('new_item_total');
                $new_per=  $this->input->post('new_item_discount_per');
                $new_dis=  $this->input->post('new_item_discount');
                $new_tax=  $this->input->post('new_item_tax');
                for($i=0;$i<count($new_quty);$i++){
          if($new_quty[$i]!=""){
             
                        $new_item_value=array('order_id'=>$guid,'discount_per'=>$new_per[$i],'discount_amount'=>$new_dis[$i],'tax'=>$new_tax[$i],'item'=>$new_item[$i],'quty'=>$new_quty[$i],'free'=>$new_free[$i],'cost'=>$new_cost[$i],'sell'=>$new_sell[$i],'mrp'=>$new_mrp[$i],'amount'=>$new_net[$i]);
                        $this->posnic->posnic_add_record($new_item_value,'purchase_order_items');
          }
                        
                }
                    
                    
                    
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
        }
        
        
    }
        
/*
 * get supplier details for purchase order
 *  */       
// functoon starts
function search_customer(){
    $search= $this->input->post('term');  
    $like=array('first_name'=>$search,'email'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);       
    $data= $this->posnic->posnic_select2('customers',$like)    ;
    echo json_encode($data);
}
// function end

/*
Delete purchase order if the user have permission  */
// function start
function delete(){
   if($this->session->userdata['brands_per']['delete']==1){ // check permission of current user for delete purchase  order
            if($this->input->post('guid')){ 
                $this->load->model('sales');
                $guid=$this->input->post('guid');
                $status=$this->sales->check_approve($guid);// check if the purchase order was already apparoved or what
                    if($status!=FALSE){
                        $this->posnic->posnic_delete($guid,'purchase_order'); // delete the purchase order
                        echo 'TRUE';
                    }else{
                        echo 'Approved';
                    }
            
            }
           }else{
            echo 'FALSE';
        }
    
}
// function end

function  get_purchase_order($guid){
    if($this->session->userdata['purchase_order_per']['edit']==1){
    $this->load->model('sales');
    $data=  $this->sales->get_purchase_order($guid);
    echo json_encode($data);
    }
}

function purchase_order_approve(){
     if($this->session->userdata['purchase_order_per']['approve']==1){
            $id=  $this->input->post('guid');
            $this->load->model('sales');
            $this->sales->approve_order($id);
            echo 'TRUE';
     }else{
         echo 'FALSE';
     }
    }
function order_number(){
       $data[]= $this->posnic->posnic_master_max('sales')    ;
       echo json_encode($data);
}
/*
 * search items to purchase order with or like 
 *  */

function search_items(){
    $search= $this->input->post('term');
    $guid= $this->input->post('suppler');
    $this->load->model('sales');
    $data= $this->sales->search_items($search);      
    echo json_encode($data);
       
        
}
}
?>
