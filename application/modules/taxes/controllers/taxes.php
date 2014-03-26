<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Taxes extends CI_Controller
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
        $where="'active',0";
        $data['type']=  $this->posnic->posnic_all_module_data('tax_types');
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function data_table(){
        $aColumns = array( 'guid','value','tax_type','value','value','active' );	
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
                        $select='taxes.*,tax_types.type as tax_type';
			 $join_where='taxes.type=tax_types.guid ';	   
			 $rResult1 = $this->posnic->data_table_with_multi_table($end,$start,'taxes','tax_types',$select,$join_where,$order,$like,'');
		   
		$iFilteredTotal =$this->posnic->data_table_count('taxes');
		
		$iTotal =$this->posnic->data_table_count('taxes');
		
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
   
    function edit_taxes($guid){
        if($_SESSION['taxes_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'taxes');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
   
    function update_taxes(){
            if($_SESSION['taxes_per']['edit']==1){
           if($this->input->post('guid')){
                $this->form_validation->set_rules("tax_value",$this->lang->line('tax_value'),'required'); 
                $this->form_validation->set_rules("taxes_type",$this->lang->line('taxes_type'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('brands_name');                
                      $where=array('guid !='=>$this->input->post('guid'),'value'=>$this->input->post('tax_value'),'type'=>$this->input->post('taxes_type'));
                if($this->posnic->check_record_unique($where,'taxes')){
                    $value=array('value'=>$this->input->post('tax_value'),'type'=>$this->input->post('taxes_type'));
                    $update_where=array('guid'=>$this->input->post('guid'));
                    $this->posnic->posnic_update_record($value,$update_where,'taxes');
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
        function add_taxes(){
            if($_SESSION['taxes_per']['add']==1){
           if($this->input->post('tax_value')){
                $this->form_validation->set_rules("tax_value",$this->lang->line('tax_value'),'required'); 
                $this->form_validation->set_rules("taxes_type",$this->lang->line('taxes_type'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                      $name=$this->input->post('brands_name');                
                      $where=array('value'=>$this->input->post('tax_value'),'type'=>$this->input->post('taxes_type'));
                if($this->posnic->check_record_unique($where,'taxes')){
                    $value=array('value'=>$this->input->post('tax_value'),'type'=>$this->input->post('taxes_type'));
                    $this->posnic->posnic_add_record($value,'taxes');
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
            $report= $this->posnic->posnic_module_active($id,'taxes'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'taxes'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function edit_brands($guid){
        if($_SESSION['brands_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'taxes');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
            
    
    function delete(){
        if($_SESSION['taxes_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'taxes');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
      
   
}
?>
