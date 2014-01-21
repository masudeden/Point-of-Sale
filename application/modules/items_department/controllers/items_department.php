<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_department extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->get_items_department(); 
    }
     function get_items_department(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='items_department';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function items_department_data_table(){
        $aColumns = array( 'guid','department_name','department_name','department_name','department_name','active' );	
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
		$like =array('department_name'=>  $this->input->get_post('sSearch'));
				
			}
					   
			 $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'items_department');
		   
		$iFilteredTotal =$this->posnic->data_table_count('items_department');
		
		$iTotal =$this->posnic->data_table_count('items_department');
		
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
   
   
    function update_items_department(){
           if($_SESSION['items_department_per']['edit']==1){
           if($this->input->post('items_department_name')){
                $this->form_validation->set_rules("items_department_name",$this->lang->line('items_department_name'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                  $id=  $this->input->post('guid');
                $name=$this->input->post('items_department_name');                
                      $where=array('guid !='=>$id,'department_name'=>$name);
                if($this->posnic->check_record_unique($where,'items_department')){
                    $value=array('department_name'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'items_department');
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
    function inactive_items_department($guid){
        if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('items_department');
          }else{
              redirect('items_department');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'items_department'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'items_department'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_items_department($guid){
        if($_SESSION['items_department_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'items_department');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($_SESSION['items_department_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'items_department');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('items_department');
          }else{
              redirect('items_department');
          }
    }        
    function items_department_manage(){
         if($this->input->post('cancel'))   {
             redirect('home');
         }
         if($this->input->post('add_tax')){
                if($_SESSION['Posnic_Add']==="Add"){
                $this->load->view('items_department/add_brand');
                }else{
                    echo "you have no permision to add items_department";
                    $this->get_items_department();
                }
               
         }
         if($this->input->post('delete_ad')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                     $this->posnic->posnic_delete($guid);
                 }
                 }redirect('items_department/get_items_department');
              }else{
                  echo "you have no permision to delete items_department";
                    $this->get_items_department();
              }
         }
         if($this->input->post('delete')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                $this->load->model('item_items_department');
                    if(!$data1==''){         
                     foreach( $data1 as $key => $guid){                        
                        $this->posnic->posnic_delete($guid);
                    }
                    }redirect('items_department/get_items_department');
              }else{
                  echo "you have no permision to delete items_department";
                    $this->get_items_department();
              }
         }
         if($this->input->post('activate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                      $this->posnic->posnic_active($guid);
                 }
                 }redirect('items_department/get_items_department');
         }
         if($this->input->post('deactivate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                    $this->posnic->posnic_deactive($guid);
                 }
                 }redirect('items_department/get_items_department');
         }
        
    }
    function add_items_department(){
            if($_SESSION['items_department_per']['add']==1){
           if($this->input->post('items_department_name')){
                $this->form_validation->set_rules("items_department_name",$this->lang->line('items_department_name'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('items_department_name');                
                      $where=array('department_name'=>$name);
                if($this->posnic->check_record_unique($where,'items_department')){
                    $value=array('department_name'=>$name);
                    $this->posnic->posnic_add_record($value,'items_department');
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
    function delete_items_department($guid){
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
