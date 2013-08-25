<?php
class Purchase_order extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
              $this->get_items();
              //$this->annan();
             //$this->load->view('annan1');
    }
    function get_items(){
        $this->load->view('add_items');
    }
    function annan(){
                $this->load->model('core_model');
                $name=$this->core_model->posnic_join_like('suppliers_x_items',$_SESSION['Bid']);
                for($i=0;$i<count($name);$i++){
                    echo $name[$i]."<br>";
                }
    }
            
    function get_selected_supplier()
    {       
       $q= addslashes($_REQUEST['term']);
                $where=array('company_name'=>$q);
                $name=$this->posnic->posnic_like('suppliers',$where,'company_name');
                $dis=  $this->posnic->posnic_like('suppliers',$where,'first_name');
                $id= $this->posnic->posnic_like('suppliers',$where,'guid');
                $j=0;
                $data=array();
                 for($i=0;$i<count($name);$i++)
                            {                                
                                $data[$j] = array(
                                          'label' =>$name[$i]  ,
                                          'company' =>$dis[$i],  
                                          'guid'=>$id[$i]
                                          
                                );			
                                        $j++;                                
                        }
        echo json_encode($data);
    
    }
   
   function get_item_details($sup){
       $q= addslashes($_REQUEST['term']);
                $like=array('code'=>$q);    
               
                $where='suppliers_x_items.item_id=items.guid AND suppliers_x_items.active = 0  AND suppliers_x_items.item_active  = 0 AND suppliers_x_items.supplier_id ="2a4e7a8de41c967c9097b2e4a1a0e662" AND items.active_status=0  AND items.active=0  ';
                $data=$this->posnic-> posnic_join_like('suppliers_x_items','items',$like,$where);
        echo json_encode($data);
    }   
    
    function get_item_details_for_view($iid){
        if ($iid=="pos") return;
            $this->load->model('purchase');     
            $id=urldecode($iid);
            $where=array('code'=>$id);
            $data=$this->posnic->posnic_one_array_module_where('items',$where);
           foreach ($data as $value){ 
            echo "  <table> <tr><td >Name  </td><td >Cost</td><td >Price</td><td > MRF</td></tr><tr><td ><input type=text style=width:150px disabled value =$value[description]   ></td><td ><input type=text value =$value[cost_price] class=items_div disabled ></td><td ><input type=text value =$value[selling_price] class=items_div disabled ></td><td ><input type=text value= $value[mrp] class=items_div  disabled ></td></tr></table>";
            
            
        }
     }
 
    
  
    function save_items(){
       $_SESSION['sup']= $this->input->post('supplier_id');
     }
   
    
}
?>
