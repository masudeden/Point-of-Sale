<?php
class Purchase_invoice extends CI_Controller{
   function __construct() {
                parent::__construct();
                $this->load->library('posnic');               
    }
    function index(){     
              //$this->get_items();
              $this->get_list();
              //$name=$this->posnic->posnic_one_field_module_where('company_name','suppliers',$supname);
              //$this->annan();
             //$this->load->view('annan1');
    }
    function add_order(){
        $this->load->view('add_items');
    }
    function annan(){
                $this->load->model('core_model');
                $name=$this->core_model->posnic_join_like('suppliers_x_items',$_SESSION['Bid']);
                for($i=0;$i<count($name);$i++){
                    echo $name[$i]."<br>";
                }
    }
    function  set_seleted_item_suppier($suid){
        
            $this->load->model('purchase');     
            $id=urldecode($suid);
            $where=array('order_id'=>$id);
            $data=$this->posnic->posnic_one_array_module_where('purchase_invoice_items',$where);
           
            foreach ($data as $value){ 
            echo " <tr><td >Name  </td><td >Cost</td><td >Price</td><td > MRF</td></tr><tr><td ><input type=text style=width:150px disabled value =$value[quty]   ></td><td ><input type=text value =$value[order_id] class=items_div disabled ></td><td ><input type=text value =$value[free] class=items_div disabled ></td><td ><input type=text value= $value[cost] class=items_div  disabled ></td></tr>";
            
            
        }
           
    }
            function get_selected_order()
    {       
       $q= addslashes($_REQUEST['term']);
                $where=array('po_no'=>$q,'order_status'=>1);
                $po=$this->posnic->posnic_like('purchase_order',$where,'po_no');
                $sup=  $this->posnic->posnic_like('purchase_order',$where,'supplier_id');
                $guid= $this->posnic->posnic_like('purchase_order',$where,'guid');
                $j=0;
                $data=array();
                 for($i=0;$i<count($po);$i++)
                            {                   
                     $supname=array('guid'=>$sup[$i]);
                     $name=$this->posnic->posnic_one_field_module_where('company_name','suppliers',$supname);
                                $data[$j] = array(
                                          'label' =>$po[$i],
                                          'company' =>$name,
                                          'guid'=>$guid[$i]
                                          
                                );			
                                        $j++;                                
                        }
        echo json_encode($data);
    
    }
   
