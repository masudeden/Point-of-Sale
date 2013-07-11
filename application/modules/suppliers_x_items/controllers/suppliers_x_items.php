<?php
class Suppliers_x_items extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
              $this->get_items();
             //$this->load->view('annan1');
    }
    function get_items(){
                $config["base_url"] = base_url()."index.php/suppliers_x_items/get_items";
	        $config["total_rows"] =$this->posnic->posnic_module_count('suppliers'); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_module_count('suppliers');                 
	        $data["row"] = $this->posnic->posnic_module_limit_result('suppliers',$config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links();
                $this->load->view('supplier_list',$data);
    }
    function add_items($guid){
         $data['supplier_id']=$guid;
         $where=array('supplier_id'=>$guid);
         $where_sup=array('guid'=>$guid);
         $data['sup']=$this->posnic->posnic_module_where('suppliers',$where_sup);         
         $data['row']=$this->posnic->posnic_module_where('suppliers_x_items',$where);
         $data['item_row']=$this->posnic->posnic_module('items');
         $this->load->view('add_items',$data);
         
    }
    function save_get(){
        $data= $this->input->post('items');
        for($i=0;$i<count($data);$i++){
               
              if($this->posnic->check_unique($value)){  
                                  
              }
        }
    }
            function save_items(){
        if($this->input->post('save')){       
        if($_SESSION['Posnic_Add']==="Add"){
            $data= $this->input->post('items');
            $sguid=  $this->input->post('s_guid');
        for($i=0;$i<count($data);$i++){
            $value=array('item_id'=>$data[$i],'supplier_id'=>$sguid);
            if($this->posnic->check_unique($value)){
                echo $data[$i];
                                  
            }
        }
        }
        }
        if($this->input->post('cancel')){
            redirect('suppliers_x_items');
        }
    }
    
    function get_item_details(){
       $q= addslashes($_REQUEST['term']);
                $where=array('code'=>$q);
                $name=$this->posnic->posnic_like('items',$where,'code');
                $dis=  $this->posnic->posnic_like('items',$where,'name');
                $id= $this->posnic->posnic_like('items',$where,'id');
                $j=0;
                $data=array();
                 for($i=0;$i<count($name);$i++)
                            {                                
                                $data[$j] = array(
                                          'label' =>$name[$i]  ,
                                          'desc' =>$dis[$i],                                          
                                          'id'=>$id[$i]
                                );			
                                        $j++;                                
                        }
        echo json_encode($data);
    }
     
     function get_item_details_for_view($iid){
        if ($iid=="pos") return;
            $this->load->model('purchase');     
            $id=urldecode($iid);
            $where=array('code'=>$id);
            $data=$this->posnic->posnic_array_module_where('items',$where);
           foreach ($data as $value){ 
            echo "  <table> <tr><td >Name  </td><td >Description</td><td >Cost</td><td >Selling Price</td><td > MRF</td></tr><tr><td><input type=text value=$value[name] class=items_div disabled ></td><td ><input type=text value =$value[description] class=items_div disabled ></td><td ><input type=text value =$value[cost_price] class=items_div disabled ></td><td ><input type=text value =$value[selling_price] class=items_div disabled ></td><td ><input type=text value= $value[mrf] class=items_div  disabled ></td></tr></table>";
            
            
        }
     }
    function get_selected_item()
    {
          if (!$_SERVER['HTTP_REFERER']){ redirect('home');}else{
       $this->load->model('receiving_items');
           $qo = mysql_real_escape_string( $_REQUEST['query'] );

        $value=  $this->receiving_items->get_selected_item_details($qo,$_SESSION['Bid']);

                $data=$value[0];
                $sel=$value[3];
                $dis=$value[1];
                $id=$value[2];
                $cost=$value[4];
   
	    echo '<ul>'."\n";
	    for($i=0;$i<count($data);$i++)
	    {
		$p = $data[$i];
		$p = preg_replace('/(' . $qo . ')/i', '<span style="font-weight:bold;">'.'</span>', $p);
		echo "\t".'<li id="autocomplete_'.$data[$i].'" rel="'.$dis[$i].'_' . $data[$i].'_' . $cost[$i].'_' . $sel[$i].'_' . $data[$i] .'_' . $id[$i]. '">'. utf8_encode( "$data[$i]" ) .'</li>'."\n";
	    }
	    echo '</ul>';
          }
	
    }
  
    function delete_item($id){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');}else{
         $this->load->model('supplier_model');
         $this->supplier_model->delete_item_suplier_for_user($id,$_SESSION['Bid'],$_SESSION['Uid']);
         redirect('supplier_vs_items');
         }
    }
    function suppliers_details(){
          if (!$_SERVER['HTTP_REFERER']){ redirect('home');}else{
              if($this->input->post('BacktoHome')){
                  redirect('home');
              }
              if($this->input->post('delete_all')){
                  $this->load->model('supplier_model');
                  $data=$this->input->post('mycheck');
                  foreach ($data as $id){                 
                $this->supplier_model->delete_item_suplier_for_user($id,$_SESSION['Bid'],$_SESSION['Uid']);    
                  }
                  redirect('supplier_vs_items');
              }
              if($this->input->post('delete_supplier_for_admin')){
                  $this->load->model('supplier_model');
                  $data=$this->input->post('mycheck');
                  foreach ($data as $id){                 
                 $this->supplier_model->delete_item_suplier_for_admin($id,$_SESSION['Bid'],$_SESSION['Uid']);   
                  }
                  redirect('supplier_vs_items');
              }
              if($this->input->post('activate')){
                   $this->load->model('supplier_model');
                   $data=$this->input->post('mycheck');
                  foreach ($data as $id){ 
                  $this->supplier_model->to_activate_supplier_for_admin($id,$_SESSION['Bid']);    
                  }
                  redirect('supplier_vs_items');
              }
              if($this->input->post('deactivate')){
                  $this->load->model('supplier_model');
                  $data=$this->input->post('mycheck');
                  foreach ($data as $id){ 
                    $this->supplier_model->to_deactivate_supplier_for_admin($id,$_SESSION['Bid']);  
                  }
                  redirect('supplier_vs_items');
              }
          }
    }
    function delete_supplier_details_in_admin($id){
         if (!$_SERVER['HTTP_REFERER']){ redirect('home');}else{
             $this->load->model('supplier_model');
                               
                $this->supplier_model->delete_item_suplier_for_admin($id,$_SESSION['Bid'],$_SESSION['Uid']);    
                
                  redirect('supplier_vs_items');
         }
    }
    function to_deactivate_supplier($id){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}else{
             $this->load->model('supplier_model');
                               
                $this->supplier_model->to_deactivate_supplier_for_admin($id,$_SESSION['Bid']);    
                
                  redirect('supplier_vs_items');
         }
    }
    function to_activate_supplier($id){
        if (!$_SERVER['HTTP_REFERER']){ redirect('home');}else{
             $this->load->model('supplier_model');                               
                $this->supplier_model->to_activate_supplier_for_admin($id,$_SESSION['Bid']);    
                
                  redirect('supplier_vs_items');
         }
    }
    
}
?>
