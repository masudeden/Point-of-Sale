
<?php
class Purchase_order_cancel extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='goods_receiving_note';
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
					   
			$this->load->model('purchase')	   ;
                        
			 $rResult1 = $this->purchase->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->purchase->count($this->session->userdata['branch_id']);
		
		$iTotal =$this->purchase->count($this->session->userdata['branch_id']);
		
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
     if($this->session->userdata['purchase_order_cancel_per']['add']==1){
        $this->form_validation->set_rules('purchase_order_guid',$this->lang->line('purchase_order_guid'), 'required');
        $this->form_validation->set_rules('items_order_guid[]',$this->lang->line('items_order_guid'), 'required');
        $this->form_validation->set_rules('items_old_quty[]',$this->lang->line('items_old_quty'), 'required|numeric');
        $this->form_validation->set_rules('items_old_free[]',$this->lang->line('items_old_free'), 'required|numeric');
        $this->form_validation->set_rules('items_quty[]',$this->lang->line('items_quty'), 'required|numeric');
        $this->form_validation->set_rules('items_free[]',$this->lang->line('items_quty'), 'numeric');
            if ( $this->form_validation->run() !== false ) {    
                $po=  $this->input->post('purchase_order_guid');
                
                $items_order_guid=  $this->input->post('items_order_guid');
                $items_old_quty=  $this->input->post('items_old_quty');
                $items_old_free=  $this->input->post('items_old_free');
                $items_quty=  $this->input->post('items_quty');
                $items_free=  $this->input->post('items_free');
                $po_item=  $this->input->post('order_items');
           
                for($i=0;$i<count($items);$i++){
          
                        $item_value=array('purchase'=>$guid,'item'=>$items[$i],'quty'=>$quty[$i],'free'=>$free[$i]);
                        $this->posnic->posnic_add_record($item_value,'grn_x_items');
                        $this->load->model('purchase');
                        $this->purchase->update_item_receving($po_item[$i],$quty[$i],$free[$i]);
                        //$this->purchase->add_stock($items[$i],$quty[$i]+$free[$i],$po_item[$i],$this->session->userdata['branch_id']);
                }
                $this->posnic->posnic_master_increment_max('purchase')  ;
                 echo 'TRUE';
    
                }else{
                   echo 'FALSE';
                }
        }else{
                   echo 'Noop';
                }
           
    }
   
        

function purchase_order_number(){
        $search= $this->input->post('term');
        $this->load->model('purchase');
        $data= $this->purchase->search_purchase_order($search,$this->session->userdata['branch_id'])    ;
        echo json_encode($data);
         
       
        
}
function delete(){
   if($this->session->userdata['goods_receiving_note_per']['delete']==1){
        if($this->input->post('guid')){
            $guid=  $this->input->post('guid');
            $this->load->model('purchase');
            $status=$this->purchase->check_approve($guid);
           if($status!=FALSE){
            $this->posnic->posnic_delete($guid,'purchase');
            
            $this->purchase->delete_grn_items($guid);            
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
    if($this->session->userdata['purchase_order_per']['edit']==1){
    $this->load->model('purchase');
    $data=  $this->purchase->get_purchase_order($guid);
    echo json_encode($data);
    }
}
function  get_goods_receiving_note($guid){
    if($this->session->userdata['purchase_order_per']['edit']==1){
    $this->load->model('purchase');
    $data=  $this->purchase->get_goods_receiving_note($guid);
    echo json_encode($data);
    }
}
function good_receiving_note_approve(){
    if($this->session->userdata['goods_receiving_note_per']['approve']==1){
        $id=  $this->input->post('guid');
        $po=  $this->input->post('po');
        $this->load->model('purchase');
        $report=$this->purchase->change_grn_status($id);
     
        $this->purchase->add_stock($id,$po,$this->session->userdata['branch_id']);
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
       $data[]= $this->posnic->posnic_master_max('purchase')    ;
       echo json_encode($data);
}
function search_items(){
    $search= $this->input->post('term');
    $guid= $this->input->post('purchase_order_guid');
    $this->load->model('purchase');
    $data= $this->purchase->search_items($search,$this->session->userdata['branch_id'],$guid,$this->session->userdata['data_limit']);      
    echo json_encode($data);
       
        
        
}
}
?>
