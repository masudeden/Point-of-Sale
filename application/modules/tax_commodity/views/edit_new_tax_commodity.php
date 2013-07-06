<?php
echo form_open('tax_commodity/update_tax_commodity');
echo "<table>";
foreach($c_row as $crow){
echo form_hidden('guid',$crow->guid);
echo "<tr><td>";echo form_label($this->lang->line('tCode'));echo "</td><td>"; echo form_input('Code',$crow->code,'id=Code autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tdescription'));echo "</td><td>"; echo form_input('Description',$crow->description,'id=Description autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tschedule'));echo "</td><td>"; echo form_input('Schedule',$crow->schedule,'id=Schedule autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tpart'));echo "</td><td>"; echo form_input('Part',$crow->part,'id=Part autofocus');echo "</td></tr>";

echo "<tr><td>";echo form_label($this->lang->line('tax_area'));echo "</td>
    <td>"; echo "<select name=tax_area>"; foreach ($area as $tarea){ if($crow->tax_area==$tarea->guid){?>
<option value="<?php echo $tarea->id; ?>" selected="selected" >
    <?php echo $tarea->name; ?></option> <?php }else{ ?><option value="<?php echo $tarea->guid; ?>" ><?php echo $tarea->name; ?></option> <?php }} echo "</select>"; echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tax'));echo "</td><td>"; 
echo "<select name=tax_value>"; foreach ($tax as $ttax){
    foreach ($tax_t as $type){
         if($type->guid==$ttax->type){
             
         
    if($crow->tax==$ttax->guid) {
        ?><option value="<?php echo $ttax->guid; ?>" selected="selected">
            <?php echo $ttax->value."%-".$type->type; ?>
        </option><?php }else{ ?><option value="<?php echo $ttax->guid; ?>">
<?php echo $ttax->value."%-".$type->type; ?></option> <?php }} }} echo "</select>"; echo "</td></tr>";

echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
}
echo form_close();
echo "</table>";
echo validation_errors();
?>
