<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!isset($_SESSION['Uid'])){
    redirect('userlogin');
}else{ 
echo form_open('home/home_main');
?><h1>POS HOME</h1><td><?php echo form_submit('logout',$this->lang->line('logout'));?></td>
<table><tr><td ><?php echo form_label($this->lang->line('pos_users')) ?></td><td><?php echo form_label($this->lang->line('item')) ?></td><td><?php echo form_label($this->lang->line('tax')) ?></td><td><?php echo form_label($this->lang->line('customers')) ?></td><td><?php echo form_label($this->lang->line('Suppliers')) ?></td><td><?php echo form_label($this->lang->line('receiving')) ?></td><td><?php if($_SESSION['Setting']['Depart']==1){ echo form_label($this->lang->line('user_groups')); }?></td><td><?php if($_SESSION['Setting']['Branch']==1)  { echo form_label($this->lang->line('branch')); }?></td>
        <td><?php echo form_label($this->lang->line('sales')) ?></td><td><?php echo form_label($this->lang->line('receiving_item')) ?></td><td><?php echo form_label('Gifts ') ?></td></tr>
    <tr><td><?php echo form_submit('pos_users',$this->lang->line('pos_users'))?></td><td><?php echo form_submit('Items',$this->lang->line('item'));?></td><td><?php echo form_submit('taxes',$this->lang->line('tax'));?></td><td><?php echo form_submit('customers',$this->lang->line('customers'))?></td><td><?php echo form_submit('suppliers',$this->lang->line('Suppliers'))?></td>
        <td><?php echo form_submit('receiving',$this->lang->line('purchase_order')) ?></td>
        <td><?php if($_SESSION['Setting']['Depart']==1){ echo form_submit('user_groups',$this->lang->line('user_groups'));}?></td>
        <td><?php if($_SESSION['Setting']['Branch']==1) { echo form_submit('branch',$this->lang->line('branch')); }?></td>
        <td><?php echo form_submit('sales',$this->lang->line('sales'))?></td><td><?php echo form_submit('stock',$this->lang->line('receiving_item')) ?></td><td><?php echo form_submit('Gifts','Gifts') ?></td></tr>
    <tr><td></td><td><?php echo form_submit('brand',$this->lang->line('brands'))?></td><td><?php echo form_submit('tax_area',$this->lang->line('tax_area'));?></td><td><?php echo form_submit('customer_cate',$this->lang->line('customer_cate'))?></td><td><?php echo form_submit('supplier_items',$this->lang->line('supplier_items'))?></td></tr>
     <tr><td></td><td><?php echo form_submit('item_setting',$this->lang->line('item_setting'))?></td><td><?php echo form_submit('commodity',$this->lang->line('commodity'));?></td></tr>
     <tr><td></td><td><?php echo form_submit('categorys',$this->lang->line('category')) ?> </td><td><?php echo form_submit('tax_types',$this->lang->line('tax_type'));?></td></tr>
     <tr><td></td><td><?php echo form_submit('item_code',$this->lang->line('EANUPC')) ?> </td></tr>
</table>
<?php

echo form_close();
}
?>
