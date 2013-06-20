<?php
echo form_open('taxes_ci/update_tax_commodity');
echo "<table>";
foreach($row as $crow){
echo form_hidden('id',$crow->id);
echo "<tr><td>";echo form_label($this->lang->line('tCode'));echo "</td><td>"; echo form_input('Code',$crow->code,'id=Code autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tdescription'));echo "</td><td>"; echo form_input('Description',$crow->description,'id=Description autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tschedule'));echo "</td><td>"; echo form_input('Schedule',$crow->schedule,'id=Schedule autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tpart'));echo "</td><td>"; echo form_input('Part',$crow->part,'id=Part autofocus');echo "</td></tr>";

echo "<tr><td>";echo form_label($this->lang->line('tax_area'));echo "</td>
    <td>"; echo "<select name=tax_area>"; foreach ($area as $tarea){ if($crow->tax_area==$tarea->id){?><option value="<?php echo $tarea->id; ?>" selected="selected" ><?php echo $tarea->name; ?></option> <?php }else{ ?><option value="<?php echo $tarea->id; ?>" ><?php echo $tarea->name; ?></option> <?php }} echo "</select>"; echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tax'));echo "</td><td>"; 
echo "<select name=tax_value>"; foreach ($tax as $ttax){ if($crow->tax==$ttax->id) { ?><option value="<?php echo $ttax->id; ?>" selected="selected"><?php echo $ttax->value."%-".$ttax->type; ?></option><?php }else{ ?><option value="<?php echo $ttax->id; ?>"><?php echo $ttax->value."%-".$ttax->type; ?></option> <?php }} echo "</select>"; echo "</td></tr>";

echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
}
echo form_close();
echo "</table>";
echo validation_errors();
?>
