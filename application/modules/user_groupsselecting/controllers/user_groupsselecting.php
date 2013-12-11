<?php
class User_groupsselecting extends CI_Controller{
    function __construct() {
        parent::__construct();
         $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('unit_test');
        session_start();        
        $this->load->helper(array('form', 'url'));
        $this->load->library('poslanguage');                 
        $this->poslanguage->set_language();
    }
    function index(){
        
        $this->get();
    }
    function get(){
                    $this->load->model('user_groups');
                    $this->load->model('branch');
                    $data['branch']= $this->branch->get_user_for_branch(55);
                    $data['depa']= $this->user_groups->get_user_groups();
                   //$this->load->view('template/header');
                    $this->load->view('ruffpaper',$data);
                   
    }
    function add($jibi,$selected){          
        $value=urldecode($selected);
          $nijan=array();
          $monish=array();
          $k=0;
        $nijan = explode(' ',$value );
            for($j=0;$j<count($nijan);$j++){
                $dep_id=array();
                $dep_id = explode('.',$nijan[$j] );
               if($dep_id[0]==$jibi){
                   $monish[$k]=$dep_id[1];
                   $k++;
               }
               }
        $this->load->model('user_groups');
        $data=$this->user_groups->get_user_deprtment($jibi);
        $id=$this->user_groups->get_user_deprtment_id($jibi);
        if(count($monish)>0){
            $selected_depa=$this->get_selected($monish,$id);
             
                 for($j=0;$j<count($selected_depa);$j++){
            $depa=$this->user_groups->get_user_seleted_depa($selected_depa[$j]);
            echo "<option value=$jibi.$selected_depa[$j] >  $depa  </option>";            
                 }             
        }else{
        for($i=0;$i< count($data);$i++){          
       echo "<option value=$jibi.$id[$i]  >$data[$i]   </option>";           
        }
        }
    }
    function get_selected($depart,$id){
       
        $new_depa=array();
        $o=0;
        $w = 0;
        $departed=$id;
        $arr=array_merge($depart,$departed);

                $len = count($arr);
        for ($i = 0; $i < $len; $i++) {
        $temp = $arr[$i];
        $j = $i;
        for ($k = 0; $k < $len; $k++) {
            if ($k != $j) {
            if ($temp == $arr[$k]) {
               
                $arr[$k]=" ";
                $arr[$i]=" ";
            }
            }
        }
        }
$r=0;
        for ($i = 0; $i < $len; $i++) {
       if($arr[$i]==" "){
           
       }
       else{
           $new_depa[$r]=$arr[$i];
           $r++;
       }
        }
        return $new_depa;
    }
  
   
    function get_user_groups_branch($annan){
        $idArray=array();
        $idArray = explode('.',$annan );
        $b_id=$idArray[0];
        $d_id=$idArray[1];
        $this->load->model('branch');
        $this->load->model('user_groups');
        $branch=$this->branch->get_user_seleted_branch($b_id);
        $depa=$this->user_groups->get_user_seleted_depa($d_id);
        echo $branch." ( ".$depa." )";
    }
    function set_user_groups_branch($jibi,$id){
        $idArray=array();
        $idArray = explode('.',$id );
        $b_id=$idArray[0];
        $d_id=$idArray[1];
        $this->load->model('branch');
        $this->load->model('user_groups');
        $branch=$this->branch->get_user_seleted_branch($b_id);
        $depa=$this->user_groups->get_user_seleted_depa($d_id);
        if($jibi==$b_id){
             echo  $depa;
        }
        
    }
    function get_selected_user_groups($id){
        echo $id;
    }
   function save(){
       echo urldecode($this->input->post('depa'));
   }
   function check_user_groups_branch($jibi,$id){
       $idArray=array();
        $idArray = explode('.',$id );
        $b_id=$idArray[0];
        $d_id=$idArray[1];
        if($jibi==$b_id){
            echo 'TRUE';
        }
   }
}
?>