<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Receiving extends CI_Controller{
    function __construct() {
                parent::__construct();
                $this->load->helper('form');
                $this->load->helper('url');
                $this->load->library('unit_test');
                session_start();        
                $this->load->library('session');
                $this->load->helper(array('form', 'url'));
                $this->load->library('poslanguage'); 
                $this->load->library('form_validation');
                $this->poslanguage->set_language();
    }
    function index(){  
          if(!isset($this->session->userdata['guid'])){// check user is login or not
                redirect('home');// if user is didnt login then redirect to login page
        }else{
           $this->get_items();
         // $this->load->view('ruffpaper');
        }
    }
    function get_items(){
        $this->load->model('receiving_items');
        $data['i_row']=  $this->receiving_items->get_items($_SESSION['Bid']);
        $data['de_row']=  $this->receiving_items->get_item_details($_SESSION['Bid']);
                $this->load->view('template/header');
                $this->load->view('receiving_items',$data);
                $this->load->view('template/footer');
        
    }
    function get_selected_item()
    {
       $this->load->model('receiving_items');
           $qo = mysql_real_escape_string( $_REQUEST['query'] );

        $value=  $this->receiving_items->get_selected_item_details($qo,$_SESSION['Bid']);

$data=$value[0];
$stock=$value[2];
$price=$value[1];
$id=$value[3];
   
	    echo '<ul>'."\n";
	    for($i=0;$i<count($data);$i++)
	    {
		$p = $data[$i];
		$p = preg_replace('/(' . $qo . ')/i', '<span style="font-weight:bold;">'.$data[$i].'</span>', $p);
		echo "\t".'<li id="autocomplete_'.$price[$i].'" rel="'.$price[$i].'_'.$stock[$i].'_' . $data[$i] .'_' . $id[$i]. '">'. utf8_encode( "$p" ) .'</li>'."\n";
	    }
	    echo '</ul>';
	
    }

    

    
}
?>
