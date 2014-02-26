<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Suppliers extends CI_Controller{
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
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='suppliers';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function suppliers_data_table(){
        $aColumns = array( 'guid','first_name','first_name','company_name','phone','email','email','active' );	
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
					   
			 $rResult1 = $this->posnic->posnic_data_table($end,$start,$order,$like,'suppliers');
		   
		$iFilteredTotal =$this->posnic->data_table_count('suppliers');
		
		$iTotal =$this->posnic->data_table_count('suppliers');
		
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
            $report= $this->posnic->posnic_module_active($id,'suppliers'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'suppliers'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
   function delete(){
        if($_SESSION['suppliers_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'suppliers');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function add_suppliers(){
            if($_SESSION['customers_per']['add']=="1"){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                           // $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            	  
                        if ( $this->form_validation->run() !== false ) {
                            $value=array('first_name'=>$this->input->post('first_name'),
                                   'last_name'=>$this->input->post('last_name'),                                   
                                    'comments'=>$this->input->post('comment'),
                                    'website'=>$this->input->post('website'), 
                                    'company_name '=>$this->input->post('company'),
                                    'account_number'=>$this->input->post('account_no'),
                                    'credit_days '=>$this->input->post('credit_days'),
                                    'credit_limit '=>$this->input->post('credit_limit'),
                                    'monthly_credit_bal '=>$this->input->post('balance'),
                                    'bank_name '=>$this->input->post('bank_name'),
                                    'bank_location '=>$this->input->post('bank_location'),
                                    'cst_no '=>$this->input->post('cst'),
                                    'gst_no '=>$this->input->post('gst'),
                                    'tex_reg_no '=>$this->input->post('tax_no'),
                                    
                                    );
                            $guid=$this->posnic->posnic_add_record($value,'suppliers');
                            $this->load->model('supplier');
                            $address=  $this->input->post('address');
                            $city=  $this->input->post('city');
                            $state=  $this->input->post('state');
                            $country=  $this->input->post('country');
                            $zip=  $this->input->post('zip');
                            $email=  $this->input->post('email');
                            $phone=  $this->input->post('phone');
                            for($i=0;$i<count($phone);$i++){
                            $this->supplier->add_contact($guid,$address[$i],$city[$i],$state[$i],$country[$i],$zip[$i],$email[$i],$phone[$i]);
                            }
                            $this->supplier->update_suplier_contact($guid,$address[0],$city[0],$state[0],$country[0],$zip[0],$phone[0],$email[0]);
                            
                        echo 'TRUE'   ;
                                   }else{
                                        echo 'FALSE';
                                   }    
                        }else{
                            echo 'NOOP';
                        }
                
        }
    
    function update_supplier(){        
     
            if($this->input->post('cancel')){
                $this->get_suppliers();
            }
            if($this->input->post('save')){
               if($_SESSION['Posnic_Edit']==="Edit"){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                            $value=array('first_name'=>$this->input->post('first_name'),
                                   'last_name'=>$this->input->post('last_name'),
                                    'email'=>$this->input->post('email'),
                                    'phone'=>$this->input->post('phone'),
                                    'city'=>$this->input->post('city'),
                                    'state'=>$this->input->post('state'),
                                    'country'=>$this->input->post('country'),
                                    'zip'=>$this->input->post('zip'),
                                    'comments'=>$this->input->post('comments'),
                                    'website'=>$this->input->post('website'),
                                    'account_number'=>$this->input->post('account'),
                                    'address1'=>$this->input->post('address1'),
                                    'address2'=>$this->input->post('address2'),
                                    'company_name '=>$this->input->post('company'));
                                   $id=  $this->input->post('id');
                                   $phone=$this->input->post('phone');
                                   $data=array('guid !='=>$id,'phone'=>$phone,'email'=>$this->input->post('email'));
                                    if($this->posnic->check_unique($data)){
                                        $where=array('guid'=>$id);
                                        $this->posnic->posnic_update($value,$where); 
                                        redirect('suppliers');
                                        }else{
                                            echo "this suplier is already added";
                                            $this->edit_supplier_details($id);
                                    }
                                  
                                    
                                   }else{
                                       
                                   }    
                        }else{
                            $this-> edit_supplier_details($id);
                        }
                    
                }else{
                    redirect('suppliers');
                }
            } 

   
   
    function active_supplier($guid){
       
                 $this->posnic->posnic_active($guid);
                 redirect('suppliers');  
        }
    function deactive_supplier($guid){
       
                 $this->posnic->posnic_deactive($guid);
                 redirect('suppliers');  
        }
    function restore_supplier($guid){
        if($_SESSION['Posnic_User']=='admin'){
                 $this->posnic->posnic_restore($guid);
        }      
                 redirect('suppliers');  
        }
    function admin_delete($guid){
       if($_SESSION['Posnic_Delete']==="Delete"){
                 $this->posnic->posnic_delete($guid);
       }
                 redirect('suppliers');  
        }
    function supplier_magement(){
        if($this->input->post('active')){
            $data=  $this->input->post('posnic'); 
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
               }
               redirect('suppliers');
        }
        if($this->input->post('deactive')){
           $data=  $this->input->post('posnic'); 
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
               }  
               redirect('suppliers');
        }
        if($this->input->post('add')){
             if($_SESSION['Posnic_Add']==="Add"){
                 $this->load->view('add_supplier');
             }else{
                 echo "You hava no permission to add new supplier";
                 $this->get_suppliers();
             }
        }
        if($this->input->post('delete')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                  $data=  $this->input->post('posnic'); 
                    foreach( $data as $key => $guid){
                    $this->posnic->posnic_delete($guid);
                    }
                    redirect('suppliers');
             }else{
                 echo "You hava no permission to delete supplier";
                 $this->get_suppliers();
             }
        }
        if($this->input->post('cancel')){
            redirect('home');
        }
    }
    function edit_suppliers($guid){
      if($_SESSION['suppliers_per']['edit']==1){
                  
                  $this->load->model('supplier');
                  $data=$this->supplier->edit_supplier($guid);
                  echo json_encode($data);
        }
    }
    
}

?>
