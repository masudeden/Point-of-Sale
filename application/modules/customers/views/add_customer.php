<?php  ?>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
$(function() {
$( "#date_start_picker" ).datepicker();
$( "#date_end_picker" ).datepicker();
});

</script>
<?php 
 if($_SESSION['customers_per']['add']==1){
     echo form_open('customers/add_new_customer');
     echo "<table>";
     echo "<tr><td>"; echo form_label($this->lang->line('title_of_customer'));echo "</td><td>";?>
<select name='tittle'>
    <option value="Mr">Mr</option>
    <option value="Dr">Dr</option>
    <option value="Ms">Ms</option>
    <option value="Mrs">Mrs</option>
    <option value="M/s">M/s</option>
</select><?php echo "</td></tr>";
     
     
     
     echo "<tr><td>"; echo form_label($this->lang->line('first_name'));echo "</td><td>";echo form_input('first_name',set_value('first_name'),'id="first_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('last_name'));echo "</td><td>";echo form_input('last_name',set_value('last_name'),'id="last_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address1'));echo "</td><td>";echo form_input('address1',set_value('address1'),'id="address1" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address2'));echo "</td><td>";echo form_input('address2',set_value('address2'),'id="address2" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('birthday'));echo "</td><td>";echo form_input('birthday',set_value('birthday'),'id="date_start_picker" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('Marragedate'));echo "</td><td>";echo form_input('Marragedate',set_value('Marragedate'),'id="date_end_picker" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('city'));echo "</td><td>";echo form_input('city',set_value('city'),'id="city" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('state'));echo "</td><td>";echo form_input('state',set_value('state'),'id="state" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('zip'));echo "</td><td>";echo form_input('zip',set_value('zip'),'id="zip" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('country'));echo "</td><td>";echo form_input('country',set_value('country'),'id="country" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('phone'));echo "</td><td>";echo form_input('phone',set_value('phone'),'id="first_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('email'));echo "</td><td>";echo form_input('email',set_value('email'),'id="email" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('company'));echo "</td><td>";echo form_input('company',set_value('company'),'id="company" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('website'));echo "</td><td>";echo form_input('website',set_value('website'),'id="website" autofocus');echo "</td></tr>";
    
     echo "<tr><td>"; echo form_label($this->lang->line('comments'));echo "</td><td>";echo form_input('comments',set_value('comments'),'id="comments" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('customer_cate'));echo "</td><td>";?><select name="cate_id"><?php foreach ($row as $crow){?><option value="<?php echo $crow->id ?>"><?php echo $crow->category_name; ?></option> <?php } ?></select> <?php echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('payment'));echo "</td><td>";?><select name="payment"><?php foreach ($pay as $prow){?><option value="<?php echo $prow->id ?>"><?php echo $prow->type; ?></option> <?php } ?></select> <?php echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('Credit Days'));echo "</td><td>";echo form_input('Credit_Days',0,'id="cst" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('Credit Limit'));echo "</td><td>";echo form_input('Credit Limit',0,'id="Credit Limit" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('Monthly Credit Balance'));echo "</td><td>";echo form_input('Monthly_Credit_Balance',0,'id="Monthly Credit Balance" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('bank_name'));echo "</td><td>";echo form_input('bank_name',set_value('bank_name'),'id="bank_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('bank_location'));echo "</td><td>";echo form_input('bank_location',set_value('bank_location'),'id="bank_location" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('account_no'));echo "</td><td>";echo form_input('account',set_value('account'),'id="account" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('cst'));echo "</td><td>";echo form_input('cst',set_value('cst'),'id="cst" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('gst'));echo "</td><td>";echo form_input('gst',set_value('gst'),'id="gst" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('tax_no'));echo "</td><td>";echo form_input('tax_no',set_value('tax_no'),'id="tax_no" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
     echo "</table>";
     echo form_close();
 }else{
     redirect('home');
 }
 echo validation_errors();
?>
