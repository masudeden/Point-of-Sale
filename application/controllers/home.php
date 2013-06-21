<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        session_start();
        $this->load->library('session');
        $this->load->library('poslanguage');                                       
        $this->poslanguage->set_language();               
    }
    function index(){
        if(!isset($_SESSION['Uid'])){
            redirect('userlogin');            
        }
        $this->pos_home();        
    }    
    function pos_home(){             
        $this->load->model('setting');
        $this->load->model('branch');        
        $data['branch_settings']=$this->setting->get_branch_setting();
        if($_SESSION['admin']==2){
         $data['row']=  $this->branch->get_branch();
        
        }else{
        $data['row']=  $this->branch->get_user_branchs($_SESSION['Uid']);
        $data['a_row']=$this->branch->get_active_user_branchs($_SESSION['Uid']);
        }
        $this->load->view('template/header');
        if($_SESSION['Setting']['Branch']==1){
        $this->load->view('template/branch',$data);
          }
        $this->load->model('modules_model')  ;
        $modules['row']=  $this->modules_model->get_modules($_SESSION['Bid']);
        $modules['mode']=$this->modules_model->get_modules_basced_on_branch();
        $this->load->view('home',$modules);   
        $this->load->view('template/footer');   
        
       
    }
    function set_branchs($branch){
       // $_SESSION['user_branch']=$branch;        
    }    
      function home_main(){
          
          $this->load->model('modules_model');
          $data=  $this->modules_model->get_modulenames($_SESSION["Bid"]);
          for($i=0;$i<count($data);$i++){
            if($this->input->post($data[$i])){
                redirect($data[$i]);
                
            }  
          }
          
          
       if($this->input->post('pos_users')){           
           if($_SESSION['users_per']['read']==1){
               redirect('pos_users');
           }else{
               echo "U have No Permission to View  users Details";
               $this->pos_home();
           }
       }
       if($this->input->post('user_groups')){          
           if($_SESSION['user_groupsCI_per']['read']==1){
                redirect('user_groupsCI');
           }else{
               echo "U have No Permission to View user_groups Details";
               $this->pos_home();
           }
       }
       if($this->input->post('logout')){
           session_destroy();
           redirect('userlogin');
       }
       if($this->input->post('branch')){
           if($_SESSION['branchCI_per']['read']==1){
               redirect('branchCI');
           }else{
               echo "U have No Permission to View Branch Details";
               $this->pos_home();
           }
       }
       if($this->input->post('customers')){
           if($_SESSION['customers_per']['read']==1){
               redirect('customers');
           }else{
               echo "you Have no permission to read Customer Deatils";
               $this->pos_home();
           }
       }
       if($this->input->post('suppliers')){
           if($_SESSION['suppliers_per']['read']==1){
               redirect('suppliers');
           }else{
               echo "you Have no permission to read supplierDeatils";
               $this->pos_home();
           }
       }
       if($this->input->post('Items')){
            if($_SESSION['items_per']['read']==1){
               redirect('items');
           }else{
               echo "you Have no permission to read supplierDeatils";
               $this->pos_home();
           }
       }
       if($this->input->post('Gifts')){
           redirect('gifts');
       }
       if($this->input->post('receiving')){
           
           redirect('purchase_main');
       }
      
       if($this->input->post('brand')){
            redirect('brands');
       }
       if($this->input->post('categorys')){
           redirect('item_category');
       }
       
           
           if($this->input->post('tax_area')){
               redirect('taxes_ci/tax_area');
           }
           if($this->input->post('taxes')){
               redirect('taxes_ci/taxes');
           }
           if($this->input->post('commodity')){
              redirect('taxes_ci/get_tax_commodity');
           }
           if($this->input->post('tax_types')){
              redirect('taxes_ci/get_tax_types');
           }
           if($this->input->post('item_setting')){
               redirect('items_setting');
           }
           if($this->input->post('item_code')){
               redirect('item_code');
           }
           if($this->input->post('customer_cate')){
               redirect('customer_category');
           }
           if($this->input->post('supplier_items')){
               redirect('supplier_vs_items');
           }
               
    }
     function user_groups(){
        redirect('user_groupsCI');
    }
    
}
?>