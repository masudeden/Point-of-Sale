<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acluser{
    function __construct() {
       
    }
    function module_permissions($mod,$bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
         $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);
          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
         $num=$num+$CI->aclpermissionmodel->get_user_modules_permissions($deaprt[$i],$bid,$mod); 
         
         }
         
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $item = array(
                   "$mod"=>$read."".$add."".$edit."".$delete,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete
               );

        $_SESSION[$mod.'_per']=$item;
        $_SESSION[$mod]='On';
        
        
        
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
