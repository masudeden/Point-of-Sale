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
        if($this->session->userdata['Setting']['Branch']==1){
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
   
  
    
    function update_branch_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        if($_SESSION['branchCI_per']['edit']==1){
    
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
			  $this->load->model('branch');
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
                          $this->branch->update_branch_details($id,$name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website);
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
               $this->load->model('branch');
               $this->branch->delete_branch($id,$this->session->userdata['guid']);
               redirect('branchCI');
           }else{
               redirect('branchCI');
           }
        }
    }
   
    function directing(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('branchCI');}  else{
        $this->get_branch();
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
			  $this->load->model('branch');
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
                         $this->branch->add_new_branch($name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website);
                         }else{
                         $user_group= $this->input->post('user_group');
                         $id=$this->branch->add_new_branch($name,$city,$state,$zip,$country,$phone,$fax,$email,$tax1,$tax2,$website);
                         $this->branch->set_added_branch_for_user($id,$name,$this->session->userdata['guid']);
                         $this->load->model('user_groups');
                         $dep_id=$this->user_groups->add_user_groups($user_group,$id);
                         $this->branch->set_user_groups_branches($dep_id,$id,$user_group,$this->session->userdata['guid']); 
                     //    $this->branch->user_groups_x_branches($id,$dep_id);
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
