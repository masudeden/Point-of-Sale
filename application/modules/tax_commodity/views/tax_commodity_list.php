<?php
echo form_open('tax_commodity/tax_com');
echo "<table>";
if($count>0){$i=0;
echo $links;
if($_SESSION['Posnic_User']=='admin'){
    
     echo "<tr><td>SL NO</td><td>Code</td><td>Description </td><td>Part </td>";
    foreach ($row as $prow){
    echo "<tr><td>".++$i."</td><td>";?> <input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" /><?php echo "</td><td>$prow->code </td><td>$prow->description </td><td>$prow->part </td><td>"?><a href="<?php echo base_url()?>index.php/tax_commodity/edit_tax/<?php echo $prow->guid ?>">Edit</a> <?php echo "</td><td>"; if($prow->active==1){?><a href="<?php echo base_url()?>index.php/tax_commodity/active_tax/<?php echo $prow->guid ?>"><?php echo $this->lang->line('active') ?></a> <?php }else{ ?><a href="<?php echo base_url()?>index.php/tax_commodity/deactive_tax/<?php echo $prow->guid ?>"><?php echo $this->lang->line('deactive') ?></a> <?php  } if($prow->active_status==1){?><a href="<?php echo base_url()?>index.php/tax_commodity/restore_tax/<?php echo $prow->guid ?>"><?php echo $this->lang->line('restore') ?></a> <?php } echo  "</td><td>"; ?><a href="<?php echo base_url()?>index.php/tax_commodity/admin_delete/<?php echo $prow->guid ?>"><?php echo $this->lang->line('delete') ?></a> <?php "</td>";
    
    }
    echo "</table>";
    echo form_submit('active',$this->lang->line('active'));
    echo form_submit('deactive',$this->lang->line('deactive'));
   
}else{
    echo "<tr><td>SL NO</td><td>Code</td><td>Description </td><td>Part </td>";
    foreach ($row as $prow){
    echo "<tr><td>".++$i."</td><td>";?> <input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" /><?php echo "</td><td>$prow->code </td><td>$prow->description </td><td>$prow->part </td><td>"?><a href="<?php echo base_url()?>index.php/tax_commodity/edit_tax/<?php echo $prow->guid ?>">Edit</a> <?php echo "</td><td>"; if($prow->active==1){?><a href="<?php echo base_url()?>index.php/tax_commodity/active_tax/<?php echo $prow->guid ?>"><?php echo $this->lang->line('active') ?></a> <?php }else{ ?><a href="<?php echo base_url()?>index.php/tax_commodity/deactive_tax/<?php echo $prow->guid ?>"><?php echo $this->lang->line('deactive') ?></a> <?php  }  echo  "</td><td>"; ?><a href="<?php echo base_url()?>index.php/tax_commodity/user_delete/<?php echo $prow->guid ?>"><?php echo $this->lang->line('delete') ?></a> <?php echo "</td>";
    
    }
    echo "</table>";
    echo form_submit('active',$this->lang->line('active'));
    echo form_submit('deactive',$this->lang->line('deactive'));
}  
echo form_submit('delete',$this->lang->line('delete'));
}else{
  
} 

echo form_submit('add',$this->lang->line('add'));echo form_submit('cancel',$this->lang->line('back_to_home'));
?>
