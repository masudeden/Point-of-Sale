<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items_category extends CI_Controller{
    function __construct() {
                parent::__construct();
                 $this->load->library('posnic');    
    }
    function index(){     
        
            $this->get_category();
    }
    function get_category(){
           $config["base_url"] = base_url()."index.php/items_category/get_category";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();
                $this->load->view('category_list',$data);
        
                
    }
    function edit_items($id){
             if($_SESSION['Posnic_Edit']==="Edit"){
                 $where=array('guid'=>$id);
                  $data['row']=$this->posnic->posnic_result($where);            
                  $this->load->view('edit_category',$data);
             }
    }
    function update_item(){
            if($this->input->post('save')){
                  if($_SESSION['Posnic_Edit']==="Edit"){
                      $id=  $this->input->post('guid');
                      $this->form_validation->set_rules("name",$this->lang->line('cate_name'),'required'); 
                      if ( $this->form_validation->run() !== false ) {
                      $type=  $this->input->post('name');

                      $data=array('guid !='=>$id,'category_name'=>$type);
                      if($this->posnic->check_unique($data)){
                          $value=array('category_name'=>$type);
                          $where=array('guid'=>$id);
                          $this->posnic->posnic_update($value,$where);
                          $this->get_category();
                                }else{
                                    echo "this payment type is already added in this branch";
                                    $this->edit_items($id);
                                }
                      }else{
                           $this->edit_items($id);
                      }
                  }else{
                      echo "you have no permission to edit data";
                      redirect('items_category');
                  }
                  }
                  else{
                   redirect('items_category');
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
    function items_type(){
          if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('add')){
                 if($_SESSION['Posnic_Add']==="Add"){
                     $this->load->view('add_item_category');
                 }else{
                     redirect('items_category');
                 }
            }
            if($this->input->post('active')){
                $data=  $this->input->post('posnic');
                 if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
                    }
               }
               redirect('items_category');
            }
            if($this->input->post('deactive')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
                }
                }
                redirect('items_category');
            }
            if($this->input->post('delete')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_delete($guid);
                }
                }
                redirect('items_category');
            }
        }
    function add_category(){
       if($this->input->post('save')){
                  if($_SESSION['Posnic_Add']==="Add"){
                      $this->form_validation->set_rules("name",$this->lang->line('cate_name'),'required'); 
                      if ( $this->form_validation->run() !== false ) {
                      $type=  $this->input->post('name');

                      $data=array('category_name'=>$type);
                      if($this->posnic->check_unique($data)){
                          $value=array('category_name'=>$type);
                          
                          $this->posnic->posnic_add($value);
                          $this->get_category();
                                }else{
                                    echo "this category is already added in this branch";
                                    $this->load->view('add_item_category');
                                }
                      }else{
                           $this->load->view('add_item_category');
                      }
                  }else{
                      echo "you have no permission to edit data";
                      redirect('items_category');
                  }
                  }
                  else{
                   redirect('items_category');
                  }
    }
    function deactive_taxes($guid){
              $this->posnic->posnic_deactive($guid);
             redirect('items_category');         
        }
        function active_taxes($guid){         
              $this->posnic->posnic_active($guid);
             redirect('items_category');
        }
        function restore_taxes($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
             redirect('items_category');
          }else{
            redirect('items_category');
          }
        }
        function admin_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              redirect('items_category');
            }else{
             redirect('items_category');
            }
        }
    
    }
?>
