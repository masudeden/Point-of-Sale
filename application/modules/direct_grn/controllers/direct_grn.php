<?php
class Direct_grn extends CI_Controller{
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
        
        //$this->load->model('purchase');
       // $this->purchase->get_purchase_order('be0e9618297967699deb19956c7567cc');
    }
    // purchase order data table
    function data_table(){
        $aColumns = array( 'guid','po_no','po_no','c_name','s_name','po_date','total_items','total_amt','active','order_status' );	
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
  
function approve(){
    if($_SESSION['purchase_order_approval_per']['approve']==1){
        $guid=  $this->input->post('guid');
      $where=array('guid'=>$guid);
                       $item_value=array('order_status'=>1);
  $this->posnic->posnic_update_record($item_value,$where,'purchase_order');
  echo 'TRUE';
}
}
}
?>
