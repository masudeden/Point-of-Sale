<?php
 if($_SESSION['suppliers_per']['edit']==1){
     echo form_open('suppliers/update_supplier');
     echo "<table>";
     foreach ($row as $c_row){ echo form_hidden('id',$c_row->id);
     echo "<tr><td>"; echo form_label($this->lang->line('first_name'));echo "</td><td>";echo form_input('first_name',$c_row->first_name,'id="first_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('last_name'));echo "</td><td>";echo form_input('last_name',$c_row->last_name,'id="last_name" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address1'));echo "</td><td>";echo form_input('address1',$c_row->address1,'id="address1" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('address2'));echo "</td><td>";echo form_input('address2',$c_row->address2,'id="address2" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('city'));echo "</td><td>";echo form_input('city',$c_row->city,'id="city" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('state'));echo "</td><td>";echo form_input('state',$c_row->state,'id="state" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('zip'));echo "</td><td>";echo form_input('zip',$c_row->zip,'id="zip" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('country'));echo "</td><td>";echo form_input('country',$c_row->country,'id="country" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('phone'));echo "</td><td>";echo form_input('phone',$c_row->phone,'id="phone" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('email'));echo "</td><td>";echo form_input('email',$c_row->email,'id="email" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('company'));echo "</td><td>";echo form_input('company',$c_row->company_name,'id="company" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('website'));echo "</td><td>";echo form_input('website',$c_row->website,'id="website" autofocus');echo "</td></tr>";
    
     echo "<tr><td>"; echo form_label($this->lang->line('comments'));echo "</td><td>";echo form_textarea('comments',$c_row->comments,'id="comments" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('account_no'));echo "</td><td>";echo form_input('account',$c_row->account_number,'id="account" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
     echo "</table>";
     }
     echo form_close();
 }else{
     redirect('home');
 }
 echo validation_errors();
?>
