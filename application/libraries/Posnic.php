<?php
class Posnic{
 private $CI;

    public function __construct()
    { 
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        
         $this->CI->load->helper('url');
      
                $this->CI->load->helper('form');
                $this->CI->load->helper('url');
                $this->CI->load->library('unit_test');
                $this->CI->load->library('session');      
                session_start();
                $this->CI->load->helper(array('form', 'url'));
                $this->CI->load->library('poslanguage'); 
                $this->CI->load->library('form_validation');
                $this->CI->poslanguage->set_language();
                $this->CI->load->library("pagination");
                $this->CI->load->model('posnic_model');
               
                
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
                return $CI->posnic_model->get_data_as_result_user($module,$value,$_SESSION['Bid']); 
            
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
    function posnic_module_all_where($table,$where){
      
             $CI=  get_instance();
             return $CI->posnic_model->posnic_module_all_where($table,$where,$_SESSION['Bid']);
       
    }
    function posnic_array_module_where($table,$where){
        if($_SESSION[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_array_where($table,$where,$_SESSION['Bid']);
        }
    }
    function posnic_array_other_module_where($table,$where){
        
             $CI=  get_instance();
             return $CI->posnic_model->module_result_array_where($table,$where,$_SESSION['Bid']);
        
    }
    function posnic_one_array_module_where($table,$where){
        
             $CI=  get_instance();
             return $CI->posnic_model->module_result_one_array_where($table,$where,$_SESSION['Bid']);
        
    }
    function posnic_one_field_module_where($field,$table,$where){
        if($_SESSION[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_one_field_where($field,$table,$where,$_SESSION['Bid']);
        }
    }
   function posnic_two($value1,$value2,$table,$where){
         $CI=  get_instance();
          return $CI->posnic_model->get_two_values($value1,$value2,$table,$where,$_SESSION['Bid']);
    }
    function check_unique($data,$table){
          $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$_SESSION['Bid'],$table);
    }
    function check_record_unique($data,$table){
          $module=$table;
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$_SESSION['Bid']);
    }
     function check_module_unique($data,$module){
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$_SESSION['Bid']);
    }
    function posnic_update($value,$where){
          $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
               $CI->posnic_model->update($module,$value,$where);
          
    }
    function posnic_update_record($value,$where,$table){
          $module=$table;
          $CI=  get_instance();
               $CI->posnic_model->update($module,$value,$where);
          
    }
    function posnic_module_update($module,$value,$where){
          $mod=$_SESSION['posnic_module'];
          $CI=  get_instance();
               $CI->posnic_model->update($module,$value,$where);
          
    }
    function posnic_module_add($module,$value){
          $mod=$_SESSION['posnic_module'];
          $CI=  get_instance();
          $branch=array('branch_id'=>$_SESSION['Bid']);
               $CI->posnic_model->add_module($module,$value,$branch);
          
    }
    function posnic_add_record($value,$table){
          $module=$table;
          $CI=  get_instance();
          $branch=array('branch_id'=>$_SESSION['Bid']);
          return $CI->posnic_model->add($module,$value,$branch,$_SESSION['Uid']);
               
          
    }
    function posnic_add($value){
          $module=$_SESSION['posnic_module'];
          $CI=  get_instance();
          $branch=array('branch_id'=>$_SESSION['Bid']);
               return $CI->posnic_model->add($module,$value,$branch,$_SESSION['Uid']);
               
           
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
    function posnic_delete($guid,$table){
        $CI=  get_instance();        
        $branch=$_SESSION['Bid'];  
             $CI->posnic_model->user_delete($guid,$table,$branch,$_SESSION['Uid']);
    }
    function posnic_module_delete($guid,$module1){
        $CI=  get_instance();
        $branch=$_SESSION['Bid']; 
          $module=$_SESSION['posnic_module'];
         if( $_SESSION[$module.'_per']['delete']==1){
            if($_SESSION['admin']==2){
           
        $CI->posnic_model->admin_where_delete($guid,$module1,$branch,$_SESSION['Uid']);
            
        }else{
             $CI->posnic_model->admin_where_delete($guid,$module1,$branch,$_SESSION['Uid']);
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
    function posnic_or_like($table,$like){
          $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_or_like($table,$like,$branch);
    }
            
    function posnic_module_like($table,$where){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_module_like($table,$where,$branch);
    }
    function posnic_join_like($table1,$table2,$like,$where){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_join_like($table1,$table2,$like,$where,$branch);
    }
    function posnic_data_table_with_join($end,$start,$table1,$table2,$join_where,$order,$like,$where){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_data_table_with_join($end,$start,$table1,$table2,$join_where,$branch,$order,$like,$where);
    }
    function data_table_with_multi_table($end,$start,$table,$join_table,$select,$join_where,$order,$like,$where){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->data_table_with_multi_table($end,$start,$table,$join_table,$select,$join_where,$order,$like,$where,$branch);
    }
    function data_table_count($table){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->data_table_count($table,$branch);
    }
    function posnic_module_active($id,$table){
          $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_module_active($id,$table,$branch);
    }
    function posnic_module_deactive($id,$table){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_module_deactive($id,$table,$branch);
    }
    function get_module_details_for_update($guid,$table){
         $CI=  get_instance();  
         return $CI->posnic_model->get_module_details_for_update($guid,$table);
    }
            
    function posnic_data_table($end,$start,$order,$like,$table){
         $CI=  get_instance();  
         $branch=$_SESSION['Bid'];
         return $CI->posnic_model->posnic_data_table($end,$start,$order,$like,$table,$branch);;
    }
    function branchs(){
        $CI=  get_instance();
        $CI->load->model('setting');
        $CI->load->model('branch');        
        $data['branch_settings']=$CI->setting->get_branch_setting();
        if($_SESSION['admin']==2){
            
        $data['row']= $CI->branch->get_branch();
        
        }else{
        
        $data['row']=$CI->branch->get_active_user_branchs($_SESSION['Uid']);
        }
        return $data;
    }
    function modules(){
        $CI=  get_instance();
        $CI->load->model('modules_model')  ;
        
        $data['cate']= $CI->modules_model->get_module_category();      
        $data['row']=  $CI->modules_model->get_modules($_SESSION['Bid']);
        $data['active']=$_SESSION['active_module'];
        return $data;
    }
    function posnic_all_module_data($table){
         $CI=  get_instance();
         $CI->load->model('modules_model')  ;        
         $data =$CI->posnic_model->get_aa_data_as_result_admin($table,$_SESSION['Bid']);
         return $data;
    }
    function posnic_master_max($key){
         $CI=  get_instance();
         $CI->load->model('modules_model')  ;        
         $data =$CI->posnic_model->posnic_master_max($key,$_SESSION['Bid']);
         return $data;
    }
    function posnic_master_increment_max($key){
         $CI=  get_instance();
         $CI->load->model('modules_model')  ;        
         $data =$CI->posnic_model->posnic_master_increment_max($key,$_SESSION['Bid']);
         return $data;
    }
}
       
?>
