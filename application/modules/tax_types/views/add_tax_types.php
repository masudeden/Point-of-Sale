<?php
echo form_open('tax_types/add_new_tax_type');
echo "<table>";
echo "<tr><td>";echo form_label($this->lang->line('tax_type'));echo "</td><td>"; echo form_input('name',set_value('name'),'id=name autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
echo form_close();
echo "</table>";
echo validation_errors();
?>
