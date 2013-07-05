<?php
echo "<table>";
echo form_open('items_setting/set');
foreach ($row as $srow){
    echo form_hidden('guid',$srow->guid);
   echo "<tr><td>";echo form_label($this->lang->line('min_qty'));echo "</td><td>";echo form_input('min_qty',$srow->min_q,'id=min_qty' ); echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('max_qty'));echo "</td><td>";echo form_input('max_qty',$srow->max_q,'id=min_qty' ); echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('sales'));echo "</td><td>";?><input type="checkbox" name="sale" <?php if($srow->sales==1){?> checked<?php } ?> <?php echo set_checkbox('sale', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('salses_return'));echo "</td><td>";?><input type="checkbox" name="salses_return" <?php if($srow->salses_return==1){?> checked<?php } ?><?php echo set_checkbox('salses_return', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('purchase'));echo "</td><td>";?><input type="checkbox" name="purchase" <?php if($srow->purchase ==1){?> checked<?php } ?> <?php echo set_checkbox('purchase', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('purchase_return'));echo "</td><td>";?><input type="checkbox" name="purchase_return" <?php if($srow->purchase_return==1){?> checked<?php } ?><?php echo set_checkbox('purchase_return', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('allow_negative'));echo "</td><td>";?><input type="checkbox" name="allow_negative" <?php if($srow->allow_negative==1){?> checked<?php } ?><?php echo set_checkbox('allow_negative', '1'); ?>> <?php echo "</td></tr>";
   echo "<tr><td>";echo form_label($this->lang->line('tax_Inclusive'));echo "</td><td>";?><select name="tax"> <option value="1" <?php if($srow->tax_inclusive ==1){?> selected<?php } ?> >YES</option> <option value="0" <?php if($srow->tax_inclusive ==0){?> selected<?php } ?> >NO</option></select><?php echo "</td></tr>";
   echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
    }
echo form_close();
echo "</table>";
echo validation_errors();
   ?>
