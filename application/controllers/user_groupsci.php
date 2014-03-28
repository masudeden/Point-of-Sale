<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class user_groupsci extends CI_Controller{
    function __construct() {
                parent::__construct();
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('unit_test');
                $this->load->helper(array('form', 'url'));
                $this->load->library('poslanguage'); 
                $this->load->library('form_validation');
                $this->poslanguage->set_language();
    }
    function index(){
        if(!isset($this->session->userdata['guid'])){
                $this->load->view('template/header');
                $this->load->view('login');
                $this->load->view('template/footer');
        }else{
                $this->get_user_groups();
        }
    }
    function get_user_groups(){
        if($this->session->userdata['user_type']==2){
            $this->load->model('user_groups');            
            $this->load->model('branch');
                $this->load->library("pagination");                
	        $config["base_url"] = base_url()."index.php/user_groupsci/get_user_groups";
	        $config["total_rows"] = $this->user_groups->get_user_groups_admin_count($this->session->userdata['branch_id']);
	        $config["per_page"] = 5;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->user_groups->get_user_groups_admin_count($this->session->userdata['branch_id']);         
	        $data["depa"] = $this->user_groups->get_user_groups_admin_details($config["per_page"],$page,$this->session->userdata['branch_id']);
                $data['branch']=$this->branch->get_branch();
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('user_groups',$data);
                $this->load->view('template/footer');
        }else{
         if($_SESSION['user_groupsci_per']['read']==1){ 
                $this->load->model('user_groups');            
                $this->load->library("pagination"); 
                $this->load->model('branch');
	        $config["base_url"] = base_url()."index.php/user_groupsci/get_user_groups";
	        $config["total_rows"] = $this->user_groups->get_user_groups_count($this->session->userdata['branch_id']);
	        $config["per_page"] = 5;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->user_groups->get_user_groups_count($this->session->userdata['branch_id']);         
	        $data["depa"] = $this->user_groups->get_user_groups_details($config["per_page"], $page,$this->session->userdata['branch_id']);
                $data['all_depa']=$this->user_groups->get_user_groups();
                $data['branch']=$this->branch->get_branch();
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('user_groups',$data);
                $this->load->view('template/footer');
    }
    else{
                echo "Ypu Have No permission to Read user_groups Details";
                redirect('home');
    }}
    }
    function user_groups(){  
        if($this->input->post('back')){
                redirect('home');
        }
        if($this->input->post('add')){
             if($_SESSION['user_groupsci_per']['add']==1 or $this->session->userdata['user_type']==2){ 
                $this->load->model('user_groups');      
                $data['row']=$this->user_groups->get_modules_permission($this->session->userdata['branch_id']);
                $this->load->view('template/header');               
                $this->load->view('add_user_groups',$data);
                $this->load->view('template/footer');
        }
        else{
            echo "you have no permission to add user_groups";
                $this->get_user_groups();
        }}
        if($this->input->post('delete')){
            if($_SESSION['user_groupsci_per']['delete']==1){ 
                $this->delete_selected_user_groups();
             redirect('posmain/user_groups');
        }else{
                echo "You have no permission to delete";
                $this->get_user_groups();
        }    
        }
        if($this->input->post('activate')){
             if($_SESSION['user_groupsci_per']['delete']==1){ 
                   $data1 = $this->input->post('mycheck'); 
                    if(!$data1==''){              
                    $this->load->model('user_groups');             
                    foreach( $data1 as $key => $value){                              
                        $this->user_groups->activate_user_groups($value);          
                 }                     
               }        
             }
             $this->get_user_groups();
        }        
         if($this->input->post('deactivate')){
             if($_SESSION['user_groupsci_per']['delete']==1){ 
                   $data1 = $this->input->post('mycheck'); 
                    if(!$data1==''){              
                    $this->load->model('user_groups');             
                    foreach( $data1 as $key => $value){                              
                        $this->user_groups->deactivate_user_groups($value);          
                 }                     
               }        
             }
             $this->get_user_groups();
        }
       if($this->input->post('delete_admin')){
            if($_SESSION['user_groupsci_per']['delete']==1){ 
                   $data1 = $this->input->post('mycheck'); 
                    if(!$data1==''){              
                    $this->load->model('user_groups');             
                    foreach( $data1 as $key => $value){                     
                    $this->user_groups->delete_user_groups_for_admin($value);          
                 }                     
               }        
             }
             $this->get_user_groups();
        }
       
    }
    function delete_selected_user_groups(){
         if($_SESSION['user_groupsci_per']['delete']==1){ 
               $data1 = $this->input->post('mycheck'); 
              if(!$data1==''){              
              $this->load->model('user_groups');             
              foreach( $data1 as $key => $value){           
              $this->user_groups_delete($value);            
              }              
              }
         }else{
             echo "You have no permission to delete";
             $this->get_user_groups();
         }
    }    
    function add_user_groups(){
        if($_SESSION['user_groupsci_per']['add']==1 or $this->session->userdata['user_type']==2){ 
                $this->load->model('user_groups');            
                $this->form_validation->set_rules("user_groups_name",$this->lang->line('user_groups_name'),"required"); 
               // $this->form_validation->set_rules('branches',$this->lang->line('branch'),"required");
                
           if ($this->form_validation->run()) {
                $this->load->model('branch');
                $depart=$this->input->post('user_groups_name');
             if($this->branch->check_deaprtment_is_already($depart,$this->session->userdata['branch_id'])!=TRUE){
                 
                $id=$this->user_groups->add_user_groups($depart,$this->session->userdata['branch_id']);
                $this->add_user_groups_branch($id,$this->session->userdata['branch_id']); 
                $this->load->model('user_groups');      
                $data=$this->user_groups->get_modules_permission($this->session->userdata['branch_id']);
                for($i=0;$i<count($data);$i++){
                $item_add=  $this->input->post($data[$i]."_read");
                $item_read=$this->input->post($data[$i]."_add");
                $item_edit=$this->input->post($data[$i]."_edit");
                $item_delete=$this->input->post($data[$i]."_delete");
                $item=$item_add+$item_delete+$item_edit+$item_read;             
                $this->add_permission($data[$i],$item,$id,$this->session->userdata['branch_id']);
                }
               redirect('posmain/user_groups');
               
               }else{
                   echo "This is user_groups is already added in this branch";
                $this->load->model('user_groups');      
                $data['row']=$this->user_groups->get_modules_permission($this->session->userdata['branch_id']);
                $this->load->view('template/header');               
                $this->load->view('add_user_groups',$data);
                $this->load->view('template/footer');
               }
           }else{
              $this->load->model('user_groups');      
                $data['row']=$this->user_groups->get_modules_permission($this->session->userdata['branch_id']);
                $this->load->view('template/header');               
                $this->load->view('add_user_groups',$data);
                $this->load->view('template/footer');
           }
           
        }
           else{
                echo "You Have No permission to add user_groups";
                $this->get_user_groups();
           }       
           if($this->input->post('cancel')){
                redirect('posmain/user_groups');
           }    
    }
   
    function add_permission($mode,$data,$user_group_id,$branchid){
         if($_SESSION['user_groupsci_per']['add']==1 or $this->session->userdata['user_type']==2){ 
                $this->load->model('permissions');
                $this->permissions->set_modules_permission($mode.'_x_page_x_permissions',$data,$user_group_id,$branchid);
              
            
         }else{
             $this->get_user_groups();
         }
    }
     function add_user_groups_branch($id,$branch){
         if($_SESSION['user_groupsci_per']['add']==1 or $this->session->userdata['user_type']==2){                 
                $this->load->model('user_groups');                
                $this->user_groups->set_branch_user_groups($id,$branch);                
                }else{
                    $this->get_user_groups();
                }
        }
        function user_groups_delete($id){
            if($_SESSION['user_groupsci_per']['delete']==1){ 
                $this->load->model('user_groups');
                $this->user_groups->delete_user_groups($id);
                //$this->user_groups->delete_items_permission($id);
                //$this->user_groups->delete_users_permission($id);
                //$this->user_groups->delete_branchCI_permission($id);
                //$this->user_groups->delete_depart_permission($id);
                //$this->user_groups->delete_depart_branch($id);                 
                redirect('user_groupsci/get_user_groups');
            }else{
                redirect('user_groupsci/get_user_groups');
            }            
        }
        function delete_user_groups_for_admin($id){
                $this->load->model('user_groups');
                $this->user_groups->delete_user_groups_for_admin($id);
                redirect('user_groupsci');
        }
        function edit_user_groups($id){
            if($_SESSION['user_groupsci_per']['edit']==1){ 
                 $this->load->model('user_groups');
                 $data['row']=$this->user_groups->get_seleted_user_groups_details($id);
                 $this->load->view('template/header');
                 $this->load->view('edit_user_groups',$data);
                 $this->load->view('template/footer');
            }else{
                echo "you have No permission To Edit user_groups";                
               redirect('user_groupsci');
            }
        }
        function update_user_groups(){
          if($_SESSION['user_groupsci_per']['edit']==1){ 
                 $this->load->model('user_groups');            
                 $this->form_validation->set_rules("user_groups",$this->lang->line('user_groups_name'),"required");                              
           if ($this->form_validation->run()) {
                 $this->load->model('branch');
                 $depart=$this->input->post('user_groups');
                 $id=$this->input->post('id') ;
             if($this->branch->check_deaprtment_is_already_for_update($depart,$this->session->userdata['branch_id'],$id)!=TRUE){
                 $this->user_groups->update_user_groups($id,$depart);
                 $this->get_user_groups();
             }else{
                 echo "$depart  user_groups is allready added";;
                 $this->edit_user_groups($id);
             }
           }
          }else{
              echo "You ahve no permission to edit user_groups";
          }
          if($this->input->post('cancel')){
              redirect('user_groupsci');
          }
        }
        function edit_user_groups_permission($id){
            
            if($_SESSION['full_per']==8888 or $this->session->userdata['user_type']==2){
                 $this->load->model('user_groups');
                 $data['row']=$this->user_groups->get_seleted_user_groups_details($id);
                 $this->load->model('permissions');
                 $data['user']=$this->permissions->get_users_permission($id,$this->session->userdata['branch_id'],$id);
                 $data['item']=$this->permissions->get_items_permission($id,$this->session->userdata['branch_id'],$id);
                 $data['depart']=$this->permissions->get_depart_permission($id,$this->session->userdata['branch_id'],$id);
                 $data['branch']=$this->permissions->get_branchCI_permission($id,$this->session->userdata['branch_id'],$id);
                 $data['supplier']=$this->permissions->get_suppliers_permissions($id,$this->session->userdata['branch_id'],$id);
                 $data['customer']=$this->permissions->get_customers_permission($id,$this->session->userdata['branch_id'],$id);
                 $data['item_kites']=$this->permissions->get_item_kites_permission($id,$this->session->userdata['branch_id'],$id);
                 $data['sales']=$this->permissions->get_sales_permission($id,$this->session->userdata['branch_id'],$id);
                 
               
                 $this->load->view('template/header');
                 $this->load->view('edit_user_groups_permission',$data);
                 $this->load->view('template/footer');
            }else{
                echo "You have no permission to edit User permissions";
               //
               // redirect('user_groupsci');
            }
        }
        function update_user_groups_permission(){
            if($this->input->post('cancel')){
                $this->get_user_groups();
            }
            if($this->input->post('update')){
                $item_add=  $this->input->post('item_read');
                $item_read=$this->input->post('item_add');
                $item_edit=$this->input->post('item_edit');
                $item_delete=$this->input->post('item_delete');
                $item=$item_add+$item_delete+$item_edit+$item_read;               
                $user_read=$this->input->post('user_read');
                $user_add=$this->input->post('user_add');
                $user_edit=$this->input->post('user_edit');
                $user_delete=$this->input->post('user_delete');
                $user=$user_add+$user_delete+$user_edit+$user_read;               
                $depa_read=$this->input->post('depa_read');
                $depa_add=$this->input->post('depa_add');
                $depa_edit=$this->input->post('depa_edit');
                $depa_delete=$this->input->post('depa_delete');
                $depa=$depa_add+$depa_delete+$depa_edit+$depa_read;                 
                $branch_read=$this->input->post('branch_read');
                $branch_add=$this->input->post('branch_add');
                $branch_edit=$this->input->post('branch_edit');
                $branch_delete=$this->input->post('branch_delete');
                $branch=$branch_add+$branch_delete+$branch_edit+$branch_read;                  
                $sup_read=$this->input->post('sup_read');
                $sup_add=$this->input->post('sup_add');
                $sup_edit=$this->input->post('sup_edit');
                $sup_delete=$this->input->post('sup_delete');
                $supplier=$sup_add+$sup_delete+$sup_edit+$sup_read;
                
                $cust_read=$this->input->post('cust_read');
                $cust_add=$this->input->post('cust_add');
                $cust_edit=$this->input->post('cust_edit');
                $cust_delete=$this->input->post('cust_delete');
                $customer=$cust_add+$cust_delete+$cust_edit+$cust_read;
                
                $sales_read=$this->input->post('do_sales');
                $sales_add=$this->input->post('retun_sales');
                $sales_edit=$this->input->post('sales_edit');
                $sales_delete=$this->input->post('sales_delete');
                $sales=$sales_add+$sales_read+$sales_delete+$sales_edit;
                
                $itemk_read=$this->input->post('itemkit_read');
                $itemk_add=$this->input->post('itemkit_add');
                $itemk_edit=$this->input->post('itemkit_edit');
                $itemk_delete=$this->input->post('itemkit_delete');
                $itemkites=$itemk_add+$itemk_delete+$itemk_edit+$itemk_read;
                
                
                        
                $id=$this->input->post('id');
                $this->update_permission($item,$user,$depa,$branch,$supplier,$customer,$sales,$itemkites,$id,$this->session->userdata['branch_id']);
                $this->get_user_groups();
            }
        }
        function update_permission($item,$user,$depa,$branch,$supplier,$customer,$sales,$itemkites,$user_group_id,$branchid){
                $this->load->model('permissions');
                $this->permissions->update_items_permission($item,$user_group_id,$branchid);
                $this->permissions->update_users_permission($user,$user_group_id,$branchid);
                $this->permissions->update_depart_permission($depa,$user_group_id,$branchid);
                $this->permissions->update_branchCI_permission($branch,$user_group_id,$branchid);
                $this->permissions->update_suppliers_permission($supplier,$user_group_id,$branchid);
                $this->permissions->update_customers_permission($customer,$user_group_id,$branchid);
                $this->permissions->update_item_kites_permission($itemkites,$user_group_id,$branchid);
                $this->permissions->update_sales_permission($sales,$user_group_id,$branchid);
        }
        function to_activate_user_groups($id){
                $this->load->model('user_groups');
                $this->user_groups->activate_user_groups($id);   
                redirect('user_groupsci');
        }
        function  to_deactivate_user_groups($id){
                $this->load->model('user_groups');
                $this->user_groups->deactivate_user_groups($id);
                redirect('user_groupsci');
        }
}
?>