<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Items extends CI_Controller{
    function __construct() {
                parent::__construct();
                $this->load->library('posnic');    
               
    }
    function index(){     
            $this->get_items();
    }
    function get_items(){
                $config["base_url"] = base_url()."index.php/items/get_items";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();
                $this->load->view('item_list',$data);
    }
    function item_magement(){
       if($this->input->post('add')){
             if($_SESSION['Posnic_Add']==="Add"){
                    $data['brands']=$this->posnic->posnic_module('brands');
                    $data['taxes']=$this->posnic->posnic_module('taxes');
                    $data['area']=  $this->posnic->posnic_module('taxes_area');
                    $data['crow']=$this->posnic->posnic_module('items_category');
                    $data['srow']=$this->posnic->posnic_module('suppliers');                   
                    $this->load->view('add_item',$data);
            }
     }
            if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('active')){               
                        $data = $this->input->post('posnic'); 
                            if(!$data==''){        
                            foreach( $data as $key => $value){  
                                $this->posnic->posnic_active($value);
                            }
                            }
                 redirect('items');
            }
            if($this->input->post('deactive')){
                 $data = $this->input->post('posnic'); 
                            if(!$data==''){              
                            foreach( $data as $key => $value){  
                                $this->posnic->posnic_deactive($value);
                            }
                            }
                 redirect('items');
             
            }
            if($this->input->post('delete')){
                 $data = $this->input->post('posnic'); 
                            if(!$data==''){ 
                            foreach( $data as $key => $value){  
                                $this->posnic->posnic_delete($value);
                            }
                            }
                 redirect('items'); 
            }
    }
    function deactive_items($guid){
              $this->posnic->posnic_deactive($guid);
              redirect('items');
        }
        function active_items($guid){         
              $this->posnic->posnic_active($guid);
              redirect('items');
        }
    function restore_items($guid){
         if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              $this->load->model('core_model');
              $this->core_model->restore_item_setting($guid,$_SESSION['Bid']);
              redirect('items');
          }else{
              redirect('items');
          }
    }
    function delete($guid){
        if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              $this->load->model('core_model');
              $this->core_model->delete_item_setting($guid,$_SESSION['Bid']);
                redirect('items');
            }else{
                redirect('items');
            }
    }       
    function add_new_item(){
        
        if($this->input->post('cancel')){
            redirect('items');
        }
        if($this->input->post('save')){
              if($_SESSION['Posnic_Add']==="Add"){
                  $this->form_validation->set_rules("code",$this->lang->line('code'),"required");
                            $this->form_validation->set_rules("item_name",$this->lang->line('item_name'),"required");
                            $this->form_validation->set_rules("cost_price",$this->lang->line('cost_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');                           
                            $this->form_validation->set_rules('discount_amount', $this->lang->line('discount_amount'),'max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('tax', $this->lang->line('tax'),'required');
                            $this->form_validation->set_rules('area', $this->lang->line('tax_area'),'required');
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('mrf_price', $this->lang->line('mrf_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('landing_cost', $this->lang->line('landing_cost'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                          if ( $this->form_validation->run() !== false ) {
                                   $data=array('code'=>$this->input->post('code'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('item_name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost_price'),
                                    'selling_price'=>$this->input->post('selling_price'),
                                    'landing_cost'=>$this->input->post('landing_cost'),
                                    'mrf'=>$this->input->post('mrf_price'),
                                    'discount_amount'=>$this->input->post('discount_amount'),
                                    'start_date'=>strtotime($this->input->post('start_date')),
                                    'end_date'=>strtotime($this->input->post('end_date')),
                                    'tax_Inclusive'=>$this->input->post('tax_in'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('tax'),
                                    'tax_area_id'=>$this->input->post('area'),
                                    'brand_id'=>$this->input->post('brand'));
                                      $value=array('code'=>$this->input->post('code'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('item_name'),
                                         );
                                 if($this->posnic->check_unique($value)){                                    
                                     $id=$this->posnic->posnic_add($data);
                                     $this->load->model('core_model');
                                     $this->core_model->item_setting($id,$_SESSION['Bid']);
                                     $this->get_items();
                                     }else{
                                        echo " this item is  already added in this branch";
                                        $data['brands']=$this->posnic->posnic_module('brands');
                                        $data['taxes']=$this->posnic->posnic_module('taxes');
                                        $data['area']=  $this->posnic->posnic_module('taxes_area');
                                        $data['crow']=$this->posnic->posnic_module('items_category');
                                        $data['srow']=$this->posnic->posnic_module('suppliers');                   
                                        $this->load->view('add_item',$data);
                                    }
                        }else{
                            $data['brands']=$this->posnic->posnic_module('brands');
                            $data['taxes']=$this->posnic->posnic_module('taxes');
                            $data['area']=  $this->posnic->posnic_module('taxes_area');
                            $data['crow']=$this->posnic->posnic_module('items_category');
                            $data['srow']=$this->posnic->posnic_module('suppliers');                   
                            $this->load->view('add_item',$data);
                        }
        
             } 
        }
    
    }
    
  
    function edit_items($guid){
        if($_SESSION['Posnic_Edit']==="Edit"){
             $where=array('guid'=>$guid);
                    $data['irow']=$this->posnic->posnic_result($where);
                    $data['brands']=$this->posnic->posnic_module('brands');
                    $data['taxes']= $this->posnic->posnic_module('taxes');
                    $data['area']= $this->posnic->posnic_module('taxes_area');
                    $data['crow']=$this->posnic->posnic_module('items_category');
                    $data['srow']=$this->posnic->posnic_module('suppliers');
                    $this->load->view('edit_item',$data);
        }
    }
    function update_item(){
        if($this->input->post('cancel')){
                redirect('items');
            }
        if($_SESSION['Posnic_Edit']==="Edit"){
             $guid=$this->input->post('guid');
                           $this->form_validation->set_rules("item_name",$this->lang->line('item_name'),"required");
                            $this->form_validation->set_rules("cost_price",$this->lang->line('cost_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');                           
                            $this->form_validation->set_rules('discount_amount', $this->lang->line('discount_amount'),'max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                            $this->form_validation->set_rules('tax', $this->lang->line('tax'),'required');
                            $this->form_validation->set_rules('area', $this->lang->line('tax_area'),'required');
                            $this->form_validation->set_rules('selling_price', $this->lang->line('selling_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('mrf_price', $this->lang->line('mrf_price'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                            $this->form_validation->set_rules('landing_cost', $this->lang->line('landing_cost'),'required|max_length[15]|regex_match[/^[0-9 .]+$/]|xss_clean');
                           
                        if ( $this->form_validation->run() !== false ) {
                                     $data=array('code'=>$this->input->post('code'),
                                    'barcode'=>$this->input->post('barcode'),
                                    'name'=>$this->input->post('item_name'),
                                    'description'=>$this->input->post('description'),
                                    'cost_price'=>$this->input->post('cost_price'),
                                    'selling_price'=>$this->input->post('selling_price'),
                                    'landing_cost'=>$this->input->post('landing_cost'),
                                    'mrf'=>$this->input->post('mrf_price'),
                                    'discount_amount'=>$this->input->post('discount_amount'),
                                    'start_date'=>strtotime($this->input->post('start_date')),
                                    'end_date'=>strtotime($this->input->post('end_date')),
                                    'tax_Inclusive'=>$this->input->post('tax_in'),
                                    'location'=>$this->input->post('location'),
                                    'category_id'=>$this->input->post('category'),
                                    'supplier_id'=>$this->input->post('supplier'),
                                    'tax_id'=>$this->input->post('tax'),
                                    'tax_area_id'=>$this->input->post('area'),
                                    'brand_id'=>$this->input->post('brand'));
                                    
                                    $value=array('guid !='=>$this->input->post('guid'),'code'=>$this->input->post('code'),
                                         'barcode'=>$this->input->post('barcode'),
                                          'name'=>$this->input->post('item_name'),
                                         );
                                 if($this->posnic->check_unique($value)){ 
                                      $where=array('guid'=>$guid);
                                      $this->posnic->posnic_update($data,$where);
                                      redirect('items');
                                 }else{
                                     
                                        echo " this item is  already added in this branch";
                                        $this->edit_items($guid);
                                    }            
               
            
                        }else{
                            $this->edit_items($guid);
                        }
        }
    }
   
    
}
?>
