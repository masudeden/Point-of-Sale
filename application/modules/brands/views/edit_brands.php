<?php
echo form_open('brands/update_brands');
echo "<table>";
foreach ($row as $tax1){
echo form_hidden('id',$tax1->id);
echo "<tr><td>";echo form_label($this->lang->line('brands_name'));echo "</td><td>"; echo form_input('name',$tax1->name,'id=name autofocus');echo "</td></tr>";

}
echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
echo form_close();
echo "</table>";
echo validation_errors();
?>
