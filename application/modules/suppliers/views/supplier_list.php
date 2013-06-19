<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); echo $links; 
?><table style="width: 550px">
    
<?php  echo  form_open('suppliers/suppliers_details'); 
if($count!=0){
      if($_SESSION['admin']==2){?><table >
          <?php foreach ($row as $b_row){
          foreach ($urow as $erow){ if($b_row->supplier_id==$erow->id){
              ?>
          
          <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $erow->id ?>" /><td style="width: 100px"><?php echo $erow->first_name; ?>
        </td><td  style="width: 100px"><?php echo $erow->phone ?></td><td  style="width: 150px"><?php echo $erow->email ?></td>
        <td style="width: 100px"><?php echo $erow->last_name ?></td><td  style="width: 100px">
            
            <?php foreach ($branch as $user_b){
            if($user_b->supplier_id==$erow->id){
                echo $user_b->branch_name;
            }
                    
            }?>
        
        </td> <td style="width: 150;margin-left: 150px"><?php if($b_row->supplier_active==0){ ?><a href="<?php echo base_url() ?>index.php/suppliers/to_deactivate_supplier/<?php echo $erow->id ?>">Deactivate</a> <?php } else{ ?><a href="<?php echo base_url() ?>index.php/suppliers/to_activate_supplier/<?php echo $erow->id ?>"> Activate</a> <?php } ?></td>
        <td style="width: 100px"><a href="<?php echo base_url() ?>index.php/suppliers/edit_supplier_details/<?php echo $erow->id ?>"><?php echo $this->lang->line('edit') ?></a><td>
        <td><a href=" <?php echo base_url() ?>index.php/suppliers/delete_supplier_details_in_admin/<?php echo $erow->id ?>"><?php echo $this->lang->line('delete') ?></a></td>
    </tr><?php }}}?></table>
<tb><?php echo form_submit('activate',$this->lang->line('activate'))?></td><tb><?php echo form_submit('deactivate',$this->lang->line('deactivate'))?></td><td><input type="submit" name="delete_supplier_for_admin" value="<?php echo $this->lang->line('delete') ?>"></td><tb><input type="submit" name="Add_supplier" value="<?php echo $this->lang->line('add_new_supplier') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
  
     <?php }else{?><table ><?php
foreach ($row as $b_row){
          foreach ($urow as $erow){ if($b_row->supplier_id==$erow->id){
   
?>



    
    
    <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $erow->id ?>" /><td style="width: 100px"><?php echo $erow->first_name; ?>
        </td><td  style="width: 100px"><?php echo $erow->phone ?></td><td  style="width: 150px"><?php echo $erow->email ?></td>
        <td style="width: 100px"><?php echo $erow->company_name ?></td><td  style="width: 100px">
            
           <?php foreach ($branch as $user_b){
            if($user_b->supplier_id==$erow->id){
                echo $user_b->branch_name;
            }
                    
            }?>
        
        </td>
        <td style="width: 100px"><a href="<?php echo base_url() ?>index.php/suppliers/edit_supplier_details/<?php echo $erow->id ?>"><?php echo $this->lang->line('edit') ?></a><td><td style="width: 100px"><a href="<?php echo base_url() ?>index.php/suppliers/delete_supplier/<?php echo $erow->id ?>"><?php echo $this->lang->line('delete') ?></a></td>
    
    </tr>
    <?php ?>

<?php }}}?></table> 
<tb><input type="submit" name="delete_all" value="<?php echo $this->lang->line('delete') ?>"></td><tb><input type="submit" name="Add_supplier" value="<?php echo $this->lang->line('add_new_supplier') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
  
<?php }
}else{   if($_SESSION['admin']==2){ ?>
    <tb><input type="submit" name="Add_supplier" value="<?php echo $this->lang->line('add_new_supplier') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
 
<?php }else{?>
    <tb><input type="submit" name="Add_supplier" value="<?php echo $this->lang->line('add_new_supplier') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
 
<?php }

}


?>  
  <?php   echo form_close() ?> 