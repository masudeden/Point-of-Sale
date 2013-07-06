<?php
echo form_open('item_code/items_details');
echo "<table>";

if($count>0){$i=0;

   
    

    echo "<tr><td>SL NO</td><td>Name</td><td>companny</td><td>Phone</td></tr>";
    foreach ($row as $prow){
       
              echo "<tr><td>".++$i."</td><td>";?> 
<input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" />
    <?php echo "</td><td>$prow->code</td><td>$prow->name</td><td> $prow->description </td><td>"; 
   if($prow->upc_ean_code=='0'){ ?> 
<a href="<?php echo base_url()?>index.php/item_code/set_item/<?php echo $prow->guid ?>">set</a> 
 <?php }else{ ?>
<a href="<?php echo base_url()?>index.php/item_code/reset_item/<?php echo $prow->guid ?>">Reset</a> 
    <?php } echo "</td>";
      
                
    }
    echo "</table>";
    

echo form_submit('edit',$this->lang->line('bulk_edit'));
}else{
  
} 

echo form_submit('cancel',$this->lang->line('back_to_home'));
?>
