<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items extends CI_Controller{
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
        $aColumns = array( 'guid','name','code','name','location','b_name','c_name','guid','active' );	
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
    function item_magement(){
       if($this->input->post('add')){
             if($_SESSION['Posnic_Add']==="Add"){
                    $data['brands']=$this->posnic->posnic_module('brands');
                    $data['taxes']=$this->posnic->posnic_module('taxes');
                    $data['area']=  $this->posnic->posnic_module('taxes_area');
                    $data['crow']=$this->posnic->posnic_module('items_category');
                    $data['tax_type']=  $this->posnic->posnic_module('tax_types');
                    $data['srow']=$this->posnic->posnic_module('suppliers');                   
                    $this->load->view('add_item',$data);
            }
     }
            if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('active')){               
                        $data = $this->input->post('posnic'); 
                            if(!$data==''){        
                            foreach( $data as $key => $value){  
                                $this->posnic->posnic_active($value);
                            }
                            }
                 redirect('items');
            }
            if($this->input->post('deactive')){
                 $data = $this->input->post('posnic'); 
                            if(!$data==''){              
                            foreach( $data as $key => $value){  
                                $this->posnic->posnic_deactive($value);
                            }
                            }
                 redirect('items');
             
            }
            if($this->input->post('delete')){
                 $data = $this->input->post('posnic'); 
                            if(!$data==''){ 
                            foreach( $data as $key => $value){  
                                $this->posnic->posnic_delete($value);
                            }
                            }
                 redirect('items'); 
            }
    }
    function deactive_items($guid){
              $this->posnic->posnic_deactive($guid);
              redirect('items');
        }
        function active_items($guid){         
              $this->posnic->posnic_active($guid);
              redirect('items');
        }
    function restore_items($guid){
         if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              $this->load->model('core_model');
              $this->core_model->restore_item_setting($guid,$_SESSION['Bid']);
              redirect('items');
          }else{
              redirect('items');
          }
    }
    function delete($guid){
        if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              $this->load->model('core_model');
              $this->core_model->delete_item_setting($guid,$_SESSION['Bid']);
                redirect('items');
            }else{
                redirect('items');
            }
    }       
    function add_new_item(){
        
        if($this->input->post('cancel')){
            redirect('items');
        }
        if($this->input->post('save')){
              if($_SESSION['Posnic_Add']==="Add"){
                  $this->form_validation->set_rules("code",$this->lang->line('code'),"required");
                            $this->form_validation->set_rules("item_name",$this->lang->line('item_name'),"required");
                            $this->form_validation->set_rules("cost_price",$this->lang->line('cost_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');                           
                            $this->form_validation->set_rules('discount_amount', $this->lang->line('discount_amount'),'max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('tax', $this->lang->line('tax'),'required');
                            $this->form_validation->set_rules('area', $this->lang->line('tax_area'),'required');
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('mrp_price', $this->lang->line('mrf_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            
                          if ( $this->form_validation->run() !== false ) {
                                   $data=array('code'=>$this->input->post('code'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('item_name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost_price'),
                                    'selling_price'=>$this->input->post('selling_price'),
                                   
                                    'mrp'=>$this->input->post('mrp_price'),
                                    'discount_amount'=>$this->input->post('discount_amount'),
                                    'start_date'=>strtotime($this->input->post('start_date')),
                                    'end_date'=>strtotime($this->input->post('end_date')),
                                    'tax_Inclusive'=>$this->input->post('tax_in'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('tax'),
                                    'tax_area_id'=>$this->input->post('area'),
                                    'brand_id'=>$this->input->post('brand'));
                                      $value=array('code'=>$this->input->post('code'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('item_name'),
                                         );
                                 if($this->posnic->check_unique($value)){                                    
                                     $id=$this->posnic->posnic_add($data);
                                     $this->load->model('core_model');
                                     $this->core_model->item_setting($id,$_SESSION['Bid']);
                                     $this->core_model->suppliers_x_items($id,$_SESSION['Bid'],$this->input->post('mrp_price'),$this->input->post('supplier'),$this->input->post('selling_price'),$this->input->post('cost_price'));
                                     $this->get_items();
                                     }else{
                                        echo " this item is  already added in this branch";
                                        $data['brands']=$this->posnic->posnic_module('brands');
                                        $data['taxes']=$this->posnic->posnic_module('taxes');
                                        $data['area']=  $this->posnic->posnic_module('taxes_area');
                                        $data['tax_type']=  $this->posnic->posnic_module('tax_types');
                                        $data['crow']=$this->posnic->posnic_module('items_category');
                                        $data['srow']=$this->posnic->posnic_module('suppliers');                   
                                        $this->load->view('add_item',$data);
                                    }
                        }else{
                            $data['brands']=$this->posnic->posnic_module('brands');
                            $data['taxes']=$this->posnic->posnic_module('taxes');
                            $data['tax_type']=  $this->posnic->posnic_module('tax_types');
                            $data['area']=  $this->posnic->posnic_module('taxes_area');
                            $data['crow']=$this->posnic->posnic_module('items_category');
                            $data['srow']=$this->posnic->posnic_module('suppliers');                   
                            $this->load->view('add_item',$data);
                        }
        
             } 
        }
    
    }
    
  
    function edit_items($guid){
        if($_SESSION['brands_per']['edit']==1){
        $data=  $this->posnic->get_module_details_for_update($guid,'brands');
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
    function update_item(){
        if($this->input->post('cancel')){
                redirect('items');
            }
        if($_SESSION['Posnic_Edit']==="Edit"){
             $guid=$this->input->post('guid');
                           $this->form_validation->set_rules("item_name",$this->lang->line('item_name'),"required");
                            $this->form_validation->set_rules("cost_price",$this->lang->line('cost_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');                           
                            $this->form_validation->set_rules('discount_amount', $this->lang->line('discount_amount'),'max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('tax', $this->lang->line('tax'),'required');
                            $this->form_validation->set_rules('area', $this->lang->line('tax_area'),'required');
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('mrf_price', $this->lang->line('mrf_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                           
                        if ( $this->form_validation->run() !== false ) {
                                     $data=array('code'=>$this->input->post('code'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('item_name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost_price'),
                                    'selling_price'=>$this->input->post('selling_price'),
                                    
                                    'mrp'=>$this->input->post('mrf_price'),
                                    'discount_amount'=>$this->input->post('discount_amount'),
                                    'start_date'=>strtotime($this->input->post('start_date')),
                                    'end_date'=>strtotime($this->input->post('end_date')),
                                    'tax_Inclusive'=>$this->input->post('tax_in'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('tax'),
                                    'tax_area_id'=>$this->input->post('area'),
                                    'brand_id'=>$this->input->post('brand'));
                                    
                                    $value=array('guid !='=>$this->input->post('guid'),'code'=>$this->input->post('code'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('item_name'),
                                         );
                                 if($this->posnic->check_unique($value)){ 
                                      $where=array('guid'=>$guid);
                                      $this->posnic->posnic_update($data,$where);
                                      redirect('items');
                                 }else{
                                     
                                        echo " this item is  already added in this branch";
                                        $this->edit_items($guid);
                                    }            
               
            
                        }else{
                            $this->edit_items($guid);
                        }
        }
    }
    function items_list(){
        $aColumns = array( 'guid','code','code',  'name','description','phone', 'company_name',  'active', 'guid','guid', );	
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
	$like =array('name'=>  $this->input->get_post('sSearch'),
            'code'=>  $this->input->get_post('sSearch'),
            'name'=>  $this->input->get_post('sSearch'),
            'description'=>  $this->input->get_post('sSearch'));
            
        }
        $this->load->model('core_model');
        $join_where='items.supplier_id=suppliers.guid ';
      
       // $rResult1 = $this->core_model->posnic_data_table($end,$start,'items','suppliers',$join_where,$_SESSION['Bid'],$_SESSION['Uid'],$order,$like);
        $rResult1 = $this->posnic->posnic_data_table($end,$start,'items','suppliers',$join_where,$order,$like,'');
      
	$iFilteredTotal =5;// $this->pos_users_model->pos_users_count($_SESSION['Uid'],$_SESSION['Bid']);	
	$iTotal =5;// $this->pos_users_model->pos_users_count($_SESSION['Uid'],$_SESSION['Bid']);	
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
   
    
}
?>
