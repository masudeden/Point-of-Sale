<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />


<?php echo form_open('user_groupsCI/update_user_groups_permission') ;?>
<table><tr><td>            
    <?php foreach ($row as $drow){
      echo form_label($drow->dep_name);  echo form_hidden('id',$drow->id);  }?></td>
    </tr>
</table>
<br><section class="main">
<table border="1"><tr><td>
<table>
<tr><td><label><?php echo $this->lang->line('item_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="item_read" value="0001" <?php if($item%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></div></td>
</tr>
<tr><td><label><?php echo $this->lang->line('item_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="item_add" value="0010" <?php if($item/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('item_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="item_edit" value="0100" <?php if($item/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('item_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="item_delete" value="1000" <?php if($item/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table></td><td>
<table >  
<tr><td><label><?php echo $this->lang->line('user_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="user_read" value="0001" <?php if($user%10!=0){?> checked="checked" <?php } ?> ><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('user_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="user_add"  value="0010" <?php if($user/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('user_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="user_edit" value="0100" <?php if($user/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('user_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="user_delete" value="1000" <?php if($user/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table></td><td>
<table >
<tr><td><label><?php echo $this->lang->line('branch_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="branch_read" value="0001" <?php if($branch%10!=0){?> checked="checked" <?php } ?> ><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('branch_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="branch_add" value="0010" <?php if($branch/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('branch_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="branch_edit" value="0100" <?php if($branch/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('branch_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="branch_delete" value="1000"<?php if($branch/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table></td><td>
<table >
<tr><td><label><?php echo $this->lang->line('depa_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="depa_read" value="0001" <?php if($depart%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('depa_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="depa_add" value="0010"<?php if($depart/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('depa_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="depa_edit" value="0100" <?php if($depart/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('depa_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox"  name="depa_delete" value="1000"<?php if($depart/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table></td></tr><tr><td>
    <table>
<tr><td><label><?php echo $this->lang->line('supplier_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="sup_read" value="0001" <?php if($supplier%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></div></td>
</tr>
<tr><td><label><?php echo $this->lang->line('supplier_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="sup_add" value="0010" <?php if($supplier/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('supplier_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="sup_edit" value="0100" <?php if($supplier/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('supplier_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="sup_delete" value="1000" <?php if($supplier/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table>
</td>
    
    <td>
    <table>
<tr><td><label><?php echo $this->lang->line('item_kites_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="itemkit_read" value="0001" <?php if($supplier%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></div></td>
</tr>
<tr><td><label><?php echo $this->lang->line('item_kites_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="itemkit_add" value="0010" <?php if($supplier/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('item_kites_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="itemkit_edit" value="0100" <?php if($supplier/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('item_kites_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="itemkit_delete" value="1000" <?php if($supplier/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table>
</td>
<td>
    <table>
<tr><td><label><?php echo $this->lang->line('customer_read'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="cust_read" value="0001" <?php if($customer%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></div></td>
</tr>
<tr><td><label><?php echo $this->lang->line('customer_add'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="cust_add" value="0010" <?php if($customer/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('customer_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="cust_edit" value="0100" <?php if($customer/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('customer_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="cust_delete" value="1000" <?php if($customer/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table>
</td>
<td>
    <table>
<tr><td><label><?php echo $this->lang->line('do_sales'); ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="do_sales" value="0001" <?php if($sales%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></div></td>
</tr>
<tr><td><label><?php echo $this->lang->line('sales_return'); ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="retun_sales" value="0010" <?php if($sales/10%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('sales_edit');?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="sales_edit" value="0100" <?php if($sales/100%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line('sales_delete');  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="sales_delete" value="1000" <?php if($sales/1000%10!=0){?> checked="checked" <?php } ?>><label><i></i></label></td>
</tr>
</table>
</td>
    
    </tr>
</table></section>

<?php echo form_submit('update',$this->lang->line('save'));echo form_submit('cancel',$this->lang->line('cancel'));
echo form_close() ?>
<?php echo validation_errors(); ?>