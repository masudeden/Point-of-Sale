<?php 
class Customers_payment_type extends CI_Controller{
        function __construct() {
                parent::__construct();
                $this->load->library('posnic');            
    }
    function index(){  
                    $this->get_customers_payment_type(); 
    }
    function get_customers_payment_type(){
      
                $config["base_url"] = base_url()."index.php/customers_payment_type/get_customers_payment_type";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
               $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $this->load->view('payment_type',$data);
           
        }
        function edit_payment($guid){
            $where=array('guid'=>$guid);
            if($_SESSION['Posnic_Edit']==="Edit"){
                  $data['row']=$this->posnic->posnic_result($where);
                  $this->load->view('edit_payment',$data);
            }else{
                echo "you have no permission to edit data";
                $this->get_customers_payment_type();
            }
          
        }
        function update(){
            if($this->input->post('update')){
            if($_SESSION['Posnic_Edit']==="Edit"){
                $id=  $this->input->post('id');
                $this->form_validation->set_rules("type",$this->lang->line('paymenent_type'),'required'); 
                if ( $this->form_validation->run() !== false ) {
                $type=  $this->input->post('type');
                
                $data=array('guid !='=>$id,'type'=>$type);
                if($this->posnic->check_unique($data)){
                    $value=array('type'=>$type);
                    $where=array('guid'=>$id);
                    $this->posnic->posnic_update($value,$where);
                    $this->get_customers_payment_type();
            }else{
                echo "this payment type is already added in this branch";
                $this->edit_payment($id);
            }
                }else{
                     $this->get_customers_payment_type();
                }
            }else{
                echo "you have no permission to edit data";
                $this->get_customers_payment_type();
            }}
            else{
   redirect('customers_payment_type');
            }
        }
        function add(){
            if($this->input->post('save')){
            if($_SESSION['Posnic_Add']==="Add"){
               
                $this->form_validation->set_rules("type",$this->lang->line('paymenent_type'),'required'); 
                if ( $this->form_validation->run() !== false ) {
                $type=  $this->input->post('type');
                
                $data=array('type'=>$type);
                if($this->posnic->check_unique($data)){
                    $value=array('type'=>$type);
                    $this->posnic->posnic_add($value);
                    $this->get_customers_payment_type();
            }else{
                echo "this payment type is already added in this branch";
                $this->edit_payment($id);
                }}
                else{
                    $this->get_customers_payment_type();
                }
            }else{
                echo "you have no permission to edit data";
                $this->get_customers_payment_type();
            }}
           if($this->input->post('cancel')){
   redirect('customers_payment_type');
           }
            }
        
        function deactive_payment($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('customers_payment_type');
          }else{
              redirect('customers_payment_type');
          }
        }
        function active_payment($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_active($guid);
              redirect('customers_payment_type');
          }else{
              redirect('customers_payment_type');
          }
        }
        function restore_payment($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('customers_payment_type');
          }else{
              redirect('customers_payment_type');
          }
        }
        function admin_delete($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_delete($guid);
              redirect('customers_payment_type');
          }else{
              redirect('customers_payment_type');
          }
        }
        function payment_type(){
              if($this->input->post('cancel')){
                  redirect('home');
                  
              }
            if($this->input->post('add')){
               if($_SESSION['Posnic_Add']==="Add"){
                   $this->load->view('add_payment');
               }
            else{
                echo "you have no Permissions to add  new record";
                $this->get_customers_payment_type();
            }
            }
            if($this->input->post('active')){
               if($_SESSION['Posnic_User']=='admin'){
                   $data=  $this->input->post('posnic');
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
               }
              redirect('Customers_payment_type');
               }
                else{
                   redirect('Customers_payment_type');
            }
        }
            if($this->input->post('deactive')){
               if($_SESSION['Posnic_User']=='admin'){
                   $data=  $this->input->post('posnic');
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
               }
              redirect('Customers_payment_type');
               }
            else{
                   redirect('Customers_payment_type');
            }
        }
            if($this->input->post('delete')){
               if($_SESSION['Posnic_Delete']==="Delete"){
                   $data=  $this->input->post('posnic');
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_delete($guid);
               }
              redirect('Customers_payment_type');
               }
            else{
                   redirect('Customers_payment_type');
            }
        }
        }
        function user_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
               }
            else{
                echo "you have no Permissions to add  new record";
                $this->get_customers_payment_type();
            }  
        }
    
}
?>
