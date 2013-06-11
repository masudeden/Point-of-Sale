<?php
class Employee_permissions extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('unit_test');
        session_start();        
        $this->load->helper(array('form', 'url'));
    }
    function index(){
        
    }
    function edit_employee_permission($id){
        $this->load->model('employeepermission');
        $data['edrow']=  $this->employeepermission->edit_employee($id); 
        
       
        $data['irow']=  $this->employeepermission->item_permission_employee($id);
        $data['erow']=  $this->employeepermission->emp_permission_employee($id);
        
        $this->load->view('edit_employee_permission',$data);
    }
    function upadate_employee_permission(){
        $id= $this->input->post('emp_id');
       
       
        
        
        $iread= $this->input->post('read');
        $iadd=  $this->input->post('add');
        $iedit=$this->input->post('edit');
        $idelete=  $this->input->post('delete');
        $item_permission= $iread+$iadd+$iedit+$idelete; 
        $eread= $this->input->post('eread');
        $eadd=  $this->input->post('eadd');
        $eedit=$this->input->post('eedit');
        $edelete=  $this->input->post('edelete');
        
         $emp_permission= $eread+$eadd+$eedit+$edelete;
         $this->load->model('employeepermission');
         $this->employeepermission->update_permission($item_permission,$emp_permission,$id);
         $this->edit_employee_permission($id);
        
        if($this->input->post('cancel')){
            
             redirect('employees/get_employee_details');
        }
    }
}
?>
