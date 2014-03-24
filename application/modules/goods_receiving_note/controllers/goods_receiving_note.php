<?php
class Goods_receiving_note extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='purchase_order';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // goods Receiving Note data table
    function data_table(){
        $aColumns = array( 'grn_guid','po_no','po_no','grn_no','c_name','s_name','grn_date','total_items','total_amt','grn_active','grn_active','guid' );	
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
                    'grn_no'=>  $this->input->get_post('sSearch'),
                        );
				
			}
					   
			$this->load->model('grn')	   ;
                        
			 $rResult1 = $this->grn->get($end,$start,$like,$_SESSION['Bid']);
		   
		$iFilteredTotal =$this->grn->count($_SESSION['Bid']);
		
		$iTotal =$this->grn->count($_SESSION['Bid']);
		
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
 
function save(){      
     if($_SESSION['purchase_order_per']['add']==1){
        $this->form_validation->set_rules('goods_receiving_note_guid',$this->lang->line('goods_receiving_note_guid'), 'required');
        $this->form_validation->set_rules('grn_date',$this->lang->line('grn_date'), 'required');
        $this->form_validation->set_rules('grn_no', $this->lang->line('grn_no'), 'required');                     
           
            if ( $this->form_validation->run() !== false ) {    
                $po=  $this->input->post('goods_receiving_note_guid');
                $grn_date=strtotime($this->input->post('grn_date'));
                $grn_no= $this->input->post('grn_no');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                
  
     
                $value=array('grn_no'=>$grn_no,'date'=>$grn_date,'po'=>$po,'remark'=>$remark,'note'=>$note);
                $guid=   $this->posnic->posnic_add_record($value,'grn');
          
                $quty=  $this->input->post('receive_quty');
                $free=  $this->input->post('receive_free');
                $items=  $this->input->post('items');
                $po_item=  $this->input->post('order_items');
           
                for($i=0;$i<count($items);$i++){
          
                        $item_value=array('grn'=>$guid,'item'=>$items[$i],'quty'=>$quty[$i],'free'=>$free[$i]);
                        $this->posnic->posnic_add_record($item_value,'grn_x_items');
                        $this->load->model('grn');
                        $this->grn->update_item_receving($po_item[$i],$quty[$i],$free[$i]);
                        //$this->grn->add_stock($items[$i],$quty[$i]+$free[$i],$po_item[$i],$_SESSION['Bid']);
                }
                $this->posnic->posnic_master_increment_max('grn')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
    function update(){
            
      if($_SESSION['purchase_order_per']['edit']==1){
        $this->form_validation->set_rules('goods_receiving_note_guid',$this->lang->line('goods_receiving_note_guid'), 'required');
        $this->form_validation->set_rules('grn_date',$this->lang->line('grn_date'), 'required');
        //$this->form_validation->set_rules('grn_no', $this->lang->line('grn_no'), 'required');                         
        $this->form_validation->set_rules('receive_quty[]', 'receive_quty', 'regex_match[/^[0-9]+$/]|xss_clean');
        $this->form_validation->set_rules('receive_free[]', 'receive_free', 'regex_match[/^[0-9]+$/]|xss_clean');
            if ( $this->form_validation->run() !== false ) {    
                $po=  $this->input->post('goods_receiving_note_guid');
                $grn_date=strtotime($this->input->post('grn_date'));
               // $grn_no= $this->input->post('grn_no');
                $remark=  $this->input->post('remark');
                $note=  $this->input->post('note');
                
  
     
                $value=array('date'=>$grn_date,'remark'=>$remark,'note'=>$note);
                $guid=  $this->input->post('grn_guid');
                $update_where=array('guid'=>$guid);
                $this->posnic->posnic_update_record($value,$update_where,'grn');          
                $quty=  $this->input->post('receive_quty');
                $grn_item_guid=  $this->input->post('grn_items_guid');
                $free=  $this->input->post('receive_free');
                $items=  $this->input->post('items');
                $po_item=  $this->input->post('order_items');
           
                for($i=0;$i<count($items);$i++){
          
                        $this->load->model('grn');
                        $this->grn->update_grn_items_quty($grn_item_guid[$i],$quty[$i],$free[$i],$items[$i],$po_item[$i]);
                      
                }
                    
                    
                    
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
          
   }
        
        
function convert_date($date){
   $new=array();
   $new[]= date('n.j.Y', strtotime('+0 year, +0 days',$date));
   echo json_encode($new);
}
function search_purchase_order(){
       $search= $this->input->post('term');
         if($search!=""){
             $this->load->model('grn');
            $data= $this->grn->search_purchase_order($search,$_SESSION['Bid'])    ;
            echo json_encode($data);
        }
        
}
function delete(){
   if($_SESSION['goods_receiving_note_per']['delete']==1){
        if($this->input->post('guid')){
            $guid=  $this->input->post('guid');
            $this->load->model('grn');
            $status=$this->grn->check_approve($guid);
           if($status!=FALSE){
            $this->posnic->posnic_delete($guid,'grn');
            
            $this->grn->delete_grn_items($guid);            
                echo 'TRUE';
            }else{
                echo 'Approved';
            }
        
        }
    }else{
         echo 'FALSE';
    }
    
}
function  get_purchase_order($guid){
    if($_SESSION['purchase_order_per']['edit']==1){
    $this->load->model('grn');
    $data=  $this->grn->get_purchase_order($guid);
    echo json_encode($data);
    }
}
function  get_goods_receiving_note($guid){
    if($_SESSION['purchase_order_per']['edit']==1){
    $this->load->model('grn');
    $data=  $this->grn->get_goods_receiving_note($guid);
    echo json_encode($data);
    }
}
function good_receiving_note_approve(){
    if($_SESSION['goods_receiving_note_per']['approve']==1){
        $id=  $this->input->post('guid');
        $po=  $this->input->post('po');
        $report= $this->posnic->posnic_module_deactive($id,'grn'); 
        $this->load->model('grn');
        $this->grn->add_stock($id,$po,$_SESSION['Bid']);
        if (!$report['error']) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }else{
        echo 'Noop';
    }
}
function group_approve(){
    if($_SESSION['goods_receiving_note_per']['approve']==1){
        $id=  $this->input->post('guid');
        $this->load->model('grn');
        $po= $this->grn->get_order_chnage_order($guid);
        $report= $this->posnic->posnic_module_deactive($id,'grn'); 
        
        $this->grn->add_stock($id,$po,$_SESSION['Bid']);
        if (!$report['error']) {
            echo 'TRUE';
        } else {
            echo 'FALSE';
        }
    }else{
        echo 'Noop';
    }
}
function order_number(){
       $data[]= $this->posnic->posnic_master_max('grn')    ;
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
