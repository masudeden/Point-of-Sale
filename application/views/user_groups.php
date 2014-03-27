<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); echo $links; 
?><table style="width: 550px">
    
<?php  echo  form_open('user_groupsci/user_groups');
  foreach ($branch as $branch_row){
      if($branch_row->guid== $this->session->userdata['branch_id']){
          echo $branch_row->store_name."<br><br>";
      }
  }
if($count>0){ 
    if($this->session->userdata['user_type']==2){ foreach ($depa as $drow) {?>
    <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $drow->guid ?>" /><?php  echo $drow->group_name ; ?></td><td><?php if($drow->active_status==0){ ?><a href="<?php echo base_url() ?>index.php/user_groupsci/to_deactivate_user_groups/<?php echo $drow->guid ?>">Deactivate</a> <?php } else{ ?><a href="<?php echo base_url() ?>index.php/user_groupsci/to_activate_user_groups/<?php echo $drow->guid ?>"> Activate</a> <?php } ?></td><td><a href="<?php echo base_url() ?>index.php/user_groupsci/edit_user_groups/<?php echo $drow->guid ?>"><?php echo $this->lang->line('edit')?></a></td><td><a href="<?php echo base_url() ?>index.php/user_groupsci/delete_user_groups_for_admin/<?php echo $drow->guid ?>"><?php echo $this->lang->line('delete')?></a></td><td ><a href="<?php echo base_url() ?>index.php/user_groupsci/edit_user_groups_permission/<?php echo $drow->guid ?>"><?php echo $this->lang->line('edit_permission')?></a></td></tr>
    <?php } ?>
    <tr><td><?php echo form_submit('activate',$this->lang->line('activate')) ?></td><td><?php echo form_submit('deactivate',$this->lang->line('deactivate')) ?></td><td><?php echo form_submit('delete_admin',$this->lang->line('delete')) ?></td><td><?php echo form_submit('add',$this->lang->line('add')) ?></td><td><?php echo form_submit('back',$this->lang->line('back_to_home')) ?></td></tr>
   
    <?php }
    else{
foreach ($depa as $row) {
   foreach ($all_depa as $drow){ 
       if($drow->guid==$row->user_group_id){
    ?>

    <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $drow->guid ?>" /><?php  echo $drow->group_name ;	 ?></td><td><a href="<?php echo base_url() ?>index.php/user_groupsci/edit_user_groups/<?php echo $drow->guid ?>"><?php echo $this->lang->line('edit')?></a></td><td><a href="<?php echo base_url() ?>index.php/user_groupsci/user_groups_delete/<?php echo $drow->guid?>"><?php echo $this->lang->line('delete')?></a></td><td ><a href="<?php echo base_url() ?>index.php/user_groupsci/edit_user_groups_permission/<?php echo $drow->guid ?>"><?php echo $this->lang->line('edit_permission')?></a></td></tr>
<?php }}}?>
    <tr><td><?php echo form_submit('delete',$this->lang->line('delete')) ?></td><td><?php echo form_submit('add',$this->lang->line('add')) ?></td><td><?php echo form_submit('back',$this->lang->line('back_to_home')) ?></td></tr>
    <?php }

}  else { if($this->session->userdata['user_type']==2){?>
        <tr><td><?php echo form_submit('add',$this->lang->line('add')) ?></td><td><?php echo form_submit('back',$this->lang->line('back_to_home')) ?></td></tr>

<?php }else{ ?>
        <tr><td><?php echo form_submit('activate',$this->lang->line('activate')) ?></td><td><?php echo form_submit('deactivate',$this->lang->line('deactivate')) ?></td><td><?php echo form_submit('delete_admin',$this->lang->line('delete')) ?></td><td><?php echo form_submit('add',$this->lang->line('add')) ?></td><td><?php echo form_submit('back',$this->lang->line('back_to_home')) ?></td></tr>

<?php }
    
}echo form_open();
?>

</table>