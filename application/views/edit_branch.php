<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  if($this->session->userdata['Setting']['Branch']==1){if($_SESSION['branchCI_per']['edit']==1){

foreach($row as $brow){?>
<table><?php echo form_open('branchCI/update_branch_details'); echo form_hidden('id',$brow->id)?>
    
    <tr><td><?php echo form_label($this->lang->line('branch_name')) ?></td><td><?php echo form_input('name',$brow->store_name) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('city')) ?></td><td><?php echo form_input('city',$brow->store_city  ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('state')) ?></td><td><?php echo form_input('state',$brow->store_state ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('zip')) ?></td><td><?php echo form_input('zip',$brow->store_zip  ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('country')) ?></td><td><?php echo form_input('country',$brow->store_country  ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('website')) ?></td><td><?php echo form_input('website',$brow->store_website ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('phone')) ?></td><td><?php echo form_input('phone',$brow->store_phone ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('email')) ?></td><td><?php echo form_input('email',$brow->store_email  ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('fax')) ?></td><td><?php echo form_input('fax',$brow->store_fax  ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('tax1')) ?></td><td><?php echo form_input('tax1',$brow->store_tax1 ) ?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('tax2')) ?></td><td><?php echo form_input('tax2',$brow->store_tax2 ) ?></td></tr>
    <tr><td><?php echo form_submit('update',$this->lang->line('update')) ?></td><td><?php echo form_submit('cancel',$this->lang->line('cancel')) ?></td></tr>    
<?php echo form_close(); ?><?php echo validation_errors(); ?>
</table>    
<?php }
}else{
    redirect('branchCI');
}
}else{
    redirect('home');
}
?>
