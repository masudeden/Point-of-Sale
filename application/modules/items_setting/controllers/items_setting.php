<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items_setting extends CI_Controller{
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
        $aColumns = array( 'name', 'code','name','location','b_name','c_name','guid','active_status','guid' );	
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
                        $row[] = $aRow[$aColumns[$i]];
                    }
            }

            $output1['aaData'][] = $row;
        }
        echo json_encode($output1);
    }
    
    function get_items_setting_details($guid){
        $this->load->model('core_model');
        $data[0]=  $this->core_model->get_items_details_for_update($_SESSION['Bid'],$guid);
        $data[1]=  $this->core_model->get_items_setting_details($_SESSION['Bid'],$guid);
        echo json_encode($data);       
    }
    
    function set_item($guid){
        $data['guid']=$guid;
        $this->load->view('set_item',$data);
    }
    
    function reset_item($guid){
        $where=array('guid'=>$guid);
        $data['row']=$this->posnic->posnic_result($where);
        $this->load->view('edit_setting',$data);
    }
    
    function set_items_setting(){
        if($_SESSION['items_setting_per']['set']==1){
            $guid=$this->input->post('guid');
               $this->form_validation->set_rules("min_qty",$this->lang->line('min_qty'),'max_length[15]|regex_match[/^[0-9]+$/]|xss_clean');                                             
               $this->form_validation->set_rules("max_qty",$this->lang->line('max_qty'),'max_length[15]|regex_match[/^[0-9]+$/]|xss_clean');                           
             if ($this->form_validation->run() !== false ) { 
                  $this->input->post('sales');
                 $data=array(
                    'set'=>1,
                    'sales'=>$this->input->post('sales'),
                    'salses_return'=>$this->input->post('sales_return'),
                    'purchase'=>$this->input->post('purchase'),
                    'purchase_return'=>$this->input->post('purchase_return'),
                    'allow_negative'=>$this->input->post('allow_negative'),
                    'min_q'=>$this->input->post('min_quty'),
                    'max_q'=>$this->input->post('max_quty'));
                    $where=array('guid'=>$guid);
                    $this->posnic->posnic_module_update('items_setting',$data,$where);
                    echo 'TRUE';
                  
            }else{  echo 'FALSE';
            }
        }else{ 
            echo 'Noop';
        }   
        
    }
    
    
}
?>
