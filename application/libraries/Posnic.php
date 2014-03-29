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
          if(!isset($this->CI->session->userdata['guid'])){
             redirect('home');
        }
    }
   
    function posnic_result_array($value){
         $CI=  get_instance();
         $module=$this->session->userdata['posnic_module'];
        if($this->session->userdata[$module.'_per']['read']==1){
             if($this->CI->session->userdata['user_type']==2){
            return $CI->posnic_model->get_data_as_result_array_admin($module,$value,$this->CI->session->userdata['branch_id']);     
            }else{
                   return $CI->posnic_model->get_data_as_result_array_user($module,$value,$this->CI->session->userdata['branch_id']);
            }
            }else{
            echo 'You have no permission';
        } 
    }  
    function module_result(){
         $CI=  get_instance();
         $module=$this->session->userdata['posnic_module'];
       if($this->CI->session->userdata['user_type']==2){
                   return $CI->posnic_model->module_result_admin($module,$this->CI->session->userdata['branch_id']);     
            }else{
                   return $CI->posnic_model->module_result_user($module,$this->CI->session->userdata['branch_id']);
            }  
    }
    function  posnic_result($value){
         $CI=  get_instance();
         $module=$this->session->userdata['posnic_module'];
        if($this->session->userdata[$module.'_per']['read']==1){
             if($this->CI->session->userdata['user_type']==2){
                return $CI->posnic_model->get_data_as_result_admin($module,$value,$this->CI->session->userdata['branch_id']);
            }else{
                return $CI->posnic_model->get_data_as_result_user($module,$value,$this->CI->session->userdata['branch_id']);  
            }
            }else{
            echo 'You have no permission';
        }       
    }
    function  posnic_module_result($value,$module){
         $CI=  get_instance();
         $mod=$this->session->userdata['posnic_module'];
                return $CI->posnic_model->get_data_as_result_user($module,$value,$this->CI->session->userdata['branch_id']); 
            
    }
  
    function posnic_count(){
         $CI=  get_instance();
         $module=$this->session->userdata['posnic_module'];
        if($this->session->userdata[$module.'_per']['read']==1){
            if($this->CI->session->userdata['user_type']==2){
                return $CI->posnic_model->get_data_count_for_admin($this->CI->session->userdata['branch_id'],$module);
            }else{
                return $CI->posnic_model->get_data_count_for_user($this->CI->session->userdata['branch_id'],$module);
            }      
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_module_count($module){
         $CI=  get_instance();
         $mod=$this->session->userdata['posnic_module'];
        if($this->session->userdata[$mod.'_per']['read']==1){
           
                return $CI->posnic_model->get_data_count_for_user($this->CI->session->userdata['branch_id'],$module);
                 
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_limit_result($limit,$start){
         $CI=  get_instance();
         $module=$this->session->userdata['posnic_module'];
         if($this->session->userdata[$module.'_per']['read']==1){
            if($this->CI->session->userdata['user_type']==2){
                return $CI->posnic_model->get_data_for_admin_with_limit($limit, $start,$module,$this->CI->session->userdata['branch_id']);
            }else{
                 return $CI->posnic_model->get_data_for_user_with_limit($limit, $start,$module,$this->CI->session->userdata['branch_id']);
            }      
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_module_limit_result($module,$limit,$start){
         $CI=  get_instance();
         $mod=$this->session->userdata['posnic_module'];
         if($this->session->userdata[$mod.'_per']['read']==1){
            
                 return $CI->posnic_model->get_data_for_user_with_limit($limit, $start,$module,$this->CI->session->userdata['branch_id']);
                 
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_limit_result_array($limit,$page){
         $module=$this->session->userdata['posnic_module'];
          $CI=  get_instance();
         if($this->session->userdata[$module.'_per']['read']==1){
            if($this->CI->session->userdata['user_type']==2){
                return $CI->posnic_model->get_data_array_for_admin_with_limit($limit, $start,$table,$this->CI->session->userdata['branch_id']);
            }else{
                 return $CI->posnic_model->get_data_array_for_user_with_limit($limit, $start,$table,$this->CI->session->userdata['branch_id']);
            }      
        }else{
            echo 'You have no permission';
        }
    }
    function posnic_module($table){
        if($this->session->userdata[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result($table,$this->CI->session->userdata['branch_id']);
        }
    }
    function posnic_module_where($table,$where){
        if($this->session->userdata[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_where($table,$where,$this->CI->session->userdata['branch_id']);
        }
    }
    function posnic_module_all_where($table,$where){
      
             $CI=  get_instance();
             return $CI->posnic_model->posnic_module_all_where($table,$where,$this->CI->session->userdata['branch_id']);
       
    }
    function posnic_array_module_where($table,$where){
        if($this->session->userdata[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_array_where($table,$where,$this->CI->session->userdata['branch_id']);
        }
    }
    function posnic_array_other_module_where($table,$where){
        
             $CI=  get_instance();
             return $CI->posnic_model->module_result_array_where($table,$where,$this->CI->session->userdata['branch_id']);
        
    }
    function posnic_one_array_module_where($table,$where){
        
             $CI=  get_instance();
             return $CI->posnic_model->module_result_one_array_where($table,$where,$this->CI->session->userdata['branch_id']);
        
    }
    function posnic_one_field_module_where($field,$table,$where){
        if($this->session->userdata[$table]==='On'){
             $CI=  get_instance();
             return $CI->posnic_model->module_result_one_field_where($field,$table,$where,$this->CI->session->userdata['branch_id']);
        }
    }
   function posnic_two($value1,$value2,$table,$where){
         $CI=  get_instance();
          return $CI->posnic_model->get_two_values($value1,$value2,$table,$where,$this->CI->session->userdata['branch_id']);
    }
    function check_unique($data,$table){
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$table,$this->CI->session->userdata['branch_id']);
    }
    function check_record_unique($data,$table){
          $module=$table;
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$this->CI->session->userdata['branch_id']);
    }
     function check_module_unique($data,$module){
          $CI=  get_instance();
          return $CI->posnic_model->check_unique_data($data,$module,$this->CI->session->userdata['branch_id']);
    }
    function posnic_update($value,$where){
          $module=$this->session->userdata['posnic_module'];
          $CI=  get_instance();
               $CI->posnic_model->update($module,$value,$where);
          
    }
    function posnic_update_record($value,$where,$table){
          $module=$table;
          $CI=  get_instance();
               $CI->posnic_model->update($module,$value,$where);
          
    }
    function posnic_module_update($module,$value,$where){
          $mod=$this->session->userdata['posnic_module'];
          $CI=  get_instance();
               $CI->posnic_model->update($module,$value,$where);
          
    }
    function posnic_module_add($module,$value){
          $mod=$this->session->userdata['posnic_module'];
          $CI=  get_instance();
          $branch=array('branch_id'=>$this->CI->session->userdata['branch_id']);
               $CI->posnic_model->add_module($module,$value,$branch);
          
    }
    function posnic_add_record($value,$table){
          $module=$table;
          $CI=  get_instance();
          $branch=array('branch_id'=>$this->CI->session->userdata['branch_id']);
          return $CI->posnic_model->add($module,$value,$branch,$this->CI->session->userdata['guid']);
               
          
    }
    function posnic_add($value){
          $module=$this->session->userdata['posnic_module'];
          $CI=  get_instance();
          $branch=array('branch_id'=>$this->CI->session->userdata['branch_id']);
               return $CI->posnic_model->add($module,$value,$branch,$this->CI->session->userdata['guid']);
               
           
    }
    function posnic_deactive_where($where){
        $CI=  get_instance();        
        $module=$this->session->userdata['posnic_module'];
        $branch=$this->CI->session->userdata['branch_id'];
        echo "1";
        $CI->posnic_model->deactive_where($where,$module,$branch);
    }
    function posnic_active_where($where){
        $CI=  get_instance();        
        $module=$this->session->userdata['posnic_module'];
        $branch=$this->CI->session->userdata['branch_id'];
        
        $CI->posnic_model->active_where($where,$module,$branch);
    }
    function posnic_deactive($guid){
        $CI=  get_instance();        
        $module=$this->session->userdata['posnic_module'];
        $branch=$this->CI->session->userdata['branch_id'];
        
        $CI->posnic_model->deactive($guid,$module,$branch);
    }
    function posnic_active($guid){
        $CI=  get_instance();        
        $module=$this->session->userdata['posnic_module'];
        $branch=$this->CI->session->userdata['branch_id'];
        
        $CI->posnic_model->active($guid,$module,$branch);
    }
    function posnic_restore($guid){
        $CI=  get_instance();        
        $module=$this->session->userdata['posnic_module'];
        $branch=$this->CI->session->userdata['branch_id'];  
    if($this->CI->session->userdata['user_type']==2){
        $CI->posnic_model->restore($guid,$module,$branch);
    }
    }
    function posnic_delete($guid,$table){
        $CI=  get_instance();        
        $branch=$this->CI->session->userdata['branch_id'];  
             $CI->posnic_model->delete_record($guid,$table,$branch,$this->CI->session->userdata['guid']);
    }
    function posnic_module_delete($guid,$module1){
        $CI=  get_instance();
        $branch=$this->CI->session->userdata['branch_id']; 
          $module=$this->session->userdata['posnic_module'];
         if( $this->session->userdata[$module.'_per']['delete']==1){
            if($this->CI->session->userdata['user_type']==2){
           
        $CI->posnic_model->admin_where_delete($guid,$module1,$branch,$this->CI->session->userdata['guid']);
            
        }else{
             $CI->posnic_model->admin_where_delete($guid,$module1,$branch,$this->CI->session->userdata['guid']);
        }
       }
    }
    function posnic_where_delete($where){
        $CI=  get_instance();        
        $module=$this->session->userdata['posnic_module'];
        $branch=$this->CI->session->userdata['branch_id'];  
         if( $this->session->userdata[$module.'_per']['delete']==1){
            if($this->CI->session->userdata['user_type']==2){
           
        $CI->posnic_model->admin_where_delete($where,$module,$branch,$this->CI->session->userdata['guid']);
            
        }else{
             $CI->posnic_model->user_where_delete($where,$module,$branch,$this->CI->session->userdata['guid']);
        }
       }
    }
    function posnic_like($table,$where,$name){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_like_data($table,$where,$name,$branch);
    }
    function posnic_or_like($table,$like){
          $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_or_like($table,$like,$branch);
    }
            
    function posnic_module_like($table,$where){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_module_like($table,$where,$branch);
    }
    function posnic_join_like($table1,$table2,$like,$where){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_join_like($table1,$table2,$like,$where,$branch);
    }
    function posnic_data_table_with_join($end,$start,$table1,$table2,$join_where,$order,$like,$where){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_data_table_with_join($end,$start,$table1,$table2,$join_where,$branch,$order,$like,$where);
    }
    function data_table_with_multi_table($end,$start,$table,$join_table,$select,$join_where,$order,$like,$where){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->data_table_with_multi_table($end,$start,$table,$join_table,$select,$join_where,$order,$like,$where,$branch);
    }
    function data_table_count($table){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->data_table_count($table,$branch);
    }
    function posnic_module_active($id,$table){
          $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_module_active($id,$table,$branch);
    }
    function posnic_module_deactive($id,$table){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_module_deactive($id,$table,$branch);
    }
    function get_module_details_for_update($guid,$table){
         $CI=  get_instance();  
         return $CI->posnic_model->get_module_details_for_update($guid,$table);
    }
            
    function posnic_data_table($end,$start,$order,$like,$table){
         $CI=  get_instance();  
         $branch=$this->CI->session->userdata['branch_id'];
         return $CI->posnic_model->posnic_data_table($end,$start,$order,$like,$table,$branch);;
    }
    function branches(){
        $CI=  get_instance();
        $CI->load->model('setting');
        $CI->load->model('branch');        
        $data['branch_settings']=$CI->setting->get_branch_setting();
        if($this->CI->session->userdata['user_type']==2){
            
        $data['row']= $CI->branch->get_branch();
        
        }else{
        
        $data['row']=$CI->branch->get_active_user_branches($this->CI->session->userdata['guid']);
        }
        return $data;
    }
    function modules(){
        $CI=  get_instance();
        $CI->load->model('modules_model')  ;
        
        $data['cate']= $CI->modules_model->get_module_category();      
        $data['row']=  $CI->modules_model->get_modules($this->CI->session->userdata['branch_id']);
       
        return $data;
    }
    function posnic_all_module_data($table){
         $CI=  get_instance();
         $CI->load->model('modules_model')  ;        
         $data =$CI->posnic_model->get_aa_data_as_result_admin($table,$this->CI->session->userdata['branch_id']);
         return $data;
    }
    function posnic_master_max($key){
         $CI=  get_instance();
         $CI->load->model('modules_model')  ;        
         $data =$CI->posnic_model->posnic_master_max($key,$this->CI->session->userdata['branch_id']);
         return $data;
    }
    function posnic_master_increment_max($key){
         $CI=  get_instance();
         $CI->load->model('modules_model')  ;        
         $data =$CI->posnic_model->posnic_master_increment_max($key,$this->CI->session->userdata['branch_id']);
         return $data;
    }
}
       
?>
