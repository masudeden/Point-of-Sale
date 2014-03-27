<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->get_brands(); 
    }
     function get_brands(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='brands';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function brands_data_table(){
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
		$like =array('name'=>  $this->input->get_post('sSearch'));
				
			}
					   
			 $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'brands');
		   
		$iFilteredTotal =$this->posnic->data_table_count('brands');
		
		$iTotal =$this->posnic->data_table_count('brands');
		
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
   
   
    function update_brands(){
           if($_SESSION['brands_per']['edit']==1){
           if($this->input->post('brands_name')){
                $this->form_validation->set_rules("brands_name",$this->lang->line('brands_name'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                      $id=  $this->input->post('guid');
                      $name=$this->input->post('brands_name');                
                      $where=array('guid !='=>$id,'name'=>$name);
                if($this->posnic->check_record_unique($where,'brands')){
                    $value=array('name'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'brands');
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
    function inactive_brands($guid){
        if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('brands');
          }else{
              redirect('brands');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'brands'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'brands'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_brands($guid){
        if($_SESSION['brands_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'brands');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($_SESSION['brands_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'brands');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('brands');
          }else{
              redirect('brands');
          }
    }        
    function brands_manage(){
         if($this->input->post('cancel'))   {
             redirect('home');
         }
         if($this->input->post('add_tax')){
                if($_SESSION['Posnic_Add']==="Add"){
                $this->load->view('brands/add_brand');
                }else{
                    echo "you have no permision to add brands";
                    $this->get_brands();
                }
               
         }
         if($this->input->post('delete_ad')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                     $this->posnic->posnic_delete($guid);
                 }
                 }redirect('brands/get_brands');
              }else{
                  echo "you have no permision to delete brands";
                    $this->get_brands();
              }
         }
         if($this->input->post('delete')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                $this->load->model('item_brands');
                    if(!$data1==''){         
                     foreach( $data1 as $key => $guid){                        
                        $this->posnic->posnic_delete($guid);
                    }
                    }redirect('brands/get_brands');
              }else{
                  echo "you have no permision to delete brands";
                    $this->get_brands();
              }
         }
         if($this->input->post('activate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                      $this->posnic->posnic_active($guid);
                 }
                 }redirect('brands/get_brands');
         }
         if($this->input->post('deactivate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                    $this->posnic->posnic_deactive($guid);
                 }
                 }redirect('brands/get_brands');
         }
        
    }
    function add_brands(){
            if($_SESSION['brands_per']['add']==1){
           if($this->input->post('brands_name')){
                $this->form_validation->set_rules("brands_name",$this->lang->line('brands_name'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('brands_name');                
                      $where=array('name'=>$name);
                if($this->posnic->check_record_unique($where,'brands')){
                    $value=array('name'=>$name);
                    $this->posnic->posnic_add_record($value,'brands');
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
    function delete_brands($guid){
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
