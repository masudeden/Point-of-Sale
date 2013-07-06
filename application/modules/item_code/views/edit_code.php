<?php
echo "<table>";
echo form_open('item_code/add_code');
foreach ($row as $srow){
    if($guid===$srow->guid){
   echo "<tr><td>";echo form_label($this->lang->line('EANUPC'));echo "</td><td>";echo form_input('code',$srow->upc_ean_code,'id=code' ); echo "</td></tr>";

   echo form_hidden('guid',$srow->guid);
   echo "<tr><td>";echo form_label($this->lang->line('code'));echo "</td><td>";?> <input value="<?php echo $srow->code ?>" disabled> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('description'));echo "</td><td>";?> <input value="<?php echo $srow->description ?>" disabled> <?php echo "</td></tr>";
   echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
    } 
}
?>
