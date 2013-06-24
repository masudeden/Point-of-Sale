<?php
echo form_open('customers_payment_type/add');

echo form_label($this->lang->line('paymenent_type'));
echo form_input('type',set_value('type'),'id=type autofocus');

echo "<br>";
echo form_submit('save',$this->lang->line('save'));
echo form_submit('cancel',$this->lang->line('cancel'));
echo form_close();
?>
