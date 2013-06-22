<?php 
class Customers_payment_type extends CI_Controller{
        function __construct() {
                parent::__construct();
               $this->load->library('posnic_module'); 
    }
    function index(){  
          if(!isset($_SESSION['Uid'])){
                redirect('home');
                }
                redirect('taxes_ci/taxes');
    }
   
    
}
?>
