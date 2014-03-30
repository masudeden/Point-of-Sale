<?php
class Suppliers_x_items extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='suppliers_x_items';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
     //   $this->get_items();
    }
    function get_items(){
                $config["base_url"] = base_url()."index.php/suppliers_x_items/get_items";
	        $config["total_rows"] =$this->posnic->posnic_module_count('suppliers'); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_module_count('suppliers');                 
	        $data["row"] = $this->posnic->posnic_module_limit_result('suppliers',$config["per_page"], $page);           
	        $data['sup']=  $this->posnic->module_result();
                $data["links"] = $this->pagination->create_links();
                $this->load->view('supplier_list',$data);
    }
    // supplier data table
      function suppliers_data_table(){
        $aColumns = array( 'guid','first_name','first_name','company_name','c_name','phone','email','email','active_status','active_status' );	
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
		$like =array('first_name'=>  $this->input->get_post('sSearch'));
				
			}
					   
			$this->load->model('supplier')	   ;
                        
			 $rResult1 = $this->supplier->get($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->supplier->count($this->session->userdata['branch_id']);
		
		$iTotal =$this->supplier->count($this->session->userdata['branch_id']);
		
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
    // supplier  vs item data table
      function suppliers_x_items_table($guid){
        $aColumns = array( 'guid','i_name','i_name','i_code','quty','cost','price','mrp','active_status','active_status','i_guid','guid' );	
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
		$like =array('items.name'=>  $this->input->get_post('sSearch'),
                  
                    );
				
			}
					   
			$this->load->model('supplier')	   ;
                        
		$rResult1 = $this->supplier->supplier_vs_items($end,$start,$like,$this->session->userdata['branch_id'],$guid);
		   
		$iFilteredTotal =$this->supplier->supplier_vs_items_count($this->session->userdata['branch_id'],$guid);
		
		$iTotal =$this->supplier->supplier_vs_items_count($this->session->userdata['branch_id'],$guid);
		
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
    
            
    function add_items(){
        if($this->session->userdata['customers_per']['add']==1){
              if($this->input->post('supplier')){
                    $this->form_validation->set_rules('item', 'item', 'required');
                    $this->form_validation->set_rules('cost', 'cost', 'required');
                    $this->form_validation->set_rules('price', 'price', 'required');
                    $this->form_validation->set_rules('quty', 'items', 'required');
                    $this->form_validation->set_rules('supplier', 'supplier', 'required');
                    $this->form_validation->set_rules('mrp', 'items', 'required'); 
                    if ( $this->form_validation->run() !== false ) {
                        $where=array('supplier_id'=>$this->input->post('supplier'),'item_id'=>$this->input->post('item'),'branch_id'=>$this->session->userdata['branch_id'],'delete_status'=>0);
                        if($this->posnic->check_record_unique($where,'suppliers_x_items')){
                        $values=array('supplier_id'=>$this->input->post('supplier'),'item_id'=>$this->input->post('item'),'quty'=>$this->input->post('quty'),'cost'=>$this->input->post('cost'),'price'=>$this->input->post('price'),'mrp'=>$this->input->post('mrp'));
                               $this->posnic->posnic_add_record($values,'suppliers_x_items');
                                echo 'TRUE';
                        }else{
                                echo "ALREADY";
                        }
                    }else{
                        echo 'FALSE';
                    }
                }else{
                    echo 'FALSE';
                }
            }else{
                 echo 'FALSE';
        }
    }
    function update_items(){
        if($this->session->userdata['customers_per']['edit']==1){
              if($this->input->post('guid')){
                 $this->form_validation->set_rules('item', 'item', 'required');
                        $this->form_validation->set_rules('cost', 'cost', 'required');
                        $this->form_validation->set_rules('price', 'price', 'required');
                        $this->form_validation->set_rules('quty', 'items', 'required');
                        $this->form_validation->set_rules('supplier', 'supplier', 'required');
                        $this->form_validation->set_rules('mrp', 'items', 'required'); 
                            if ( $this->form_validation->run() !== false ) {
                                $guid=  $this->input->post('guid');
                                
                                $where=array('guid !='=>$guid,'supplier_id'=>$this->input->post('supplier'),'item_id'=>$this->input->post('item'),'branch_id'=>$this->session->userdata['branch_id'],'delete_status'=>0);
                                 if($this->posnic->check_record_unique($where,'suppliers_x_items')){
                                     $values=array('supplier_id'=>$this->input->post('supplier'),'item_id'=>$this->input->post('item'),'quty'=>$this->input->post('quty'),'cost'=>$this->input->post('cost'),'price'=>$this->input->post('price'),'mrp'=>$this->input->post('mrp'));
                                     $update_where=array('guid'=>$guid);
                                     $this->posnic->posnic_update_record($values,$update_where,'suppliers_x_items');
                                        echo 'TRUE';
                                    }else{
                                            echo "ALREADY";
                                    }
                            }else{
                                echo 'FALSE';
                            }
                }else{
                    echo 'FALSE';
                }

            }else{
                 echo 'FALSE';
            }
    }
    
  
    
    function active_supplier($guid){
         $where=array('supplier_id'=>$guid);
              $this->posnic->posnic_active_where($where);
              redirect('suppliers_x_items');
    }
    function search_items(){
        $search= $this->input->post('term');
        $this->load->model('supplier');
        $data= $this->supplier->search_items($search,$this->session->userdata['branch_id']);      
        echo json_encode($data);
     
     }
       function item_active(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_active($id,'suppliers_x_items'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function item_deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'suppliers_x_items'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function get_suppliers_x_items($guid){
        $this->load->model('supplier');
        $data=  $this->supplier->get_suppliers_x_items($guid);
        echo json_encode($data);
    }
    function item_delete(){
      if($this->session->userdata['suppliers_x_items_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'suppliers_x_items');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function search_suppliers(){
        $search= $this->input->post('term');
        $like=array('first_name'=>$search,'last_name'=>$search,'company_name'=>$search,'phone'=>$search,'email'=>$search);
        $this->load->model('supplier');
        $data= $this->supplier->supplier_like($like,$this->session->userdata['branch_id']);      
        echo json_encode($data);
        
    }
    
}
?>
