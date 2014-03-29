<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userlogin extends CI_Controller
{
    function __construct() {
        parent::__construct();
        session_start();
        $this->load->helper('url');
        $this->load->library('unit_test');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->load->library('poslanguage');                 
        $this->poslanguage->set_language();     
    }
    function index(){    
	

   
        if(!isset($this->session->userdata['guid'])){
            $this->load->view('template/login/header');
            $this->load->view('login');
            $this->load->view('template/login/footer');
        }else{
            $this->load->view('template/header');
            $this->load->view('home');
            $this->load->view('template/footer');
        }     
        } 
	function employee()
	{
		redirect('/employees');
	}
	function login(){
		$this->load->library('form_validation');
		if($this->input->post('login')){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			if($this->form_validation->run()!=FALSE){
				$username	=  $this->input->post('username');
				$password	=  $this->input->post('password');
				$this->load->model('logindetails');
				if($this->logindetails->user_validation($username,$password) === true )
					echo "1";
				else 
					echo $this->lang->line($this->logindetails->user_validation($username,$password));
				
			} // End If condition
			
		} // End If condition
	   
	} // End Login Function 
 
    function setlanguage($lang){     
       $this->session->userdata('lang',$lang); // set langauge 
    }
    

}
?>
