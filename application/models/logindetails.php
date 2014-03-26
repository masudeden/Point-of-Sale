<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logindetails extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function login($username,$password){ 
        $pass=  md5($password);
        $this->db->select()->from('users')->where('username',$username)->where('password',$pass);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }        
    }
    function loginid($username,$password){ 
        $pass=  md5($password);
        $this->db->select()->from('users')->where('username',$username)->where('password',$pass);
        $sql=$this->db->get();
        foreach ($sql->result() as $row){
           return $row->guid;
        }        
    }
    function is_in_active_branches($Uid){                
        $this->db->select()->from('users_x_branches')->where('user_id',$Uid);
        $sql_b=  $this->db->get();
        $data=array();
        $value=0;
        foreach ($sql_b->result() as $brow){
            $data[]=$brow->branch_id ;
        }
        for($i=0;$i<count($data);$i++){
           $this->db->select()->from('branches')->where('guid',$data[$i])->where('active_status',1);
           $sql=  $this->db->get();
           if($sql->num_rows()>0){
               $value=$value+1;
           }else{
               $value=$value+0;
           }
        }
        return $value;
    }
    function check_admin($id){
        $this->db->select()->from('users')->where('guid',$id)->where('user_type',2);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    function check_user_is_active_or_not($id){
        $this->db->select()->from('users_x_branches')->where('user_id',$id)->where('user_active',0)->where('user_delete ',0);
        $sql=$this->db->get();
        if($sql->num_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
?>
