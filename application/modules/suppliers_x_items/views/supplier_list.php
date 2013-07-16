<?php
echo form_open('suppliers_x_items/supplier_magement');
echo "<table>";
if($count>0){$i=0;
    
    echo "<tr><td>SL NO</td><td></td><td>Name</td><td>companny</td><td>Phone</td></tr>";
    foreach ($row as $prow){
        $status=1;
        foreach ($sup as $su_row){
            if($prow->guid==$su_row->supplier_id){
        echo "<tr><td>".++$i."</td><td>";?> <input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" /><?php echo "</td><td>$prow->first_name</td><td>$prow->company_name</td><td> $prow->phone</td><td>"?><a href="<?php echo base_url()?>index.php/suppliers_x_items/add_items/<?php echo $prow->guid ?>">Edit Items</a> <?php echo "</td><td>"; if($su_row->active==1){?><a href="<?php echo base_url()?>index.php/suppliers_x_items/active_supplier/<?php echo $prow->guid ?>"><?php echo $this->lang->line('active') ?></a> <?php }else{ ?><a href="<?php echo base_url()?>index.php/suppliers_x_items/deactive_supplier/<?php echo $prow->guid ?>"><?php echo $this->lang->line('deactive') ?></a> <?php  }  echo  "</td></tr>";
        $status=0;
        break;
            }
        }  
        if($status==1){
    echo "<tr><td>".++$i."</td><td>";?> <input type="checkbox" name="posnic[]" value="<?php echo $prow->guid ?>" /><?php echo "</td><td>$prow->first_name</td><td>$prow->company_name</td><td> $prow->phone</td><td>"?><a href="<?php echo base_url()?>index.php/suppliers_x_items/add_items/<?php echo $prow->guid ?>">Add Items</a> <?php   echo  "</td></tr>";
        }
    }
    echo "</table>";
    echo form_submit('active',$this->lang->line('active'));
    echo form_submit('deactive',$this->lang->line('deactive'));

    

}

echo form_submit('cancel',$this->lang->line('back_to_home'));
?>
