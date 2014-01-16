<?php
class Item_code extends CI_Controller{
    function __construct() {
    parent::__construct();
               $this->load->library('posnic');  
    }
    function index(){     
              $this->get_items();
    }
    function get_items(){                  
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='brands';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
        function data_table(){
        $aColumns = array( 'guid','name','ean_upc_code', 'code','name','location','b_name','c_name','guid','active' );	
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
			$this->load->model('core_model')		   ;
			 $rResult1 = $this->core_model->items_data_table($end,$start,$order,$like);
		   
		$iFilteredTotal =$this->posnic->data_table_count('items');
		
		$iTotal =$this->posnic->data_table_count('items');
		
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
    function set_item($guid){
         if($_SESSION['Posnic_Add']==="Add"){
             $data['row']=$guid;
             $this->load->view('add_code',$data);
         }
         else{
             redirect('item_code');
         }
    }
    function reset_item($guid){
         if($_SESSION['Posnic_Edit']==="Edit"){
             $data['guid']=$guid;
             $data['row']=  $this->posnic->posnic_module('items');
             $this->load->view('edit_code',$data);
         }
         else{
             redirect('item_code');
         }
    }
    function items_details(){
             if($this->input->post('cancel')){
                redirect('home');
            }
    }
   
    function add_code(){
             if($this->input->post('save')){  
                   if($_SESSION['Posnic_Add']==="Add"){
               $guid=  $this->input->post('guid');
               $this->form_validation->set_rules("code",$this->lang->line('code'),'required');                                             
              if ($this->form_validation->run() !== false ) {  
                  $value=array('upc_ean_code'=>  $this->input->post('code'));
                     $where=array('guid'=>$guid);
                     $this->posnic->posnic_module_update('items',$value,$where);
                     redirect('item_code');
                    
              }else{
                  $this->set_item($guid);
              }
                }else{
                    redirect('item_code');
                }
             }if($this->input->post('cancel')){
             redirect('item_code');
         }
    }
    function edit_item($id){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
    $this->load->model('item_setting');
    $data['row']=  $this->item_setting->get_item_details($id);
    $data['set']=  $this->item_setting->get_item_details_for_edit($id);
                $this->load->view('template/header');
                $this->load->view('item_code/edit_code',$data);
                $this->load->view('template/footer');
          }
    }
    function update_code(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
            if($this->input->post('cancel')){
                redirect('item_code');
            }
            if($this->input->post('save')){
                 $this->load->library('form_validation');
               $id=  $this->input->post('id');
               $this->load->model('item_setting');
               $this->form_validation->set_rules("code",$this->lang->line('code'),'required');                                             
              if ($this->form_validation->run() !== false ) {       
                    $code=$this->input->post('code');
                    if($this->item_setting->check_code_for_update($code,$id,$_SESSION['Bid'])){
                        $this->item_setting->update_code_for_item($code,$id,$_SESSION['Bid']);
                        redirect('item_code');
                    }else{
                        echo "this code is alreay added for one item";
                        $this->edit_item($id);
                    }
                    
              }else{
                  $this->edit_item($id);
              }
            }
        }
    }
}
?>
