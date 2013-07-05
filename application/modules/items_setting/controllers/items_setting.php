<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items_setting extends CI_Controller{
    function __construct() {
                parent::__construct();
               $this->load->library('posnic');   
    }
    function index(){     
         if(!isset($_SESSION['Uid'])){
                redirect('home');
        }else{
            $this->get_setting();
        }
    }
    function get_setting(){
                $config["base_url"] = base_url()."index.php/items_setting/get_settings";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["srow"] = $this->posnic->posnic_limit_result($config["per_page"], $page);
                $data['row']=$this->posnic->posnic_module('items');
	        $data["links"] = $this->pagination->create_links();
                $this->load->view('item_list',$data);
    }   
    function edit_item($guid){
                $where=array('guid'=>$guid);
                $data['row']=$this->posnic->posnic_module_result($where,'items');
                $this->load->view('edit_setting',$data);
        
    }
    function set_item($guid){
        $data['guid']=$guid;
        $this->load->view('set_item',$data);
    }
    function reset_item($guid){
        $where=array('guid'=>$guid);
        $data['row']=$this->posnic->posnic_result($where);
        $this->load->view('edit_setting',$data);
    }
    function set(){
        if($this->input->post('cancel')){
            $this->get_setting();
        }
        if($this->input->post('save')){
        if($_SESSION['Posnic_Add']==="Add"){
            $guid=$this->input->post('guid');
               $this->form_validation->set_rules("min_qty",$this->lang->line('min_qty'),'required|max_length[15]|regex_match[/^[0-9]+$/]|xss_clean');                                             
               $this->form_validation->set_rules("max_qty",$this->lang->line('max_qty'),'required|max_length[15]|regex_match[/^[0-9]+$/]|xss_clean');                           
             if ($this->form_validation->run() !== false ) {  
                 $data=array(
                    'set'=>1,
                    'sales'=>$this->input->post('sale')?1:0,
                    'salses_return'=>$this->input->post('salses_return')?1:0,
                    'purchase'=>$this->input->post('purchase')?1:0,
                    'purchase_return'=>$this->input->post('purchase_return')?1:0,
                    'allow_negative'=>$this->input->post('allow_negative')?1:0,
                    'tax_inclusive'=>$this->input->post('tax'),
                    'min_q'=>$this->input->post('min_qty'),
                    'max_q'=>$this->input->post('max_qty'));
                    $where=array('guid'=>$guid);
                    $this->posnic->posnic_update($data,$where);
                    redirect('items_setting'); 
            }else{
                $this->set_item($guid);
            }
        }else{
            redirect('items_setting');
        }   
        }
    }
      
    function items_details(){
       
        
             if($this->input->post('cancel')){
                redirect('home');
            }
             if($this->input->post('edit')){
                  $data['row'] = $this->input->post('posnic'); 
                            if(!$data['row']==''){   
                            
                            $this->load->view('bulk_edit_setting',$data);
                            
                            }else{
                                redirect('items_setting');
                            }
             }
        
        
    }
    function bult_update(){        
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}
        else{
            if($this->input->post('cancel')){
                redirect('items_setting');
            }
            if($this->input->post('save')){
             $data=$this->input->post('guid');
              $this->load->library('form_validation');
               $this->form_validation->set_rules("min_qty",$this->lang->line('min_qty'),'required|max_length[15]|regex_match[/^[0-9]+$/]|xss_clean');                                             
               $this->form_validation->set_rules("max_qty",$this->lang->line('max_qty'),'required|max_length[15]|regex_match[/^[0-9]+$/]|xss_clean');                           
            if ($this->form_validation->run() !== false ) {       
                     $data1=array(
                    'set'=>1,
                    'sales'=>$this->input->post('sale')?1:0,
                    'salses_return'=>$this->input->post('salses_return')?1:0,
                    'purchase'=>$this->input->post('purchase')?1:0,
                    'purchase_return'=>$this->input->post('purchase_return')?1:0,
                    'allow_negative'=>$this->input->post('allow_negative')?1:0,
                    'tax_inclusive'=>$this->input->post('tax'),
                    'min_q'=>$this->input->post('min_qty'),
                    'max_q'=>$this->input->post('max_qty'));
                     foreach( $data as $key => $value){ 
                         $where=array('guid'=>$value);
                         $this->posnic->posnic_update($data1,$where);
                       } 
                redirect('items_setting'); 
            }else{
                           
                            $this->load->view('bulk_edit_setting',$data);
                            
            }
            }
        }
    }
}
?>
