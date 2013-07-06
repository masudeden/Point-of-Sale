<?php 
class Taxes extends CI_Controller{
     
        function __construct() {
                parent::__construct();
                $this->load->library('posnic'); 
    }
    function index(){  
        $this->get_tax();
    }
       function get_tax(){
      
                $config["base_url"] = base_url()."index.php/taxes/get_tax";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $data['trow']=$this->posnic->posnic_module('tax_types');
                $this->load->view('taxes_list',$data);
           
        }
        function item_tax(){
            if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('add')){
                 if($_SESSION['Posnic_Add']==="Add"){
                     $data['row']=$this->posnic->posnic_module('tax_types');
                     $this->load->view('add_new',$data);
                 }else{
                     redirect('taxes');
                 }
            }
            if($this->input->post('active')){
                $data=  $this->input->post('posnic');
                 if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
                    }
               }
               redirect('taxes');
            }
            if($this->input->post('deactive')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
                }
                }
                redirect('taxes');
            }
            if($this->input->post('delete')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_delete($guid);
                }
                }
                redirect('taxes');
            }
        }
        function add_new_tax(){
            if($this->input->post('cancel')){
                redirect('taxes');
            }
            if($this->input->post('save')){
                if($_SESSION['Posnic_Add']==="Add"){
                    $this->form_validation->set_rules('rate',$this->lang->line('tax'),'required');
                    $this->form_validation->set_rules('type',$this->lang->line('tax_type'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('rate');
                                    $data=array('value'=>$type,'type'=>$this->input->post('type'));
                                 if($this->posnic->check_unique($data)){
                                        $value=array('value'=>$type,'type'=>$this->input->post('type'));
                                        $this->posnic->posnic_add($value);
                                        redirect('taxes');
                                }else{
                                     echo "this area is already added";
                                     $data['row']=$this->posnic->posnic_module('tax_types');
                                     $this->load->view('add_new',$data);
                                    }                                    
                          }
                         else{
                           $data['row']=$this->posnic->posnic_module('tax_types');
                           $this->load->view('add_new',$data);
                            }
                 }else{
                     redirect('taxes');
                 }
            }
        }
        function edit_taxes($guid){
            if($_SESSION['Posnic_Edit']==="Edit"){
                 $where=array('guid'=>$guid);          
                 $data['row']=$this->posnic->posnic_module('tax_types');
                 $data['trow']=$this->posnic->posnic_result($where);
                 $this->load->view('edit_tax',$data);
            }else{
                redirect('taxes');
            }
        }
        function update_tax(){
            if($this->input->post('cancel')){
                redirect('taxes');
            }
            if($this->input->post('save')){
                 if($_SESSION['Posnic_Edit']==="Edit"){
                     $guid=  $this->input->post('guid');
                       $this->form_validation->set_rules('rate',$this->lang->line('tax'),'required');
                       $this->form_validation->set_rules('type',$this->lang->line('tax_type'),'required');
                       if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('rate');
                                
                                    $data=array('value'=>$type,'type'=>  $this->input->post('type'),'guid !='=>$guid);
                                 if($this->posnic->check_unique($data)){
                                        $value=array('value'=>$type,'type'=>$this->input->post('type'));
                                        $where=array('guid'=>$guid);
                                        $this->posnic->posnic_update($value,$where);
                                        redirect('taxes');
                                }else{
                                    echo "this area is already added";
                                    $this->edit_tax_area($guid);
                                    }                                    
                          }
                         else{
                                    $this->edit_tax_area($guid);
                            }
                 }else{
                     redirect('taxes');
                 }
            }
        }
        function deactive_taxes($guid){
              $this->posnic->posnic_deactive($guid);
              redirect('taxes');         
        }
        function active_taxes($guid){         
              $this->posnic->posnic_active($guid);
              redirect('taxes');
        }
        function restore_taxes($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('taxes');
          }else{
              redirect('taxes');
          }
        }
        function admin_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              redirect('taxes');
            }else{
             redirect('taxes');
            }
        }
   
    
}
?>

