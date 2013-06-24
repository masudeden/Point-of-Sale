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
            if($_SESSION['Posnic_Edit']==="Edit"){
                $this->form_validation->set_rules("type",$this->lang->line('paymenent_type'),'required'); 
                $type=  $this->input->post('type');
                $id=  $this->input->post('id');
                $data=array('guid !='=>$id,'type'=>$type);
                if($this->posnic->check_unique($data)){
                    echo "down";
            }else{
                
            }
            }else{
                echo "you have no permission to edit data";
                $this->get_customers_payment_type();
            }
        }
   
    
}
?>
