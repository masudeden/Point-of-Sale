<?php
class Purchase_order extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
           //   $this->get_list();
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='purchase_order';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    // purchase order data table
    function data_table(){
        $aColumns = array( 'guid','po_no','po_no','c_name','s_name','po_date','total_items','total_amt','active','active' );	
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
		$like =array('first_name'=>  $this->input->get_post('sSearch'));
				
			}
					   
			$this->load->model('purchase')	   ;
                        
			 $rResult1 = $this->purchase->get($end,$start,$like,$_SESSION['Bid']);
		   
		$iFilteredTotal =$this->purchase->count($_SESSION['Bid']);
		
		$iTotal =$this->purchase->count($_SESSION['Bid']);
		
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
    function annan(){
                $this->load->model('core_model');
                $name=$this->core_model->posnic_join_like('suppliers_x_items',$_SESSION['Bid']);
                for($i=0;$i<count($name);$i++){
                    echo $name[$i]."<br>";
                }
    }
    function  set_seleted_item_suppier($suid){
        $_SESSION['supplier_guid']=$suid;
    }
            function get_selected_supplier()
    {       
       $q= addslashes($_REQUEST['term']);
                $where=array('company_name'=>$q);
                $name=$this->posnic->posnic_like('suppliers',$where,'company_name');
                $dis=  $this->posnic->posnic_like('suppliers',$where,'first_name');
                $id= $this->posnic->posnic_like('suppliers',$where,'guid');
                $j=0;
                $data=array();
                 for($i=0;$i<count($name);$i++)
                            {                                
                                $data[$j] = array(
                                          'label' =>$name[$i]  ,
                                          'company' =>$dis[$i],  
                                          'guid'=>$id[$i]
                                          
                                );			
                                        $j++;                                
                        }
        echo json_encode($data);
    
    }
   
   function get_item_details(){
       $q= addslashes($_REQUEST['term']);
                $like=array('code'=>$q);    
               
                $where='suppliers_x_items.item_id=items.guid AND suppliers_x_items.active = 0  AND suppliers_x_items.item_active  = 0 AND suppliers_x_items.supplier_id ="'.$_SESSION['supplier_guid'].'" AND items.active_status=0  AND items.active=0  ';
                $data=$this->posnic-> posnic_join_like('suppliers_x_items','items',$like,$where);
        echo json_encode($data);
    }   
    
    function get_item_details_for_view($iid){
        if ($iid=="pos") return;
            $this->load->model('purchase');     
            $id=urldecode($iid);
            $where=array('code'=>$id);
            $data=$this->posnic->posnic_one_array_module_where('items',$where);
           foreach ($data as $value){ 
            echo "  <table> <tr><td >Name  </td><td >Cost</td><td >Price</td><td > MRF</td></tr><tr><td ><input type=text style=width:150px disabled value =$value[description]   ></td><td ><input type=text value =$value[cost_price] class=items_div disabled ></td><td ><input type=text value =$value[selling_price] class=items_div disabled ></td><td ><input type=text value= $value[mrp] class=items_div  disabled ></td></tr></table>";
            
            
        }
     }
 
    
  
