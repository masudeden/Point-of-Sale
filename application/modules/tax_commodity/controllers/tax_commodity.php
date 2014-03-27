<?php 
class Tax_commodity extends CI_Controller{
    function __construct() {
                parent::__construct();
                $this->load->library('posnic'); 
    }
    function index(){  
        $this->get_tax();
    }
       function get_tax(){
      
                $config["base_url"] = base_url()."index.php/tax_commodity/get_tax";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $data['trow']=$this->posnic->posnic_module('tax_types');
                $this->load->view('tax_commodity_list',$data);
           
        }
        function tax_com(){
            if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('add')){
                 if($_SESSION['Posnic_Add']==="Add"){
                     $data['row']=$this->posnic->posnic_module('tax_types');
                     $data['area']=$this->posnic->posnic_module('taxes_area');
                     $data['tax']=$this->posnic->posnic_module('taxes');
                     $data['tax_t']=$this->posnic->posnic_module('tax_types');
                     $this->load->view('add_new_tax_commodity',$data);
                 }else{
                     redirect('tax_commodity');
                 }
            }
            if($this->input->post('active')){
                $data=  $this->input->post('posnic');
                 if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
                    }
               }
               redirect('tax_commodity');
            }
            if($this->input->post('deactive')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
                }
                }
                redirect('tax_commodity');
            }
            if($this->input->post('delete')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_delete($guid);
                }
                }
                redirect('tax_commodity');
            }
        }
        function add_new_tax_commodity(){
            if($this->input->post('cancel')){
                redirect('tax_commodity');
            }
            if($this->input->post('save')){
                if($_SESSION['Posnic_Add']==="Add"){
                    $this->form_validation->set_rules('Code',$this->lang->line('tax'),'required');
                    $this->form_validation->set_rules('tax_value',$this->lang->line('tax'),'required');
                    $this->form_validation->set_rules('tax_area',$this->lang->line('tax_area'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('rate');
                                    $data=array('code'=>  $this->input->post('Code'),
                                        'tax'=>  $this->input->post('Code')
                                        );
                                 if($this->posnic->check_unique($data)){
                                        $value=array('schedule'=>  $this->input->post('Schedule'),
                                        'tax_area'=>  $this->input->post('tax_area'),
                                        'part'=>  $this->input->post('Part'),
                                        'code'=>  $this->input->post('Code'),
                                        'tax'=>  $this->input->post('Code'),
                                        'description'=>$this->input->post('Description'));
                                        $this->posnic->posnic_add($value);
                                        redirect('tax_commodity');
                                }else{
                                     echo "this tax commodity is already added";
                                        $data['row']=$this->posnic->posnic_module('tax_types');
                                        $data['area']=$this->posnic->posnic_module('taxes_area');
                                        $data['tax']=$this->posnic->posnic_module('taxes');
                                        $data['tax_t']=$this->posnic->posnic_module('tax_value');
                                        $this->load->view('add_new_tax_commodity',$data);
                                    }                                    
                          }
                         else{
                                        $data['row']=$this->posnic->posnic_module('tax_types');
                                        $data['area']=$this->posnic->posnic_module('taxes_area');
                                        $data['tax']=$this->posnic->posnic_module('taxes');
                                        $data['tax_t']=$this->posnic->posnic_module('tax_types');
                                        $this->load->view('add_new_tax_commodity',$data);
                            }
                 }else{
                     redirect('tax_commodity');
                 }
            }
        }
        function edit_tax($guid){
            if($_SESSION['Posnic_Edit']==="Edit"){
                 $where=array('guid'=>$guid);          
                 $data['row']=$this->posnic->posnic_module('tax_types');
                 $data['area']=$this->posnic->posnic_module('taxes_area');
                 $data['tax']=$this->posnic->posnic_module('taxes');
                 $data['tax_t']=$this->posnic->posnic_module('tax_types');
                 $data['c_row']=$this->posnic->posnic_result($where);
                 $this->load->view('edit_new_tax_commodity',$data);
            }else{
                redirect('tax_commodity');
            }
        }
        function update_tax_commodity(){
            if($this->input->post('cancel')){
                redirect('tax_commodity');
            }
            if($this->input->post('save')){
                 if($_SESSION['Posnic_Edit']==="Edit"){
                     $guid=  $this->input->post('guid');
                        $this->form_validation->set_rules('Code',$this->lang->line('tax'),'required');
                    $this->form_validation->set_rules('tax_value',$this->lang->line('tax'),'required');
                    $this->form_validation->set_rules('tax_area',$this->lang->line('tax_area'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('rate');
                                    $data=array('code'=>  $this->input->post('Code'),
                                        'tax'=>  $this->input->post('Code'),
                                        'guid !='=>$guid
                                        );
                                 if($this->posnic->check_unique($data)){
                                        $value=array('schedule'=>  $this->input->post('Schedule'),
                                        'tax_area'=>  $this->input->post('tax_area'),
                                        'part'=>  $this->input->post('Part'),
                                        'code'=>  $this->input->post('Code'),
                                        'tax'=>  $this->input->post('tax_value'),
                                        'description'=>$this->input->post('Description'));
                                        $where=array('guid'=>$guid);
                                        $this->posnic->posnic_update($value,$where);
                                        redirect('tax_commodity');
                                }else{
                                    echo "this area is already added";
                                    $this->edit_tax($guid);
                                    }                                    
                          }
                         else{
                                    $this->edit_tax($guid);
                            }
                 }else{
                     redirect('tax_commodity');
                 }
            }
        }
        function deactive_tax($guid){
              $this->posnic->posnic_deactive($guid);
              redirect('tax_commodity');         
        }
        function active_tax($guid){         
              $this->posnic->posnic_active($guid);
              redirect('tax_commodity');
        }
        function restore_tax($guid){
          if($this->session->userdata['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('tax_commodity');
          }else{
              redirect('tax_commodity');
          }
        }
        function admin_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              redirect('tax_commodity');
            }else{
             redirect('tax_commodity');
            }
        }
   
    
}
?>


