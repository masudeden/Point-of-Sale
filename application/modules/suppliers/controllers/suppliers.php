<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Suppliers extends CI_Controller{
    function __construct() {
                parent::__construct();
               $this->load->library('posnic'); 
    }
    function index(){     
        
            $this->get_suppliers();
        
    }
    
    function get_suppliers(){// Read all suppliers
        $config["base_url"] = base_url()."index.php/customers_payment_type/get_customers_payment_type";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links(); 
                $this->load->view('supplier_list',$data);
        
    }
    function suppliers_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('suppliers');} else{
            if($this->input->post('BacktoHome')){
                redirect('home');
            }
            if($this->input->post('Add_supplier')){
                if($_SESSION['suppliers_per']['add']==1){
                    $this->load->view('template/header');
                    $this->load->view('add_supplier');
                    $this->load->view('template/footer');
                }else{
                    echo "You have no permission to add supplier";
                    $this->get_suppliers();
                }
            }
            if($this->input->post('delete_all')){
                 if($_SESSION['suppliers_per']['delete']==1){
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
                if($_SESSION['suppliers_per']['add']==1){
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
             if($_SESSION['suppliers_per']['edit']==1){
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
     
            if($this->input->post('cancel')){
                $this->get_suppliers();
            }
            if($this->input->post('save')){
               if($_SESSION['Posnic_Edit']==="Edit"){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email');                             	  
                        if ( $this->form_validation->run() !== false ) {
                            $value=array('first_name'=>$this->input->post('first_name'),
                                   'last_name'=>$this->input->post('last_name'),
                                    'email'=>$this->input->post('email'),
                                    'phone'=>$this->input->post('phone'),
                                    'city'=>$this->input->post('city'),
                                    'state'=>$this->input->post('state'),
                                    'country'=>$this->input->post('country'),
                                    'zip'=>$this->input->post('zip'),
                                    'comments'=>$this->input->post('comments'),
                                    'website'=>$this->input->post('website'),
                                    'account_number'=>$this->input->post('account'),
                                    'address1'=>$this->input->post('address1'),
                                    'address2'=>$this->input->post('address2'),
                                    'company_name '=>$this->input->post('company'));
                                   $id=  $this->input->post('id');
                                   $phone=$this->input->post('phone');
                                   $data=array('guid !='=>$id,'phone'=>$phone);
                                    if($this->posnic->check_unique($data)){
                                        $where=array('guid'=>$id);
                                        $this->posnic->posnic_update($value,$where); 
                                        redirect('suppliers');
                                        }else{
                                            echo "this suplier is already added";
                                            $this->edit_supplier_details($id);
                                    }
                                  
                                    
                                   }else{
                                       
                                   }    
                        }else{
                            $this-> edit_supplier_details($id);
                        }
                    
                }else{
                    redirect('suppliers');
                }
            } 
    function delete_supplier($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('suppliers'); }else{
             if($_SESSION['suppliers_per']['delete']==1){
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
    function supplier_magement(){
        if($this->input->post('active')){
            $data=  $this->input->post('posnic'); 
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
               }
               redirect('suppliers');
        }
        if($this->input->post('deactive')){
           $data=  $this->input->post('posnic'); 
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
               }  
               redirect('suppliers');
        }
    }
    function edit_payment($guid){
      if($_SESSION['Posnic_Edit']==="Edit"){
                  $where=array('guid'=>$guid);
                  $data['row']=$this->posnic->posnic_result($where);
                  $this->load->view('edit_supplier',$data);
        }else{
            redirect('suppliers');
        }
    }
    
}

?>
