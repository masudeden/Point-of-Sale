<?php
echo form_open('taxes_ci/add_new_tax_area');
echo "<table>";
echo "<tr><td>";echo form_label($this->lang->line('tax_area'));echo "</td><td>"; echo form_input('area',set_value('area'),'id=area autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
echo form_close();
echo "</table>";
echo validation_errors();
?>
