<?php

class Modules_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_modules($bid){
        $this->db->select()->from('modules_x_branchs')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
        $sql=  $this->db->get();
        if($sql->num_rows()==0){
            return FALSE;
        }else{
            return $sql->result();
        }
    }
    function get_modules_basced_on_branch(){
        $this->db->select()->from('modules');
        $sql=$this->db->get();
        return $sql->result();
    }
    function get_modulenames($bid){
        $this->db->select()->from('modules_x_branchs')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
        $sql=$this->db->get();
        $data=array();
        foreach ($sql->result() as $row){
            $this->db->select()->from('modules')->where('guid',$row->module_id);
            $val=$this->db->get();
            foreach ($val->result() as $mod){
                $data[]=$mod->module_name;
            }
        }
        return $data;
    }
    function get_module_permission($bid){
         $this->db->select()->from('modules_x_branchs')->where('branch_id',$bid)->where('active_status',0)->where('delete_status',0);
        $sql=$this->db->get();
        $data=array();
        foreach ($sql->result() as $row){
            $this->db->select()->from('modules')->where('guid',$row->module_id);
            $val=$this->db->get();
            foreach ($val->result() as $mod){
                $data[]=$mod->guid;
            }
        }
        return $data;
    }
}
?>
