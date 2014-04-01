<?php
class Supplier_payment extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
        $this->load->view('template/app/header'); 
        $this->load->view('header/header');         
        $this->load->view('template/branch',$this->posnic->branches());
        $data['active']='purchase_invoice';
        $this->load->view('index',$data);
        $this->load->view('template/app/navigation',$this->posnic->modules());
        $this->load->view('template/app/footer');
        
        
    }
    // goods Receiving Note data table
    function data_table(){
        $aColumns = array( 'guid','code','code','p_invoice','first_name','company_name','payment_date','amount','guid' );	
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
                $like =array(
                    'po_no'=>  $this->input->get_post('sSearch'),
                    'grn_no'=>  $this->input->get_post('sSearch'),
                    );

            }
            $this->load->model('payment')	   ;
            $rResult1 = $this->payment->get($end,$start,$like,$this->session->userdata['branch_id']);
            $iFilteredTotal =$this->payment->count($this->session->userdata['branch_id']);
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
				else if ( $aColumns[$i]== 'po_date' )
				{
					/* General output */
					$row[] = date('d-m-Y',$aRow[$aColumns[$i]]);
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
 
function save(){      
     if($this->session->userdata['supplier_payment_per']['add']==1){
        $this->form_validation->set_rules('payment_date',$this->lang->line('payment_date'), 'required');
        $this->form_validation->set_rules('balance_amount',$this->lang->line('balance_amount'), 'required|numeric');
        $this->form_validation->set_rules('payment_code', $this->lang->line('payment_code'), 'required');
        $this->form_validation->set_rules('payment', $this->lang->line('payment'), 'required');
        $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|numeric');
            if ( $this->form_validation->run() !== false ) {    
             
                $date=strtotime($this->input->post('payment_date'));
                $code= $this->input->post('payment_code');
                $amount=  $this->input->post('amount');
                $balance_amount=  $this->input->post('balance_amount');
                $memo=  $this->input->post('memo');
                $payment=  $this->input->post('payment');
                $this->load->model('payment');
                if($amount>$balance_amount){
                    echo 10;
                }else{
                    
                        if($this->payment->save_payment($payment,$amount,$date,$memo,$code)){
                        $this->posnic->posnic_master_increment_max('supplier_payment')  ;
                       echo 1;
                   }else{
                       echo 10;
                   }
                }
             }else{
                  echo 0;
             }
    }else{
                   echo 'Noop';
                }
}
    function update(){
        If($this->session->userdata['supplier_payment_per']['add']==1){
            $this->form_validation->set_rules('payment_date',$this->lang->line('payment_date'), 'required');
            $this->form_validation->set_rules('payment_id',$this->lang->line('payment_id'), 'required');
            $this->form_validation->set_rules('balance_amount',$this->lang->line('balance_amount'), 'required|numeric');
            $this->form_validation->set_rules('payment_code', $this->lang->line('payment_code'), 'required');
            $this->form_validation->set_rules('payment', $this->lang->line('payment'), 'required');
            $this->form_validation->set_rules('amount', $this->lang->line('amount'), 'required|numeric');
                if ( $this->form_validation->run() !== false ) {    

                    $date=strtotime($this->input->post('payment_date'));
                    $code= $this->input->post('payment_code');
                    $amount=  $this->input->post('amount');
                    $balance_amount=  $this->input->post('balance_amount');
                    $memo=  $this->input->post('memo');
                    $payment=  $this->input->post('payment');
                    $this->load->model('payment');
                    $guid=  $this->input->post('payment_id');
                    if($amount>$balance_amount){
                        echo 10;
                    }else{
                            if($this->payment->update_payment($guid,$payment,$amount,$date,$memo,$code)){
                        
                       echo 1;
                    }else{
                        echo 10;
                    }
                }
            }else{
                 echo 0;
            }
        }else{
            echo 'Noop';
        }
          
   }
    function delete(){
       if($this->session->userdata['goods_receiving_note_per']['delete']==1){
            if($this->input->post('guid')){
                $guid=  $this->input->post('guid');
                
                $this->load->model('payment');
                $this->payment->delete_payment($guid);
                echo 1;
            }
        }else{
             echo 'FALSE';
        }

    }
   
   
    
    /*
    get payment code form master data
     * function start     */
    function payment_code(){
           $data[]= $this->posnic->posnic_master_max('supplier_payment')    ;
           echo json_encode($data);
    }
    /*
    function end     */
    /*
    Search purchase payable purchase invoice
     * function start     */
    function search_purchase_invoice(){
        $search= $this->input->post('term'); /* get key word*/
        $this->load->model('payment'); /* load payement model*/
        $data= $this->payment->serach_invoice($search);   /* get invoice list */   
        echo json_encode($data); /* send data in json fromat*/
    }
    /* function end */
   
    /*
     *  get payment details for edit     
     * function start */
    function get_supplier_payment($guid){
        $this->load->model('payment');
        $data=  $this->payment->get_payment_details($guid);
        echo json_encode($data); // encode data array to json
    }
    /* function end*/
    
    }
?>
