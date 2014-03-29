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
        $aColumns = array( 'guid','name','name','name','name','active_status' );	
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
    }
   
   
    function update_brands(){
           if($this->session->userdata['brands_per']['edit']==1){
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
        if($this->session->userdata['brands_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'brands');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($this->session->userdata['brands_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'brands');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    
    function add_brands(){
            if($this->session->userdata['brands_per']['add']==1){
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
   
   
}
?>
