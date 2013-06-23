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
        $this->posnic->get_array('users',21);
    }
   
    
}
?>
