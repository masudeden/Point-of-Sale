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
        $config["base_url"] = base_url()."index.php/suppliers/get_suppliers";
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
    function add_new_supplier(){
            if($this->input->post('cancel')){
                $this->get_suppliers();
            }
          if($this->input->post('save')){
               if($_SESSION['Posnic_Add']==="Add"){
                    $this->load->library('form_validation');
                            $this->form_validation->set_rules("first_name",$this->lang->line('first_name'),"required"); 
                            $this->form_validation->set_rules("last_name",$this->lang->line('last_name'),"required"); 
                            $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                            $this->form_validation->set_rules('email', $this->lang->line('email'), 'required|valid_email');                             	  
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
                                   
                                   $phone=$this->input->post('phone');
                                   $data=array('phone'=>$phone,'email'=>$this->input->post('email'));
                                    if($this->posnic->check_unique($data)){
                                        $this->posnic->posnic_add($value); 
                                        redirect('suppliers');
                                        }else{
                                            echo "this suplier is already added";
                                            $this->edit_supplier_details($id);
                                    }   
                                   }else{
                                       $this->load->view('add_supplier') ;
                                   }    
                        }else{
                            $this-> edit_supplier_details($id);
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
                                   $data=array('guid !='=>$id,'phone'=>$phone,'email'=>$this->input->post('email'));
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

   
   
    function active_supplier($guid){
       
                 $this->posnic->posnic_active($guid);
                 redirect('suppliers');  
        }
    function deactive_supplier($guid){
       
                 $this->posnic->posnic_deactive($guid);
                 redirect('suppliers');  
        }
    function restore_supplier($guid){
        if($_SESSION['Posnic_User']=='admin'){
                 $this->posnic->posnic_restore($guid);
        }      
                 redirect('suppliers');  
        }
    function admin_delete($guid){
       if($_SESSION['Posnic_Delete']==="Delete"){
                 $this->posnic->posnic_delete($guid);
       }
                 redirect('suppliers');  
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
        if($this->input->post('add')){
             if($_SESSION['Posnic_Add']==="Add"){
                 $this->load->view('add_supplier');
             }else{
                 echo "You hava no permission to add new supplier";
                 $this->get_suppliers();
             }
        }
        if($this->input->post('delete')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                  $data=  $this->input->post('posnic'); 
                    foreach( $data as $key => $guid){
                    $this->posnic->posnic_delete($guid);
                    }
                    redirect('suppliers');
             }else{
                 echo "You hava no permission to delete supplier";
                 $this->get_suppliers();
             }
        }
        if($this->input->post('cancel')){
            redirect('home');
        }
    }
    function edit_supplier($guid){
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
