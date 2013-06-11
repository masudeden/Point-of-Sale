<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

echo form_open('userlogin/login');?>
<table><tr><td>
            
<?php echo form_label($this->lang->line('user_name'));?></td><td>
<?php echo form_input('username',set_value('username'), 'id='.$this->lang->line('user_name').' autofocus')?></td></tr><tr><td>
<?php echo form_label($this->lang->line('password'));?></td><td>
<?php echo form_password('password',set_value('password'), 'id='.$this->lang->line('password').' autofocus');?></tr>
<tr><td><?php echo form_submit('login',$this->lang->line('login')) ?></td></tr>

</table>
    <?php
echo form_close();


?><?php echo validation_errors(); ?>