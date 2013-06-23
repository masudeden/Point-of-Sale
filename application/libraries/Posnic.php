<?php
class Posnic{
    function __construct() {
          $CI=  get_instance();
          
                $CI->load->helper('form');
                $CI->load->helper('url');
                $CI->load->library('unit_test');
                $CI->load->library('session');      
                session_start();
                $CI->load->helper(array('form', 'url'));
                $CI->load->library('poslanguage'); 
                $CI->load->library('form_validation');
                $CI->poslanguage->set_language();
    }
    function get_array($module,$value){
        if($_SESSION[$module.'_per']['read']==1){
            echo 'you have no permission to';
             //$CI->load->model('aclpermissionmodel');
             //$deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);
        }else{
            echo 'You have no permission';
        }
        
    }
}
       
?>
