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
                $CI->load->model('posnic_model');
    }
    function posnic_result_array_for_admin($module,$value){
        if($_SESSION[$module.'_per']['read']==1){
           echo  $_SESSION['Posnic_User'];
            //return $CI->posnic_model->get_user_groups($id,$bid);
        }else{
            echo 'You have no permission';
        }
        
    }
}
       
?>
