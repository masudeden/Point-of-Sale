<?php
echo form_open('purchase_order/purchase_order_magement');
echo "<table>";
if($count>0){$i=0;
if($_SESSION['Posnic_User']=='admin'){
    
    echo "<tr><td>SL NO</td><td></td><td>PO No</td><td>companny</td><td>Total Amount</td></tr>";
    foreach ($row as $prow){
       
    echo "<tr><td>".++$i."</td><td>";?>
<input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" />
    <?php echo "</td><td>$prow->po_no</td><td> ";
    foreach ($sup as $isup){ if($prow->supplier_id==$isup->guid) echo $isup->company_name;
    } echo "</td><td> $prow->total_amt</td><td>"?>
<a href="<?php echo base_url()?>index.php/purchase_order/edit_purchase_order/<?php echo $prow->guid ?>">Edit</a>
  <?php
   if($prow->active_status==1){?>
<a href="<?php echo base_url()?>index.php/purchase_order/restore_purchase_order/<?php echo $prow->guid ?>">
    <?php echo $this->lang->line('restore') ?></a> <?php } echo  "</td><td>"; ?>
<a href="<?php echo base_url()?>index.php/purchase_order/delete/<?php echo $prow->guid ?>">
    <?php echo $this->lang->line('delete') ?></a> <?php "</td>";
        
    }
    echo "</table>";

   
}else{
       echo "<tr><td>SL NO</td><td></td><td>PO No</td><td>companny</td><td>Total Amount</td></tr>";
    foreach ($row as $prow){
       
    echo "<tr><td>".++$i."</td><td>";?>
<input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" />
    <?php echo "</td><td>$prow->po_no</td><td> ";
    foreach ($sup as $isup){ if($prow->supplier_id==$isup->guid) echo $isup->company_name;
    } echo "</td><td> $prow->total_amt</td><td>"?>
<a href="<?php echo base_url()?>index.php/purchase_order/edit_purchase_order/<?php echo $prow->guid ?>">Edit</a>
 <?php  echo  "</td><td>"; ?>
<a href="<?php echo base_url()?>index.php/purchase_order/delete/<?php echo $prow->guid ?>">
    <?php echo $this->lang->line('delete') ?></a> <?php "</td>";
        
    }
    echo "</table>";
}  
echo form_submit('delete',$this->lang->line('delete'));
}else{
  
} 

echo form_submit('add',$this->lang->line('add'));echo form_submit('cancel',$this->lang->line('back_to_home'));
?>
