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
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='brands';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function data_table(){
        $aColumns = array( 'name','upc_ean_code', 'code','name','location','b_name','c_name','guid','active_status','guid' );	
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
		$like =array('upc_ean_code'=>  $this->input->get_post('sSearch'),'items.name'=>  $this->input->get_post('sSearch'),'code'=>  $this->input->get_post('sSearch'));
				
			}
			$this->load->model('core_model')		   ;
			 $rResult1 = $this->core_model->items_data_table($end,$start,$order,$like,$this->session->userdata['branch_id']);
		   
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
    
   
   
    function set_item_code(){
             if($this->input->post('guid')){  
                   if($this->session->userdata['Posnic_Add']==="Add"){
               $guid=  $this->input->post('guid');
               $this->form_validation->set_rules("ean_upc_code",$this->lang->line('ean_upc_code'),'required');                                             
              if ($this->form_validation->run() !== false ) {  
                  $value=array('upc_ean_code'=>  $this->input->post('ean_upc_code'));
                     $where=array('guid'=>$guid);
                     $this->posnic->posnic_module_update('items',$value,$where);
                    echo 'TRUE';
                    
              }else{
                 echo 'FALSE';
              }
                }else{
                   echo 'NOOP';
                }
             }
    }
   
    function get_items_details(){
            $search= $this->input->post('term');
            $like=array('code'=>$search,'barcode'=>$search,'name'=>$search,'upc_ean_code'=>$search);
            $data= $this->posnic->posnic_select2('items',$like);
            echo json_encode($data);
        
    }
            
    
}
?>
