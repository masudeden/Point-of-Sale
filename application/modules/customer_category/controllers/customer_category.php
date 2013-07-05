<?php
class Customer_category extends CI_Controller{ 
    function __construct() {
                parent::__construct();
                $this->load->library('posnic');  
    }
    function index(){     
         if(!isset($_SESSION['Uid'])){
                redirect('home');
        }else{
            $this->get_category();
        }
    }
    function get_category(){               
	        $config["base_url"] = base_url()."index.php/customer_category/get_category";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();  
                $this->load->view('category_list',$data);
    }
    function edit_category($guid){
          $where=array('guid'=>$guid);
           if($_SESSION['Posnic_Edit']==="Edit"){
              $data['row']=$this->posnic->posnic_result($where);
              $this->load->view('edit_category',$data);
          }else{
              redirect('customer_category');
          } 
               
    }
    function update_customer(){
            if($this->input->post('save')){
                if($_SESSION['Posnic_Edit']==="Edit"){
             $this->load->library('form_validation');
             $guid=  $this->input->post('guid');
                $this->form_validation->set_rules("name",$this->lang->line('cate_name'),'required'); 
                  if ( $this->form_validation->run() !== false ) {
			  
                         $area=$this->input->post('name');
                         $data=array('guid !='=>$guid,'category_name'=>$area);
                        if($this->posnic->check_unique($data)){
                            $value=array('category_name'=>$area);
                            $where=array('guid'=>$guid);
                            $this->posnic->posnic_update($value,$where);
                            redirect('customer_category');
                          }else{                             
                          
                           echo "this tax arae is already added in this branch";
                           $this->edit_category($id);
                  
            }
            }else{
                $this->edit_category($id);
            }
            }
            }
            if($this->input->post('cancel')){
                 redirect('customer_category');
     
            }   
    }
    
    function active_tax_area($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('customer_category'); }else{
         $this->load->model('customer_category_model');
         $this->customer_category_model->activate_tax_area($id);
         redirect('customer_category/tax_area');
        }
    }
   function inactive_tax_area($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('customer_category'); }else{
         $this->load->model('customer_category_model');
         $this->customer_category_model->inactivate_tax_area($id);
         redirect('customer_category/tax_area');
         }
    }
    function manage_customer(){
         if($this->input->post('delete')){
           if($_SESSION['Posnic_Delete']==="Delete"){                
                $data1 = $this->input->post('posnic'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                 $this->posnic->posnic_delete($value);
                 
                 }
          }
           }
        redirect('customer_category');
        }
         if($this->input->post('active')){
            $this->load->model('customer_category_model');                 
                $data1 = $this->input->post('posnic'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->posnic->posnic_active($value);
               }
          }
        redirect('customer_category');
        }
         if($this->input->post('deactive')){
            $this->load->model('customer_category_model');                 
                $data1 = $this->input->post('posnic'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                 $this->posnic->posnic_deactive($value);
               }
          }
        redirect('customer_category');
        }
        if($this->input->post('add')){
                if($_SESSION['Posnic_Add']==="Add"){
                $this->load->view('add_customer_category');
                }else{
                    redirect('Customer_category');
                }
        }
        if($this->input->post('cancel')){
              redirect('home');
        }
      }
    function admin_delete($guid){
          if($_SESSION['Posnic_Delete']==="Delete"){
              $this->posnic->posnic_delete($guid);
              redirect('customer_category');
               }
            else{
                echo "you have no Permissions to add  new record";
                redirect('customer_category');
            }  
        }
     function restore_category($guid){
         if($_SESSION['Posnic_User']=='admin'){
              $this->posnic->posnic_restore($guid);
               redirect('customer_category');
          }else{
               redirect('customer_category');
          }
     }
     function active_category($guid){
               $this->posnic->posnic_active($guid);
               redirect('customer_category');
     }
     function deactive_category($guid){
         $this->posnic->posnic_deactive($guid);
         redirect('customer_category');
     }
             
     function add_category(){
             if($this->input->post('cancel')){
                 redirect('customer_category');
             }if($this->input->post('save')){
             if($_SESSION['Posnic_Add']==="Add"){
                  $this->load->library('form_validation');
                            $this->form_validation->set_rules("name",$this->lang->line('name'),"required"); 
                                                        	  
                        if ( $this->form_validation->run() !== false ) {
                                    $area=$this->input->post('name');
                                    $data=array('category_name'=>$area);
                                    if($this->posnic->check_unique($data)){
                                       $value=array('category_name'=>$area);
                                       $this->posnic->posnic_add($value);
                                       redirect('customer_category');
                                    }else{
                                       echo "this category is already added";                                        
                                       $this->load->view('add_customer_category');
                                    }
                        }else{
                                $this->load->view('add_customer_category');
                        }
             }
             }
    }
    
}
?>
