<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); if($this->session->userdata['Setting']['Branch']==1){
echo $links; 
 echo form_open('branchCI/branch_details');
    
    
if($count!=0){
      if($this->session->userdata['user_type']==2){ ?><table><?php
          foreach ($row as $erow ){?>
             

        <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $erow->id ?>" /><td style="width: 100px"><?php echo $erow->store_name ; ?>
        </td><td  style="width: 100px"><?php echo $erow->store_phone  ?></td><td  style="width: 150px"><?php echo $erow->store_fax  ?></td>
        <td style="width: 100px"><?php echo $erow->store_city ?></td><td  style="width: 100px">                     
        </td>
        <td style="width: 100px"><?php if($erow->active_status!=0){ ?><a href="<?php echo base_url() ?>index.php/branchCI/activate_branch_details/<?php echo $erow->id ?>"><?php  echo $this->lang->line('activate');?></a> <?php }else{?><a href="<?php echo base_url() ?>index.php/branchCI/deactivate_branch_details/<?php echo $erow->id ?>"><?php echo $this->lang->line('deactivate');?></a> <?php  } ?><td></td><td><a href="<?php echo base_url() ?>index.php/branchCI/edit_branch_details/<?php echo $erow->id ?>"><?php echo $this->lang->line('edit') ?></a><td><td style="width: 100px"><a href="<?php echo base_url() ?>index.php/branchCI/admin_delete_branch/<?php echo $erow->id ?>"><?php echo $this->lang->line('delete') ?></a></td>
        </tr>
    <?php ?>

                  <?php             
          }  ?></table><tb><?php echo form_submit('activate',$this->lang->line('activate')) ?></td><tb><?php echo form_submit('deactivate',$this->lang->line('deactivate')) ?></td><td><input type="submit" name="delete_admin" value="<?php echo $this->lang->line('delete') ?>"></td><tb><input type="submit" name="Add_branch" value="<?php echo $this->lang->line('branch_add') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
    <?php        
      }else{ ?><table ><?php
          foreach ($br_row as $erow){
foreach ($row as $s_row){
   if($erow->id==$s_row->branch_id){
?>



    
    
    <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $erow->id ?>" /><td style="width: 100px"><?php echo $erow->store_name ; ?>
        </td><td  style="width: 100px"><?php echo $erow->store_phone  ?></td><td  style="width: 150px"><?php echo $erow->store_fax  ?></td>
        <td style="width: 100px"><?php echo $erow->store_city ?></td><td  style="width: 100px">
            
           
        </td>
        <td style="width: 100px"><a href="<?php echo base_url() ?>index.php/branchCI/edit_branch_details/<?php echo $erow->id ?>"><?php echo $this->lang->line('edit') ?></a><td><td style="width: 100px"><a href="<?php echo base_url() ?>index.php/branchCI/delete_branch/<?php echo $erow->id ?>"><?php echo $this->lang->line('delete') ?></a></td>
    
    </tr>
    <?php }}}?>
</table><tb><input type="submit" name="delete_all" value="<?php echo $this->lang->line('delete') ?>"></td><tb><input type="submit" name="Add_branch" value="<?php echo $this->lang->line('branch_add') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
    
<?php }

}else{?><tb><input type="submit" name="Add_branch" value="<?php echo $this->lang->line('branch_add') ?>"></td><td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
    
<?php }


?>  
 <?php echo form_close(); }else{
         redirect('home');
     }
?> 