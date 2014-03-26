<?php if($_SESSION['user_groupsci_per']['edit']==1){ 
    echo form_open('user_groupsci/update_user_groups');
     foreach ($row as $drow){
         echo form_label($this->lang->line('user_groups')). form_input('user_groups',$drow->group_name);
         echo form_submit('update',$this->lang->line('update'));
         echo form_hidden('id',$drow->guid);
         echo form_submit('cancel',$this->lang->line('cancel'));
     }
    
}else{
    redirect('user_groupsci');
}
?>
