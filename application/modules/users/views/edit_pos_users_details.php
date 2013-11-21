<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>




<nav id="top_navigation">
                                <div class="container">
                                        <ul id="icon_nav_h" class="top_ico_nav clearfix">
                                                <li>
                                                        <a href="#">
                                                                <i class="icon-home icon-2x"></i>
                                                                <span class="menu_label">Home</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#">
                                                                <i class="icon-edit icon-2x"></i>
                                                                <span class="menu_label">Content</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#">
                                                                <i class="icon-group icon-2x"></i>
                                                                <span class="menu_label">Users</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#">
                                                                <span class="label label-danger">12</span>
                                                                <i class="icon-tasks icon-2x"></i>
                                                                <span class="menu_label">Tasks</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#">
                                                                <i class="icon-beaker icon-2x"></i>
                                                                <span class="menu_label">Plugins</span>
                                                        </a>
                                                </li>
                                                <li class="active">
                                                        <a href="#">
                                                                <i class="icon-book icon-2x"></i>
                                                                <span class="menu_label">Help</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#">
                                                                <span class="label label-success">$2 347</span>
                                                                <i class="icon-tags icon-2x"></i>
                                                                <span class="menu_label">E-Commerce</span>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#">
                                                                <i class="icon-wrench icon-2x"></i>
                                                                <span class="menu_label">Settings</span>
                                                        </a>
                                                </li>
                                        </ul>
                                </div>
                        </nav>
                        <!-- mobile navigation -->
                        <nav id="mobile_navigation"></nav>
                        <section id="wizard" class="container clearfix main_section ">
                        
                                    <?php foreach ($row as $erow) {?>
											
                                                                                          <?php   $form =array('id'=>'wizard-demo-2',
                                                                                              'runat'=>'server',
                                                                                              'class'=>'form-horizontal');
                                                                         echo form_open_multipart('users/upadate_pos_users_details',$form);
                                                                         $guid=array('name'=>'guid','value'=>$erow->guid)?>

                                                                             <input type="text" name="guid" value="<?php echo $erow->guid?>">
                                                                             
												<fieldset class="wizard-step ">
                                                                                                    
                                                                                                    <legend class="wizard-label "><i class="icon-user"></i> <?php echo $this->lang->line('personal_details') ?></legend>
                                                                                                        
                                                                                                    <div class="row my_wizard">
											<div class="col-sm-3">
												<div class="step_info">
													<div class="fileupload fileupload-new" data-provides="fileupload">
                                                                                                            <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;">
                                                                                                                          <img class="img-responsive" src="<?php echo base_url(); ?>uploads/<?php echo $erow->image?>"></div>
                                                                                                                         
                                                                                                            <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px">
                                                                                                               
                                                                                                            </div>
                                                                                                            <div>
                                                                                                                <span class="btn btn-default btn-file"><span class="fileupload-new"><?php echo $this->lang->line('select_image') ?></span><span class="fileupload-exists"><?php echo $this->lang->line('change') ?></span>
                                                                                                                    <input type="file" name="userfile" /></span>
                                                                                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('remove') ?></a>
                                                                                                            </div>
                                                                                                        </div>
												</div> 
											</div>
											<div class="col-sm-3">
												<div class="form_sep">
													<label for="firstname" class="req"><?php echo $this->lang->line('first_name') ?></label>                                                                                                       
                                                                                                        
                                                                                                        <?php $first_name=array('name'=>'first_name',
                                                                                                                                     'class'=>'required form-control',
                                                                                                                                     'id'=>'first_name',
                                                                                                                                     'value'=>$erow->first_name );
                                                                                                        echo form_input($first_name)?> 
													
												</div>
												<div class="form_sep">
													<label for="last_name" class="req"><?php echo $this->lang->line('last_name') ?></label>                                                                                                       
                                                                                                              <?php $last_name=array('name'=>'last_name',
                                                                                                                                    'class'=>'required form-control',
                                                                                                                                    'id'=>'last_name',
                                                                                                                                    'value'=>$erow->last_name);
                                                                                                               echo form_input($last_name)?> 
												</div>
												</div>
                                                                                                <div class="col-sm-3">
												<div class="form_sep">
													<label for="age" class="req"><?php echo $this->lang->line('age') ?></label>
                                                                                                                   <?php $age=array('name'=>'age',
                                                                                                                                    'class'=>'required number form-control',
                                                                                                                                    'id'=>'age',
                                                                                                                                    'maxlength'=>"2",
                                                                                                                                    'value'=>$erow->age);
                                                                                                                     echo form_input($age)?> 
												</div>
												<div class="form_sep">
													<label for="address"><?php echo $this->lang->line('sex') ?></label>
													<select id="sex" name="sex" class="form-control required">
                                                                                                            <option value="<?php echo $this->lang->line('male') ?>" <?php if($erow->sex==$this->lang->line('male')){ ?> selected="selected" <?php }?>><?php echo $this->lang->line('male') ?></option>
                                                                                                            <option value="<?php echo $this->lang->line('female') ?>" <?php if($erow->sex==$this->lang->line('female')){ ?> selected="selected" <?php }?>><?php echo $this->lang->line('female') ?></option>
                                                                                                            <option value="<?php echo $this->lang->line('other') ?>" <?php if($erow->sex==$this->lang->line('other')){ ?> selected="selected" <?php }?>><?php echo $this->lang->line('other') ?></option>                                                                                                       
                                                                                                        </select>
												</div>  
											    </div>
                                                                                            <div class="col-sm-3">
												<div class="form_sep">
													<label for="dob" class="req"><?php echo $this->lang->line('date_of') ?></label>
													<div class="input-group date ebro_datepicker" data-date-format="mm.dd.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                                                                   <?php $dob=array('name'=>'dob',
                                                                                                                                    'class'=>'required form-control',
                                                                                                                                    'id'=>'dob',
                                                                                                                                    'value'=>date('n.j.Y', strtotime('+0 year, +0 days',$erow->dob)));
                                                                                                                     echo form_input($dob)?>
													<span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                                                        </div>
                                                                                                       
												</div>  
											    </div>
										</div>
												</fieldset>
												<fieldset class="wizard-step">     
                                                                                                    <legend class="wizard-label "><i class="icon-book"></i><?php echo $this->lang->line('contact_details') ?></legend>                                                                                                        
                                                                                                    <div class="row my_wizard" style="margin-top: -20px;">
											<div class="col-sm-3">
												<div class="step_info">
                                                                                                         <label for="address" class="req"><?php echo $this->lang->line('address') ?></label>													
                                                                                                        <?php 
                                                                                                        $address = array(
                                                                                                                        'name'        => 'address',
                                                                                                                        'id'          => 'address',
                                                                                                                        'value'       => $erow->address,
                                                                                                                        'rows'        => '3',
                                                                                                                        'cols'        => '10',
                                                                                                                        'class'       =>'form-control required'
                                                                                                                        
                                                                                                                      );

                                                                                                                    echo form_textarea($address);
                                                                                                        ?>
												</div> 
											</div>
											<div class="col-sm-3">
												<div class="form_sep">
													<label for="city" class="req"><?php echo $this->lang->line('city') ?></label>													
                                                                                                                  <?php $city=array('name'=>'city',
                                                                                                                                    'class'=>'required  form-control',
                                                                                                                                    'id'=>'city',
                                                                                                                                    'value'=>$erow->city);
                                                                                                                     echo form_input($city)?>
												</div>
												<div class="form_sep">
													<label for="state" class="req"><?php echo $this->lang->line('state') ?></label>													
                                                                                                                 <?php $state=array('name'=>'state',
                                                                                                                                    'class'=>'required  form-control',
                                                                                                                                    'id'=>'state',
                                                                                                                                    'value'=>$erow->state);
                                                                                                                     echo form_input($state)?>
												</div>
												</div>
                                                                                                <div class="col-sm-3">
												<div class="form_sep">
													<label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label>
                                                                                                      
                                                                                                                   <?php $zip=array('name'=>'zip',
                                                                                                                                    'class'=>'required  form-control',
                                                                                                                                    'id'=>'zip',
                                                                                                                                    'value'=>$erow->zip);
                                                                                                                     echo form_input($zip)?>
												</div>
												<div class="form_sep">
													<label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													
                                                                                                               <?php $country=array('name'=>'country',
                                                                                                                                    'class'=>'required  form-control',
                                                                                                                                    'id'=>'country',
                                                                                                                                    'value'=>$erow->country);
                                                                                                                     echo form_input($country)?>
												</div>  
											    </div>
                                                                                            <div class="col-sm-3">
												<div class="form_sep">
													<label for="email"><?php echo $this->lang->line('email') ?></label>													
                                                                                                                 <?php $email=array('name'=>'email',
                                                                                                                                    'class'=>'required  form-control email',
                                                                                                                                    'id'=>'email',
                                                                                                                                    'value'=>$erow->email);
                                                                                                                     echo form_input($email)?>
												</div>
                                                                                                <div class="form_sep">
													<label for="phone"><?php echo $this->lang->line('phone') ?></label>
													
                                                                                                         <?php $phone=array('name'=>'phone',
                                                                                                                                    'class'=>'required  form-control number',
                                                                                                                                    'id'=>'phone',
                                                                                                                                    'value'=>$erow->phone);
                                                                                                                     echo form_input($phone)?>
												</div>
											    </div>
										</div>
												</fieldset>
												<fieldset class="wizard-step">
													<legend class="wizard-label"><i class="icon-group icon-2x"></i><?php echo $this->lang->line('user_group') ?> </legend>
													  <div class="row my_wizard" style="margin-top: -20px;">
											<div class="col-sm-3">
												<div class="step_info">
                                                                                                    <select id="branch" name="FromLJ"  class="form-control" style="width:150;">
                                                                                                <?php if($_SESSION['admin']==2){ 
                                                                                                    foreach ($branch as $brow) {

                                                                                             ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->store_name ?></option><?php 
                                                                                                    }}else{ foreach ($branch as $brow) {

                                                                                                    ?> <option name="<?php echo $brow->branch_id ?>" value="<?php echo $brow->branch_id ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->branch_name ?></option>
                                                                                            <?php }}?>

                                                                                            </select>
                                                                                           
                                                                                            
                         
                                                                                            <input type="hidden" name="depa" id="depa">
												</div> 
											</div>
											<div class="col-sm-3">
												<div class="form_sep">
												 <select multiple id="myDiv" class="form-control" name="ToLJ" style="width: 150;height:128px;">
                                                                                            </select>
                                                                                                </div>
												</div>
                                                                                                <div class="col-sm-1">
												<div class="form_sep">
                                                                                            <input type="button" class="btn btn-danger icon-align-left" onClick="move(this.form.ToLJ,this.form.lang),get_selected(this.form.lang)" 
                                                                                                   value=">"  >
                                                                                            </div>
                                                                                                    <div class="form_sep">
                                                                                            <input type="button" class="btn btn-danger icon-align-right" onClick="backmove(this.form.lang,this.form.ToLJ),get_selected(this.form.lang)" 
                                                                                            value="<">
												</div>  
											    </div>
                                                                                            <div class="col-sm-3">
												<div class="form_sep">
                                                                                            <select multiple  name="lang" size="7" class="form-control"  style="width: 250">

                                                                                            <?php foreach ($selected_depart as $s_b_row) {
                                                                                                 foreach ($selected_branch as $b_row){
                                                                                                if($b_row->branch_id==$s_b_row->branch_id ){
                                                                                                ?>
                                                                                                <option value="<?php echo $s_b_row->branch_id.".".$s_b_row->depart_id  ?>"><?php echo  $b_row->branch_name ." ( " . $s_b_row->depart_name ." )"?></option>
                                                                                                <?php } } }?>
                                                                                            </select>
                                                                                                   
                                                                                                    <?php $depa=array('id'=>'depa','name'=>'depa');
                                                                                                    echo form_hidden($depa)?>
                                                                                                </div>  
											    </div>
										</div>
												</fieldset>
												<fieldset class="wizard-step">
													<legend class="wizard-label"><i class="icon-key"></i><?php echo $this->lang->line('login_details') ?></legend>
																  <div class="row my_wizard" style="margin-top: -20px;">
											<div class="col-sm-3">
												<div class="step_info">
													<label for="pos_users_id" class="req"><?php echo $this->lang->line('username') ?></label>
                                                                                                              <?php $username=array('name'=>'pos_users_id',
                                                                                                                                    'class'=>'required  form-control ',
                                                                                                                                    'id'=>'pos_users_id',
                                                                                                                                    'value'=>$erow->user_id);
                                                                                                                     echo form_input($username)?>
												</div> 
											</div>
                                                                                            <div class="col-sm-3">
												<div class="form_sep">
												<label for="password" class="req"><?php echo $this->lang->line('password') ?></label>												
                                                                                                              <?php $password=array('name'=>'password',
                                                                                                                                    'class'=>'  form-control ',
                                                                                                                                    'id'=>'password',
                                                                                                                                    'value'=>set_value('password'));
                                                                                                                     echo form_input($password)?>
											    </div>
											    <div class="form_sep">
												
												<label for="reg_password_repeat" class="req"><?php echo $this->lang->line('confirm_password') ?></label>                                                                                               
                                                                                                 <?php $confirm_password=array('name'=>'confirm_password',
                                                                                                                                    'class'=>' form-control ',
                                                                                                                                    'id'=>'confirm_password',
                                                                                                                                    'equalto'=>"#password",
                                                                                                                                    'value'=>set_value('confirm_password'));
                                                                                                                     echo form_input($confirm_password)?>
											    </div>
											    </div>
                                                                                                                                       <div class="col-sm-3">
                                                                                                                                           <div class="form_sep">&nbsp;</div>
                                                                                                                                           <div class="form_sep">
                                                                                                                                               <?php 
                                                                                                                                               $submit=array(
                                                                                                                                                   'name'=>'submit',
                                                                                                                                                   'value'=>$this->lang->line('save'),
                                                                                                                                                   'class'=>'btn btn-success');
                                                                                                                                               echo form_submit($submit);
                                                                                                                                               ?>
                                                                                                                                           </div>
                                                                                                                                           </div>
										</div>
												</fieldset>
											</form>
										
</section>
                                    <?php }?>             
                        
 
                 
           
<script>
    $(document).ready( function () {
        jQuery('.form-horizontal').validate({
			rules : {
				password : {
					minlength : 5
				},
				password_confirm : {
					minlength : 5,
					equalTo : "#password"
				}
			}
		});
    });
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

    <?php if(validation_errors()!=""){
        ?>
<div class="col-sm-3 label label-warning">
 <?php   echo validation_errors()?>
</div>
<?php
    } ?>

    

        



                        </div>





   

		
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

</script>
            

              




</form>
<?php echo validation_errors(); ?>