   function get_item_details(){
       $q= addslashes($_REQUEST['term']);
                $like=array('code'=>$q);    
               
                $where='suppliers_x_items.item_id=items.guid AND suppliers_x_items.active = 0  AND suppliers_x_items.item_active  = 0 AND suppliers_x_items.supplier_id ="'.$_SESSION['supplier_guid'].'" AND items.active_status=0  AND items.active=0  ';
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
           if($this->input->post('save')){       
        if($_SESSION['Posnic_Add']==="Add"){
        
        
            $this->form_validation->set_rules('supplier_id',$this->lang->line('supplier_id'), 'required');
            $this->form_validation->set_rules('expdate',$this->lang->line('expdate'), 'required');
            $this->form_validation->set_rules('pono', $this->lang->line('pono'), 'required');
            $this->form_validation->set_rules('podate', $this->lang->line('podate'), 'required');                      
           
            if ( $this->form_validation->run() !== false ) {    
      $supplier=  $this->input->post('supplier_id');
      $expdate=strtotime($this->input->post('expdate'));
      $pono= $this->input->post('pono');
      $podate= strtotime($this->input->post('podate'));
      $discount=  $this->input->post('discount');
      $freight=  $this->input->post('freight');
       $round_amt=  $this->input->post('round_amt');
      $total_items=$this->input->post('roll_no')-1;
      $remark=  $this->input->post('remark');
      $note=  $this->input->post('note');
    $item_total=  $this->input->post('hidden_total_price');
       $dis_amt= (trim($item_total)*$discount)/100;
      $grand_total=  (trim($item_total)-$dis_amt)+trim($freight)+trim($round_amt);
      $item=  $this->input->post('items');
      $quty=  $this->input->post('quty');
      $cost=  $this->input->post('cost');
      $sell=  $this->input->post('sell');
      $mrp=  $this->input->post('mrp');
      $del_date= $this->input->post('del_date');
      $net=  $this->input->post('net');
             $value=array('supplier_id'=>$supplier,'exp_date'=>$expdate,'po_no'=>$pono,'po_date'=>$podate,'discount'=>$discount,'discount_amt'=>$dis_amt,'freight'=>$freight,'round_amt'=>$freight,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'order_status'=>0,'total_item_amt'=>$item_total);
           $guid= $this->posnic->posnic_add($value);
            $module='purchase_invoice_items';
      for($i=0;$i<count($item);$i++){
          $item_value=array('order_id'=>$guid,'item'=>$item[$i],'quty'=>$quty[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'date'=> strtotime($del_date[$i]));
      $this->posnic->posnic_module_add($module,$item_value);
      }
 redirect('purchase_invoice/get_list');
    
     }else{
         $this->add_order();
                 
     }
        }
           }else{
               $this->get_list();
           }
    }
    function get_list(){
        
	        $config["base_url"] = base_url()."index.php/purchase_invoice/get_list";
	        $config["total_rows"] =$this->posnic->posnic_count(); 
	        $config["per_page"] = 8;
	        $config["uri_segment"] = 3;
	        $this->pagination->initialize($config);	 
	        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;               
                $data['count']=$this->posnic->posnic_count();                 
	        $data["row"] = $this->posnic->posnic_limit_result($config["per_page"], $page);           
	        $data["links"] = $this->pagination->create_links(); 
                $where=array();
                $data['sup']=  $this->posnic->posnic_module_where('suppliers',$where);
                $this->load->view('order_list',$data);
    }
    function purchase_invoice_magement(){
        if(isset($_POST['add'])){
            if($_SESSION['Posnic_Add']==="Add"){
            $this->add_order();
            }else{
                  echo "You  Have No permmission To Edit PO";
                    $this->get_list();
            }
        }if(isset($_POST['cancel'])){
            redirect('home');
        }
        
    }
    function edit_purchase_invoice($guid){
        if($_SESSION['Posnic_Edit']==="Edit"){
                $where=array('guid'=>$guid);
                $data['order']=  $this->posnic->posnic_module_where('purchase_invoice',$where);
                $where=array('order_id'=>$guid);
                $data['order_items']=  $this->posnic->posnic_module_all_where('purchase_invoice_items',$where);
                $where=array();
                $data['item']= $this->posnic->posnic_module_all_where('items',$where);
                $where=array();
                $data['sup']=  $this->posnic->posnic_module_all_where('suppliers',$where);
                $this->load->view('update_order',$data);
    }else{
        echo "You  Have No permmission To Edit PO";
        $this->get_list();
    }
    
        }
        function update_order(){if(isset($_POST['save'])){
        if($_SESSION['Posnic_Edit']==="Edit"){
        
            
            $this->form_validation->set_rules('supplier_id',$this->lang->line('supplier_id'), 'required');
            $this->form_validation->set_rules('expdate',$this->lang->line('expdate'), 'required');
            $this->form_validation->set_rules('pono', $this->lang->line('pono'), 'required');
            $this->form_validation->set_rules('podate', $this->lang->line('podate'), 'required');                      
           $guid=  $this->input->post('order_id');
            if ( $this->form_validation->run() !== false ) {    
      $supplier=  $this->input->post('supplier_id');
      $expdate=strtotime($this->input->post('expdate'));
      $pono= $this->input->post('pono');
      $podate= strtotime($this->input->post('podate'));
      $discount=  $this->input->post('discount');
      $freight=  $this->input->post('freight');
       $round_amt=  $this->input->post('round_amt');
      $total_items=$this->input->post('roll_no')-1;
      $remark=  $this->input->post('remark');
      $note=  $this->input->post('note');
      $item_total= $this->input->post('hidden_total_pric');
      $dis_amt= (trim($item_total)*$discount)/100;
      $grand_total=  (trim($item_total)-$dis_amt)+trim($freight)+trim($round_amt);
      $item=  $this->input->post('items');
      $quty=  $this->input->post('quty');
      $cost=  $this->input->post('cost');
      $sell=  $this->input->post('sell');
      $mrp=  $this->input->post('mrp');
      $del_date=$this->input->post('del_dates');
      $net=  $this->input->post('net');
             $value=array('supplier_id'=>$supplier,'exp_date'=>$expdate,'po_no'=>$pono,'po_date'=>$podate,'discount'=>$discount,'discount_amt'=>$dis_amt,'freight'=>$freight,'round_amt'=>$freight,'total_items'=>$total_items,'total_amt'=>$grand_total,'remark'=>$remark,'note'=>$note,'order_status'=>0,'total_item_amt'=>$item_total);
                $where=array('guid'=>$guid);
                $this->posnic->posnic_update($value,$where);
             
                 if($_SESSION['Posnic_Delete']==="Delete"){
                $where=array('order_id'=>$guid);
               $data=$this->posnic->posnic_array_other_module_where('purchase_invoice_items',$where);
            
            if(count($data)>0)     { $i=0;
                 foreach ($data as $i_value){
             
                     if(!$this->input->post($i_value['item'])){
                        $where=array('guid'=>$i_value['guid']);
                        $this->posnic->posnic_module_delete($where,'purchase_invoice_items');
                       
                     }
                 }
                    }
            }
            $module='purchase_invoice_items';
             for($i=0;$i<count($item);$i++){         
      
               $value=array('order_id'=>$guid,'item'=>$item[$i]);
                        if($this->posnic->check_module_unique($value,$module)){
                            $item_value=array('order_id'=>$guid,'item'=>$item[$i],'quty'=>$quty[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'date'=>strtotime($del_date[$i]));
                            $this->posnic->posnic_module_add($module,$item_value);
            }else{
                $where=array('order_id'=>$guid,'item'=>$item[$i]);
                            $item_value=array('order_id'=>$guid,'item'=>$item[$i],'quty'=>$quty[$i],'cost'=>$cost[$i],'sell'=>$sell[$i],'mrp'=>$mrp[$i],'amount'=>$net[$i],'date'=>strtotime($del_date[$i]));
                            $this->posnic->posnic_module_update($module,$item_value,$where);
            }
                
             }  
            $this->get_list();
            }else{
                $this->edit_purchase_invoice($guid);
            }
            
            
            
         }else{
        echo "You  Have No permmission To Edit PO";
        $this->get_list();
    }
        }
        else{
            redirect('purchase_invoice/get_list');
        }}
}
?>
