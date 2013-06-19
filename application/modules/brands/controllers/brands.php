<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands extends CI_Controller
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
        $this->get_brands(); 
    }
     function get_brands(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('item_brands'); }else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('item_brands');                
	        $config["base_url"] = base_url()."index.php/brands/get_brands";
	        $config["total_rows"] = $this->item_brands->brands_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->item_brands->brands_count_for_admin($_SESSION['Bid']);                 
	        $data["row"] = $this->item_brands->get_brands_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();               
                $this->load->view('template/header');
                $this->load->view('brands/brands_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination");                 
                $this->load->model('item_brands');
	        $config["base_url"] = base_url()."index.php/brands/get_brands";
                $config["total_rows"] = $this->item_brands->get_brands_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;                
                $data['count']=$this->item_brands->get_brands_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->item_brands->get_brands_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links(); 
                $this->load->view('template/header');
                $this->load->view('brands/brands_list',$data);
                $this->load->view('template/footer');
            }                      
       }
    }
    function edit_brands($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('item_brands'); }else{
            $this->load->model('item_brands');
            $data['row']=  $this->item_brands->get_brands($id);
                $this->load->view('template/header');
                $this->load->view('brands/edit_brands',$data);
                $this->load->view('template/footer');     
          }
    }
    function update_brands(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
           if($this->input->post('save')){
               $this->load->library('form_validation');
                $this->form_validation->set_rules("name",$this->lang->line('tax_type'),'required'); 
                $id=  $this->input->post('id');
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('item_brands');                          
                          $name=$this->input->post('name');
                          if($this->item_brands->check_brands($name,$_SESSION['Bid'],$id)){
                              $this->item_brands->update_brands($id,$name);
                              redirect('brands/get_brands');                          
                          }else{
                              echo "this is tax type is already added in this branch";
                              $this->edit_brands($id);
                          }                          
                  }else{
                      $this->edit_brands($id);
                      
                  }
           }
           if($this->input->post('cancel')){
               redirect('brands/get_brands');
           }
         }
    }
    function inactive_brands($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
          $this->load->model('item_brands');
          $this->item_brands->inactive_brands($id);  
          redirect('brands/get_brands');
        }
    }
    function active_brands($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
          $this->load->model('item_brands');
          $this->item_brands->active_brands($id);  
          redirect('brands/get_brands');
        }
    }
    function delete_brands_ad($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
          $this->load->model('item_brands');
          $this->item_brands->delete_brands_for_admin($id,$_SESSION['Uid']);  
          redirect('brands/get_brands');
        }
    }


    function brands_manage(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
         if($this->input->post('cancel'))   {
             redirect('home');
         }
         if($this->input->post('add_tax')){
                $this->load->view('template/header');
                $this->load->view('brands/add_brand');
                $this->load->view('template/footer');   
         }
         if($this->input->post('delete_ad')){
             $data1 = $this->input->post('mycheck'); 
             $this->load->model('item_brands');
                 if(!$data1==''){         
                 foreach( $data1 as $key => $value){                        
                     $this->item_brands->delete_brands_for_admin($value,$_SESSION['Uid']);
                 }
                 }redirect('brands/get_brands');
         }
         if($this->input->post('delete')){
             $data1 = $this->input->post('mycheck'); 
             $this->load->model('item_brands');
                 if(!$data1==''){         
                 foreach( $data1 as $key => $value){                        
                     $this->item_brands->delete_brands_for_user($value,$_SESSION['Uid']);
                 }
                 }redirect('brands/get_brands');
         }
        }
    }
    function add_brands(){
          if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
           if($this->input->post('save')){
               $this->load->library('form_validation');
                $this->form_validation->set_rules("name",$this->lang->line('tax_type'),'required'); 
                $id=  $this->input->post('id');
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('item_brands');                          
                          $name=$this->input->post('name');
                          if($this->item_brands->check_brands_for_add($name,$_SESSION['Bid'])){
                              $this->item_brands->add_brands($name,$_SESSION['Bid'],$_SESSION['Uid']);
                              redirect('brands/get_brands');                          
                          }else{
                              echo "this is tax type is already added in this branch";
                                $this->load->view('template/header');
                                $this->load->view('brands/add_brand');
                                $this->load->view('template/footer'); 
                          }                          
                  }else{
                        $this->load->view('template/header');
                        $this->load->view('brands/add_brand');
                        $this->load->view('template/footer'); 
                      
                  }
           }
           if($this->input->post('cancel')){
               redirect('brands/get_brands');
           }
         }
    }
    function delete_brands($id){
          if(!$_SERVER['HTTP_REFERER']){ redirect('brands'); }else{
          $this->load->model('item_brands');
          $this->item_brands->delete_brands_for_user($id,$_SESSION['Uid']);  
          redirect('brands/get_brands');
        }
    }
   
}
?>
