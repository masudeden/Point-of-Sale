<?php 
class Customers_payment_type extends CI_Controller{
        function __construct() {
                parent::__construct();
               $this->load->library('posnic_module'); 
              
              
    }
    function index(){  
        
                    $this->get_customers_payment_type();
                
    }
    function get_customers_payment_type(){
       
    }
   
    
}
?>
