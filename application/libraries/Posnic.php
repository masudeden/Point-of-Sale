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
                $CI->load->library("pagination");
                $CI->load->model('posnic_model');
                $module=$_SESSION['posnic_module'];
    }
    function posnic_result_array($value){
         $CI=  get_instance();
         $module=$_SESSION['posnic_module'];
        if($_SESSION[$module.'_per']['read']==1){
             if($_SESSION['admin']==2){
            return $CI->posnic_model->get_data_as_result_array_admin($module,$value,$_SESSION['Bid']);     
            }else{
                   return $CI->posnic_model->get_data_as_result_array_user($module,$value,$_SESSION['Bid']);
            }
            }else{
            echo 'You have no permission';
        } 
    }  
    function  posnic_result($value){
         $CI=  get_instance();
         $module=$_SESSION['posnic_module'];
        if($_SESSION[$module.'_per']['read']==1){
             if($_SESSION['admin']==2){
                return $CI->posnic_model->get_data_as_result_admin($module,$value,$_SESSION['Bid']);
            }else{
                return $CI->posnic_model->get_data_as_result_user($module,$value,$_SESSION['Bid']);  
            }
            }else{
            echo 'You have no permission';
        }       
    }
  
    function posnic_count(){
        
         $CI=  get_instance();
         $module=$_SESSION['posnic_module'];
        if($_SESSION[$module.'_per']['read']==1){
            if($_SESSION['admin']==2){
                return $CI->posnic_model->get_data_count_for_admin($_SESSION['Bid'],$module);
            }else{
                return $CI->posnic_model->get_data_count_for_user($_SESSION['Bid'],$module);
            }      
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_limit_result($limit,$start){
         $CI=  get_instance();
         $module=$_SESSION['posnic_module'];
         if($_SESSION[$module.'_per']['read']==1){
            if($_SESSION['admin']==2){
                return $CI->posnic_model->get_data_for_admin_with_limit($limit, $start,$module,$_SESSION['Bid']);
            }else{
                 return $CI->posnic_model->get_data_for_user_with_limit($limit, $start,$module,$_SESSION['Bid']);
            }      
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_limit_result_array($limit,$page){
         $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
         if($_SESSION[$module.'_per']['read']==1){
            if($_SESSION['admin']==2){
                return $CI->posnic_model->get_data_array_for_admin_with_limit($limit, $start,$table,$_SESSION['Bid']);
            }else{
                 return $CI->posnic_model->get_data_array_for_user_with_limit($limit, $start,$table,$_SESSION['Bid']);
            }      
        }else{
            echo 'You have no permission';
        }
    }
    function check_unique($data){
        $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$_SESSION['Bid']);
    }
}
       
?>
