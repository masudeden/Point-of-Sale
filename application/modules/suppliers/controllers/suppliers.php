<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Suppliers extends CI_Controller{
    function __construct() {
                parent::__construct();
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('unit_test');
                session_start();        
                $this->load->library('session');
                $this->load->helper(array('form', 'url'));
                $this->load->library('poslanguage'); 
                $this->load->library('form_validation');
                $this->poslanguage->set_language();
    }
    function index(){     
         if(!isset($_SESSION['Uid'])){// check user is login or not
                redirect('home');// if user is didnt login then redirect to login page
        }else{
            $this->get_suppliers();
        }
    }
    
    function get_suppliers(){// Read all suppliers
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');} //check the function is call directly or not if yes then redirect to home
        else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                
                $this->load->model('supplier_model');
	        $config["base_url"] = base_url()."index.php/supplier/get_suppliers";
	        $config["total_rows"] = $this->supplier_model->supplier_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['branch']=$this->supplier_model->get_selected_branch_for_view();
                $data['count']=$this->supplier_model->supplier_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->supplier_model->get_supplier_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);
                $data['urow']= $this->supplier_model->get_suppliers();
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('supplier_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination"); 
                
                $this->load->model('supplier_model');
	        $config["base_url"] = base_url()."index.php/supplier/get_suppliers";
                $config["total_rows"] = $this->supplier_model->pos_supplier_count($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['branch']=$this->supplier_model->get_selected_branch_for_view();
                $data['count']=$this->supplier_model->pos_supplier_count($_SESSION['Bid']);             
	        $data["row"] = $this->supplier_model->get_supplier_details($config["per_page"], $page,$_SESSION['Bid']);
                $data['urow']=$this->supplier_model->get_suppliers();
	        $data["links"] = $this->pagination->create_links(); 
                
                $this->load->view('template/header');
                $this->load->view('supplier_list',$data);
                $this->load->view('template/footer');
            }
        }
        
    }
    function suppliers_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('suppliers');} else{
            if($this->input->post('BacktoHome')){
                redirect('home');
            }
            if($this->input->post('Add_supplier')){
                if($_SESSION['Supplier_per']['add']==1){
                    $this->load->view('template/header');
                    $this->load->view('add_supplier');
                    $this->load->view('template/footer');
                }else{
                    echo "You have no permission to add supplier";
                    $this->get_suppliers();
                }
            }
            if($this->input->post('delete_all')){
                 if($_SESSION['Supplier_per']['delete']==1){
                     $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                               $this->load->model('supplier_model');
                               $this->supplier_model->delete_supplier_for_user($value,$_SESSION['Bid'],$_SESSION['Uid']);
                            }
                           }
                            redirect('suppliers');
                 }else{
                     $this->get_suppliers();
                 }
            }
            if($this->input->post('activate')){
                if($_SESSION['admin']==2){
                 $this->load->model('supplier_model');
                 $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                                 $this->supplier_model->to_activate_supplier($value,$_SESSION['Bid']);
                            }
                            }
                 redirect('suppliers');
                 
             }else{
                 redirect('home');
             }
            }
            if($this->input->post('deactivate')){
                     if($_SESSION['admin']==2){
                 $this->load->model('supplier_model');
                 $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                                 $this->supplier_model->deactivate_suppliers($value,$_SESSION['Bid']);
                            }
                            }
                 redirect('suppliers');
                 
             }else{
                 redirect('home');
             }
            }
            if($this->input->post('delete_supplier_for_admin')){
                if($_SESSION['admin']==2){
                 $this->load->model('supplier_model');
                 $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                                 $this->supplier_model->delete_suppliers_details_in_admin($value,$_SESSION['Bid']);
                            }
                            }
                 redirect('suppliers');
                 
             }else{
                 redirect('home');
             } 
            }
            
        }
        
    }
    function add_new_supplier(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
            if($this->input->post('cancel')){
                $this->get_suppliers();
            }
            if($this->input->post('save')){
                if($_SESSION['Supplier_per']['add']==1){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required");
                            $this->form_validation->set_rules("company",$this->lang->line('company'),"required");
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                                    $this->load->model('supplier_model');
                                    $first_name=$this->input->post('first_name');
                                    $last_name=  $this->input->post('last_name');
                                    $email=$this->input->post('email');
                                    $phone=$this->input->post('phone');
                                    $city=$this->input->post('city');
                                    $state=$this->input->post('state');
                                    $country=$this->input->post('country');
                                    $zip=$this->input->post('zip');
                                    $comments=$this->input->post('comments');
                                    $website=$this->input->post('website');
                                    $account_no=$this->input->post('account');
                                    $address1=$this->input->post('address1');
                                    $address2=$this->input->post('address2');
                                    $company=$this->input->post('company');
                                    
                                   if(!$this->supplier_model->check_supplier_already_in($phone,$_SESSION['Bid'])){
                                    $id=$this->supplier_model->add_supplier($first_name,$last_name,$email,$phone,$city,$state,$country,$zip,$comments,$website,$account_no,$address1,$address2,$company,$_SESSION['Bid'],$_SESSION['Uid']);
                                    $this->supplier_model->add_supplier_branchs($id,$_SESSION['Bid']);
                                    $this->get_suppliers();
                                    
                                   }else{
                                        echo "this user is already added";
                                        $this->load->view('template/header');
                                        $this->load->view('add_supplier');
                                        $this->load->view('template/footer');
                                   }                           
                          
                        }else{
                                $this->load->view('template/header');
                                $this->load->view('add_supplier');
                                $this->load->view('template/footer');
                        }                    
                }else{
                    redirect('suppliers');
                }
            }
        }
    }
    function edit_supplier_details($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
             if($_SESSION['Supplier_per']['edit']==1){
                 $this->load->model('supplier_model');
                 $data['row']= $this->supplier_model->get_supplier_details_for_edit($id);
                  $this->load->view('template/header');
                  $this->load->view('edit_supplier',$data);
                  $this->load->view('template/footer');
             }else{
                 redirect('supplier');
             }
        }
        
    }
    function update_supplier(){        
     if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
            if($this->input->post('cancel')){
                $this->get_suppliers();
            }
            if($this->input->post('save')){
                if($_SESSION['Supplier_per']['edit']==1){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                                    $this->load->model('supplier_model');
                                    $first_name=$this->input->post('first_name');
                                    $last_name=  $this->input->post('last_name');
                                    $email=$this->input->post('email');
                                    $phone=$this->input->post('phone');
                                    $city=$this->input->post('city');
                                    $state=$this->input->post('state');
                                    $country=$this->input->post('country');
                                    $zip=$this->input->post('zip');
                                    $comments=$this->input->post('comments');
                                    $website=$this->input->post('website');
                                    $account_no=$this->input->post('account');
                                    $address1=$this->input->post('address1');
                                    $address2=$this->input->post('address2');
                                    $company=$this->input->post('company');
                                   $id=  $this->input->post('id');
                                   if(!$this->supplier_model->check_supplier_already_for_update($id,$phone,$_SESSION['Bid'])){
                                    $this->supplier_model->update_supplier($id,$first_name,$last_name,$email,$phone,$city,$state,$country,$zip,$comments,$website,$account_no,$address1,$address2,$company,$_SESSION['Bid']);
                                    $this->get_suppliers();
                                    
                                   }else{
                                       $this->edit_supplier_details($id);
                                   }
                                    
                                    
                        }else{
                            $this-> edit_supplier_details($id);
                        }
                    
                }else{
                    redirect('suppliers');
                }
            }
        }
    }
    function delete_supplier($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
             if($_SESSION['Supplier_per']['delete']==1){
                 $this->load->model('supplier_model');
                 $this->supplier_model->delete_supplier_for_user($id,$_SESSION['Bid'],$_SESSION['Uid']);
                 redirect('suppliers');
                 
             }else{
                 echo "You Have no permission to delete supplier Details";
                 $this->get_suppliers();
             }
            
        }
    }
    function delete_supplier_details_in_admin($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
              if($_SESSION['admin']==2){
                 $this->load->model('supplier_model');
                 $this->supplier_model->delete_suppliers_details_in_admin($id,$_SESSION['Bid']);
                 redirect('suppliers');
                 
             }else{
                 redirect('home');
             }
            
        }
    }
    function to_deactivate_supplier($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
              if($_SESSION['admin']==2){
                 $this->load->model('supplier_model');
                 $this->supplier_model->deactivate_suppliers($id,$_SESSION['Bid']);
                 redirect('suppliers');
                 
             }else{
                 redirect('home');
             }
            
        }
    }
    function to_activate_supplier($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
              if($_SESSION['admin']==2){
                 $this->load->model('supplier_model');
                 $this->supplier_model->to_activate_supplier($id,$_SESSION['Bid']);
                 redirect('suppliers');
                 
             }else{
                 redirect('home');
             }
            
        }
    }
    
    
}

?>
