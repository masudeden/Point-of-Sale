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
                   'item'=>$read."".$add."".$edit."".$delete,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete
               );

        $_SESSION[$mod.'_per']=$item;
        
        
        
    }
   

     function user_branchCI_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
        $num=$num+$CI->aclpermissionmodel->branchCI_permission($deaprt[$i],$bid); 
         }        echo $num;
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $emp = array(
                   'branch'=>$read."".$add."".$edit."".$delete,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['branchCI_per']=$emp;       
        
    }
    
    
     function user_customer_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
        $num=$num+$CI->aclpermissionmodel->customer_permission($deaprt[$i],$bid); 
         }        echo $num;
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $emp = array(
                   'branch'=>$read."".$add."".$edit."".$delete,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['Customer_per']=$emp;       
        
    }
    function user_item_kits_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
        $num=$num+$CI->aclpermissionmodel->item_kits_permission($deaprt[$i],$bid); 
         }        echo $num;
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $emp = array(
                   'branch'=>$read."".$add."".$edit."".$delete,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['item_kits_per']=$emp;       
        
    } function user_sales_permissions($bid,$id){
         $CI=  get_instance();
         $CI->load->library('session');
         $CI->load->model('aclpermissionmodel');
          $deaprt=$CI->aclpermissionmodel->get_user_groups($id,$bid);          
         $num=0000;
         for($i=0;$i<count($deaprt);$i++){
        $num=$num+$CI->aclpermissionmodel->sales_permission($deaprt[$i],$bid); 
         }        echo $num;
        if($num%10==0){  $read=0; }else{  $read=1; }
        if($num/10%10==0){  $add=0; }else{  $add=1; }
        if($num/100%10==0){ $edit=0; }else{  $edit=1; }
        if($num/1000%10==0){ $delete= 0; }else{  $delete= 1; }
         
        $emp = array(
                   'branch'=>$read."".$add."".$edit."".$delete,
                   'read'=>$read,
                   'add'=> $add,
                   'edit' =>$edit,
                   'delete'=>$delete               );
        $_SESSION['Sales_per']=$emp;       
        
    }
     function set_admin_permission(){
            $branch = array(
                   'branch'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $item = array(
                   'item'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $depa = array(
                   'depa'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $user = array(
                   'user'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $supplier = array(
                   'supplier'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $customer = array(
                   'customer'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $item_kits = array(
                   'item_kites'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            $sales = array(
                   'sale'=>1111,
                   'read'=>1,
                   'add'=> 1,
                   'edit' =>1,
                   'delete'=>1 );
            
        $_SESSION['branchCI_per']=$branch; 
        $_SESSION['user_groupsCI_per']=$depa; 
        $_SESSION['users_per']=$user; 
        $_SESSION['items_per']=$item;
        $_SESSION['suppliers_per']=$supplier;
        $_SESSION['Sales_per']=$sales;
        $_SESSION['item_kits_per']=$item_kits;
        $_SESSION['Customer_per']=$customer;
        
        $_SESSION['full_per']=8888;
    }
    function user_full_permissions(){
        $user=$_SESSION['user_groupsCI_per']['depa']+ $_SESSION['branchCI_per']['branch']+$_SESSION['users_per']['user']+$_SESSION['items_per']['item'];
        $_SESSION['full_per']=$user;
    }
    
    
}
?>
