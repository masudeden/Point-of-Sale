<?php
echo form_open('taxes_ci/add_new_tax_commodity');
echo "<table>";
echo "<tr><td>";echo form_label($this->lang->line('tCode'));echo "</td><td>"; echo form_input('Code',set_value('Code'),'id=Code autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tdescription'));echo "</td><td>"; echo form_input('Description',set_value('Description'),'id=Description autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tschedule'));echo "</td><td>"; echo form_input('Schedule',set_value('Schedule'),'id=Schedule autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tpart'));echo "</td><td>"; echo form_input('Part',set_value('Part'),'id=Part autofocus');echo "</td></tr>";

echo "<tr><td>";echo form_label($this->lang->line('tax_area'));echo "</td>
    <td>"; echo "<select name=tax_area>"; foreach ($area as $tarea){ ?><option value="<?php echo $tarea->id; ?>"><?php echo $tarea->name; ?></option> <?php } echo "</select>"; echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tax'));echo "</td><td>"; 
echo "<select name=tax_value>"; foreach ($tax as $ttax){ ?><option value="<?php echo $ttax->id; ?>"><?php echo $ttax->value."%-".$ttax->type; ?></option> <?php } echo "</select>"; echo "</td></tr>";

echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
echo form_close();
echo "</table>";
echo validation_errors();
?>
