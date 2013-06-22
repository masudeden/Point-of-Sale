<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>css/style.css" />


<?php echo form_open('user_groupsCI/add_user_groups') ;?>
<table><tr><td>
            
    <?php echo form_label($this->lang->line('user_groups_name'));?></td><td><?php echo form_input('user_groups_name',set_value('user_groups_name'), 'id="user_groups_name" autofocus')?></td>
    </tr>
</table>
<br><section class="main">
<table ><tr>
            <?php $i=0; foreach ($row as $mode){ 
            if($i%4==0){
                echo "</tr><tr><td><br></td></tr><tr>";
            }$i++;
           
            ?><td>
<table>
<tr><td><label><?php echo $this->lang->line($mode)."". 'Read'; ?> </label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="$mode_read" value="0001"><label><i></i></label></div></td>
</tr>
<tr><td><label><?php echo $this->lang->line($mode)."". 'Add'; ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="$mode_add" value="0010" ><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line($mode)."". 'Edit';;?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="$mode_edit" value="0100"><label><i></i></label></td>
</tr>
<tr><td><label><?php echo $this->lang->line($mode)."". 'Delete';  ?></label> </td>
    <td><div class="switch demo3" ><input type="checkbox" name="$mode_delete" value="1000"><label><i></i></label></td>
</tr>
            </table>   </td><?php echo "<td></td><td></td>";
            } ?>
      </tr>
</table>
</section>

<?php echo form_submit('save',$this->lang->line('save'));echo form_submit('cancel',$this->lang->line('cancel'));
echo form_close() ?>
<?php echo validation_errors(); ?>