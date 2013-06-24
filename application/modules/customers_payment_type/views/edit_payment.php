<?php
echo form_open('customers_payment_type/update');
foreach ($row as $prow){
echo form_label($this->lang->line('paymenent_type'));
echo form_input('type',$prow->type,'id=type autofocus');
echo form_hidden('id',$prow->guid);
}
echo "<br>";
echo form_submit('update',$this->lang->line('update'));
echo form_submit('cancel',$this->lang->line('cancel'));
echo form_close();
?>
