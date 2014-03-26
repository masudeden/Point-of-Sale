<?php

class Modules_model extends CI_Model{
    function __construct() {
        parent::__construct();
    }
   
    function get_module_category(){
        $this->db->select()->from('modules_category');
        $sql=  $this->db->get();
        return $sql->result();
    }
    function get_modules($bid){         
        $this->db->select('modules.*');
        $this->db->from('modules');  
        $this->db->join('modules_x_branches', " modules_x_branches.module_id= modules.guid ",'left');
        $this->db->where('modules.active_status ',1);
        $this->db->where('modules.delete_status ',0);
        $this->db->where('modules_x_branches.active_status',1);
        $this->db->where('modules_x_branches.delete_status',0);        
        $query=$this->db->get();
        return $query->result();
       
    }
    function get_modules_basced_on_branch(){
        $this->db->select()->from('modules');
        $sql=$this->db->get();
        return $sql->result();
    }
    function get_modulenames($bid){
        $this->db->select()->from('modules_x_branches')->where('branch_id',$bid)->where('active_status',1)->where('delete_status',0);
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
         $this->db->select()->from('modules_x_branches')->where('branch_id',$bid)->where('active_status',1)->where('delete_status',0);
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
