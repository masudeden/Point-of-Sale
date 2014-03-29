<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poslanguage{
    function __construct() {
        
    }
    function set_language(){
        $CI=  get_instance();
        $CI->load->library('session');
          if(isset($this->session->userdata['lang'])){                
             
        $lang= $this->session->userdata['lang'];
        $CI->config->set_item('language',$lang); 
        $CI->lang->load($lang);
             }
        else{
       $CI->config->set_item('language','english'); 
       $CI->lang->load('english');
        }
        
    }
}
?>
