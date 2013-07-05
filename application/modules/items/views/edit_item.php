<?php  if($_SESSION['items_per']['add']==1){
    ?>
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
     echo form_open('items/update_item');
     echo "<table>";
     foreach ($irow as $it_row){
         echo form_hidden('guid',$it_row->guid);
     echo "<tr><td>"; echo form_label($this->lang->line('code'));echo "</td><td>";echo form_input('code',$it_row->code,'id="code" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('barcode'));echo "</td><td>";echo form_input('barcode',$it_row->barcode,'id="barcode" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('item_name'));echo "</td><td>";echo form_input('item_name',$it_row->name,'id="address1" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('description'));echo "</td><td>";echo form_input('description',$it_row->description,'id="description" autofocusm ');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('cost_price'));echo "</td><td>";echo form_input('cost_price',$it_row->cost_price,'id="cost_price" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('landing_cost'));echo "</td><td>";echo form_input('landing_cost',$it_row->landing_cost,'id="landing_cost" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('mrf_price'));echo "</td><td>";echo form_input('mrf_price',$it_row->mrf,'id="mrf_price" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('selling_price'));echo "</td><td>";echo form_input('selling_price',$it_row->selling_price,'id="salling_price" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('discount_amount'));echo "</td><td>";echo form_input('discount_amount',$it_row->discount_amount,'id="discount_amount" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('start_date'));echo "</td><td>";?><input type="text" name="start_date" id="date_start_picker" value="<?php echo date('n/j/Y', strtotime('+0 year, +0 days',$it_row->start_date ));   ?>"/><?php echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('end_date'));echo "</td><td>";?><input type="text" name="end_date" id="date_end_picker" value="<?php echo date('n/j/Y', strtotime('+0 year, +0 days',$it_row->end_date ));   ?>"><?php echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('location'));echo "</td><td>";echo form_input('location',$it_row->location,'id="location" autofocus');echo "</td></tr>";
     if($_SESSION['items_category']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('cate_name'));echo "</td><td>"; ?><select name="category" style="width:150"><?php  foreach ($crow as $irow){ if($it_row->category_id ==$irow->id ){ ?>          <option name="<?php echo $irow->id  ?> " value="<?php echo $irow->id  ?>" selected="selected"> <?php echo $irow->category_name  ?> </option><?php      }else{?>   <option name="<?php echo $irow->id  ?> " value="<?php echo $irow->id  ?>"> <?php echo $irow->category_name  ?> </option><?php } } echo "</select>";?>  <?php  echo "</td></tr>";
     }
     if($_SESSION['suppliers']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('supplier'));echo "</td><td>"; echo "<select name=supplier>"; echo"<option value=none>None</option>"; foreach ($srow as $s_row){  ?><option value="<?php echo $s_row->guid ?>" <?php if($s_row->guid===$it_row->supplier_id){ ?>selected<?php  } ?> ><?php echo $s_row->company_name ?></option> <?php } echo "</select>"; echo "</td></tr>";
      }
     if($_SESSION['brands']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('brands'));echo "</td><td>";?><select name='brand'><?php foreach ($brands as $ibrand){ if($ibrand->id==$it_row->brand_id ){ ?><option value="<?php echo $ibrand->id ?>" selected ><?php echo $ibrand->name?></option> <?php }else{?><option value="<?php echo $ibrand->id ?>"><?php echo $ibrand->name?></option> <?php }} ?></select><?php echo "</td></tr>";
     }
     if($_SESSION['taxes_area']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('tax_area'));echo "</td><td>"; ?><select name='area'><?php foreach ($area as $tarea){ if($tarea->id==$it_row->tax_area_id ) { ?><option value="<?php echo $tarea->id ?>" selected ><?php echo $tarea->name ?></option> <?php }else {?><option value="<?php echo $tarea->id ?>"><?php echo $tarea->name ?></option> <?php }} ?></select><?php echo "</td></tr>";
     }
     if($_SESSION['taxes']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('tax'));echo "</td><td>";?><select name=tax><?php foreach ($taxes as $ttax){ if($ttax->id==$it_row->tax_id) { ?><option value="<?php echo $ttax->id ?>" selected ><?php echo $ttax->value."%-".$ttax->type ?> </option><?php }else{ ?><option value="<?php echo $ttax->id ?>"><?php echo $ttax->value."%-".$ttax->type ?></option> <?php } } ?></select><?php echo "</td></tr>";
     }
     echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
     }
     echo "</table>";
     echo form_close();
 }else{
     redirect('home');
 }
 echo validation_errors();
?>


