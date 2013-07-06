<?php 
class Tax_types extends CI_Controller{
     
        function __construct() {
                parent::__construct();
                $this->load->library('posnic'); 
    }
    function index(){  
        $this->get_tax();
    }
       function get_tax(){
      
                $config["base_url"] = base_url()."index.php/tax_types/get_tax";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $this->load->view('tax_type_list',$data);
           
        }
        function tax_type(){
            if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('add')){
                 if($_SESSION['Posnic_Add']==="Add"){
                     $this->load->view('add_tax_types');
                 }else{
                     redirect('tax_types');
                 }
            }
            if($this->input->post('active')){
                $data=  $this->input->post('posnic');
                 if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
                    }
               }
               redirect('tax_types');
            }
            if($this->input->post('deactive')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
                }
                }
                redirect('tax_types');
            }
            if($this->input->post('delete')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_delete($guid);
                }
                }
                redirect('tax_types');
            }
        }
        function add_new_tax_type(){
            if($this->input->post('cancel')){
                redirect('tax_types');
            }
            if($this->input->post('save')){
                if($_SESSION['Posnic_Add']==="Add"){
                    $this->form_validation->set_rules('name',$this->lang->line('tax_type'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('name');
                                    $data=array('type'=>$type);
                                 if($this->posnic->check_unique($data)){
                                        $value=array('type'=>$type);
                                        $this->posnic->posnic_add($value);
                                        redirect('tax_types');
                                }else{
                                    echo "this area is already added";
                                     $this->load->view('add_tax_types');
                                    }                                    
                          }
                         else{
                           $this->load->view('add_tax_types');
                            }
                 }else{
                     redirect('tax_types');
                 }
            }
        }
        function edit_tax_type($guid){
            if($_SESSION['Posnic_Edit']==="Edit"){
                 $where=array('guid'=>$guid);          
                 $data['row']=$this->posnic->posnic_result($where);
                 $this->load->view('edit_tax_types',$data);
            }else{
                redirect('tax_types');
            }
        }
        function update_tax_type(){
            if($this->input->post('cancel')){
                redirect('tax_types');
            }
            if($this->input->post('save')){
                 if($_SESSION['Posnic_Edit']==="Edit"){
                     $guid=  $this->input->post('guid');
                       $this->form_validation->set_rules('name',$this->lang->line('tax_types'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('name');                                
                                    $data=array('type'=>$type,'guid !='=>$guid);
                                 if($this->posnic->check_unique($data)){
                                        $value=array('type'=>$type);
                                        $where=array('guid'=>$guid);
                                        $this->posnic->posnic_update($value,$where);
                                        redirect('tax_types');
                                }else{
                                    echo "this area is already added";
                                    $this->edit_tax_area($guid);
                                    }                                    
                          }
                         else{
                                    $this->edit_tax_area($guid);
                            }
                 }else{
                     redirect('tax_type');
                 }
            }
        }
        function deactive_tax_type($guid){
              $this->posnic->posnic_deactive($guid);
              redirect('tax_types');         
        }
        function active_tax_type($guid){         
              $this->posnic->posnic_active($guid);
              redirect('tax_types');
        }
        function restore_tax_type($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('tax_types');
          }else{
              redirect('tax_types');
          }
        }
        function admin_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              redirect('tax_types');
            }else{
             redirect('tax_types');
            }
        }
   
    
}
?>

