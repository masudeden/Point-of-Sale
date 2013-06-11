<?php
echo $links; 
echo form_open('items_category/manage_item');
echo "<table>";echo "<tr><td> Select </td><td> Name</td><td></td></tr>";
if($count>0){
if($_SESSION['admin']==2){
foreach ($row as $trow ){ ?>
<tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $trow->id ?>" /></td><td><?php echo $trow->category_name 	 ?></td>
    <td><a href="<?php echo base_url() ?>index.php/items_category/edit_item/<?php echo $trow->id ?>">Edit</a></td><td><a href="<?php echo base_url() ?>index.php/items_category/delete_item_for/<?php echo $trow->id ?>">Delete</a><td><?php if($trow->active_status==0){ ?><a href="<?php echo base_url() ?>index.php/items_category/inactive_item/<?php echo $trow->id ?>">Deactivate</a><?php }else{ ?><a href="<?php echo base_url() ?>index.php/items_category/active_item/<?php echo $trow->id ?>">Activate</a><?php  } ?></td></td></tr>
<?php }
echo "<tr><td>";echo form_submit('Activate',$this->lang->line('activate'));echo "</td><td>";echo form_submit('Deactivate',$this->lang->line('deactivate'));echo "</td><td>";echo form_submit('delete_ad',$this->lang->line('delete'));echo "</td><td>";echo form_submit('add_tax',$this->lang->line('add'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";

}else{
    foreach ($row as $trow ){ ?>
<tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $trow->id ?>" /></td><td><?php echo $trow->category_name 	?></td>
    <td><a href="<?php echo base_url() ?>index.php/items_category/edit_item/<?php echo $trow->id ?>">Edit</a></td><td><a href="<?php echo base_url() ?>index.php/items_category/delete_item/<?php echo $trow->id ?>">Delete</a></td></tr>
<?php }
echo "<tr><td>";echo form_submit('delete',$this->lang->line('delete'));echo "</td><td>";echo form_submit('add_tax',$this->lang->line('add'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";

}}else{
    echo "<tr><td>";echo form_submit('add_tax',$this->lang->line('add'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";

}
echo "</table>";

?>
