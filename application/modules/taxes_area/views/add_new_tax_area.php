<?php
echo form_open('taxes_area/add_new_tax_area');
echo "<table>";
echo "<tr><td>";echo form_label($this->lang->line('tax_area'));echo "</td><td>"; echo form_input('tax_area',set_value('tax_area'),'id=tax_area autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
echo form_close();
echo "</table>";
echo validation_errors();
?>
