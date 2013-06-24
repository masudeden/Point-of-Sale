<?php
echo $links; 
echo form_open('brands/brands_manage');
echo "<table>";echo "<tr><td>Sl No</td><td> Select </td><td> Name</td><td></td></tr>";

if($count>0){$i=0;
if($_SESSION['Posnic_User']=='admin'){
foreach ($row as $trow ){ ?>
<tr><td><?php echo ++$i; ?></td><td><input type="checkbox" name="mycheck[]" value="<?php echo $trow->guid ?>" /></td><td><?php echo $trow->name ?></td>
    <td><a href="<?php echo base_url() ?>index.php/brands/edit_brands/<?php echo $trow->guid ?>">Edit</a></td><td><?php if($trow->active==0){ ?><a href="<?php echo base_url() ?>index.php/brands/inactive_brands/<?php echo $trow->guid ?>"><?php echo $this->lang->line('deactivate') ?></a><?php }else{ ?><a href="<?php echo base_url() ?>index.php/brands/active_brands/<?php echo $trow->guid ?>"><?php echo $this->lang->line('activate') ?></a><?php  } ?></td></td><td><?php if($trow->active_status==1){ ?><a href="<?php echo base_url() ?>index.php/brands/restore/<?php echo $trow->guid ?>"><?php echo $this->lang->line('restore') ?></a><?php } ?></td><td><a href="<?php echo base_url() ?>index.php/brands/delete_brands_ad/<?php echo $trow->guid ?>"><?php echo $this->lang->line('delete') ?></a><td></tr>
<?php }
echo "<tr><td>";echo form_submit('deactivate',$this->lang->line('deactivate'));echo "</td><td>";echo form_submit('activate',$this->lang->line('activate'));echo "</td><td>"; echo form_submit('delete_ad',$this->lang->line('delete'));echo "</td><td>";echo form_submit('add_tax',$this->lang->line('add'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";

}else{
    foreach ($row as $trow ){ ?>
<tr><td><?php echo ++$i; ?><input type="checkbox" name="mycheck[]" value="<?php echo $trow->guid ?>" /></td><td><?php echo $trow->name ?></td>
    <td><a href="<?php echo base_url() ?>index.php/brands/edit_brands/<?php echo $trow->guid ?>">Edit</a></td><td><?php if($trow->active==0){ ?><a href="<?php echo base_url() ?>index.php/brands/inactive_brands/<?php echo $trow->guid ?>"><?php echo $this->lang->line('deactivate') ?></a><?php }else{ ?><a href="<?php echo base_url() ?>index.php/brands/active_brands/<?php echo $trow->guid ?>"><?php echo $this->lang->line('activate') ?></a><?php  } ?></td><td><a href="<?php echo base_url() ?>index.php/brands/delete_brands/<?php echo $trow->guid ?>">Delete</a></td></tr>
<?php }
echo "<tr><td>";echo form_submit('deactivate',$this->lang->line('deactivate'));echo "</td><td>";echo form_submit('activate',$this->lang->line('activate'));echo "</td><td>";echo form_submit('delete',$this->lang->line('delete'));echo "</td><td>";echo form_submit('add_tax',$this->lang->line('add'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";

}

    }else{
    echo "<tr><td>";echo form_submit('add_tax',$this->lang->line('add'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";

}
echo "</table>";

?>
