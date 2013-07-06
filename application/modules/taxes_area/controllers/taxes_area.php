<?php 
class Taxes_area extends CI_Controller{
     
        function __construct() {
                parent::__construct();
                $this->load->library('posnic'); 
    }
    function index(){  
        $this->get_tax();
    }
       function get_tax(){
      
                $config["base_url"] = base_url()."index.php/taxes_area/get_tax";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $this->load->view('tax_area_list',$data);
           
        }
        function tax_area(){
            if($this->input->post('cancel')){
                redirect('home');
            }
            if($this->input->post('add')){
                 if($_SESSION['Posnic_Add']==="Add"){
                     $this->load->view('add_new_tax_area');
                 }else{
                     redirect('taxes_area');
                 }
            }
            if($this->input->post('active')){
                $data=  $this->input->post('posnic');
                 if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_active($guid);
                    }
               }
               redirect('taxes_area');
            }
            if($this->input->post('deactive')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_deactive($guid);
                }
                }
                redirect('taxes_area');
            }
            if($this->input->post('delete')){
                $data=  $this->input->post('posnic');
                if($data!=""){
                    foreach( $data as $key => $guid){  
                          $this->posnic->posnic_delete($guid);
                }
                }
                redirect('taxes_area');
            }
        }
        function add_new_tax_area(){
            if($this->input->post('cancel')){
                redirect('taxes_area');
            }
            if($this->input->post('save')){
                if($_SESSION['Posnic_Add']==="Add"){
                    $this->form_validation->set_rules('tax_area',$this->lang->line('tax_area'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('tax_area');
                                    $data=array('name'=>$type);
                                 if($this->posnic->check_unique($data)){
                                        $value=array('name'=>$type);
                                        $this->posnic->posnic_add($value);
                                        redirect('taxes_area');
                                }else{
                                    echo "this area is already added";
                                     $this->load->view('add_new_tax_area');
                                    }                                    
                          }
                         else{
                           $this->load->view('add_new_tax_area');
                            }
                 }else{
                     redirect('taxes_area');
                 }
            }
        }
        function edit_tax_area($guid){
            if($_SESSION['Posnic_Edit']==="Edit"){
                 $where=array('guid'=>$guid);          
                 $data['row']=$this->posnic->posnic_result($where);
                 $this->load->view('edit_tax_area',$data);
            }else{
                redirect('taxes_area');
            }
        }
        function update_tax_area(){
            if($this->input->post('cancel')){
                redirect('taxes_area');
            }
            if($this->input->post('save')){
                 if($_SESSION['Posnic_Edit']==="Edit"){
                     $guid=  $this->input->post('guid');
                       $this->form_validation->set_rules('tax_area',$this->lang->line('tax_area'),'required');
                          if ( $this->form_validation->run() !== false ) {
                                $type=  $this->input->post('tax_area');
                                
                                    $data=array('name'=>$type,'guid !='=>$guid);
                                 if($this->posnic->check_unique($data)){
                                        $value=array('name'=>$type);
                                        $where=array('guid'=>$guid);
                                        $this->posnic->posnic_update($value,$where);
                                        redirect('taxes_area');
                                }else{
                                    echo "this area is already added";
                                    $this->edit_tax_area($guid);
                                    }                                    
                          }
                         else{
                                    $this->edit_tax_area($guid);
                            }
                 }else{
                     redirect('taxes_area');
                 }
            }
        }
        function deactive_tax_area($guid){
              $this->posnic->posnic_deactive($guid);
              redirect('taxes_area');         
        }
        function active_tax_area($guid){         
              $this->posnic->posnic_active($guid);
              redirect('taxes_area');
        }
        function restore_tax_area($guid){
          if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
              redirect('taxes_area');
          }else{
              redirect('taxes_area');
          }
        }
        function admin_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              redirect('taxes_area');
            }else{
             redirect('taxes_area');
            }
        }
   
    
}
?>

