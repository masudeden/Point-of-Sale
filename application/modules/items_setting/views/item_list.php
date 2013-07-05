<?php
echo form_open('items_setting/items_details');
echo "<table>";

if($count>0){$i=0;

   
    

    echo "<tr><td>SL NO</td><td>Name</td><td>companny</td><td>Phone</td></tr>";
    foreach ($row as $prow){
        foreach ($srow as $iirow){
            if($prow->guid==$iirow->item_id){
              echo "<tr><td>".++$i."</td><td>";?> 
<input type="checkbox" name="posnic[]" value="<?php echo $iirow->guid ?>" />
    <?php echo "</td><td>$prow->code</td><td>$prow->name</td><td> $prow->description </td><td>"; 
    if($iirow->set==0){ ?> 
<a href="<?php echo base_url()?>index.php/items_setting/set_item/<?php echo $iirow->guid ?>">set</a> 
 <?php }else{ ?>
<a href="<?php echo base_url()?>index.php/items_setting/reset_item/<?php echo $iirow->guid ?>">Reset</a> 
    <?php } echo "</td>";
      
            }
    }
    }
    echo "</table>";
    

echo form_submit('edit',$this->lang->line('bulk_edit'));
}else{
  
} 

echo form_submit('cancel',$this->lang->line('back_to_home'));
?>
