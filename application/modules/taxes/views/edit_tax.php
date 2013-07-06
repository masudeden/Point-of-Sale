<?php
echo form_open('taxes_ci/update_tax');
echo "<table>";
foreach ($trow as $tax1){
echo form_hidden('id',$tax1->id);
echo "<tr><td>";echo form_label($this->lang->line('tax'));echo "</td><td>"; echo form_input('rate',$tax1->value,'id=rate autofocus');echo "</td></tr>";
echo "<tr><td>";echo form_label($this->lang->line('tax'));echo "</td><td>";?>
    <select name=type> 
        <?php foreach ($row as $tow){ 
            
    if($tax1->type==$tow->type){ ?>

<option value="<?php echo $tow->id ?>" selected="selected"><?php echo $tow->type?></option>    
    <?php }else{ ?>
        <option value="<?php echo $tow->id ?>" ><?php echo $tow->type?></option>  
    <?php }
        }
echo "</select></td></tr>"    ;

}
echo "<tr><td>";echo form_submit('save',$this->lang->line('save'));echo "</td><td>";echo form_submit('cancel',$this->lang->line('cancel'));echo "</td></tr>";
echo form_close();
echo "</table>";
echo validation_errors();
?>
