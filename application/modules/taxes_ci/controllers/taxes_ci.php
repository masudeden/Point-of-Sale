<?php 
class Taxes_ci extends CI_Controller{
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
          if(!isset($_SESSION['Uid'])){
                redirect('home');
                }
    }
    function get_taxs(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
                $this->load->view('template/header');
                $this->load->view('tax/taxes');
                $this->load->view('template/footer');
        }
          
    }
    function taxes(){
       if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
           
               $this->taxes_details();
           
          
       }
          
    }
    function get_tax_types(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('taxes');                
	        $config["base_url"] = base_url()."index.php/taxes_ci/get_tax_types";
	        $config["total_rows"] = $this->taxes->get_tax_type_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->taxes->get_tax_type_count_for_admin($_SESSION['Bid']);                 
	        $data["row"] = $this->taxes->get_tax_type_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();               
                $this->load->view('template/header');
                $this->load->view('tax/tax_type_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination");                 
                $this->load->model('taxes');
	        $config["base_url"] = base_url()."index.php/taxes_ci/get_tax_types";
                $config["total_rows"] = $this->taxes->get_tax_type_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;                
                $data['count']=$this->taxes->get_tax_type_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->taxes->get_tax_type_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links(); 
                $this->load->view('template/header');
                $this->load->view('tax/tax_type_list',$data);
                $this->load->view('template/footer');
            }                      
       }
    }
    function manage_tax_types(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
             if($this->input->post('cancel')){
                 redirect('home');
             }
             if($this->input->post('delete_ad')){
                 $this->load->model('taxes');                
                 $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_type_for_admin($value,$_SESSION['Uid']);
             }
             }   redirect('taxes_ci/get_tax_types');          
         }
         if($this->input->post('add_tax')){
                $this->load->view('template/header');
                $this->load->view('tax/add_tax_types');
                $this->load->view('template/footer');   
         }
         if($this->input->post('delete')){
                 $this->load->model('taxes');                    
                 $data1 = $this->input->post('mycheck'); 
                 if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_type_for_user($value,$_SESSION['Bid']);
         }
                 }redirect('taxes_ci/get_tax_types'); 
         }
         }
    }
    function edit_tax_type($id){
          if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            $this->load->model('taxes');
            $data['row']=  $this->taxes->get_tax_types_for_edit($id);
                $this->load->view('template/header');
                $this->load->view('tax/edit_tax_types',$data);
                $this->load->view('template/footer');     
          }
    }
    function update_tax_type(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
             if($this->input->post('cancel')){
                 redirect('taxes_ci/get_tax_types');
             }
             if($this->input->post('save')){
                $this->load->library('form_validation');
                $this->form_validation->set_rules("name",$this->lang->line('tax_type'),'required'); 
                $id=  $this->input->post('id');
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');                          
                          $name=$this->input->post('name');
                          if($this->taxes->check_unique_tax_types($name,$_SESSION['Bid'],$id)){
                              $this->taxes->update_tax_type($id,$name);
                              redirect('taxes_ci/get_tax_types');                          
                          }else{
                              echo "this is tax type is already added in this branch";
                              $this->edit_tax_type($id);
                          }                          
                  }else{
                      $this->edit_tax_type($id);
                      
                  }
             }
         }
    }
    function delete_tax_type_for($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            $this->load->model('taxes');
            $this->taxes->delete_tax_type_for_admin($id,$_SESSION['Uid']);
            redirect('taxes_ci/get_tax_types');  
         }
    }
    function inactive_tax_types($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            $this->load->model('taxes');
            $this->taxes->inactivate_tx_type($id);
            redirect('taxes_ci/get_tax_types');  
         }
    }
    function active_tax_types($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            $this->load->model('taxes');
            $this->taxes->activate_tx_type($id);
            redirect('taxes_ci/get_tax_types');  
         }
    }
    function add_new_tax_type(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
             if($this->input->post('save')){
          $this->load->library('form_validation');
                $this->form_validation->set_rules("name",$this->lang->line('tax_type'),'required'); 
               
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');                          
                          $name=$this->input->post('name');
                          if($this->taxes->check_unique_tax_types_for_add($name,$_SESSION['Bid'])){
                              $this->taxes->add_new_tax_type($name,$_SESSION['Bid']);
                              redirect('taxes_ci/get_tax_types');                          
                          }else{
                              echo "this is tax type is already added in this branch";
                              $this->load->view('template/header');
                              $this->load->view('tax/add_tax_types');
                              $this->load->view('template/footer');  
                          }                          
                  }else{
                     $this->load->view('template/header');
                     $this->load->view('tax/add_tax_types');
                     $this->load->view('template/footer');  
                      
                  }   
    }else{
          redirect('taxes_ci/get_tax_types');
    }
         }
                  
        
    
    }
    function delete_tax_type($id){
          if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{             
            $this->load->model('taxes');
            $this->taxes->delete_tax_type_for_user($id,$_SESSION['Uid']);
            redirect('taxes_ci/get_tax_types'); 
            
          }
    }




    // commmodity functions
    function get_tax_commodity(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('taxes');                
	        $config["base_url"] = base_url()."index.php/taxes_ci/get_tax_commodity";
	        $config["total_rows"] = $this->taxes->get_tax_commodity_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->taxes->get_tax_commodity_count_for_admin($_SESSION['Bid']); 
                $data['area']=  $this->taxes->get_tax_area_for_commodity($_SESSION['Bid']);
	        $data["row"] = $this->taxes->get_tax_commodity_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();  
                $data['tax']=  $this->taxes->get_tax_for_commodity($_SESSION['Bid']);
                $this->load->view('template/header');
                $this->load->view('tax/tax_commodity_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination");                 
                $this->load->model('taxes');
	        $config["base_url"] = base_url()."index.php/taxes_ci/get_tax_commodity";
                $config["total_rows"] = $this->taxes->get_tax_commodity_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0; 
                $data['area']=  $this->taxes->get_tax_area_for_commodity($_SESSION['Bid']);;
                $data['count']=$this->taxes->get_tax_commodity_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->taxes->get_tax_commodity_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links(); 
                $data['tax']=  $this->taxes->get_tax_for_commodity($_SESSION['Bid']);
                $this->load->view('template/header');
                $this->load->view('tax/tax_commodity_list',$data);
                $this->load->view('template/footer');
            }                      
       }
    }
    function manage_tax_commodity(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
         if($this->input->post('delete_ad')){
            $this->load->model('taxes');        
                $data['row']=  $this->taxes->delete_tax($id);
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_commoodity_for_admin($value,$_SESSION['Uid']);
               }
          }
        redirect('taxes_ci/get_tax_commodity');
        }
        if($this->input->post('add_tax')){
            $this->load->model('taxes');
            $data['tax']=  $this->taxes->get_tax_for_commodity($_SESSION['Bid']);
            $data['area']=  $this->taxes->get_tax_area_for_commodity($_SESSION['Bid']);
                $this->load->view('template/header');
                $this->load->view('tax/add_new_tax_commodity',$data);
                $this->load->view('template/footer');
        }
        if($this->input->post('cancel')){
              redirect('home');
        }
        if($this->input->post('delete')){
            $this->load->model('taxes');                   
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_commoodity_for_user($value,$_SESSION['Uid']);
               }
            
        }redirect('taxes_ci/get_tax_commodity');
         }
        
         }
    }
    function add_new_tax_commodity(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('save')){
             $this->load->library('form_validation');
                $this->form_validation->set_rules("Code",$this->lang->line('tCode'),'required'); 
                $this->form_validation->set_rules("Description",$this->lang->line('tdescription'),'required');
                $this->form_validation->set_rules("Schedule",$this->lang->line('tschedule'),'required');
                $this->form_validation->set_rules("Part",$this->lang->line('tpart'),'required');
                $this->form_validation->set_rules("tax_area",$this->lang->line('tax_area'),'required');
                $this->form_validation->set_rules("tax_value",$this->lang->line('tax'),'required');
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');
                          
                          $dis=$this->input->post('Description');
                          $schue=$this->input->post('Schedule');
                          $part=$this->input->post('Part');
                          $code=$this->input->post('Code');
                          $taxare=$this->input->post('tax_area');
                          $tax=$this->input->post('tax_value');
                          
                         
                          if($this->taxes->check_tax_commodity_is_unique($code,$_SESSION['Bid']))
                          {
                           $this->taxes->save_new_tax_commodity($code,$schue,$part,$tax,$taxare,$dis,$_SESSION['Uid'],$_SESSION['Bid']);
                           redirect('taxes_ci/get_tax_commodity');
                          }else{
                                echo "this tax  area is already added";
                                
                                    $this->load->model('taxes');
                                    $data['tax']=  $this->taxes->get_tax_for_commodity($_SESSION['Bid']);
                                    $data['area']=  $this->taxes->get_tax_area_for_commodity($_SESSION['Bid']);
                                    $this->load->view('template/header');
                                    $this->load->view('tax/add_new_tax_commodity',$data);
                                    $this->load->view('template/footer');
                          }                         
                  }else{
                            $this->load->model('taxes');
                            $data['tax']=  $this->taxes->get_tax_for_commodity($_SESSION['Bid']);
                            $data['area']=  $this->taxes->get_tax_area_for_commodity($_SESSION['Bid']);
                            $this->load->view('template/header');
                            $this->load->view('tax/add_new_tax_commodity',$data);
                            $this->load->view('template/footer');
                  }                 
        }
        if($this->input->post('cancel')){
            redirect('taxes_ci/get_tax_commodity');
        }
        }
    }
    function edit_tax_commodity($id){
       if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{ 
                            $this->load->model('taxes');
                            $data['tax']=  $this->taxes->get_tax_for_commodity($_SESSION['Bid']);
                            $data['area']=  $this->taxes->get_tax_area_for_commodity($_SESSION['Bid']);
                            $data['row']=  $this->taxes->get_tax_comodity_for_edit($id);
                            $this->load->view('template/header');
                            $this->load->view('tax/edit_new_tax_commodity',$data);
                            $this->load->view('template/footer');
       } 
    }
    
    function update_tax_commodity() {
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('cancel')){
                redirect('taxes_ci/get_tax_commodity');
            }
            if($this->input->post('save')){
                $this->load->library('form_validation');
                $this->form_validation->set_rules("Code",$this->lang->line('tCode'),'required'); 
                $this->form_validation->set_rules("Description",$this->lang->line('tdescription'),'required');
                $this->form_validation->set_rules("Schedule",$this->lang->line('tschedule'),'required');
                $this->form_validation->set_rules("Part",$this->lang->line('tpart'),'required');
                $this->form_validation->set_rules("tax_area",$this->lang->line('tax_area'),'required');
                $this->form_validation->set_rules("tax_value",$this->lang->line('tax'),'required');
                $id=$this->input->post('id');
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');
                          
                          $dis=$this->input->post('Description');
                          $schue=$this->input->post('Schedule');
                          $part=$this->input->post('Part');
                          $code=$this->input->post('Code');
                          $taxare=$this->input->post('tax_area');
                          $tax=$this->input->post('tax_value');
                          
                         
                          if($this->taxes->check_tax_commodity_is_unique_for_update($code,$_SESSION['Bid'],$id) )
                          {
                           $this->taxes->update_tax_commodity($id,$code,$schue,$part,$tax,$taxare,$dis);
                           redirect('taxes_ci/get_tax_commodity');
                          }else{
                                echo "this tax commodity is already added";                               
                                $this->edit_tax_commodity($id)   ;
                          }                         
                  }else{
                        $this->edit_tax_commodity($id);
                  }                 
            }
        }        
    }
    function inactive_tax_commodity($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
          $this->load->model('taxes');
          $this->taxes->innactive_tax_commoodity($id);  
           redirect('taxes_ci/get_tax_commodity');
         }
    }
    function active_tax_commodity($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
          $this->load->model('taxes');
          $this->taxes->active_tax_commoodity($id);  
           redirect('taxes_ci/get_tax_commodity');
         }
    }
    function delete_tax_commodity_for($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
          $this->load->model('taxes');
          $this->taxes->delete_tax_commoodity_for_admin($id,$_SESSION['Uid']);  
           redirect('taxes_ci/get_tax_commodity');
         }
    }
    function delete_tax_commodity($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
          $this->load->model('taxes');
          $this->taxes->delete_tax_commoodity_for_user($id,$_SESSION['Uid']);  
           redirect('taxes_ci/get_tax_commodity');
         }
    }
    // tax area funcctions   
    
    
    function tax_area(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('taxes');                
	        $config["base_url"] = base_url()."index.php/taxes_ci/tax_area";
	        $config["total_rows"] = $this->taxes->get_tax_area_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->taxes->get_tax_area_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->taxes->get_tax_area_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();                  
                $this->load->view('template/header');
                $this->load->view('tax/tax_area_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination");                 
                $this->load->model('taxes');
	        $config["base_url"] = base_url()."index.php/taxes_ci/tax_area";
                $config["total_rows"] = $this->taxes->get_tax_area_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               ;
                $data['count']=$this->taxes->get_tax_area_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->taxes->get_tax_area_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('tax/tax_area_list',$data);
                $this->load->view('template/footer');
            }                      
       }
    }
    function edit_tax_area($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
             $this->load->model('taxes');
             $data['row']= $this->taxes->get_tax_area_details($id);             
             $this->load->view('template/header');
             $this->load->view('tax/edit_tax_area',$data);
             $this->load->view('template/footer');
        }        
    }
    function update_tax_area(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('save')){
             $this->load->library('form_validation');
             $id=  $this->input->post('id');
                $this->form_validation->set_rules("area",$this->lang->line('tax_area'),'required'); 
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');
                          $area=$this->input->post('area');
                          if($this->taxes->check_tax_area_is_unique_for_update($area,$id,$_SESSION['Bid']))
                          {                            
                      $this->taxes->update_tax_area($area,$id);
                           redirect('taxes_ci/tax_area');
                          }else{
                              
                          }
                           echo "this tax arae is already added in this branch";
                           $this->edit_tax_area($id);
                  }else{
                      $this->edit_tax_area($id);
                  }
            }
            if($this->input->post('cancel')){
                 redirect('taxes_ci/tax_area');
     
            }        
        }
    }
    function delete_tax_area_for($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{            
            $this->load->model('taxes');
            $this->taxes->delete_tax_area_for_admin($id,$_SESSION['Uid']);
            redirect('taxes_ci/tax_area');                     
        }
        
    }
    function active_tax_area($id){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
         $this->load->model('taxes');
         $this->taxes->activate_tax_area($id);
         redirect('taxes_ci/tax_area');
        }
    }
   function inactive_tax_area($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
         $this->load->model('taxes');
         $this->taxes->inactivate_tax_area($id);
         redirect('taxes_ci/tax_area');
         }
    }
    function manage_tax_area(){
         if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
         if($this->input->post('delete_ad')){
            $this->load->model('taxes');                 
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_area_for_admin($value,$_SESSION['Uid']);
               }
          }
        redirect('taxes_ci/tax_area');
        }
        if($this->input->post('add_tax')){
                $this->load->view('template/header');
                $this->load->view('tax/add_new_tax_area');
                $this->load->view('template/footer');
        }
        if($this->input->post('cancel')){
              redirect('home');
        }
        if($this->input->post('delete')){
            $this->load->model('taxes');                   
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_area($value,$_SESSION['Uid']);
               }
            
        }redirect('taxes_ci/tax_area');
         }
         }
    }
    function add_new_tax_area(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('save')){
             $this->load->library('form_validation');
                $this->form_validation->set_rules("area",$this->lang->line('tax_area'),'required'); 
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');
                          $area=$this->input->post('area');
                         
                          if($this->taxes->check_tax_area_is_unique($area,$_SESSION['Bid']))
                          {
                          $this->taxes->save_new_tax_area($area,$_SESSION['Uid'],$_SESSION['Bid']);
                           redirect('taxes_ci/tax_area');
                          }else{
                                echo "this tax  area is already added";
                                
                                $this->load->view('template/header');
                                $this->load->view('tax/add_new_tax_area');
                                $this->load->view('template/footer');
                          }                         
                  }else{
                        $this->load->view('template/header');
                        $this->load->view('tax/add_new_tax_area');
                        $this->load->view('template/footer');
                  }
                  
        }
        if($this->input->post('cancel')){
            redirect('taxes_ci/tax_area');
        }
        }
    }
    function delete_tax_area($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            $this->load->model('taxes');
            $this->taxes->delete_tax_area($id,$_SESSION['Uid']);
            redirect('taxes_ci/tax_area');
        }
    }


    // tax deatails
    function taxes_details(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('taxes');                
	        $config["base_url"] = base_url()."index.php/taxes_ci/taxes_details";
	        $config["total_rows"] = $this->taxes->get_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->taxes->get_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->taxes->get_tax_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);           
	        $data["links"] = $this->pagination->create_links();                  
                $this->load->view('template/header');
                $this->load->view('tax/taxes_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination");                 
                $this->load->model('taxes');
	        $config["base_url"] = base_url()."index.php/taxes_ci/taxes_details";
                $config["total_rows"] = $this->taxes->get_count_for_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               ;
                $data['count']=$this->taxes->get_count_for_user($_SESSION['Bid']);             
	        $data["row"] = $this->taxes->get_tax_details_for_user($config["per_page"], $page,$_SESSION['Bid']);               
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('tax/taxes_list',$data);
                $this->load->view('template/footer');
            }                      
       }
    }
    function active($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
        $this->load->model('taxes');
        $this->taxes->activate_tax($id);
        redirect('taxes_ci/taxes_details');
        }
    }
    function inactive($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
        $this->load->model('taxes');
        $this->taxes->inactivate_tax($id);
        redirect('taxes_ci/taxes_details');
         }
    }
    function delete_tax($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
        $this->load->model('taxes');
        $this->taxes->delete_tax($id,$_SESSION['Uid']);
        redirect('taxes_ci/taxes_details');
         }
    }
    function manage_taxes(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('delete')){
                $this->load->model('taxes');                
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax($value,$_SESSION['Uid']);
               }
                            }
        redirect('taxes_ci/taxes_details');
         }
        
        if($this->input->post('add_tax')){
            $this->load->model('taxes');
            $data['row']=  $this->taxes->get_tax_types($_SESSION['Bid']);
                $this->load->view('template/header');
                $this->load->view('tax/add_new',$data);
                $this->load->view('template/footer');
        }
        if($this->input->post('cancel')){
            redirect('home');
        }
        if($this->input->post('delete_ad')){
            $this->load->model('taxes');        
                
                $data1 = $this->input->post('mycheck'); 
                if(!$data1==''){         
                 foreach( $data1 as $key => $value){   
                  $this->taxes->delete_tax_for_admin($value,$_SESSION['Uid']);
               }
        }redirect('taxes_ci/taxes_details');
        }
        }
    }
    function add_new_taxe(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('cancel')){
                redirect('taxes_ci/taxes_details');
            }
            if($this->input->post('save')){
                $this->load->library('form_validation');
                $this->form_validation->set_rules("rate",$this->lang->line('tax'),'required|max_length[2]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');
                          $rate=$this->input->post('rate');
                          $type=  $this->input->post('type');
                          if($this->taxes->check_taxype_is_unique($rate,$type,$_SESSION['Bid']))
                          {
                          $this->taxes->save_new_tax($rate,$type,$_SESSION['Bid'],$_SESSION['Uid']);
                           redirect('taxes_ci/taxes_details');
                          }else{
                                echo "this tax is already added";
                                $this->load->model('taxes');
                                $data['row']=  $this->taxes->get_tax_types($_SESSION['Bid']);
                                $this->load->view('template/header');
                                $this->load->view('tax/add_new',$data);
                                $this->load->view('template/footer');
                          }                         
                  }else{
                       $this->load->model('taxes');
                        $data['row']=  $this->taxes->get_tax_types($_SESSION['Bid']);
                        $this->load->view('template/header');
                        $this->load->view('tax/add_new',$data);
                        $this->load->view('template/footer');
                  }
                  
            }
        }
        
    }
    function edit_tax($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
     $this->load->model('taxes');
             $data['trow']= $this->taxes->get_tax_details($id);
             $data['row']=  $this->taxes->get_tax_types($_SESSION['Bid']);
             $this->load->view('template/header');
             $this->load->view('tax/edit_tax',$data);
             $this->load->view('template/footer');
        }
       
    }
    function update_tax(){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
            if($this->input->post('cancel')){
                redirect('taxes_ci/taxes_details');
            }
            if($this->input->post('save')){
                $this->load->library('form_validation');
                $id=  $this->input->post('id');
                $this->form_validation->set_rules("rate",$this->lang->line('tax'),'required|max_length[2]|regex_match[/^[0-9 .]+$/]|xss_clean'); 
                  if ( $this->form_validation->run() !== false ) {
			  $this->load->model('taxes');
                          $rate=$this->input->post('rate');
                          $type=  $this->input->post('type');
                          if($this->taxes->check_taxype_is_unique_for_update($rate,$type,$id,$_SESSION['Bid']))
                          {                            
                          $this->taxes->update_tax($rate,$type,$id,$_SESSION['Bid']);
                           redirect('taxes_ci/taxes_details');
                          }else{
                                echo "this tax is already added";
                                $this->edit_tax($id);
                               
                          }                         
                  }else{
                      $this->edit_tax($id);
                  }
                  
            }
        }
    }
    function delete_tax_for($id){
        if(!$_SERVER['HTTP_REFERER']){ redirect('taxes'); }else{
        $this->load->model('taxes');
        $this->taxes->delete_tax_for_admin($id,$_SESSION['Uid']);
        redirect('taxes_ci/taxes_details');
        }
    }
    
}
?>
