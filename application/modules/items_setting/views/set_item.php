<?php
echo "<table>";
echo form_open('items_setting/set');

   echo form_hidden('guid',$guid);
   echo "<tr><td>";echo form_label($this->lang->line('min_qty'));echo "</td><td>";echo form_input('min_qty',set_value('min_qty'),'id=min_qty' ); echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('max_qty'));echo "</td><td>";echo form_input('max_qty',set_value('max_qty'),'id=min_qty' ); echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('sales'));echo "</td><td>";?><input type="checkbox" name="sale" > <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('salses_return'));echo "</td><td>";?><input type="checkbox" name="salses_return" > <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('purchase'));echo "</td><td>";?><input type="checkbox" name="purchase"> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('purchase_return'));echo "</td><td>";?><input type="checkbox" name="purchase_return" > <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('allow_negative'));echo "</td><td>";?><input type="checkbox" name="allow_negative"> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('tax_Inclusive'));echo "</td><td>";?><select name="tax"> <option value="1" >NO</option></select><?php echo "</td></tr>";
   echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
    
echo form_close();
echo "</table>";
echo validation_errors();
   ?>
