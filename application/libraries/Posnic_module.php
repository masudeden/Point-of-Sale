<?php
class Posnic_module{
    function __construct() {
          $CI=  get_instance();
          
                $CI->load->helper('form');
                $CI->load->helper('url');
                $CI->load->library('unit_test');
                $CI->load->library('session');      
                $CI->load->library('session');
                $CI->load->helper(array('form', 'url'));
                $CI->load->library('poslanguage'); 
                $CI->load->library('form_validation');
                $CI->poslanguage->set_language();
    }
}
       
?>
