<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acluser{
    function __construct() {
       
    }
    function module_permissions($mod,$bid,$id){
        
          $CI=  get_instance();
          $CI->load->library('session');
          $CI->load->model('aclpermissionmodel');
          $module_name=$CI->aclpermissionmodel->get_module_name($mod);  
          $CI->config->load("$module_name/posnic");
          
          
          $acl_list =$CI->config->item('M_ACL');
          //$permission=$CI->aclpermissionmodel->get_admin_permission($mod);
         
  
          
         $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);
          
         $permission=0;
         for($i=0;$i<count($deaprt);$i++){
         
         $permission =$permission+ $CI->aclpermissionmodel->get_user_modules_permissions($deaprt[$i],$bid,$mod);
         
         }
         $item=array();
         for($j=0;$j<count($acl_list);$j++){
               $per_v= substr($permission,$j,1);
               if($per_v=="" or $per_v==0){               
                        // array_push($item["$acl_list"]=>0);
                    $second_array = array("$acl_list[$j]" => 0);
                    $item = array_merge((array)$item, (array)$second_array);
                       }else{
                    $second_array = array("$acl_list[$j]" => 1);
                    $item = array_merge((array)$item, (array)$second_array);
                   }
         }
        $second_array = array($module_name => $permission);
        $item = array_merge((array)$item, (array)$second_array);
        $_SESSION[$module_name.'_per']=$item;
        $_SESSION[$module_name]='On';   
    }  
    function admin_module_permissions($mode){
    
        $sasi=$mode;
             $item = array(
                   $mode=>1111,
                   'read'=>1,
                   'add'=>1,
                   'edit' =>1,
                   'delete'=>1
               );

        $_SESSION[$sasi."_per"]=$item; 
        $_SESSION[$sasi]='On';
    }
    function user_full_permissions(){
        $user=$_SESSION['user_groupsci_per']['depa']+ $_SESSION['branchCI_per']['branch']+$_SESSION['users_per']['user']+$_SESSION['items_per']['item'];
        $_SESSION['full_per']=$user;
    }
    
    
}
?>
