<?php
echo "<table>";
echo form_open('items_setting/bult_update');

    echo form_hidden('id',$row);
   echo "<tr><td>";echo form_label($this->lang->line('min_qty'));echo "</td><td>";echo form_input('min_qty',0,'id=min_qty' ); echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('max_qty'));echo "</td><td>";echo form_input('max_qty',0 ,'id=min_qty' ); echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('sales'));echo "</td><td>";?><input type="checkbox" name="sale" checked <?php echo set_checkbox('sale', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('salses_return'));echo "</td><td>";?><input type="checkbox" name="salses_return"  checked<?php echo set_checkbox('salses_return', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('purchase'));echo "</td><td>";?><input type="checkbox" name="purchase"  checked<?php echo set_checkbox('purchase', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('purchase_return'));echo "</td><td>";?><input type="checkbox" name="purchase_return"  checked<?php echo set_checkbox('purchase_return', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('allow_negative'));echo "</td><td>";?><input type="checkbox" name="allow_negative"  checked<?php echo set_checkbox('allow_negative', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('tax_Inclusive'));echo "</td><td>";?><select name="tax"> <option value="1"  >YES</option> <option value="0" selected>NO</option></select><?php echo "</td></tr>";
   echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
    
echo form_close();
echo "</table>";
echo validation_errors();
   ?>
