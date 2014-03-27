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
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='brands';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
        function data_table(){
        $aColumns = array( 'guid','name','code','name','location','b_name','c_name','d_name','guid','active_status' );	
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
			 $rResult1 = $this->core_model->items_data_table($end,$start,$order,$like,$_SESSION['Bid']);
		   
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
   
    function active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'items'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'items'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
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
         if($_SESSION['brands_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');             
              $this->posnic->posnic_delete($guid,'items');
              $this->load->model('core_model');
              $this->core_model->delete_item_setting($guid,$_SESSION['Bid']);
              echo 'TRUE';
               // redirect('items');
            }
    }
    }
    function add_new_item(){
        
        if($this->input->post('cost')){
              if($_SESSION['items_per']['add']===1){
                  
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required");
                            $this->form_validation->set_rules("sku",$this->lang->line('sku'),'required');                           
                            $this->form_validation->set_rules('cost', $this->lang->line('cost'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('mrp', $this->lang->line('mrp'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                          
                            $this->form_validation->set_rules('taxes', $this->lang->line('taxes'),'required');
                            $this->form_validation->set_rules('taxes_area', $this->lang->line('taxes_area'),'required');
                            $this->form_validation->set_rules('supplier', $this->lang->line('supplier'),'required');
                            $this->form_validation->set_rules('brand', $this->lang->line('brand'),'required');
                            $this->form_validation->set_rules('category', $this->lang->line('category'),'required');
                            $this->form_validation->set_rules('item_department', $this->lang->line('item_department'),'required');                            
                          if ( $this->form_validation->run() !== false ) {
                                   $data=array('code'=>$this->input->post('sku'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost'),
                                    'selling_price'=>$this->input->post('selling_price'),                                   
                                    'mrp'=>$this->input->post('mrp'),
                                    'discount_amount'=>$this->input->post('discount_per'),
                                    'start_date'=>$this->input->post('starting_date'),
                                    'end_date'=>$this->input->post('ending_date'),
                                    'tax_Inclusive'=>$this->input->post('tax_Inclusive'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('taxes'),
                                    'tax_area_id'=>$this->input->post('taxes_area'),
                                    'depart_id'=>$this->input->post('item_department'),
                                    'brand_id'=>$this->input->post('brand'));
                                      $value=array('code'=>$this->input->post('sku'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('name'),
                                         );
                                 if($this->posnic->check_unique($value,'items')){ 
                                     echo 'TRUE';
                                     $id=$this->posnic->posnic_add_record($data,'items');
                                     $this->load->model('core_model');
                                     $this->core_model->item_setting($id,$_SESSION['Bid']);
                                     $this->core_model->suppliers_x_items($id,$_SESSION['Bid'],$this->input->post('mrp_price'),$this->input->post('supplier'),$this->input->post('selling_price'),$this->input->post('cost_price'));
                               
                                     }else{
                                        echo "ALREADY";
                                       
                                    }
                        }else{
                           echo "FALSE";
                        }
        
             } 
        }
    
    }
    
  
    function edit_items($guid){
        if($_SESSION['brands_per']['edit']==1){
        $this->load->model('core_model')		   ;
	$data = $this->core_model->get_items_details_for_update($_SESSION['Bid'],$guid);
        echo json_encode($data);
        }else{
            echo 'FALSE';
        }
    }
    function update_items(){
       
        if($_SESSION['items_per']['edit']==1){
             $guid=$this->input->post('guid');
                          $this->form_validation->set_rules("name",$this->lang->line('name'),"required");
                            $this->form_validation->set_rules("sku",$this->lang->line('sku'),'required');                           
                            $this->form_validation->set_rules('cost', $this->lang->line('cost'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('mrp', $this->lang->line('mrp'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                          
                            $this->form_validation->set_rules('taxes', $this->lang->line('taxes'),'required');
                            $this->form_validation->set_rules('taxes_area', $this->lang->line('taxes_area'),'required');
                            $this->form_validation->set_rules('supplier', $this->lang->line('supplier'),'required');
                            $this->form_validation->set_rules('brand', $this->lang->line('brand'),'required');
                            $this->form_validation->set_rules('category', $this->lang->line('category'),'required');
                            $this->form_validation->set_rules('item_department', $this->lang->line('item_department'),'required');                            
                          if ( $this->form_validation->run() !== false ) {
                                    $data=array('code'=>$this->input->post('sku'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost'),
                                    'selling_price'=>$this->input->post('selling_price'),                                   
                                    'mrp'=>$this->input->post('mrp'),
                                    'discount_amount'=>$this->input->post('discount_per'),
                                    'start_date'=>$this->input->post('starting_date'),
                                    'end_date'=>$this->input->post('ending_date'),
                                    'tax_Inclusive'=>$this->input->post('tax_Inclusive'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('taxes'),
                                    'tax_area_id'=>$this->input->post('taxes_area'),
                                    'depart_id'=>$this->input->post('item_department'),
                                    'brand_id'=>$this->input->post('brand'));
                                    
                                    $value=array('guid !='=>$this->input->post('guid'),'code'=>$this->input->post('sku'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('name'),
                                         );
                                 if($this->posnic->check_unique($value,'items')){ 
                                     echo 'TRUE';
                                     $where=array('guid'=>$guid);
                                     $this->posnic->posnic_module_update('items',$data,$where);
                                    
                                 }else{
                                     
                                       echo 'ALREADY';
                                    }            
               
            
                        }else{
                           echo 'FALSE';
                        }
        }else{
            echo 'NOOP';
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
      
       // $rResult1 = $this->core_model->posnic_data_table($end,$start,'items','suppliers',$join_where,$_SESSION['Bid'],$this->session->userdata['guid'],$order,$like);
        $rResult1 = $this->posnic->posnic_data_table($end,$start,'items','suppliers',$join_where,$order,$like,'');
      
	$iFilteredTotal =5;// $this->pos_users_model->pos_users_count($this->session->userdata['guid'],$_SESSION['Bid']);	
	$iTotal =5;// $this->pos_users_model->pos_users_count($this->session->userdata['guid'],$_SESSION['Bid']);	
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
    function get_department(){
         $search= $this->input->post('term');
         if($search!=""){
            $like=array('department_name'=>$search);
            $data= $this->posnic->posnic_or_like('items_department',$like);      
            echo json_encode($data);
        }
    }
    function get_category(){
         $search= $this->input->post('term');
         if($search!=""){
            $like=array('category_name'=>$search);
            $data= $this->posnic->posnic_or_like('items_category',$like);      
            echo json_encode($data);
        }
    }
    function get_brand(){
         $search= $this->input->post('term');
         if($search!=""){
            $like=array('name'=>$search);
            $data= $this->posnic->posnic_or_like('brands',$like);      
            echo json_encode($data);
        }
    }
    function get_supplier(){
         $search= $this->input->post('term');
         if($search!=""){
            $like=array('company_name '=>$search,'first_name '=>$search,'phone '=>$search,'email'=>$search);
            $data= $this->posnic->posnic_or_like('suppliers',$like);      
            echo json_encode($data);
        }
    }
    function get_taxes_area(){
         $search= $this->input->post('term');
         if($search!=""){
            $like=array('name'=>$search);
            $data= $this->posnic->posnic_or_like('taxes_area',$like);      
            echo json_encode($data);
        }
    }
    function get_taxes(){
         $search= $this->input->post('term');
         if($search!=""){
            $like=array('tax_types.type'=>$search);
            $this->load->model('core_model');
            $data= $this->core_model->get_taxes($_SESSION['Bid'],$like);      
            echo json_encode($data);
        }
    }
    function add_item_image(){
        
         $config['upload_path'] = './uploads/items';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '202100';
		$config['max_width']  = '11024';
		$config['max_height']  = '3768';
//            	$this->load->model('products_details');	
              $guid=  $this->input->post('guid');
//		$max=$this->products_details->max_id($guid);
//               
              $config['file_name']=$guid;
              //  $config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
                        echo $this->upload->display_errors();
		}
		else
		{       $upload_data = $this->upload->data();
                     $file_name =$upload_data['file_name'];
                    $data=array('image'=>$file_name);
                                $where=array('guid'=>$guid);
                                     $this->posnic->posnic_module_update('items',$data,$where);
		}
    }
    
}
?>
