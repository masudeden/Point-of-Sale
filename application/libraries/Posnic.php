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
               
                
          if(!isset($_SESSION['Uid'])){
             redirect('home');
        }
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
    function module_result(){
         $CI=  get_instance();
         $module=$_SESSION['posnic_module'];
       if($_SESSION['admin']==2){
                   return $CI->posnic_model->module_result_admin($module,$_SESSION['Bid']);     
            }else{
                   return $CI->posnic_model->module_result_user($module,$_SESSION['Bid']);
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
    function  posnic_module_result($value,$module){
         $CI=  get_instance();
         $mod=$_SESSION['posnic_module'];
        if($_SESSION[$mod.'_per']['read']==1){
                return $CI->posnic_model->get_data_as_result_user($module,$value,$_SESSION['Bid']); 
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
    function posnic_module_count($module){
         $CI=  get_instance();
         $mod=$_SESSION['posnic_module'];
        if($_SESSION[$mod.'_per']['read']==1){
           
                return $CI->posnic_model->get_data_count_for_user($_SESSION['Bid'],$module);
                 
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
    function posnic_module_limit_result($module,$limit,$start){
         $CI=  get_instance();
         $mod=$_SESSION['posnic_module'];
         if($_SESSION[$mod.'_per']['read']==1){
            
                 return $CI->posnic_model->get_data_for_user_with_limit($limit, $start,$module,$_SESSION['Bid']);
                 
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
    function posnic_module($table){
        if($_SESSION[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result($table,$_SESSION['Bid']);
        }
    }
    function posnic_module_where($table,$where){
        if($_SESSION[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_where($table,$where,$_SESSION['Bid']);
        }
    }
    function posnic_array_module_where($table,$where){
        if($_SESSION[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_array_where($table,$where,$_SESSION['Bid']);
        }
    }
    function posnic_one_array_module_where($table,$where){
        if($_SESSION[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_one_array_where($table,$where,$_SESSION['Bid']);
        }
    }
            function posnic_two($value1,$value2,$table,$where){
         $CI=  get_instance();
          return $CI->posnic_model->get_two_values($value1,$value2,$table,$where,$_SESSION['Bid']);
    }
            function check_unique($data){
        $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$_SESSION['Bid']);
    }
    function posnic_update($value,$where){
          $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
           if($_SESSION[$module.'_per']['edit']==1){
               $CI->posnic_model->update($module,$value,$where);
           }else{
               echo redirect($module);
           }
    }
    function posnic_module_update($module,$value,$where){
          $mod=$_SESSION['posnic_module'];
          $CI=  get_instance();
           if($_SESSION[$mod.'_per']['edit']==1){
               $CI->posnic_model->update($module,$value,$where);
           }else{
               echo redirect($module);
           }
    }
    function posnic_add($value){
          $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
          $branch=array('branch_id'=>$_SESSION['Bid']);
           if($_SESSION[$module.'_per']['edit']==1){
               return $CI->posnic_model->add($module,$value,$branch,$_SESSION['Uid']);
               
           }else{
               echo redirect($module);
           }
    }
    function posnic_deactive_where($where){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];
        echo "1";
        $CI->posnic_model->deactive_where($where,$module,$branch);
    }
    function posnic_active_where($where){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];
        
        $CI->posnic_model->active_where($where,$module,$branch);
    }
    function posnic_deactive($guid){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];
        
        $CI->posnic_model->deactive($guid,$module,$branch);
    }
    function posnic_active($guid){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];
        
        $CI->posnic_model->active($guid,$module,$branch);
    }
    function posnic_restore($guid){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];  
    if($_SESSION['admin']==2){
        $CI->posnic_model->restore($guid,$module,$branch);
    }
    }
    function posnic_delete($guid){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];  
         if( $_SESSION[$module.'_per']['delete']==1){
            if($_SESSION['admin']==2){
           
        $CI->posnic_model->admin_delete($guid,$module,$branch,$_SESSION['Uid']);
            
        }else{
             $CI->posnic_model->user_delete($guid,$module,$branch,$_SESSION['Uid']);
        }
       }
    }
    function posnic_where_delete($where){
        $CI=  get_instance();        
        $module=$_SESSION['posnic_module'];
        $branch=$_SESSION['Bid'];  
         if( $_SESSION[$module.'_per']['delete']==1){
            if($_SESSION['admin']==2){
           
        $CI->posnic_model->admin_where_delete($where,$module,$branch,$_SESSION['Uid']);
            
        }else{
             $CI->posnic_model->user_where_delete($where,$module,$branch,$_SESSION['Uid']);
        }
       }
    }
    function posnic_like($table,$where,$name){
         $CI=  get_instance();        
  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_like_data($table,$where,$name,$branch);
    }
}
       
?>
