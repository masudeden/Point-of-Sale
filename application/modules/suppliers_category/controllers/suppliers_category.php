<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers_category extends CI_Controller
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
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='suppliers_category';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function suppliers_category_data_table(){
        $aColumns = array( 'guid','category_name','category_name','category_name','category_name','active_status' );	
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
		$like =array('category_name'=>  $this->input->get_post('sSearch'));
				
			}
					   
			 $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'suppliers_category');
		   
		$iFilteredTotal =$this->posnic->data_table_count('suppliers_category');
		
		$iTotal =$this->posnic->data_table_count('suppliers_category');
		
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
   
   
    function update_suppliers_category(){
           if($this->session->userdata['suppliers_category_per']['edit']==1){
           if($this->input->post('suppliers_category')){
                $this->form_validation->set_rules('suppliers_category',$this->lang->line('suppliers_category'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                      $id=  $this->input->post('guid');
                      $name=$this->input->post('suppliers_category');                
                      $where=array('guid !='=>$id,'category_name'=>$name);
                if($this->posnic->check_record_unique($where,'suppliers_category')){
                    $value=array('category_name'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'suppliers_category');
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
    function inactive_suppliers_category($guid){
        if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('suppliers_category');
          }else{
              redirect('suppliers_category');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'suppliers_category'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'suppliers_category'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_suppliers_category($guid){
        if($this->session->userdata['suppliers_category_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'suppliers_category');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($this->session->userdata['suppliers_category_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'suppliers_category');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('suppliers_category');
          }else{
              redirect('suppliers_category');
          }
    }        
    
    function add_suppliers_category(){
            if($this->session->userdata['suppliers_category_per']['add']==1){
           if($this->input->post('suppliers_category')){
                $this->form_validation->set_rules("suppliers_category",$this->lang->line('suppliers_category'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('suppliers_category');                
                      $where=array('category_name'=>$name);
                if($this->posnic->check_record_unique($where,'suppliers_category')){
                    $value=array('category_name'=>$name);
                    $this->posnic->posnic_add_record($value,'suppliers_category');
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
    function delete_suppliers_category($guid){
           if($this->session->userdata['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
               }
            else{
                echo "you have no Permissions to add  new record";
                $this->get_customers_payment_type();
            } 
        
    }
   
}
?>
