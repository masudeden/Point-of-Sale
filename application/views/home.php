<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION['Uid'])){
    redirect('userlogin');
}else{ 
echo form_open('home/home_main');
?><h1>POS HOME</h1><td><?php echo form_submit('logout',$this->lang->line('logout'));?></td>
<table>
    <tr>
       <?php $i=0; echo $_SESSION['user_groupsci_per']['add'];
       if($row>0){
       foreach ($row as $mid){
     foreach ($mode as $mo_id){
         if($mid->module_id ==$mo_id->guid){
            
             if($i%9==0){ echo "</tr><tr>"; }
             
         echo "<td>";
           echo form_submit($mo_id->module_name,$this->lang->line($mo_id->module_name));
         echo "</td>";
            $i++;
}} } }?>
    </tr>    
</table>
<?php

echo form_close();
}
?>
