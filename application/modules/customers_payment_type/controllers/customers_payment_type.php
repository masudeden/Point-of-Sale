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
        $value=array('ctive_status'=>0);
        if( $_SESSION['Posnic_User']=='admin'){
        $data['row']=$this->posnic->posnic_result_array_for_admin('users',$value);
        }else{
            
        }
    }
   
    
}
?>
