<?php
 if($_SESSION['Customer_per']['edit']==1){
     echo form_open('customers/update_customer');
     echo "<table>";
     foreach ($irow as $c_row){ echo form_hidden('id',$c_row->id);
     echo "<tr><td>"; echo form_label($this->lang->line('title_of_customer'));echo "</td><td>";?>
<select name='tittle'>
    <option value="Mr"<?php if($c_row->title=='Mr'){?> selected<?php } ?>>Mr</option>
    <option value="Dr"<?php if($c_row->title=='Dr'){?> selected<?php } ?>>Dr</option>
    <option value="Ms"<?php if($c_row->title=='Ms'){?> selected<?php } ?>>Ms</option>
    <option value="Mrs"<?php if($c_row->title=='Mrs'){?> selected<?php } ?>>Mrs</option>
    <option value="M/s"<?php if($c_row->title=='M/s'){?> selected<?php } ?>>M/s</option>
</select><?php echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('first_name'));echo "</td><td>";echo form_input('first_name',$c_row->first_name,'id="first_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('last_name'));echo "</td><td>";echo form_input('last_name',$c_row->last_name,'id="last_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address1'));echo "</td><td>";echo form_input('address1',$c_row->address1,'id="address1" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address2'));echo "</td><td>";echo form_input('address2',$c_row->address2,'id="address2" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('birthday'));echo "</td><td>";echo form_input('birthday',date('n/j/Y', strtotime('+0 year, +0 days',$c_row->bday )),'id="date_start_picker" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('Marragedate'));echo "</td><td>";echo form_input('Marragedate',date('n/j/Y', strtotime('+0 year, +0 days',$c_row->mday )),'id="date_end_picker" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('city'));echo "</td><td>";echo form_input('city',$c_row->city,'id="city" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('state'));echo "</td><td>";echo form_input('state',$c_row->state,'id="state" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('zip'));echo "</td><td>";echo form_input('zip',$c_row->zip,'id="zip" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('country'));echo "</td><td>";echo form_input('country',$c_row->country,'id="country" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('phone'));echo "</td><td>";echo form_input('phone',$c_row->phone,'id="phone" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('email'));echo "</td><td>";echo form_input('email',$c_row->email,'id="email" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('company'));echo "</td><td>";echo form_input('company',$c_row->company_name,'id="company" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('website'));echo "</td><td>";echo form_input('website',$c_row->website,'id="website" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('comments'));echo "</td><td>";echo form_input('comments',$c_row->comments,'id="comments" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('customer_cate'));echo "</td><td>";?><select name="cate_id"><?php foreach ($row as $crow){ if($crow->id==$c_row->category_id ){?><option value="<?php echo $crow->id ?>" selected><?php echo $crow->category_name; ?></option> <?php }else{ ?><option value="<?php echo $crow->id ?>"><?php echo $crow->category_name; ?></option> <?php }} ?></select> <?php echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('payment'));echo "</td><td>";?><select name="payment"><?php foreach ($pay as $prow){    foreach ($spay as $sp_row){ if($prow->id==$sp_row->payment_type_id ){?><option value="<?php echo $prow->id ?>" selected ><?php echo $prow->type; ?></option> <?php }else{ ?><option value="<?php echo $prow->id ?>"><?php echo $prow->type; ?></option> <?php }} } ?></select> <?php echo "</td></tr>";
 foreach ($spay as $payed){ if($payed->customer_id==$c_row->id){
     echo "<tr><td>"; echo form_label($this->lang->line('Credit Days'));echo "</td><td>";echo form_input('Credit_Days',$payed->credit_days ,'id="cst" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('Credit Limit'));echo "</td><td>";echo form_input('Credit Limit',$payed->limit ,'id="Credit Limit" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('Monthly Credit Balance'));echo "</td><td>";echo form_input('Monthly_Credit_Balance',$payed->monthly_limit ,'id="Monthly Credit Balance" autofocus');echo "</td></tr>";
 }}
     echo "<tr><td>"; echo form_label($this->lang->line('bank_name'));echo "</td><td>";echo form_input('bank_name',$c_row->bank_name,'id="bank_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('bank_location'));echo "</td><td>";echo form_input('bank_location',$c_row->bank_location,'id="bank_location" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('account_no'));echo "</td><td>";echo form_input('account',$c_row->account_number,'id="account" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('cst'));echo "</td><td>";echo form_input('cst',$c_row->cst,'id="cst" autofocus');echo "</td></tr>";
     
     echo "<tr><td>"; echo form_label($this->lang->line('gst'));echo "</td><td>";echo form_input('gst',$c_row->gst,'id="gst" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('tax_no'));echo "</td><td>";echo form_input('tax_no',$c_row->tax_no,'id="gst" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
     echo "</table>";
     }
     echo form_close();
 }else{
     redirect('home');
 }
 echo validation_errors();
?>
