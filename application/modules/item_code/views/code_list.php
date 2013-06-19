<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); echo $links; 
?><table style="width: 550px">
    
<?php  echo  form_open('item_code/items_details'); 
if($count!=0){
      if($_SESSION['admin']==2){?><table >         
          <?php 
      foreach ($set as $iset){          
          foreach ($row as $erow){
        if($iset->item_id==$erow->id){
              ?>
          
          <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $iset->id ?>" /><td style="width: 100px"><?php echo $erow->code ; ?>
        </td><td  style="width: 100px"><?php echo $erow->name  ?></td><td  style="width: 150px"><?php echo $erow->brand_id  ?></td>
        <td style="width: 100px"><?php echo $erow->selling_price ?></td>
        <td style="width: 100px">    <?php if($erow->code_status==1){
                ?>
                <a href="<?php echo base_url() ?>index.php/item_code/edit_item/<?php echo $erow->id ?>"><?php echo $this->lang->line('edit') ?></a> 
               <?php
            
            }else{?>
                <a href="<?php echo base_url() ?>index.php/item_code/add_item/<?php echo $erow->id ?>"><?php echo $this->lang->line('add') ?></a>
      <?php      }
?>
            
        </td>
    </tr><?php } }}?></table>
   <td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
  
     <?php }else{?><table ><?php
     foreach ($set as $iset){          
          foreach ($row as $erow){
        if($iset->item_id==$erow->id){

        
   
?>   
    
    <tr><td><input type="checkbox" name="mycheck[]" value="<?php echo $iset->id ?>" /><td style="width: 100px"><?php echo $erow->code ?>
        </td><td  style="width: 100px"><?php echo $erow->name ?></td><td  style="width: 150px">
            <?php foreach ($brands as $item_brands){
            if($item_brands->id==$erow->brand_id ){
                echo $item_brands->name;
            }
                  
            }?></td>
        <td style="width: 100px"><?php echo $erow->selling_price ?></td>
        <td style="width: 100px">
            <?php if($erow->code_status==1){
                ?>
                <a href="<?php echo base_url() ?>index.php/item_code/edit_item/<?php echo $erow->id ?>"><?php echo $this->lang->line('edit') ?></a> 
               <?php
            
            }else{?>
                <a href="<?php echo base_url() ?>index.php/item_code/add_item/<?php echo $erow->id ?>"><?php echo $this->lang->line('add') ?></a>
      <?php      }
?>
            
        <td>
    
    </tr>
    <?php ?>

<?php } } }?></table> 

    <tr><tb><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td></tr>
  
<?php
}?>

<?php 
}else{   ?>
   <td><?php echo form_submit('BacktoHome',$this->lang->line('back_to_home')) ?></td>
 
<?php 

}


?>  
  <?php   echo form_close() ?> 