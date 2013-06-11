<?php
class Item_code extends CI_Controller{
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
        }else{
            $this->get_item_code();
        }
    }
    function get_item_code(){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');} //check the function is call directly or not if yes then redirect to home
        else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
                $this->load->model('item_setting');
                $this->load->model('item_model');
	        $config["base_url"] = base_url()."index.php/item_code/get_setting";
	        $config["total_rows"] = $this->item_model->item_count_for_admin($_SESSION['Bid']);// get item count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['brands']=  $this->item_model->get_brands_user($_SESSION['Bid']);
                $data['set']=  $this->item_setting->get_item_setting($_SESSION['Bid']);
                $data['count']=$this->item_model->item_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->item_model->get_item_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);
                $data['urow']= $this->item_model->get_items();
                $data['code']=  $this->item_setting->get_code();
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('item_code/code_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination"); 
                $this->load->model('item_setting');
                $this->load->model('item_model');
	        $config["base_url"] = base_url()."index.php/items_setting/get_setting";
                $config["total_rows"] = $this->item_model->pos_item_count($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['set']=  $this->item_setting->get_item_setting($_SESSION['Bid']);  
                $data['brands']=  $this->item_model->get_brands_user($_SESSION['Bid']);
                $data['count']=$this->item_model->pos_item_count($_SESSION['Bid']);             
	        $data["row"] = $this->item_model->get_item_details($config["per_page"], $page,$_SESSION['Bid']);
                $data['code']=  $this->item_setting->get_code();
	        $data["links"] = $this->pagination->create_links(); 
                
                $this->load->view('template/header');
                $this->load->view('item_code/code_list',$data);
                $this->load->view('template/footer');
            }
        }
    }
    function items_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
             if($this->input->post('BacktoHome')){
                redirect('home');
            }
             if($this->input->post('bulk_edit')){
                  $data['row'] = $this->input->post('mycheck'); 
                            if(!$data==''){   
                            $this->load->view('template/header');
                            $this->load->view('items_settings/bulk_edit_setting',$data);
                            $this->load->view('template/footer');
                            
                            }else{
                                redirect('items_setting');
                            }
             }
        
       
             if($this->input->post('BacktoHome')){
                redirect('home');
            }
             if($this->input->post('bulk_edit')){
                  $data['row'] = $this->input->post('mycheck'); 
                            if(!$data==''){   
                            $this->load->view('template/header');
                            $this->load->view('items_settings/bulk_edit_setting',$data);
                            $this->load->view('template/footer');
                            
                            }else{
                                redirect('items_setting');
                            }
             }
        
        }
    }
    function add_item($id){
          if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
    $this->load->model('item_setting');
    $data['row']=  $this->item_setting->get_item_details($id);
                $this->load->view('template/header');
                $this->load->view('item_code/add_code',$data);
                $this->load->view('template/footer');
          }
    }
    function add_code(){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');}  else{
             if($this->input->post('save')){             
               $this->load->library('form_validation');
               $id=  $this->input->post('id');
               $this->load->model('item_setting');
               $this->form_validation->set_rules("code",$this->lang->line('code'),'required');                                             
              if ($this->form_validation->run() !== false ) {       
                    $code=$this->input->post('code');
                    if($this->item_setting->check_code($code,$_SESSION['Bid'])){
                        $this->item_setting->set_code_for_item($code,$id,$_SESSION['Bid']);
                        redirect('item_code');
                    }else{
                        echo "this code is alreay added for one item";
                        $this->add_item($id);
                    }
                    
              }else{
                  $this->add_item($id);
              }
         }if($this->input->post('cancel')){
             redirect('item_code');
         }
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
