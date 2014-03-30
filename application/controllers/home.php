<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct() {
        parent::__construct();
       
        $this->load->helper('form');
        $this->load->library('poslanguage');                                       
        $this->poslanguage->set_language();               
    }
	
    function index(){
        if(!isset($this->session->userdata['guid'])){
            redirect('userlogin');            
        }
       $this->pos_home();   
       $this->session->set_userdata('data_limit',20);
    }
	    
    function pos_home(){             
        $this->load->model('setting');
        $this->load->model('branch');        
        $data['branch_settings']=$this->setting->get_branch_setting();
        if($this->session->userdata['user_type']==2){
            $this->session->set_userdata('Posnic_User','admin');
			//$this->session->userdata['Posnic_User']='admin';
            $data['row']=  $this->branch->get_branch();
        
        }else{
			//$this->session->userdata['Posnic_User']='user';
			$this->session->set_userdata('Posnic_User','admin');
			$data['row']=$this->branch->get_active_user_branches($this->session->userdata['guid']);
        }
       
        $this->load->view('template/app/header');
        if($this->session->userdata['Setting']['Branch']==1){
        	$this->load->view('template/branch',$data);
          }
        $modules['active']="home";
        $this->load->model('modules_model')  ;
        $modules['cate']= $this->modules_model->get_module_category();      
        $modules['row']=  $this->modules_model->get_modules($this->session->userdata['branch_id']);
        $this->load->view('home');  
        $this->load->view('template/app/navigation',$modules);
        $this->load->view('template/app/footer');   
        
       
    }
	
     function home_main($module){
         
                redirect($module);
          
               
    }

    function logout(){
       
	 $user_data = $this->session->all_userdata();
		   
			foreach ($user_data as $key => $value) {
				if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
					$this->session->unset_userdata($key);
				}
			}
			$this->session->sess_destroy();
			redirect('home');

          /* session_destroy();
           redirect('userlogin');*/
        
    }
}
?>