<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items extends CI_Controller{
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
            $this->get_items();
        }
    }
    
    function get_items(){// Read all items
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');} //check the function is call directly or not if yes then redirect to home
        else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
               
                $this->load->model('item_model');
	        $config["base_url"] = base_url()."index.php/items/get_items";
	        $config["total_rows"] = $this->item_model->item_count_for_admin($_SESSION['Bid']);// get item count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['branch']=$this->item_model->get_selected_branch_for_view();
                $data['brands']=  $this->item_model->get_brands_user($_SESSION['Bid']);
                
                $data['count']=$this->item_model->item_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->item_model->get_item_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);
                $data['urow']= $this->item_model->get_items();
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('item_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination"); 
               
                $this->load->model('item_model');
	        $config["base_url"] = base_url()."index.php/items/get_items";
                $config["total_rows"] = $this->item_model->pos_item_count($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['branch']=$this->item_model->get_selected_branch_for_view();
                $data['brands']=  $this->item_model->get_brands_user($_SESSION['Bid']);             
                $data['count']=$this->item_model->pos_item_count($_SESSION['Bid']);             
	        $data["row"] = $this->item_model->get_item_details($config["per_page"], $page,$_SESSION['Bid']);
                
	        $data["links"] = $this->pagination->create_links(); 
                
                $this->load->view('template/header');
                $this->load->view('item_list',$data);
                $this->load->view('template/footer');
            }
        }
        
    }
      function items_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('items');} else{
            if($this->input->post('BacktoHome')){
                redirect('home');
            }
            if($this->input->post('Add_item')){
                if($_SESSION['Item_per']['add']==1){
                    $this->add_new_item_in_branch();
                }else{
                    echo "You have no permission to add item";
                    $this->get_items();
                }
            }
            if($this->input->post('delete_all')){
                 if($_SESSION['Item_per']['delete']==1){
                     $data = $this->input->post('mycheck'); 
                            if(!$data==''){   
                             $this->load->model('item_model');
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                               
                               $this->item_model->deactivate_items_by_user($value,$_SESSION['Bid'],$_SESSION['Uid']);
                            }
                           }
                            redirect('items');
                 }else{
                     $this->get_items();
                 }
            }
            if($this->input->post('activate')){
                if($_SESSION['admin']==2){
                 $this->load->model('item_model');
                 $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                                 $this->item_model->to_activate_item($value,$_SESSION['Bid']);
                            }
                            }
                 redirect('items');
                 
             }else{
                 redirect('home');
             }
            }
            if($this->input->post('deactivate')){
                     if($_SESSION['admin']==2){
                 $this->load->model('item_model');
                 $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                                 $this->item_model->deactivate_items($value,$_SESSION['Bid']);
                            }
                            }
                 redirect('items');
                 
             }else{
                 redirect('home');
             }
            }
            if($this->input->post('delete_item_for_admin')){
                if($_SESSION['admin']==2){
                 $this->load->model('item_model');
                 $data = $this->input->post('mycheck'); 
                            if(!$data==''){              
                            $this->load->model('pos_users_model');
                            foreach( $data as $key => $value){  
                                 $this->item_model->delete_items_details_in_admin($value,$_SESSION['Uid']);
                            }
                            }
                 redirect('items');
                 
             }else{
                 redirect('home');
             } 
            }
           
            
        }
        
    }
    function add_new_item_in_branch(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
        if($_SESSION['Item_per']['add']==1){
        $this->load->model('item_model');
                    $data['brands']=  $this->item_model->get_brands_user($_SESSION['Bid']);
                    $data['taxes']=  $this->item_model->get_tax_for_user($_SESSION['Bid']);
                    $data['area']=  $this->item_model->get_tax_area_for_user($_SESSION['Bid']);
                    $data['crow']=$this->item_model->get_category($_SESSION['Bid']);
                    $data['srow']=$this->item_model->get_suppier_in_branch($_SESSION['Bid']);
                    $data['sb_row']=$this->item_model->get_supplier_details();
                    $this->load->view('template/header');
                    $this->load->view('add_item',$data);
                    $this->load->view('template/footer');
        }else{
            redirect('items');
        }           
        }
    }
    function delete_item_details_in_admin($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
              if($_SESSION['admin']==2){
                 $this->load->model('item_model');
                 $this->item_model->delete_items_details_in_admin($id,$_SESSION['Bid']);
                 redirect('items');
                 
             }else{
                 redirect('home');
             }
            
        }
    }
    function to_deactivate_item($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
              if($_SESSION['admin']==2){
                 $this->load->model('item_model');
                 $this->item_model->deactivate_items($id,$_SESSION['Uid']);
                 redirect('items');
                 
             }else{
                 redirect('home');
             }
            
        }
    }
    function to_activate_item($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
              if($_SESSION['admin']==2){
                 $this->load->model('item_model');
                 $this->item_model->to_activate_item($id,$_SESSION['Uid']);
                 redirect('items');
                 
             }else{
                 redirect('home');
             }
            
        }
    }
    function add_category(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
             if($this->input->post('cancel')){
                 redirect('items');
             }
             if($_SESSION['Item_per']['add']==1 or $_SESSION['Item_per']['edit']==1){
                  $this->load->library('form_validation');
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required"); 
                                                        	  
                        if ( $this->form_validation->run() !== false ) {
                                    $cat= $this->input->post('name');
                                    $this->load->model('item_model');
                                    if(!$this->item_model->check_item_category($cat,$_SESSION['Bid'])){
                                    $id=$this->item_model->add_category($cat,$_SESSION['Bid']);
                                    $this->item_model->add_item_category_branch($id,$_SESSION['Bid']);
                                    $this->get_items();
                                    }else{
                                        echo "this category is already added";
                                        $this->load->view('template/header');
                                        $this->load->view('add_item_category');
                                        $this->load->view('template/footer');
                                    }
                        }else{
                                $this->load->view('template/header');
                                $this->load->view('add_item_category');
                                $this->load->view('template/footer');
                        }
             }
           
         }
    }
    function add_new_category(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('home'); }else{
        if($_SESSION['Item_per']['add']==1 or $_SESSION['Item_per']['edit']==1){
                     $this->load->view('template/header');
                     $this->load->view('add_item_category');
                     $this->load->view('template/footer');
                 }else{
                     $this->get_items();
                 }
        }
    }
    function add_new_item(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
        if($this->input->post('cancel')){
            redirect('items');
        }
        if($this->input->post('save')){
             if($_SESSION['Item_per']['add']==1){
                  $this->form_validation->set_rules("code",$this->lang->line('code'),"required");
                            $this->form_validation->set_rules("item_name",$this->lang->line('item_name'),"required");
                            $this->form_validation->set_rules("cost_price",$this->lang->line('cost_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');                           
                            $this->form_validation->set_rules('discount_amount', $this->lang->line('discount_amount'),'max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('tax', $this->lang->line('tax'),'required');
                            $this->form_validation->set_rules('area', $this->lang->line('tax_area'),'required');
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('mrf_price', $this->lang->line('mrf_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('landing_cost', $this->lang->line('landing_cost'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules("category",$this->lang->line('category'),"required");
                            $this->form_validation->set_rules("supplier",$this->lang->line('supplier'),"required");
                            
                        if ( $this->form_validation->run() !== false ) {
                                    $this->load->model('item_model');
                                    $code=$this->input->post('code');
                                    $barcode=  $this->input->post('barcode');
                                    $item_name=$this->input->post('item_name');
                                    $description=$this->input->post('description');
                                    $cost=$this->input->post('cost_price');
                                    $sellimg=$this->input->post('selling_price');                                    
                                    $landing=$this->input->post('landing_cost');
                                    $mrf=$this->input->post('mrf_price');
                                    $discount=$this->input->post('discount_amount');
                                    $start=strtotime($this->input->post('start_date'));
                                    $end=strtotime($this->input->post('end_date'));
                                    $tax_in=  $this->input->post('tax_in');
                                    $location=$this->input->post('location');                                    
                                    $category=$this->input->post('category');
                                    $suppier=$this->input->post('supplier');
                                    $tax=  $this->input->post('tax');
                                    $area=  $this->input->post('area');
                                    $brand=  $this->input->post('brand');
                                    if($this->item_model->check_item($code,$_SESSION['Bid'])){
                                    $item_id= $this->item_model->add_item($_SESSION['Bid'],$_SESSION['Uid'],$tax,$area,$brand,$code,$barcode,$item_name,$description,$cost,$sellimg,$landing,$mrf,$discount,$start,$end,$location,$category,$suppier);
                                    $this->item_model->item_setting($tax_in,$item_id,$_SESSION['Bid']);
                                    $this->item_model->item_supplier($item_id,$cost,$sellimg,$suppier,$_SESSION['Bid'],$_SESSION['Uid']);
                                    redirect('items');
                                    }else{
                                        echo " this item is  already added in this branch";
                                        $this->add_new_item_in_branch();
                                    }
            
                        }else{
                            $this->add_new_item_in_branch();
                        }
        
             } 
        }
    }
    }
    
  
    function edit_item_details($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
        if($_SESSION['Item_per']['edit']==1){
           $this->load->model('item_model');
                    $data['brands']=  $this->item_model->get_brands_user($_SESSION['Bid']);
                    $data['taxes']=  $this->item_model->get_tax_for_user($_SESSION['Bid']);
                    $data['area']=  $this->item_model->get_tax_area_for_user($_SESSION['Bid']);
                    $data['crow']=$this->item_model->get_category($_SESSION['Bid']);
                    $data['srow']=$this->item_model->get_suppier_in_branch($_SESSION['Bid']);
                    $data['sb_row']=$this->item_model->get_supplier_details();
                    $data['irow']=$this->item_model->get_selected_item($id);
                    $this->load->view('template/header');
                    $this->load->view('edit_item',$data);
                    $this->load->view('template/footer');
        }
        }
    }
    function update_item(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
            if($this->input->post('cancel')){
                redirect('items');
            }
        if($_SESSION['Item_per']['edit']==1){
                           $this->form_validation->set_rules("item_name",$this->lang->line('item_name'),"required");
                            $this->form_validation->set_rules("cost_price",$this->lang->line('cost_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');                           
                            $this->form_validation->set_rules('discount_amount', $this->lang->line('discount_amount'),'max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('tax', $this->lang->line('tax'),'required');
                            $this->form_validation->set_rules('area', $this->lang->line('tax_area'),'required');
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('mrf_price', $this->lang->line('mrf_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('landing_cost', $this->lang->line('landing_cost'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules("category",$this->lang->line('category'),"required");
                            $this->form_validation->set_rules("supplier",$this->lang->line('supplier'),"required");
                            $id=  $this->input->post('id');
                        if ( $this->form_validation->run() !== false ) {
                                    $this->load->model('item_model');
                                    $code=$this->input->post('code');
                                    $barcode=  $this->input->post('barcode');
                                    $item_name=$this->input->post('item_name');
                                    $description=$this->input->post('description');
                                    $cost=$this->input->post('cost_price');
                                    $sellimg=$this->input->post('selling_price');                                    
                                    $landing=$this->input->post('landing_cost');
                                    $mrf=$this->input->post('mrf_price');
                                    $discount=$this->input->post('discount_amount');
                                    $start=strtotime($this->input->post('start_date'));
                                    $end=strtotime($this->input->post('end_date'));                                   
                                    $location=$this->input->post('location');                                    
                                    $category=$this->input->post('category');
                                    $suppier=$this->input->post('supplier');
                                    $tax=  $this->input->post('tax');
                                    $area=  $this->input->post('area');
                                    $brand=  $this->input->post('brand');
                                    if($this->item_model->check_item_for_update($code,$id,$_SESSION['Bid'])){
                                    $item_id= $this->item_model->update_item($id,$tax,$area,$brand,$code,$barcode,$item_name,$description,$cost,$sellimg,$landing,$mrf,$discount,$start,$end,$location,$category,$suppier);
                                    $this->item_model->update_item_supplier($id,$cost,$sellimg,$suppier,$_SESSION['Bid'],$_SESSION['Uid']);
                                    
                                    redirect('items');
                                    }else{
                                        echo " this item is  already added in this branch";
                                        $this->add_new_item_in_branch();
                                    }            
               
            
                        }else{
                            $this->edit_item_details($id);
                        }
        }
        }
    }
    function delete_item($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('items'); }else{
           
        if($_SESSION['Item_per']['delete']==1){
             $this->load->model('item_model');
             $this->item_model->deactivate_items_by_user($id,$_SESSION['Uid']);
             redirect('items');
        }else{
            echo "you Have no permission to delete items";
        }
        }
    }
    
}
?>
