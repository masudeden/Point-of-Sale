<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends CI_Controller
{
    function __construct() {
        parent::__construct();
          $this->load->library('posnic');              
    }
    function index(){
        $this->get_brands(); 
    }
     function get_brands(){
        $config["base_url"] = base_url()."index.php/brands/get_brands";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $this->load->view('brands_list',$data);
    }
    function edit_brands($guid){
         $where=array('guid'=>$guid);
            if($_SESSION['Posnic_Edit']==="Edit"){
                  $data['row']=$this->posnic->posnic_result($where);
                   $this->load->view('edit_brands',$data);
            }else{
                echo "you have no permission to edit data";
                $this->get_customers_payment_type();
            }
        
    }
    function update_brands(){
         
           if($this->input->post('save')){
                    if($_SESSION['Posnic_Edit']==="Edit"){
                    $this->form_validation->set_rules("name",$this->lang->line('tax_type'),'required'); 
                    $id=  $this->input->post('id');
                    $name=$this->input->post('name');                
                    $data=array('guid !='=>$id,'name'=>$name);
                if($this->posnic->check_unique($data)){
                    $value=array('name'=>$name);
                    $where=array('guid'=>$id);
                    $this->posnic->posnic_update($value,$where);
                    $this->get_brands();
            }else{
                    echo "this payment type is already added in this branch";
                    $this->edit_brands($id);
            }
            }else{
                    echo "you have no permission to edit data";
                    $this->get_brands();  
            }      
           }	             
           if($this->input->post('cancel')){
               redirect('brands/get_brands');
           }
    }
    function inactive_brands($guid){
        if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_deactive($guid);
              redirect('brands');
          }else{
              redirect('brands');
          }
    }
    function active_brands($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_active($guid);
              redirect('brands');
          }else{
               redirect('brands');
          }
    }
    function delete_brands_ad($guid){
      if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_delete($guid);
             redirect('brands');
          }else{
            redirect('brands');
          }
    }
    function restore($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('brands');
          }else{
              redirect('brands');
          }
    }        
    function brands_manage(){
         if($this->input->post('cancel'))   {
             redirect('home');
         }
         if($this->input->post('add_tax')){
                if($_SESSION['Posnic_Add']==="Add"){
                $this->load->view('brands/add_brand');
                }else{
                    echo "you have no permision to add brands";
                    $this->get_brands();
                }
               
         }
         if($this->input->post('delete_ad')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                     $this->posnic->posnic_delete($guid);
                 }
                 }redirect('brands/get_brands');
              }else{
                  echo "you have no permision to delete brands";
                    $this->get_brands();
              }
         }
         if($this->input->post('delete')){
              if($_SESSION['Posnic_Delete']==="Delete"){
                $data1 = $this->input->post('mycheck'); 
                $this->load->model('item_brands');
                    if(!$data1==''){         
                     foreach( $data1 as $key => $guid){                        
                        $this->posnic->posnic_delete($guid);
                    }
                    }redirect('brands/get_brands');
              }else{
                  echo "you have no permision to delete brands";
                    $this->get_brands();
              }
         }
         if($this->input->post('activate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                      $this->posnic->posnic_active($guid);
                 }
                 }redirect('brands/get_brands');
         }
         if($this->input->post('deactivate')){
              $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $guid){                        
                    $this->posnic->posnic_deactive($guid);
                 }
                 }redirect('brands/get_brands');
         }
        
    }
    function add_brands(){
          
           if($this->input->post('save')){
                if($_SESSION['Posnic_Add']==="Add"){
                $this->form_validation->set_rules("name",$this->lang->line('tax_type'),'required');                
                  if ( $this->form_validation->run() !== false ) {			                          
                           $name=$this->input->post('name');
                           $data=array('name'=>$name);
                            if($this->posnic->check_unique($data)){
                                    $value=array('name'=>$name);
                                    $this->posnic->posnic_add($value);
                                    redirect('brands/get_brands');  
                            }else{
                                echo "this brand is already added";
                                $this->load->view('add_brand');
                                }                    
                          }else{
                                $this->load->view('add_brand');
                          }                          
                  }else{
                       echo "You have no permmission to add new brands";
                       $this->get_brands();
                  }
           }
           if($this->input->post('cancel')){
                redirect('brands/get_brands');  
           }
         
    }
    function delete_brands($guid){
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
