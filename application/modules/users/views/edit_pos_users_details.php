<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>








</head>
<body>
   
<?php foreach ($row as $erow){?>
		
  <table>
    <?php $form =array('id'=>'form1',
                        'runat'=>'server');
    echo form_open('users/upadate_pos_users_details',$form)?>
    <input type="hidden" name="id" value="<?php echo $erow->id?>">
    <tr><td><?php echo form_label($this->lang->line('first_name'))?> </td><td><input type="text" name="first_name" value="<?php echo $erow->first_name ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('last_name'))?></td><td><input type="text" name="last_name" value="<?php echo $erow->last_name ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('sex'))?></td><td><select name="sex"><option name="male" value="Male" <?php if($erow->sex=='Male') {?> selected <?php }?>>Male</option><option name="Female" value="FeMale"<?php if($erow->sex=='FeMale'){ ?>selected<?php }?>>Female</option></select></td></tr>
    <tr><td><?php echo form_label($this->lang->line('age'))?></td><td><input type="text" name="age" value="<?php echo $erow->age ?>"></td></tr>
     
     <tr><td><?php echo form_label($this->lang->line('address'))?></td><td><input type="text" name="address" value="<?php echo $erow->address ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('city'))?></td><td><input type="text" name="city" value="<?php echo $erow->city ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('state'))?></td><td><input type="text" name="state" value="<?php echo $erow->state ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('zip'))?></td><td><input type="text" name="zip" value="<?php echo $erow->zip ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('country'))?></td><td><input type="text" name="country" value="<?php echo $erow->country ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('email'))?></td><td><input type="text" name="email" value="<?php echo $erow->email ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('phone'))?></td><td><input type="text" name="phone" value="<?php echo $erow->phone ?>" maxlength="13"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('date_of'))?></td><td><input type="text" id="datepicker" name="dob" value="<?php echo date('n/j/Y', strtotime('+0 year, +0 days',$erow->dob));   ?>"> </td></tr>
   
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
    <?php if($_SESSION['admin']==2){ 
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

<?php foreach ($selected_depart as $s_b_row) {
     foreach ($selected_branch as $b_row){
    if($b_row->branch_id==$s_b_row->branch_id ){
    ?>
    <option value="<?php echo $s_b_row->branch_id.".".$s_b_row->depart_id  ?>"><?php echo  $b_row->branch_name ." ( " . $s_b_row->depart_name ." )"?></option>
    <?php } } }?>
</select>
<input type="hidden" name="depa" id="depa"></td></tr>
    <tr><td><?php echo form_label($this->lang->line('user_name'))?></td><td><input type="text" name="pos_users_id" value="<?php echo $erow->user_id ?>"> </td></tr>
    <tr><td><?php echo form_label($this->lang->line('password'))?></td><td><?php echo form_input('password',set_value('password'), 'id="password" autofocus')?></td></tr>
   <tr><td></td> 
       
   <td><input type="submit" name="Save" value="<?php echo $this->lang->line('save') ?>" >
          
        <?php echo form_submit('Cancel', $this->lang->line('cancel')) ?></td>
    </tr> 
        
        




    

    <?php form_close() ?>
    <?php //echo validation_errors(); ?>
   </table>
<?php }?>
</script>
            

              




</form>
<?php echo validation_errors(); ?>
