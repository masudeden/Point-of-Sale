<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posmain extends CI_Controller{
    function __construct() {
        parent::__construct();
          session_start();
        $this->load->helper('form');
        $this->load->helper('url');        
        $this->load->library('unit_test');
        $this->load->library('poslanguage');                 
        $this->poslanguage->set_language();
    }
	
    function index()  { 
		if(!isset($this->session->userdata['guid'])){
            $this->load->view('template/header');
            $this->load->view('login');
            $this->load->view('template/footer');
        }else{
            $this->set_user_default_branch();             
        }
    }
	
	
   function set_user_default_branch(){
     
        $this->load->model('branch');
        $this->pos_setting();       
        if($this->session->userdata('user_type')==2){
             $admin=  $this->branch->branch_for_admin();         
             $this->acl_session_for_user($admin);  
             redirect('home');
        }else{
             if($this->branch->check_user_branch_active($this->session->userdata['guid'],$this->session->userdata['default_branch'])){
				 $this->acl_session_for_user($this->session->userdata['default_branch']);        
				 redirect('home');            
        	 }else{
				$branch_id =$this->branch->select_any_active_branch($this->session->userdata['guid']);
				$this->acl_session_for_user($branch_id);        
				redirect('home');           
        	}
        }
        
    } // End Set user Function 
	
	
   function acl_session_for_user($branch_id){
      
	    $this->session->set_userdata('branch_id', $branch_id);
        $this->load->model('modules_model')  ;
        $this->load->library('acluser'); 
        if($this->session->userdata['user_type']==2){
            $modules=  $this->modules_model->get_module_permission($this->session->userdata['branch_id']); 
            for($i=0;$i<count($modules);$i++){
                $this->acluser->admin_module_permissions($modules[$i]);
            } // End for loop
        }else{
       
        	$modules=  $this->modules_model->get_module_permission($this->session->userdata['branch_id']); 
            for($i=0;$i<count($modules);$i++){
                $this->acluser->module_permissions($modules[$i],$branch_id ,$this->session->userdata['guid']);
        	}  // End for loop
                exit();
        } // End if condition
		
    } //End ACL function 
	
	
    function pos_setting(){
        $this->load->model('setting');
        $data=  $this->setting->get_setting();
        $setting=array('Branch'=>$data[0],
            'Depart'=>$data[1]);
       // $this->session->userdata['Setting']=$setting;
		$this->session->set_userdata('Setting',$setting);
    }
  
    function user_groups(){
        redirect('user_groupsci');
    }
    function change_user_branch($brnch){
        $this->load->model('aclpermissionmodel');
        if($this->session->userdata['user_type']==2){
            $this->acl_session_for_user($brnch);
        }else{
        if($this->aclpermissionmodel->check_user_branch($brnch,$this->session->userdata['guid'])){
            $this->acl_session_for_user($brnch);
        }}
        
        
    }
    function get_date_in_strtotime(){
        $date=$this->input->post('date');
         echo date('n/j/Y', strtotime('+0 year, +0 days',$date));
    }
    
}
?>
