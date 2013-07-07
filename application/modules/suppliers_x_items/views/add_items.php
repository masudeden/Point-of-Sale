
  <body>
     
	 
      <div style="margin-left:100px;">
	  <?php echo form_open('supplier_vs_items/save_items'); echo form_hidden('id',$supplier_id) ?>
           <tr><td> <?php echo form_submit('save',$this->lang->line('save')); ?> <?php echo form_submit('cancel',$this->lang->line('cancel')); ?></td></tr>
           <?php if(count($row)>0){ ?> <input type="text" id="estado_autocomplete" name="estado" autocomplete="off"  /><?php ?>
	<tr><td> <label>Item Code</label> </td><td> Description  </td><td><label>Quty</label> </td><td><label>Cost</label></td><td><label>selling price</label></td><td><label>Discount</label></td><td><label>Deactivate</label></td><td><label>Remove</label></td></tr>
           
            <?php } if(count($row)>0){
                
                foreach ($row as $irow){ 
                    foreach ($item as $itrow){
                        if($itrow->id==$irow->item_id){
                            
                     
                    ?>
        
          <div id="<?php echo $irow->item_id ?>"><ul   class="data"  >
                  <td><input type="hidden" name="itemsid[]" value="<?php echo $irow->item_id; ?>"> 
                    <input type="text" value="<?php echo $itrow->code; ?>" disabled style="width: 80px;" > </li>
                  <li ><input type="text" value="<?php echo $itrow->description; ?>" disabled style="width: 80px;" > </li>
                  <li ><input type="text" name="quty[]" title="0" id="<?php echo $irow->item_id."5"; ?>" value="0" onkeyup="removeTextTag(event,<?php echo $irow->item_id."5";?>)" style="width: 80px;" > </li>
                  <li ><input type="text" value="<?php echo $irow->cost;?> "title="<?php echo $irow->cost;?>" id="<?php echo $irow->item_id."6"; ?>" name="cost[]" onkeyup="removeTextTag(event,<?php echo $irow->item_id."6";?>)" style="width: 80px;" > </li>
                  <li ><input type="text" value="<?php echo $irow->price;?>"  name="price[]" title="<?php echo $irow->price; ?>" id="<?php echo $irow->item_id."7"; ?>" onkeyup="removeTextTag(event,<?php echo $irow->item_id."7"; ?>)" style="width: 80px;"  > </li>
                  <li ><input type="text" name="disco[]" value="0" title="0" id="<?php echo $irow->item_id."8"; ?>"  onkeyup="removeTextTag(event,<?php echo $irow->item_id."8"; ?>)" style="width: 80px;" ></li>
                  <li ><input type="checkbox" name="<?php echo $irow->item_id ?>" <?php if($irow->active_status==1){?> checked<?php } ?> <?php echo set_checkbox($irow->item_id, '1'); ?>></li>
                  <li > <input type="button" value="X" name="send"  onclick="get_mag(<?php echo $irow->item_id; ?>)" > <input type=hidden name=items[] value="+item+"></li></ul></div>        
              <?php    }
                    }}}else{  ?>
                 <input type="text" id="estado_autocomplete" name="estado" autocomplete="off"  />
             <?php }?>
               
           <div id="yourTableId" border="1" class="myrow" >
              
          
         <?php echo form_close();?>
      </div>
      </div>
     
    
  </body>
</html>