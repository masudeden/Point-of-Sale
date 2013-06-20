<?php
echo form_open('taxes_ci/taxes');
echo form_submit('taxes',$this->lang->line('tax'));
echo form_submit('tax_area',$this->lang->line('tax_area'));
echo form_submit('commodity',$this->lang->line('commodity'));
echo form_submit('tax_types',$this->lang->line('tax_type'));
echo form_submit('cancel',$this->lang->line('cancel'));

echo form_close();
?>
