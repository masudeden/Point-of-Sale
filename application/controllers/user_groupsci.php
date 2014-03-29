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
    function add_user_groups_branch($id,$branch){
         if($this->session->userdata['user_groupsci_per']['add']==1 or $this->session->userdata['user_type']==2){                 
            $this->load->model('user_groups');                
            $this->user_groups->set_branch_user_groups($id,$branch);                
        }else{
            $this->get_user_groups();
        }
    }
       
       
      
      
     
}
?>