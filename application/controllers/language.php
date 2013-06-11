<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends CI_Controller{
    function __construct() {
        parent::__construct();
        session_start();
        $this->load->helper(array('form', 'url'));
    }
    function index()
    {
        
    }
   
    
}
?>
