<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers_payment_type extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');     // load posnic libary         
    }
    function index(){
        $this->get(); 
    }
    
    // load customer payment module view
    function get(){// get function start
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='customers_payment_type';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules()); // Get modules 
        $this->load->view('template/app/footer');
    }// get function end
    // Get Payment data table
    function customers_payment_type_data_table(){ // function start
        $aColumns = array( 'guid','type','type','type','type','active_status' );	
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
		$like =array('type'=>  $this->input->get_post('sSearch'));
	    }
	    $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'customers_payment_type');
	    $iFilteredTotal =$this->posnic->data_table_count('customers_payment_type');
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
		    else if ( $aColumns[$i] != ' ' )
		    {
		    /* General output */
		        $row[] = $aRow[$aColumns[$i]];
		    }
		}
				
		$output1['aaData'][] = $row;
		}
                
		 echo json_encode($output1);
    }// function end
   
   
    function update_customers_payment_type(){
        if($_SESSION['customers_payment_type_per']['edit']==1){
           if($this->input->post('customers_payment_type')){
                $this->form_validation->set_rules('customers_payment_type',$this->lang->line('customers_payment_type'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                      $id=  $this->input->post('guid');
                      $name=$this->input->post('customers_payment_type');                
                      $where=array('guid !='=>$id,'type'=>$name);
                if($this->posnic->check_record_unique($where,'customers_payment_type')){
                    $value=array('type'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'customers_payment_type');
                    echo 'TRUE';
                }else{
                        echo "ALREADY";
                }
                }else{
                    echo "FALSE";
                }
            }else{
                    echo "FALSE";
            }	             
        }else{
               echo "NOOP";
        }
    }
    function inactive_customers_payment_type($guid){
        if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('customers_payment_type');
          }else{
              redirect('customers_payment_type');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'customers_payment_type'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'customers_payment_type'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_customers_payment_type($guid){
        if($_SESSION['customers_payment_type_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'customers_payment_type');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($_SESSION['customers_payment_type_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'customers_payment_type');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('customers_payment_type');
          }else{
              redirect('customers_payment_type');
          }
    }        
    
    function add_customers_payment_type(){
            if($_SESSION['customers_payment_type_per']['add']==1){
           if($this->input->post('customers_payment_type')){
                $this->form_validation->set_rules("customers_payment_type",$this->lang->line('customers_payment_type'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('customers_payment_type');                
                      $where=array('type'=>$name);
                if($this->posnic->check_record_unique($where,'customers_payment_type')){
                    $value=array('type'=>$name);
                    $this->posnic->posnic_add_record($value,'customers_payment_type');
                    echo 'TRUE';
                }else{
                        echo "ALREADY";
                }
                }else{
                    echo "FALSE";
                }
                }else{
                       echo "FALSE";
                }	             
           }else{
               echo "NOOP";
           }
         
    }
    function delete_customers_payment_type($guid){
           if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
               }
            else{
                echo "you have no Permissions to add  new record";
                $this->get_customers_payment_type();
            } 
        
    }
   
}
?>
