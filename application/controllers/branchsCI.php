<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BranchCI extends CI_Controller{
    function __construct() {
                parent::__construct();
                 session_start();    
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('unit_test');
                   
                $this->load->helper(array('form', 'url'));
                $this->load->library('poslanguage');                 
                $this->poslanguage->set_language();
                $this->load->library('form_validation');
    }
    function index(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        if($_SESSION['Setting']['Branch']==1){
         if(!isset($this->session->userdata['guid'])){
                $this->load->view('template/header');
                $this->load->view('login');
                $this->load->view('template/footer');
            }else{
                $this->get_branch();
        }
        }else{
            redirect('home');
        }
         }
    }
    function get_branch(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
        if($this->session->userdata['user_type']==2){
        $this->load->library("pagination"); 
                $this->load->model('branches');
	        $config["base_url"] = base_url()."index.php/branchCI/get_branch";
	        $config["total_rows"] = $this->branches->branchcount_for_admin();
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;                
                $data['count']=$this->branches->branchcount_for_admin();             
	        $data["row"] = $this->branches->get_branch_details_for_admin($config["per_page"], $page);
                
	        $data["links"] = $this->pagination->create_links(); 
                $this->load->view('template/header');
                $this->load->view('branches',$data);
                $this->load->view('template/footer');
        }else{
         if($_SESSION['branchCI_per']['read']==1){
                $this->load->library("pagination"); 
                $this->load->model('branches');
	        $config["base_url"] = base_url()."index.php/branchCI/get_branch";
	        $config["total_rows"] = $this->branches->branchcount($this->session->userdata['guid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;                
                $data['count']=$this->branches->branchcount($this->session->userdata['guid']);             
	        $data["row"] = $this->branches->get_branch_details($config["per_page"], $page,$this->session->userdata['guid']);
	        $data["links"] = $this->pagination->create_links(); 
                $data['br_row']=$this->branches->get_branch();
                $this->load->view('template/header');
                $this->load->view('branches',$data);
                $this->load->view('template/footer');
         }
         else{
             echo "You have no permission To read Branch details";
             redirect('home');
         }
    }
    }}
    function edit_branch_details($id){
       if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
       if($_SESSION['branchCI_per']['edit']==1){
           $this->load->model('branches');
           $data['row']=  $this->branches->get_branch_details_for_edit($id);
           $this->load->view('template/header');
           $this->load->view('edit_branch',$data);
           $this->load->view('template/footer');           
       }else{
           echo "you have no permission To edit Branch";
           redirect('branchCI');
       }       
    }
    }
    function branch_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        if($this->input->post('BacktoHome')){
            redirect('home');            
        }if($this->input->post('delete_admin')){
           if($this->session->userdata['user_type']==2){
             $data = $this->input->post('mycheck'); 
              if(!$data==''){
              $this->load->model('branches');
              foreach( $data as $key => $value){ 
                 $this->branches->delete_branch_for_admin($value) ;
              }
              }
        }
        redirect('branchCI');
        }  if($this->input->post('activate')) {
              if($this->session->userdata['user_type']==2){
              $data = $this->input->post('mycheck'); 
              if(!$data==''){
              $this->load->model('branches');        
              foreach( $data as $key => $value){ 
                   $this->branches->activate_branch($value);
              }
              }           
              }
              redirect('branchCI');
         }
        if($this->input->post('deactivate'))  {
             if($this->session->userdata['user_type']==2){
              $data = $this->input->post('mycheck'); 
              if(!$data==''){
              $this->load->model('branches');        
              foreach( $data as $key => $value){ 
                   $this->branches->deactivate_branch($value);
              }
              }              
              }
              redirect('branchCI');
        }
        if($this->input->post('delete_all')){
            if($_SESSION['branchCI_per']['delete']==1){
              $deleted_by=$this->session->userdata['guid'];                  
              $data = $this->input->post('mycheck'); 
              if(!$data==''){
              $this->load->model('branches');        
              foreach( $data as $key => $value){ 
                   $this->branches->delete_branch($value,$deleted_by);
              }
              }  
            }
            redirect('branchCI');
        }
        if($this->input->post('Add_branch')){
           if($_SESSION['branchCI_per']['add']==1){
              $this->load->view('template/header');
              $this->load->view('add_branch');
              $this->load->view('template/footer');
           }else{
               redirect('branchCI') ;
           }
        }
        }
    }
    function update_branch_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        if($_SESSION['branchCI_per']['edit']==1){
        if($this->input->post('cancel')){
            redirect('branchCI');
        }
        if($this->input->post('update')){
            $id= $this->input->post('id');
            $this->load->library('form_validation');
                $this->form_validation->set_rules("name",$this->lang->line('branch_name'),"required"); 
                $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                $this->form_validation->set_rules('city', $this->lang->line('city'), 'required');
                $this->form_validation->set_rules('tax1',$this->lang->line('tax1'),'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('tax2',$this->lang->line('tax2'),'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email|required');
                $this->form_validation->set_rules('website',$this->lang->line('website'),'valid_url');
                if ( $this->form_validation->run() !== false ) {
			  $this->load->model('branches');
                          $name=$this->input->post('name');
                          $city=  $this->input->post('city');
                          $state=$this->input->post('state');
			  $zip=$this->input->post('zip');
                          $country=$this->input->post('country');
                          $phone=$this->input->post('phone');
                          $fax=$this->input->post('fax');
                          $email=$this->input->post('email');
                          $tax1=$this->input->post('tax1');
                          $tax2=$this->input->post('tax2');
                          $website=$this->input->post('website');
                          $this->branches->update_branch_details($id,$name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website);
                          $this->get_branch();
                }else{
                    $this->edit_branch_details($id);
                }         
        }else{
            redirect('branchCI');
        }
        
        }else{
            redirect('branchCI');
        }
    }}
    function delete_branch($id){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
           if($_SESSION['branchCI_per']['delete']==1){
               $this->load->model('branches');
               $this->branches->delete_branch($id,$this->session->userdata['guid']);
               redirect('branchCI');
           }else{
               redirect('branchCI');
           }
        }
    }
    function admin_delete_branch($id){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        if($this->session->userdata['user_type']==2){
        $this->load->model('branches');
        $this->branches->delete_branch_for_admin($id) ;
        redirect('branchCI');
        }else{
            redirect('branchCI') ;
        }
    }}
    function directing(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        $this->get_branch();
        }
    }
    function activate_branch_details($id){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
         if($this->session->userdata['user_type']==2){
         $this->load->model('branches');
         $this->branches->activate_branch($id);
         }
         redirect('branchCI');
        }
    }
    function deactivate_branch_details($id){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
         if($this->session->userdata['user_type']==2){
         $this->load->model('branches');
         $this->branches->deactivate_branch($id);
         }
         redirect('branchCI');
        }
    }
    function add_new_branch(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
            if($this->input->post('save')){
            if($_SESSION['branchCI_per']['add']==1){
                $this->load->library('form_validation');
                $this->form_validation->set_rules("name",$this->lang->line('branch_name'),"required"); 
                $this->form_validation->set_rules('phone', $this->lang->line('phone'), 'required|max_length[10]|regex_match[/^[0-9]+$/]|xss_clean');
                $this->form_validation->set_rules('city', $this->lang->line('city'), 'required');
                $this->form_validation->set_rules('tax1',$this->lang->line('tax1'),'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('tax2',$this->lang->line('tax2'),'max_length[10]|regex_match[/^[0-9 .]+$/]|xss_clean');
                $this->form_validation->set_rules('email', $this->lang->line('email'), 'valid_email|required');
                $this->form_validation->set_rules('website',$this->lang->line('website'),'valid_url');
                if($this->session->userdata['user_type']!=2){
                $this->form_validation->set_rules("user_group",$this->lang->line('user_group'),"required"); 
                }
                if ( $this->form_validation->run() !== false ) {
			  $this->load->model('branches');
                          $name=$this->input->post('name');
                          $city=  $this->input->post('city');
                          $state=$this->input->post('state');
			  $zip=$this->input->post('zip');
                          $country=$this->input->post('country');
                          $phone=$this->input->post('phone');
                          $fax=$this->input->post('fax');
                          $email=$this->input->post('email');
                          $tax1=$this->input->post('tax1');
                          $tax2=$this->input->post('tax2');
                          
                         $website=$this->input->post('website');
                         if($this->session->userdata['user_type']==2){
                         $this->branches->add_new_branch($name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website);
                         }else{
                         $user_group= $this->input->post('user_group');
                         $id=$this->branches->add_new_branch($name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website);
                         $this->branches->set_added_branch_for_user($id,$name,$this->session->userdata['guid']);
                         $this->load->model('user_groups');
                         $dep_id=$this->user_groups->add_user_groups($user_group,$id);
                         $this->branches->set_user_groups_branches($dep_id,$id,$user_group,$this->session->userdata['guid']); 
                       //  $this->branches->user_groups_x_branches($id,$dep_id);
                            $this->load->model('permissions');
                            $this->permissions->set_items_permission(1111,$dep_id,$id);
                            $this->permissions->set_users_permission(1111,$dep_id,$id);
                            $this->permissions->set_depart_permission(1111,$dep_id,$id);
                            $this->permissions->set_branchCI_permission(1111,$dep_id,$id);
                            $this->permissions->set_suppliers_permission(1111,$dep_id,$id);
                         } $this->get_branch();
                         
                }else{
                    $this->load->view('template/header');
                    $this->load->view('add_branch');
                    $this->load->view('template/footer');
                }         
            }            
            }
            if($this->input->post('cancel')){
                redirect('branchCI');
            }
        }
    }
}
?>
