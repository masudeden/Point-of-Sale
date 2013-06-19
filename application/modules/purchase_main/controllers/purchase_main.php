<?php
class Purchase_main extends CI_Controller{
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
          $this->get_suppliers();
         // $this->load->view('purchase/sasi');
        }
    }
    function get_suppliers(){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');} //check the function is call directly or not if yes then redirect to home
        else{
            if($_SESSION['admin']==2){// check user is admin or not
                $this->load->library("pagination"); 
               
                $this->load->model('purchase');
	        $config["base_url"] = base_url()."index.php/purchase_main/get_suppliers";
	        $config["total_rows"] = $this->purchase->supplier_count_for_admin($_SESSION['Bid']);// get supplier count
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['branch']=$this->purchase->get_selected_branch_for_view();
                $data['count']=$this->purchase->supplier_count_for_admin($_SESSION['Bid']);         
	        $data["row"] = $this->purchase->get_supplier_details_for_admin($config["per_page"], $page,$_SESSION['Bid']);
                $data['urow']= $this->purchase->get_suppliers();
	        $data["links"] = $this->pagination->create_links();                 
                $this->load->view('template/header');
                $this->load->view('supplier_list',$data);
                $this->load->view('template/footer');
            }else{
                $this->load->library("pagination"); 
                
                $this->load->model('purchase');
	        $config["base_url"] = base_url()."index.php/purchase_main/get_suppliers";
                $config["total_rows"] = $this->purchase->get_purchase_order_user($_SESSION['Bid']);
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
                $data['branch']=$this->purchase->get_selected_branch_for_view();
                $data['count']=$this->purchase->get_purchase_order_user($_SESSION['Bid']);             
	        $data["row"] = $this->purchase->get_purchase_order_details_for_user($config["per_page"], $page,$_SESSION['Bid']);
                $data['urow']=$this->purchase->get_suppliers();
	        $data["links"] = $this->pagination->create_links(); 
                
                $this->load->view('template/header');
                $this->load->view('purchase/order_list',$data);
                $this->load->view('template/footer');
            }
        }
    }
    function purchase_order_details(){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');} //check the function is call directly or not if yes then redirect to home
        else{
        if($this->input->post('BacktoHome')){
            redirect('home');
        }
        if($this->input->post('add_new')){
                $this->load->view('template/header');
                $this->load->view('purchase/add_new_order');
                $this->load->view('template/footer');
        }
        }
    }
     function get_selected_supplier()
    {
       
      $q= addslashes($_REQUEST['term']);
                $this->load->model('purchase');    
                $value=  $this->purchase->get_selected_supplier($q,$_SESSION['Bid']);
                $name=$value[0];
                $company=$value[1];
                $phone=$value[2];
                $email=$value[3];              
                $id=$value[4];
                $j=0;
                $data=array();
                 for($i=0;$i<count($name);$i++)
                            {                                
                                $data[$j] = array(
                                          'label' =>$name[$i]  ,
                                          'company' =>$company[$i],
                                          'phone' =>$phone[$i],
                                          'email'=>$email[$i], 
                                          'id'=>$id[$i]
                                         
                                );			
                                        $j++;                                
                        }
        echo json_encode($data);
	
    }
 
    function get_item_details(){
       $q= addslashes($_REQUEST['term']);
                $this->load->model('purchase');    
                $value=  $this->purchase->get_selected_item($q,$_SESSION['Bid']);
                $name=$value[0];
                $dis=$value[1];
                $id=$value[2];
                $cost=$value[3];
                $sell=$value[4];
                $mrf=$value[5];
                $iname=$value[6];
                $j=0;
                $data=array();
                 for($i=0;$i<count($name);$i++)
                            {                                
                                $data[$j] = array(
                                          'label' =>$name[$i]  ,
                                          'desc' =>$dis[$i],
                                          'cost' =>$cost[$i],
                                          'sell'=>$sell[$i],
                                          'mrp'=>$mrf[$i]  , 
                                          'id'=>$id[$i],
                                          'name'=>$iname[$j]
                                );			
                                        $j++;                                
                        }
        echo json_encode($data);
    }
    function get_item_details_for_view($iid){
        if ($iid=="pos") return;
            $this->load->model('purchase');     
            $id=urldecode($iid);
            if($this->purchase->get_selected_item_view($id,$_SESSION['Bid'])!=FALSE){
            $value=$this->purchase->get_selected_item_view($id,$_SESSION['Bid']);
            echo "  <table> <tr><td >Name</td><td >Description</td><td >Cost</td><td >Selling Price</td><td > MRF</td></tr><tr><td><input type=text value=$value[0] class=items_div disabled ></td><td ><input type=text value =$value[1] class=items_div disabled ></td><td ><input type=text value =$value[2] class=items_div disabled ></td><td ><input type=text value =$value[3] class=items_div disabled ></td><td ><input type=text value= $value[4] class=items_div  disabled ></td></tr></table>";
             
}
}
}

?>
