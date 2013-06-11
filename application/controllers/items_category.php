<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items_category extends CI_Controller{
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
                $this->load->model('item_cate_model');                
	        $config["base_url"] = base_url()."index.php/items_category/get_category";
	        $config["total_rows"] = $this->item_cate_model->get_item_cate_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->item_cate_model->get_item_cate_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->item_cate_model->get_item_cate_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();                  
                $this->load->view('template/header');
                $this->load->view('item_category/category_list',$data);
                $this->load->view('template/footer'); 
            }else{
                $this->load->library("pagination");                 
                $this->load->model('item_cate_model');
	        $config["base_url"] = base_url()."index.php/items_category/get_category";
                $config["total_rows"] = $this->item_cate_model->get_item_cate_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               ;
                $data['count']=$this->item_cate_model->get_item_cate_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->item_cate_model->get_item_cate_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('item_category/category_list',$data);
                $this->load->view('template/footer'); 
            }                      
       }
        
                
    }
    function edit_item($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items_category'); }else{
             $this->load->model('item_cate_model');
             $data['row']= $this->item_cate_model->get_item_category_details($id);             
             $this->load->view('template/header');
             $this->load->view('item_category/edit_category',$data);
             $this->load->view('template/footer');
        }        
    }
    function update_item(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            if($this->input->post('save')){
             $this->load->library('form_validation');
             $id=  $this->input->post('id');
                $this->form_validation->set_rules("name",$this->lang->line('cate_name'),'required'); 
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('item_cate_model');
                          $area=$this->input->post('name');
                          if($this->item_cate_model->check_item_is_unique_for_update($area,$id,$_SESSION['Bid']))
                          {                            
                      $this->item_cate_model->update_item($area,$id);
                           redirect('items_category');
                          }else{                             
                          
                           echo "this tax arae is already added in this branch";
                           $this->edit_item($id);
                  
            }
            }else{
                $this->edit_item($id);
            }
            }
            if($this->input->post('cancel')){
                 redirect('items_category');
     
            }        
        }
    }
    
    function active_tax_area($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('items_category'); }else{
         $this->load->model('item_cate_model');
         $this->item_cate_model->activate_tax_area($id);
         redirect('items_category/tax_area');
        }
    }
   function inactive_tax_area($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items_category'); }else{
         $this->load->model('item_cate_model');
         $this->item_cate_model->inactivate_tax_area($id);
         redirect('items_category/tax_area');
         }
    }
    function manage_item(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
         if($this->input->post('delete_ad')){
            $this->load->model('item_cate_model');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->item_cate_model->delete_item_category_for_admin($value,$_SESSION['Uid']);
               }
          }
        redirect('items_category');
        }
         if($this->input->post('Activate')){
            $this->load->model('item_cate_model');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->item_cate_model->active_item($value);
               }
          }
        redirect('items_category');
        }
         if($this->input->post('Deactivate')){
            $this->load->model('item_cate_model');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->item_cate_model->inactive_item($value);
               }
          }
        redirect('items_category');
        }
        if($this->input->post('add_tax')){
                $this->load->view('template/header');
                $this->load->view('item_category/add_item_category');
                $this->load->view('template/footer');
        }
        if($this->input->post('cancel')){
              redirect('home');
        }
        if($this->input->post('delete')){
            $this->load->model('item_cate_model');                   
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->item_cate_model->delete_item_category_for_user($value,$_SESSION['Uid']);
               }
            
        }redirect('items_category');
         }
         }
    }
    function add_category(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
             if($this->input->post('cancel')){
                 redirect('items_category');
             }if($this->input->post('save')){
            
                  $this->load->library('form_validation');
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required"); 
                                                        	  
                        if ( $this->form_validation->run() !== false ) {
                                    $cat= $this->input->post('name');
                                    $this->load->model('item_cate_model');
                                    if(!$this->item_cate_model->check_item_category($cat,$_SESSION['Bid'])){
                                    $id=$this->item_cate_model->add_category($cat,$_SESSION['Bid'],$_SESSION['Uid']);                                    
                                    redirect('items_category');
                                    }else{
                                        echo "this category is already added";
                                        $this->load->view('template/header');
                                        $this->load->view('item_category/add_item_category');
                                        $this->load->view('template/footer');
                                    }
                        }else{
                                $this->load->view('template/header');
                                $this->load->view('item_category/add_itemcategory');
                                $this->load->view('template/footer');
                        }
             }
             
         }
    }
    function inactive_item($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('item_cate_model');
            $this->item_cate_model->inactive_item($id);
            redirect('items_category');
        }
    }
    function active_item($id){
       if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('item_cate_model');
            $this->item_cate_model->active_item($id);
            redirect('items_category');
        } 
    }
    function delete_item_for($id){
      if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('item_cate_model');
            $this->item_cate_model->delete_item_category_for_admin($id,$_SESSION['Uid']);
            redirect('items_category');
        }   
    }
    function delete_item($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
            $this->load->model('item_cate_model');
            $this->item_cate_model->delete_item_category_for_user($id,$_SESSION['Uid']);
            redirect('items_category');
        }  
    }
    
    }
?>
