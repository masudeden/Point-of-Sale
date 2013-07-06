<?php
class Item_code extends CI_Controller{
    function __construct() {
    parent::__construct();
               $this->load->library('posnic');  
    }
    function index(){     
              $this->get_items();
    }
    function get_items(){
                $config["base_url"] = base_url()."index.php/item_code/get_items";
	        $config["total_rows"] =$this->posnic->posnic_module_count('items'); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_module_count('items');                 
	        $data["row"] = $this->posnic->posnic_module_limit_result('items',$config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links(); 
                $this->load->view('code_list',$data);
    }
    function set_item($guid){
         if($_SESSION['Posnic_Add']==="Add"){
             $data['row']=$guid;
             $this->load->view('add_code',$data);
         }
         else{
             redirect('item_code');
         }
    }
    function reset_item($guid){
         if($_SESSION['Posnic_Edit']==="Edit"){
             $data['guid']=$guid;
             $data['row']=  $this->posnic->posnic_module('items');
             $this->load->view('edit_code',$data);
         }
         else{
             redirect('item_code');
         }
    }
    function items_details(){
             if($this->input->post('cancel')){
                redirect('home');
            }
    }
   
    function add_code(){
             if($this->input->post('save')){  
                   if($_SESSION['Posnic_Add']==="Add"){
               $guid=  $this->input->post('guid');
               $this->form_validation->set_rules("code",$this->lang->line('code'),'required');                                             
              if ($this->form_validation->run() !== false ) {  
                  $value=array('upc_ean_code'=>  $this->input->post('code'));
                     $where=array('guid'=>$guid);
                     $this->posnic->posnic_module_update('items',$value,$where);
                     redirect('item_code');
                    
              }else{
                  $this->set_item($guid);
              }
                }else{
                    redirect('item_code');
                }
             }if($this->input->post('cancel')){
             redirect('item_code');
         }
    }
    function edit_item($id){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
    $this->load->model('item_setting');
    $data['row']=  $this->item_setting->get_item_details($id);
    $data['set']=  $this->item_setting->get_item_details_for_edit($id);
                $this->load->view('template/header');
                $this->load->view('item_code/edit_code',$data);
                $this->load->view('template/footer');
          }
    }
    function update_code(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
            if($this->input->post('cancel')){
                redirect('item_code');
            }
            if($this->input->post('save')){
                 $this->load->library('form_validation');
               $id=  $this->input->post('id');
               $this->load->model('item_setting');
               $this->form_validation->set_rules("code",$this->lang->line('code'),'required');                                             
              if ($this->form_validation->run() !== false ) {       
                    $code=$this->input->post('code');
                    if($this->item_setting->check_code_for_update($code,$id,$_SESSION['Bid'])){
                        $this->item_setting->update_code_for_item($code,$id,$_SESSION['Bid']);
                        redirect('item_code');
                    }else{
                        echo "this code is alreay added for one item";
                        $this->edit_item($id);
                    }
                    
              }else{
                  $this->edit_item($id);
              }
            }
        }
    }
}
?>