function save(){      
       if($_SESSION['purchase_order_per']['add']==1){
        
        
            $this->form_validation->set_rules('supplier_guid',$this->lang->line('supplier_guid'), 'required');
            $this->form_validation->set_rules('expiry_date',$this->lang->line('expiry_date'), 'required');
            $this->form_validation->set_rules('order_number', $this->lang->line('order_number'), 'required');
            $this->form_validation->set_rules('order_date', $this->lang->line('order_date'), 'required');                      
            $this->form_validation->set_rules('grand_total', $this->lang->line('grand_total'), 'required');                      
            $this->form_validation->set_rules('total_amount', $this->lang->line('total_amount'), 'required');                      
           
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
          
             $item=  $this->input->post('items_id');
      $quty=  $this->input->post('items_quty');
      $cost=  $this->input->post('items_cost');
      $free=  $this->input->post('items_free');
      $sell=  $this->input->post('items_price');
      $mrp=  $this->input->post('items_mrp');
      $del_date= $this->input->post('items_date');
      $net=  $this->input->post('items_total');
      for($i=0;$i<count($item);$i++){
          
          $item_value=array('order_id'=>$guid,'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'date'=> strtotime($del_date[$i]));
         $this->posnic->posnic_add_record($item_value,'purchase_order_items');
      }
       echo 'TRUE';
    
     }else{
        echo 'FALSE';
     }
        }
           
    }
    function get_list(){
        
	        $config["base_url"] = base_url()."index.php/purchase_order/get_list";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links(); 
                $where=array();
                $data['sup']=  $this->posnic->posnic_module_where('suppliers',$where);
                $this->load->view('order_list',$data);
    }
    function purchase_order_magement(){
        if(isset($_POST['add'])){
            if($_SESSION['Posnic_Add']==="Add"){
            $this->add_order();
            }else{
                  echo "You  Have No permmission To Edit PO";
                    $this->get_list();
            }
        }
        if(isset($_POST['cancel'])){
            redirect('home');
        }
        
    }
    function edit_purchase_order($guid){
        if($_SESSION['Posnic_Edit']==="Edit"){
                $where=array('guid'=>$guid);
                $data['order']=  $this->posnic->posnic_module_where('purchase_order',$where);
                $where=array('order_id'=>$guid);
                $data['order_items']=  $this->posnic->posnic_module_all_where('purchase_order_items',$where);
                $where=array();
                $data['item']= $this->posnic->posnic_module_all_where('items',$where);
                $where=array();
                $data['sup']=  $this->posnic->posnic_module_all_where('suppliers',$where);
                $this->load->view('update_order',$data);
    }else{
        echo "You  Have No permmission To Edit PO";
        $this->get_list();
    }
    
        }
        function update_order(){
            if(isset($_POST['save'])){
        if($_SESSION['Posnic_Edit']==="Edit"){
        
            
            $this->form_validation->set_rules('supplier_id',$this->lang->line('supplier_id'), 'required');
            $this->form_validation->set_rules('expdate',$this->lang->line('expdate'), 'required');
            $this->form_validation->set_rules('pono', $this->lang->line('pono'), 'required');
            $this->form_validation->set_rules('podate', $this->lang->line('podate'), 'required');                      
           $guid=  $this->input->post('order_id');
            if ( $this->form_validation->run() !== false ) {    
      $supplier=  $this->input->post('supplier_id');
      $expdate=strtotime($this->input->post('expdate'));
      $pono= $this->input->post('pono');
      $podate= strtotime($this->input->post('podate'));
      $discount=  $this->input->post('discount');
      $freight=  $this->input->post('freight');
       $round_amt=  $this->input->post('round_amt');
      $total_items=$this->input->post('roll_no')-1;
      $remark=  $this->input->post('remark');
      $note=  $this->input->post('note');
      $item_total= $this->input->post('hidden_total_pric');
      $dis_amt= (trim($item_total)*$discount)/100;
      $grand_total=  (trim($item_total)-$dis_amt)+trim($freight)+trim($round_amt);
      $item=  $this->input->post('items');
      $quty=  $this->input->post('quty');
      $free=  $this->input->post('free');
      $cost=  $this->input->post('cost');
      $sell=  $this->input->post('sell');
      $mrp=  $this->input->post('mrp');
      $del_date=$this->input->post('del_dates');
      $net=  $this->input->post('net');
             $value=array('supplier_id'=>$supplier,'exp_date'=>$expdate,'po_no'=>$pono,'po_date'=>$podate,'discount'=>$discount,'discount_amt'=>$dis_amt,'freight'=>$freight,'round_amt'=>$freight,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'order_status'=>0,'total_item_amt'=>$item_total);
                $where=array('guid'=>$guid);
                $this->posnic->posnic_update($value,$where);
             
                 if($_SESSION['Posnic_Delete']==="Delete"){
                $where=array('order_id'=>$guid);
               $data=$this->posnic->posnic_array_other_module_where('purchase_order_items',$where);
            
            if(count($data)>0)     { $i=0;
                 foreach ($data as $i_value){
             
                     if(!$this->input->post($i_value['item'])){
                        $where=array('guid'=>$i_value['guid']);
                        $this->posnic->posnic_module_delete($where,'purchase_order_items');
                       
                     }
                 }
                    }
            }
            $module='purchase_order_items';
             for($i=0;$i<count($item);$i++){         
      
               $value=array('order_id'=>$guid,'item'=>$item[$i]);
                        if($this->posnic->check_module_unique($value,$module)){
                            $item_value=array('order_id'=>$guid,'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'date'=>strtotime($del_date[$i]));
                            $this->posnic->posnic_module_add($module,$item_value);
            }else{
                $where=array('order_id'=>$guid,'item'=>$item[$i]);
                            $item_value=array('order_id'=>$guid,'item'=>$item[$i],'quty'=>$quty[$i],'free'=>$free[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'date'=>strtotime($del_date[$i]));
                            $this->posnic->posnic_module_update($module,$item_value,$where);
            }
                
             }  
            $this->get_list();
            }else{
                $this->edit_purchase_order($guid);
            }
            
            
            
         }else{
        echo "You  Have No permmission To Edit PO";
        $this->get_list();
    }
        }
        else{
            redirect('purchase_order/get_list');
        }}
        
        
function convert_date($date){
   $new=array();
   $new[]= date('n.j.Y', strtotime('+0 year, +0 days',$date));
   echo json_encode($new);
}
function search_supplier(){
       $search= $this->input->post('term');
         if($search!=""){
            $like=array('first_name'=>$search,'last_name'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);
       
            $data= $this->posnic->posnic_or_like('suppliers',$like)    ;
            echo json_encode($data);
        }
        
}
function order_number(){
       $data[]= $this->posnic->posnic_master_max('purchase_order')    ;
       echo json_encode($data);
}
function search_items(){
       $search= $this->input->post('term');
    $guid= $this->input->post('suppler');
         if($search!=""){
            
            $this->load->model('purchase');
            $data= $this->purchase->serach_items($search,$_SESSION['Bid'],$guid);      
            echo json_encode($data);
        }
        
}
}
?>
