<?php
 if($_SESSION['suppliers_per']['add']==1){
     echo form_open('suppliers/add_new_supplier');
     echo "<table>";
     echo "<tr><td>"; echo form_label($this->lang->line('first_name'));echo "</td><td>";echo form_input('first_name',set_value('first_name'),'id="first_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('last_name'));echo "</td><td>";echo form_input('last_name',set_value('last_name'),'id="last_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address1'));echo "</td><td>";echo form_input('address1',set_value('address1'),'id="address1" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address2'));echo "</td><td>";echo form_input('address2',set_value('address2'),'id="address2" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('city'));echo "</td><td>";echo form_input('city',set_value('city'),'id="city" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('state'));echo "</td><td>";echo form_input('state',set_value('state'),'id="state" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('zip'));echo "</td><td>";echo form_input('zip',set_value('zip'),'id="zip" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('country'));echo "</td><td>";echo form_input('country',set_value('country'),'id="country" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('phone'));echo "</td><td>";echo form_input('phone',set_value('phone'),'id="first_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('email'));echo "</td><td>";echo form_input('email',set_value('email'),'id="email" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('company'));echo "</td><td>";echo form_input('company',set_value('company'),'id="company" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('website'));echo "</td><td>";echo form_input('website',set_value('website'),'id="website" autofocus');echo "</td></tr>";
    
     echo "<tr><td>"; echo form_label($this->lang->line('comments'));echo "</td><td>";echo form_input('comments',set_value('comments'),'id="comments" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('account_no'));echo "</td><td>";echo form_input('account',set_value('account'),'id="account" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
     echo "</table>";
     echo form_close();
 }else{
     redirect('home');
 }
 echo validation_errors();
?>
