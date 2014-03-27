 <?php
                    $form =array('id'=>'form1',
                        'runat'=>'server',
                        'name'=>'combo_box');
     echo form_open_multipart('users/add_pos_users_details/',$form);?><table>

<tr><td><?php echo form_label($this->lang->line('first_name'))?> </td><td><?php echo form_input('first_name',set_value('first_name'), 'id="first_name" autofocus')?> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('last_name'))?></td><td><?php echo form_input('last_name',set_value('last_name'), 'id="llast_name" autofocus')?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('sex'))?></td><td><select name="sex"><option name="male" value="Male">Male</option><option name="Female" value="FeMale">Female</option></select></td></tr>
     <tr><td><?php echo form_label($this->lang->line('age'))?></td><td><?php  echo form_input('age',set_value('age'), 'id="age" autofocus')?></td></tr>
     <tr><td><?php echo form_label($this->lang->line('address'))?></td><td><?php echo form_input('address',set_value('address'), 'id="address" autofocus')?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('city'))?></td><td><?php echo form_input('city',set_value('city'), 'id="city" autofocus')?> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('state'))?></td><td><?php echo form_input('state',set_value('state'), 'id="state" autofocus')?> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('zip'))?></td><td><?php echo form_input('zip',set_value('zip'), 'id="zip" autofocus')?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('country'))?></td><td><?php echo form_input('country',set_value('country'), 'id="country" autofocus')?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('email'))?></td><td><?php echo form_input('email',set_value('email'), 'id="email" autofocus')?> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('phone'))?></td><td><?php echo form_input('phone',set_value('phone'), 'id="phone" autofocus')?></td></tr>
    <tr><td><?php echo form_label($this->lang->line('date_of'))?></td><td><?php echo form_input('dob',set_value('dob'), 'id="dob" autofocus')?> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('user_groups'))?></td><td>
           
