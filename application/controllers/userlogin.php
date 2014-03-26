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
        if(!isset($_SESSION['Uid'])){
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
function testlogin(){
    echo mysql_real_escape_string($_POST['username']);;
}
 function login(){
    $this->load->library('form_validation');
   
    if($this->input->post('login')){
        $this->form_validation->set_rules('username',$this->lang->line('user_name'), 'required');
        $this->form_validation->set_rules('password',$this->lang->line('password'),'required');
        if($this->form_validation->run()!=FALSE){
            $username=  $this->input->post('username');
            $password=$this->input->post('password');
            $this->load->model('logindetails');
            if($this->logindetails->login($username,$password)){
              
                $_SESSION['Uid']= $this->logindetails->loginid($username,$password);
                if(!$this->logindetails->check_user_is_active_or_not($_SESSION['Uid']))
                {
                    if($this->logindetails->check_admin($_SESSION['Uid'])){
                     $_SESSION['admin']=2;
                     echo '22'; 
                }else{
                   echo "11";
                }
                   
                }else{
                if($this->logindetails->check_admin($_SESSION['Uid'])){
                     $_SESSION['admin']=2;
                      echo '22';
                }else{
               if($this->logindetails->is_in_active_branches($_SESSION['Uid'])!=0){
                    $_SESSION['admin']=0;
                     echo '22';
               }else{
                   echo "1";
                  
               }}}
            }else{
                echo "2";                
                               
            }           
            }  else {          
              
             echo "3";
        }
    }
   
}
 
    function setlanguage($lang){
       $_SESSION['lang']=$lang;
    }
    

}
?>
