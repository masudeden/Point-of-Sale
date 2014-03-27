<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_category extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->get_items_category(); 
    }
     function get_items_category(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='items_category';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function items_category_data_table(){
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
            $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'items_category');
            $iFilteredTotal =$this->posnic->data_table_count('items_category');
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
					$row[] = $aRow[$aColumns[$i]];
				}				
			}				
		$output1['aaData'][] = $row;
		}
        
        echo json_encode($output1);
    }
   
   
    function update_items_category(){
           if($_SESSION['items_category_per']['edit']==1){
           if($this->input->post('items_category_name')){
                $this->form_validation->set_rules("items_category_name",$this->lang->line('items_category_name'),'required'); 
                if ( $this->form_validation->run() !== false ) {  
                      $id=  $this->input->post('guid');
                      $name=$this->input->post('items_category_name');                
                      $where=array('guid !='=>$id,'category_name'=>$name);
                if($this->posnic->check_record_unique($where,'items_category')){
                    $value=array('category_name'=>$name);
                    $update_where=array('guid'=>$id);
                    $this->posnic->posnic_update_record($value,$update_where,'items_category');
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
    function inactive_items_category($guid){
        if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('items_category');
          }else{
              redirect('items_category');
          }
    }
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'items_category'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'items_category'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_items_category($guid){
        if($_SESSION['items_category_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'items_category');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($_SESSION['items_category_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'items_category');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function restore($guid){
          if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('items_category');
          }else{
              redirect('items_category');
          }
    }        
    function items_category_manage(){
         if($this->input->post('cancel'))   {
             redirect('home');
         }
         if($this->input->post('add_tax')){
                if($_SESSION['Posnic_Add']==="Add"){
                $this->load->view('items_category/add_brand');
                }else{
                    echo "you have no permision to add items_category";
                    $this->get_items_category();
                }
               
         }
         if($this->input->post('delete_ad')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                     $this->posnic->posnic_delete($guid);
                 }
                 }redirect('items_category/get_items_category');
              }else{
                  echo "you have no permision to delete items_category";
                    $this->get_items_category();
              }
         }
         if($this->input->post('delete')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                $this->load->model('item_items_category');
                    if(!$data1==''){         
                     foreach( $data1 as $key => $guid){                        
                        $this->posnic->posnic_delete($guid);
                    }
                    }redirect('items_category/get_items_category');
              }else{
                  echo "you have no permision to delete items_category";
                    $this->get_items_category();
              }
         }
         if($this->input->post('activate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                      $this->posnic->posnic_active($guid);
                 }
                 }redirect('items_category/get_items_category');
         }
         if($this->input->post('deactivate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                    $this->posnic->posnic_deactive($guid);
                 }
                 }redirect('items_category/get_items_category');
         }
        
    }
    function add_items_category(){
            if($_SESSION['items_category_per']['add']==1){
           if($this->input->post('items_category_name')){
                $this->form_validation->set_rules("items_category_name",$this->lang->line('items_category_name'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('items_category_name');                
                      $where=array('category_name'=>$name);
                if($this->posnic->check_record_unique($where,'items_category')){
                    $value=array('category_name'=>$name);
                    $this->posnic->posnic_add_record($value,'items_category');
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
    function delete_items_category($guid){
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
