<?php
echo "<table>";
echo form_open('item_code/add_code');

   echo form_hidden('guid',$row);
   echo "<tr><td>";echo form_label($this->lang->line('EANUPC'));echo "</td><td>";
   echo form_input('code',set_value('code'),'id=code' ); echo "</td></tr>";
   echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));
   echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
   
echo form_close();
?>
