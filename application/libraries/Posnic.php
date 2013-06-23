<?php
class Posnic{
    function __construct() {
          $CI=  get_instance();
          
                $CI->load->helper('form');
                $CI->load->helper('url');
                $CI->load->library('unit_test');
                $CI->load->library('session');      
                session_start();
                $CI->load->helper(array('form', 'url'));
                $CI->load->library('poslanguage'); 
                $CI->load->library('form_validation');
                $CI->poslanguage->set_language();
    }
    function get_array($module,$value){
        
    }
}
       
?>
