<?php
echo form_open('branchCI/add_new_branch');
echo "<table>";
echo "<tr><td>";echo form_label($this->lang->line('branch_name'));echo "</td><td>";echo form_input('name',set_value('name'),'id="name" autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('city'));echo "</td><td>";echo form_input('city',set_value('city'),'id=city autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('state'));echo "</td><td>";echo form_input('state',set_value('state'),'id=state autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('zip'));echo "</td><td>";echo form_input('zip',set_value('zip'),'id=zip autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('country'));echo "</td><td>";echo form_input('country',set_value('country'),'id=country autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('website'));echo "</td><td>";echo form_input('website',set_value('website'),'id=website autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('phone'));echo "</td><td>";echo form_input('phone',set_value('phone'),'id=phone autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('fax'));echo "</td><td>";echo form_input('fax',set_value('fax'),'id=fax autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('email'));echo "</td><td>";echo form_input('email',set_value('email'),'id=email autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tax1'));echo "</td><td>";echo form_input('tax1',set_value('tax1'),'id=tax1 autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tax1'));echo "</td><td>";echo form_input('tax2',set_value('tax2'),'id=tax2 autofocus');echo "</td></tr>";
if($this->session->userdata['user_type']!=2){
echo "<tr><td>";echo form_label($this->lang->line('default_user_group'));echo "</td><td>";echo form_input('user_group',set_value('user_group'),'id="user_group" autofocus');echo "</td></tr>";
}
echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";

echo "</table>";

echo form_close();   
echo validation_errors();
?>
