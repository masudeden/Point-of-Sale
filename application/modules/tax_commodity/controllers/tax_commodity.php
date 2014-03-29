<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_commodity extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
       $this->get(); 
    }
     function get(){
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='brands';
        $where="'active',0";
        $this->load->model('tax');
      
        $data['taxes']=  $this->tax->get_taxes();
        $data['area']=  $this->posnic->posnic_all_module_data('taxes_area');
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function data_table(){
        $aColumns = array( 'guid','schedule','code','schedule','description','taxes_area_name','tax_type','tax_value','active_status','active_status','guid' );	
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
		
			if ($this->input->get_post('sSearch') != "" )
		{
		$like =array('name'=>  $this->input->get_post('sSearch'));
				
			}
                        $select='taxes.*,tax_types.type as tax_type';
			 $join_where='taxes.type=tax_types.guid ';	 
                         $this->load->model('tax');
			 $rResult1 = $this->tax->data_table($end,$start,$like,$this->session->userdata['branch_id']);
		   
		$iFilteredTotal =$this->posnic->data_table_count('tax_commodity');
		
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
   
    function edit_tax_commodity($guid){
        if($this->session->userdata['tax_commodity_per']['edit']==1){
            $this->load->model('tax');
            $data=  $this->tax->edit_tax_commodity($guid);
            echo json_encode($data);
        }else{
                echo 'FALSE';
        }
    }
   
    function update_tax_commodity(){
            if($this->session->userdata['tax_commodity_per']['edit']==1){
                $this->form_validation->set_rules("guid",$this->lang->line('guid'),'required'); 
                $this->form_validation->set_rules("code",$this->lang->line('code'),'required'); 
                $this->form_validation->set_rules("schedule",$this->lang->line('schedule'),'required'); 
                $this->form_validation->set_rules("part",$this->lang->line('part'),'required'); 
                $this->form_validation->set_rules("tax_area",$this->lang->line('tax_area'),'required'); 
                $this->form_validation->set_rules("taxes",$this->lang->line('taxes'),'required'); 
                if ( $this->form_validation->run() !== false ) { 
                                
                      $where=array('guid !='=>$this->input->post('guid'),'code'=>$this->input->post('code'),'tax'=>$this->input->post('taxes'),'part'=>$this->input->post('part'));
                if($this->posnic->check_record_unique($where,'tax_commodity')){
                    $value=array('schedule'=>  $this->input->post('schedule'),'code'=>$this->input->post('code'),'tax'=>$this->input->post('taxes'),'part'=>$this->input->post('part'),'tax_area'=>$this->input->post('tax_area'),'description'=>$this->input->post('description'));
                    $update_where=array('guid'=>$this->input->post('guid'));
                    $this->posnic->posnic_update_record($value,$update_where,'tax_commodity');
                    echo 'TRUE';
                }else{
                        echo "ALREADY";
                }
                }else{
                    echo "FALSE";
                }
               	             
           }else{
               echo "NOOP";
           }
    }
        function add_tax_commodity(){
            if($this->session->userdata['tax_commodity_per']['add']==1){
         
                $this->form_validation->set_rules("code",$this->lang->line('code'),'required'); 
                $this->form_validation->set_rules("schedule",$this->lang->line('schedule'),'required'); 
                $this->form_validation->set_rules("part",$this->lang->line('part'),'required'); 
                $this->form_validation->set_rules("tax_area",$this->lang->line('tax_area'),'required'); 
                $this->form_validation->set_rules("taxes",$this->lang->line('taxes'),'required'); 
                if ($this->form_validation->run() !== false ) { 
                                    
                      $where=array('code'=>$this->input->post('code'),'tax'=>$this->input->post('taxes'),'part'=>$this->input->post('part'));
                if($this->posnic->check_record_unique($where,'tax_commodity')){
                    $value=array('schedule'=>  $this->input->post('schedule'),'code'=>$this->input->post('code'),'tax'=>$this->input->post('taxes'),'part'=>$this->input->post('part'),'tax_area'=>$this->input->post('tax_area'),'description'=>$this->input->post('description'));
                    $this->posnic->posnic_add_record($value,'tax_commodity');
                    echo 'TRUE';
                }else{
                        echo "ALREADY";
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
            $report= $this->posnic->posnic_module_active($id,'tax_commodity'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'tax_commodity'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
}
?>