<script>
function select_branch(tbTo)
{    
 var arrLU="";
    for (i = 0;i < tbTo.options.length; i++) 
 {
  arrLU =arrLU+" "+tbTo.options[i].value;           
 } 
var jibi = document.getElementById("branch").value;
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("GET","<?php echo base_url() ?>index.php/user_groupsselecting/add/"+jibi+"/"+arrLU,false);

xmlhttp.send();
document.getElementById("myDiv").innerHTML=xmlhttp.responseText;
}
function move(tbFrom, tbTo) 
{      
 var arrFrom = new Array(); var arrTo = new Array(); 
 var arrLU = new Array();
 var i;
 for (i = 0;i < tbTo.options.length; i++) 
 {
  arrLU[tbTo.options[i].text] = tbTo.options[i].value;
  arrTo[i] = tbTo.options[i].text;
 }
 var fLength = 0;
 var tLength = arrTo.length;
 for(i = 0; i < tbFrom.options.length; i++) 
 {
  arrLU[tbFrom.options[i].text] = tbFrom.options[i].value;
  if (tbFrom.options[i].selected && tbFrom.options[i].value != "") 
  {
   arrTo[tLength] = tbFrom.options[i].text;
   tLength++;
  }
  else 
  {
   arrFrom[fLength] = tbFrom.options[i].text;
   fLength++;
  }
}

tbFrom.length = 0;
tbTo.length = 0;
var ii;

for(ii = 0; ii < arrFrom.length; ii++) 
{
  var no = new Option();
  no.value = arrLU[arrFrom[ii]];
  no.text = arrFrom[ii];  
  tbFrom[ii] = no;  
}

for(ii = 0; ii < arrTo.length; ii++) 
{
 var no = new Option();
 no.value = arrLU[arrTo[ii]];  
                var xmlhttp;
                if (window.XMLHttpRequest)
                {
                xmlhttp=new XMLHttpRequest();
                }
                else
                {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.open("GET","<?php echo base_url() ?>index.php/user_groupsselecting/get_user_groups_branch/"+arrLU[arrTo[ii]],false);
                xmlhttp.send();
              no.text = xmlhttp.responseText;
              
 tbTo[ii] = no; 
}
}
function backmove(tbFrom, tbTo) 
{
 var jibi = document.getElementById("branch").value;
 var arrFrom = new Array(); var arrTo = new Array(); 
 var arrLU = new Array();
 var i;
 for (i = 0;i < tbTo.options.length; i++) 
 {
  arrLU[tbTo.options[i].text] = tbTo.options[i].value;
  arrTo[i] = tbTo.options[i].text;  
 }
 var fLength = 0;
 var tLength = arrTo.length;
 for(i = 0; i < tbFrom.options.length; i++) 
 {
  arrLU[tbFrom.options[i].text] = tbFrom.options[i].value;
  if (tbFrom.options[i].selected && tbFrom.options[i].value != "") 
  {
   arrTo[tLength] = tbFrom.options[i].text;
   tLength++;
  }
  else 
  {
   arrFrom[fLength] = tbFrom.options[i].text;
   fLength++;
  }
}
tbFrom.length = 0;
tbTo.length = 0;
var ii;
for(ii = 0; ii < arrFrom.length; ii++) 
{
  var no = new Option();
  no.value = arrLU[arrFrom[ii]];
  no.text = arrFrom[ii];  
  tbFrom[ii] = no; 
}
for(ii = 0; ii < arrTo.length; ii++) 
{
 var no = new Option();
 no.value = arrLU[arrTo[ii]]; 
                var xmlhttp;
                if (window.XMLHttpRequest)
                {
                xmlhttp=new XMLHttpRequest();
                }
                else
                {
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.open("GET","<?php echo base_url() ?>index.php/user_groupsselecting/check_user_groups_branch/"+jibi+"/"+arrLU[arrTo[ii]],false);
                xmlhttp.send();
                if(xmlhttp.responseText=='TRUE'){                   
                xmlhttp.open("GET","<?php echo base_url() ?>index.php/user_groupsselecting/set_user_groups_branch/"+jibi+"/"+arrLU[arrTo[ii]],false);
                xmlhttp.send();                
                no.text = xmlhttp.responseText;
                tbTo[ii] = no; 
 }
}
}
function get_selected(tbTo){
var arrLU="";
    for (i = 0;i <tbTo.options.length; i++) 
 {
  arrLU =arrLU+" "+tbTo.options[i].value; 
  } 
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
        xmlhttp=new XMLHttpRequest();
        }
        else
        {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        if(arrLU!=""){
        xmlhttp.open("GET","<?php echo base_url() ?>index.php/user_groupsselecting/get_selected_user_groups/"+arrLU,false);
        xmlhttp.send();
             document.getElementById("depa").value = xmlhttp.responseText;
            
           }else{
                document.getElementById("mine").innerHTML="";
           }
}
</script>
<select id="branch" name="FromLJ" style="width:150">
    <?php if($this->session->userdata['user_type']==2){ 
        foreach ($branch as $brow) {
        
 ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->store_name ?></option><?php 
        }}else{ foreach ($branch as $brow) {
          
        ?> <option name="<?php echo $brow->branch_id ?>" value="<?php echo $brow->branch_id ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->branch_name ?></option>
<?php }}?>

</select>
<select multiple id="myDiv" name="ToLJ" style="width: 150">
</select>
<input type="button" onClick="move(this.form.ToLJ,this.form.lang),get_selected(this.form.lang)" 
value="->">
<input type="button" onClick="backmove(this.form.lang,this.form.ToLJ),get_selected(this.form.lang)" 
value="<-">
<select multiple  name="lang" size="7"  style="width: 250">

</select>
<input type="hidden" name="depa" id="depa"></td></tr>
    <tr><td><?php echo form_label($this->lang->line('user_name'))?></td><td><?php echo form_input('pos_users_id',set_value('pos_users_id'), 'id="pos_users_id" autofocus')?> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('password'))?></td><td><?php echo form_input('password',set_value('password'), 'id="password" autofocus')?></td></tr>
   <tr><td></td> 
       
   <td><input type="submit" name="Save" value="<?php echo $this->lang->line('save') ?>" >
          
        <?php echo form_submit('Cancel', $this->lang->line('cancel')) ?></td>
    </tr> 
        
        




    

    <?php form_close() ?>
    <?php //echo validation_errors(); ?>
   </table>
    
</script>
                <div id="upload" ><span><?php echo $this->lang->line('photo') ?><span></div><span id="status" ></span>
		
		<ul id="files" ></ul>

              




</form>
<?php echo validation_errors(); ?>