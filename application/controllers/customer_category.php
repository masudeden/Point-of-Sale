<?php
class Customer_category extends CI_Controller{ 
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
         if(!isset($_SESSION['Uid'])){
                redirect('home');
        }else{
            $this->get_category();
        }
    }
    function get_category(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('customer_category_model');                
	        $config["base_url"] = base_url()."index.php/customer_category/get_category";
	        $config["total_rows"] = $this->customer_category_model->get_customer_cate_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->customer_category_model->get_customer_cate_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->customer_category_model->get_customer_cate_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();                  
                $this->load->view('template/header');
                $this->load->view('customer_category/category_list',$data);
                $this->load->view('template/footer'); 
            }else{
                $this->load->library("pagination");                 
                $this->load->model('customer_category_model');
	        $config["base_url"] = base_url()."index.php/customer_category/get_category";
                $config["total_rows"] = $this->customer_category_model->get_customer_cate_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               ;
                $data['count']=$this->customer_category_model->get_customer_cate_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->customer_category_model->get_customer_cate_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('customer_category/category_list',$data);
                $this->load->view('template/footer'); 
            }                      
       }
        
                
    }
    function edit_customer($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('customer_category'); }else{
             $this->load->model('customer_category_model');
             $data['row']= $this->customer_category_model->get_customer_category_details($id);             
             $this->load->view('template/header');
             $this->load->view('customer_category/edit_category',$data);
             $this->load->view('template/footer');
        }        
    }
    function update_customer(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            if($this->input->post('save')){
             $this->load->library('form_validation');
             $id=  $this->input->post('id');
                $this->form_validation->set_rules("name",$this->lang->line('cate_name'),'required'); 
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('customer_category_model');
                          $area=$this->input->post('name');
                          if($this->customer_category_model->check_customer_is_unique_for_update($area,$id,$_SESSION['Bid']))
                          {                            
                      $this->customer_category_model->update_customer($area,$id);
                           redirect('customer_category');
                          }else{                             
                          
                           echo "this tax arae is already added in this branch";
                           $this->edit_customer($id);
                  
            }
            }else{
                $this->edit_customer($id);
            }
            }
            if($this->input->post('cancel')){
                 redirect('customer_category');
     
            }        
        }
    }
    
    function active_tax_area($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('customer_category'); }else{
         $this->load->model('customer_category_model');
         $this->customer_category_model->activate_tax_area($id);
         redirect('customer_category/tax_area');
        }
    }
   function inactive_tax_area($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('customer_category'); }else{
         $this->load->model('customer_category_model');
         $this->customer_category_model->inactivate_tax_area($id);
         redirect('customer_category/tax_area');
         }
    }
    function manage_customer(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
         if($this->input->post('delete_ad')){
            $this->load->model('customer_category_model');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->customer_category_model->delete_customer_category_for_admin($value,$_SESSION['Uid']);
               }
          }
        redirect('customer_category');
        }
         if($this->input->post('Activate')){
            $this->load->model('customer_category_model');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->customer_category_model->active_customer($value);
               }
          }
        redirect('customer_category');
        }
         if($this->input->post('Deactivate')){
            $this->load->model('customer_category_model');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->customer_category_model->inactive_customer($value);
               }
          }
        redirect('customer_category');
        }
        if($this->input->post('add_tax')){
                $this->load->view('template/header');
                $this->load->view('customer_category/add_customer_category');
                $this->load->view('template/footer');
        }
        if($this->input->post('cancel')){
              redirect('home');
        }
        if($this->input->post('delete')){
            $this->load->model('customer_category_model');                   
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->customer_category_model->delete_customer_category_for_user($value,$_SESSION['Uid']);
               }
            
        }redirect('customer_category');
         }
         }
    }
    function add_category(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
             if($this->input->post('cancel')){
                 redirect('customer_category');
             }if($this->input->post('save')){
            
                  $this->load->library('form_validation');
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required"); 
                                                        	  
                        if ( $this->form_validation->run() !== false ) {
                                    $cat= $this->input->post('name');
                                    $this->load->model('customer_category_model');
                                    if(!$this->customer_category_model->check_customer_category($cat,$_SESSION['Bid'])){
                                    $id=$this->customer_category_model->add_category($cat,$_SESSION['Bid'],$_SESSION['Uid']);                                    
                                    redirect('customer_category');
                                    }else{
                                        echo "this category is already added";
                                        $this->load->view('template/header');
                                        $this->load->view('customercustomer_category/add_customer_category');
                                        $this->load->view('template/footer');
                                    }
                        }else{
                                $this->load->view('template/header');
                                $this->load->view('customer_category/add_customercategory');
                                $this->load->view('template/footer');
                        }
             }
             
         }
    }
    function inactive_customer($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('customer_category_model');
            $this->customer_category_model->inactive_customer($id);
            redirect('customer_category');
        }
    }
    function active_customer($id){
       if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('customer_category_model');
            $this->customer_category_model->active_customer($id);
            redirect('customer_category');
        } 
    }
    function delete_customer_for($id){
      if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('customer_category_model');
            $this->customer_category_model->delete_customer_category_for_admin($id,$_SESSION['Uid']);
            redirect('customer_category');
        }   
    }
    function delete_customer($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('customer_category_model');
            $this->customer_category_model->delete_customer_category_for_user($id,$_SESSION['Uid']);
            redirect('customer_category');
        }  
    }
}
?>
