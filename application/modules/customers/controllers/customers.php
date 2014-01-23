<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller
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
        $this->load->view('template/branch',$this->posnic->branchs());
        $data['active']='customers';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
    }
    function customers_data_table(){
        $aColumns = array( 'guid','guid','first_name','company_name','phone','email','c_name','type','type','active' );	
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
			$this->load->model('customer')		   ;
			 $rResult1 = $this->customer->get($end,$start,$like,$_SESSION['Bid']);
		   
		$iFilteredTotal =$this->posnic->data_table_count('customers');
		
		$iTotal =$this->posnic->data_table_count('customers');
		
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
            $report= $this->posnic->posnic_module_active($id,'customers'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
    function deactive(){
            $id=  $this->input->post('guid');
            $report= $this->posnic->posnic_module_deactive($id,'customers'); 
            if (!$report['error']) {
                echo 'TRUE';
              } else {
                echo 'FALSE';
              }
    }
   function delete(){
        if($_SESSION['customers_per']['delete']==1){
            if($this->input->post('guid')){
             $guid=  $this->input->post('guid');
              $this->posnic->posnic_delete($guid,'customers');
             echo 'TRUE';
            }
           }else{
            echo 'FALSE';
        }
    }
    function add_customers(){
                  if($_SESSION['customers_per']['add']=="1"){
                       if($this->input->post('country')){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules("category",$this->lang->line('category'),"required"); 
                            $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                            $this->form_validation->set_rules("payment_type",$this->lang->line('payment_type'),"required"); 
                            $this->form_validation->set_rules("city",$this->lang->line('city'),"required"); 
                            $this->form_validation->set_rules("state",$this->lang->line('state'),"required"); 
                            $this->form_validation->set_rules("zip",$this->lang->line('zip'),"required"); 
                            $this->form_validation->set_rules("country",$this->lang->line('country'),"required"); 
                            $this->form_validation->set_rules("address",$this->lang->line('address'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'max_length[12]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('credit_days', $this->lang->line('credit_days'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('credit_limit', $this->lang->line('credit_limit'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('balance', $this->lang->line('balance'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                            $values=array(
                                     'first_name'=>$this->input->post('first_name'),
                                    'last_name'=>  $this->input->post('last_name'),
                                    'email'=>$this->input->post('email'),
                                    'phone'=>$this->input->post('phone'),
                                    'city'=>$this->input->post('city'),
                                    'state'=>$this->input->post('state'),
                                    'country'=>$this->input->post('country'),
                                    'zip'=>$this->input->post('zip'),
                                    'comments'=>$this->input->post('comments'),
                                    'website'=>$this->input->post('website'),
                                    'account_number'=>$this->input->post('account'),
                                    'address'=>$this->input->post('address'),
                                    'company_name'=>$this->input->post('company'),                                    
                                    
                                    'payment'=>$this->input->post('payment_type'),
                                    'credit_limit'=>$this->input->post('credit_limit'),
                                    'cdays'=>$this->input->post('credit_days'),
                                    'month_credit_bal'=>$this->input->post('balance'),
                                    'bday'=>strtotime($this->input->post('dob')),
                                    'mday'=>strtotime($this->input->post('marragedate')),
                                    'title'=>$this->input->post('title'),
                                    'category_id'=>$this->input->post('category'),
                                
                                    'bank_name'=>$this->input->post('bank_name'),
                                    'bank_location'=>$this->input->post('bank_location'),
                                    'account_number'=>$this->input->post('account_no'),
                                    'cst'=>$this->input->post('cst'),
                                    'gst'=>$this->input->post('gst'),
                                    'tax_no'=>  $this->input->post('tax_no'));
                                    
                                    
                                    
                                   $where=array('phone'=>$this->input->post('first_name'),'email'=>$this->input->post('email'));
                                 if($this->posnic->check_record_unique($where,'customers')){
                   
                    $this->posnic->posnic_add_record($values,'customers');
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
    function get_category(){
          $search= $this->input->post('term');
         if($search!=""){
            $like=array('category_name'=>$search);
            $data= $this->posnic->posnic_or_like('customer_category',$like);      
            echo json_encode($data);
        }
    }
    function get_payment(){
          $search= $this->input->post('term');
         if($search!=""){
            $like=array('type'=>$search);
            $data= $this->posnic->posnic_or_like('customers_payment_type',$like);      
            echo json_encode($data);
        }
    }
            
    function edit_customers($guid){
             if($_SESSION['Posnic_Edit']==="Edit"){
                  $where=array('guid'=>$guid);
                  $data['irow']=$this->posnic->posnic_result($where);
                  $data['row']=$this->posnic->posnic_module('customer_category');
                  $data['pay']=$this->posnic->posnic_module('customers_payment_type');
                  $data['spay']= $this->posnic->posnic_module('customers_payment_type');
                 
                  $this->load->view('customers/edit_customer',$data);
             }else{
                 redirect('customer');
             }
       
    }
    function update_customer(){        
            if($this->input->post('cancel')){
                $this->get_customers();
            }
            if($this->input->post('save')){
                 if($_SESSION['Posnic_Edit']==="Edit"){
                    $guid=  $this->input->post('guid');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("cate_id",$this->lang->line('customer_cate'),"required"); 
                            $this->form_validation->set_rules("payment",$this->lang->line('payment'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'max_length[12]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('Credit_Days', $this->lang->line('Credit Days'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('Credit_Limit', $this->lang->line('Credit Limit'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('Monthly_Credit_Balance', $this->lang->line('MonthlyCreditBalance'), 'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                                    $values=array('first_name'=>$this->input->post('first_name'),
                                    'last_name'=>  $this->input->post('last_name'),
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
                                    'company_name'=>$this->input->post('company'),                                    
                                    'cst'=>$this->input->post('cst'),
                                    'gst'=>$this->input->post('gst'),
                                    'payment'=>$this->input->post('payment'),
                                    'credit_limit'=>$this->input->post('Credit_Limit'),
                                    'cdays'=>$this->input->post('Credit_Days'),
                                    'month_credit_bal'=>$this->input->post('Monthly_Credit_Balance'),
                                    'bday'=>strtotime($this->input->post('birthday')),
                                    'mday'=>strtotime($this->input->post('Marragedate')),
                                    'title'=>$this->input->post('tittle'),
                                    'category_id'=>$this->input->post('cate_id'),
                                    'bank_name'=>$this->input->post('bank_name'),
                                    'bank_location'=>$this->input->post('bank_location'),
                                    'tax_no'=>  $this->input->post('tax_no'));
                                    
                                 $data=array('guid !='=>$guid,'phone'=>$this->input->post('first_name'),'email'=>$this->input->post('email'));
                                    if($this->posnic->check_unique($data)){
                                        $where=array('guid'=>$guid);
                                        $this->posnic->posnic_update($values,$where);
                                        redirect('customers');
                                    
                                   }else{
                                        echo "this user is already added";
                                        $this->edit_customers($guid);
                                   }
                                    
                                    
                        }else{
                            $this->edit_customers($guid);
                        }
                    
                }else{
                    redirect('customers');
                }
            }
    }
    
    
    function deactive_customers($guid){
                 $this->posnic->posnic_deactive($guid);
                 redirect('customers');
             
    }
    function active_customers($guid){
                 $this->posnic->posnic_active($guid);
                 redirect('customers');
             
    }
    function restore_customers($guid){
       if($_SESSION['Posnic_User']=='admin'){
                 $this->posnic->posnic_restore($guid);
        
                 redirect('customers');
                 
             }else{
                 redirect('home');
             }
    }
  
}

?>
