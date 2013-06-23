<?php

class posnic_model extends CI_model{
    function __construct() {
        parent::__construct();
    }
   
    function get_data_as_result_array($table,$where){
        $this->db->select()->from($table)->where($where);
        $sql=  $this->db->get();
        return $sql->result_array();
  }
}
?>
