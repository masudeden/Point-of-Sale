<?php  if($_SESSION['items_per']['add']==1){ ?>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
$(function() {
$( "#date_start_picker" ).datepicker();
$( "#date_end_picker" ).datepicker();
});

</script><?php

     echo form_open('items/add_new_item');
     echo "<table>";
     echo "<tr><td>"; echo form_label($this->lang->line('code'));echo "</td><td>";echo form_input('code',set_value('code'),'id="code" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('barcode'));echo "</td><td>";echo form_input('barcode',set_value('barcode'),'id="barcode" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('item_name'));echo "</td><td>";echo form_input('item_name',set_value('item_name'),'id="address1" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('description'));echo "</td><td>";echo form_input('description',set_value('description'),'id="description" autofocusm ');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('cost_price'));echo "</td><td>";echo form_input('cost_price',set_value('cost_price'),'id="cost_price" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('mrf_price'));echo "</td><td>";echo form_input('mrp_price',set_value('mrf_price'),'id="mrf_price" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('selling_price'));echo "</td><td>";echo form_input('selling_price',set_value('selling_price'),'id="salling_price" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('discount_amount'));echo "</td><td>";echo form_input('discount_amount',set_value('discount_amount'),'id="discount_amount" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('start_date'));echo "</td><td>";echo form_input('start_date',set_value('start_date'),'id="date_start_picker" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('end_date'));echo "</td><td>";echo form_input('end_date',set_value('end_date'),'id="date_end_picker" autofocus');echo "</td></tr>";
     echo "<tr><td>"; echo form_label($this->lang->line('location'));echo "</td><td>";echo form_input('location',set_value('location'),'id="location" autofocus');echo "</td></tr>";
    if($_SESSION['items_category']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('cate_name'));echo "</td><td>"; ?><select  style="width:150" name="category"><?php    foreach ($crow as $irow){ ?><option name="<?php echo $irow->guid  ?> " value="<?php echo $irow->guid  ?>"> <?php echo $irow->category_name  ?> </option><?php }echo "</select>";?> <?php   echo "</td></tr>";
    }
    if($_SESSION['suppliers']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('supplier'));echo "</td><td>";  if(count($srow)>0 ){ ?><select style="width:150" name="supplier"  ><?php foreach ($srow as $cs_row){      ?><option name="<?php echo $cs_row->guid  ?>" value="<?php echo $cs_row->guid  ?>"> <?php echo $cs_row->company_name  ?> </option><?php }echo "</select>";?> <?php }  echo "</td></tr>";
    }
    if($_SESSION['brands']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('brands'));echo "</td><td>"; echo "<select name=brand >"; foreach ($brands as $ibrand){ ?><option value="<?php echo $ibrand->guid ?>"><?php echo $ibrand->name?></option> <?php } echo "</select>"; echo "</td></tr>";
    }
    if($_SESSION['taxes_area']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('tax_area'));echo "</td><td>"; echo "<select name=area >";foreach ($area as $tarea){ ?><option value="<?php echo $tarea->guid ?>"><?php echo $tarea->name ?></option> <?php } echo "</select>"; echo "</td></tr>";
    }
    if($_SESSION['taxes']=='On'){
     echo "<tr><td>"; echo form_label($this->lang->line('tax'));echo "</td><td>"; echo "<select name=tax >";foreach ($taxes as $ttax){    foreach ($tax_type as $type){  if($ttax->type==$type->guid){ ?><option value="<?php echo $ttax->guid ?>"><?php echo $ttax->value."%-".$type->type ?></option> <?php }}} echo "</select>"; echo "</td></tr>";   
    }
    echo "<tr><td>"; echo form_label($this->lang->line('tax_Inclusive'));echo "</td><td>"; echo "<select name=tax_in >";?><option value="1">Yes</option> <option value="1">No</option> <?php  echo "</select>"; echo "</td></tr>";
     
     echo "<tr><td>"; echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel')); echo "</td></tr>";
   echo "</table>";
     echo form_close();
 }else{
     redirect('home');
 }
 echo validation_errors();
?>