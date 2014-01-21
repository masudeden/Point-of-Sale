<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxes_area extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->get(); 
    }
     function get(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='taxes_area';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function taxes_area_data_table(){
        $aColumns = array( 'guid','name','name','name','name','active' );	
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
					   
			 $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'taxes_area');
		   
		$iFilteredTotal =$this->posnic->data_table_count('taxes_area');
		
		$iTotal =$this->posnic->data_table_count('taxes_area');
		
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
    }
   
   
    function update_taxes_area(){
           if($_SESSION['taxes_area_per']['edit']==1){
           if($this->input->post('taxes_area')){
                $this->form_validation->set_rules('taxes_area',$this->lang->line('taxes_area'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                      $id=  $this->input->post('guid');
                      $name=$this->input->post('taxes_area');                
                      $where=array('guid !='=>$id,'name'=>$name);
                if($this->posnic->check_record_unique($where,'taxes_area')){
                    $value=array('name'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'taxes_area');
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
    function inactive_taxes_area($guid){
        if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('taxes_area');
          }else{
              redirect('taxes_area');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'taxes_area'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'taxes_area'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_taxes_area($guid){
        if($_SESSION['taxes_area_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'taxes_area');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($_SESSION['taxes_area_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'taxes_area');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('taxes_area');
          }else{
              redirect('taxes_area');
          }
    }        
    
    function add_taxes_area(){
            if($_SESSION['taxes_area_per']['add']==1){
           if($this->input->post('taxes_area')){
                $this->form_validation->set_rules("taxes_area",$this->lang->line('taxes_area'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('taxes_area');                
                      $where=array('name'=>$name);
                if($this->posnic->check_record_unique($where,'taxes_area')){
                    $value=array('name'=>$name);
                    $this->posnic->posnic_add_record($value,'taxes_area');
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
    function delete_taxes_area($guid){
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
