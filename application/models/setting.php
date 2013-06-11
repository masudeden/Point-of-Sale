<?php
class Setting extends CI_Model{
    function __construct() {
        parent::__construct();
    }
    function get_branch_setting(){
        $this->db->select()->from('settings');
        $sql=$this->db->get();
        foreach ($sql->result() as $row) {           
                 $data= $row->branch ;                    
    }
    return $data;
    }
    
    function get_setting(){
        $this->db->select()->from('settings');
        $sql=$this->db->get();
        $data=array();
        foreach ($sql->result() as $row) {           
                 $data[]= $row->branch ; 
                 $data[]=$row->department 	;
    }
    return $data;
    }
}
?>
