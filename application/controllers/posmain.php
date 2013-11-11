<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posmain extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('unit_test');
        session_start();        
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('poslanguage');                 
        $this->poslanguage->set_language();
        
    }
    function index()
    { if(!isset($_SESSION['Uid'])){
            $this->load->view('template/header');
            $this->load->view('login');
            $this->load->view('template/footer');
        }else{
            $this->set_user_default_branch();             
            }
        
    }
    function set_user_default_branch(){
        $this->load->model('branch');
        $data=$this->branch->get_user_default_branch($_SESSION['Uid']);
        $this->pos_setting();       
        if($_SESSION['admin']==2){
             $admin=  $this->branch->branch_for_admin();         
             $this->acl_session_for_user($admin);        
            redirect('home');
        }else{
             if($this->branch->check_branch_is_in_active($data,$_SESSION['Uid'])){
             $this->acl_session_for_user($data);        
             redirect('home');
            
        }else{
            $id =$this->branch->is_in_active_branchs($_SESSION['Uid']);
            $this->acl_session_for_user($id);        
            redirect('home');           
        }
        }
    }
   function acl_session_for_user($b_id){
       $_SESSION['Bid']=$b_id;
        $this->load->model('modules_model')  ;
        $this->load->library('acluser'); 
        if($_SESSION['admin']==2){
            $modules=  $this->modules_model->get_module_permission($_SESSION['Bid']); 
            for($i=0;$i<count($modules);$i++){
                $this->acluser->admin_module_permissions($modules[$i]);
            }
        }else{
       
        $modules=  $this->modules_model->get_module_permission($_SESSION['Bid']); 
            for($i=0;$i<count($modules);$i++){
                
                $this->acluser->module_permissions($modules[$i],$b_id ,$_SESSION['Uid']);
               
                
            }
        
        }
        $_SESSION['Bid']=$b_id;
    }
    function pos_setting(){
        $this->load->model('setting');
        $data=  $this->setting->get_setting();
        $setting=array('Branch'=>$data[0],
            'Depart'=>$data[1]);
         $_SESSION['Setting']=$setting;
    }
  
    function user_groups(){
        redirect('user_groupsci');
    }
    function change_user_branch($brnch){
        $this->load->model('aclpermissionmodel');
        if($_SESSION['admin']==2){
            $this->acl_session_for_user($brnch);
        }else{
        if($this->aclpermissionmodel->check_user_branch($brnch,$_SESSION['Uid'])){
            $this->acl_session_for_user($brnch);
        }}
        
        
    }
    
}
?>
