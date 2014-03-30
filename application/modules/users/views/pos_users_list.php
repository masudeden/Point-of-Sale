<style type="text/css">
    .my_select{
         -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #FFFFFF;
    border-color: #C0C0C0 #D9D9D9 #D9D9D9;
    border-image: none;
    border-radius: 1px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    box-shadow: none;
    font-size: 13px;
  
    line-height: 1.4;
    padding:1px 1px 1px 3px;
    transition: none 0s ease 0s;
    }
 
</style>	
<script type="text/javascript">

     $(document).ready( function () {
     
    var options = { 
    beforeSend: function() 
    {
    	$("#progress").show();
    	//clear everything
    	$("#bar").width('0%');
    	$("#message").html("");
		$("#percent").html("0%");
    },
    uploadProgress: function(event, position, total, percentComplete) 
    {
    	$("#bar").width(percentComplete+'%');
    	$("#percent").html(percentComplete+'%');

    
    },
    success: function() 
    {
        $("#bar").width('100%');
    	$("#percent").html('100%');
    },
	complete: function(response) { 
                  if(response['responseText']=='true'){
                                     $.bootstrapGrowl('<?php echo $this->lang->line('user').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                    
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_users_lists();
                  }else  if(response['responseText']=='already'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('users').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                  }else  if(response['responseText']=='false'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                  }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('users');?>', { type: "error" });                           
                  }
	 
                  
	},
	error: function()
	{
		$("#message").html("<font color='red'> ERROR: Problem in adding user. Please try again</font>");

	}
   
}; 

        <?php if($this->session->userdata['users_per']['add']==1){ ?>
          if($('#posnic_user_2').valid()){
            $("#posnic_user_2").ajaxForm(options);
          }else{
            $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields')." ".$this->lang->line('users');?>', { type: "error" });         
          }         
       <?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add Record')?>");  
       <?php }?>
         /*
         $('#add_new_user').click(function() { 
                <?php if($this->session->userdata['users_per']['add']==1){ ?>
                        if($('#posnic_user_2').valid()){
                var inputs = $('#posnic_user_2').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/users/add_pos_users_details')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                          if(response['responseText']=='true'){
                             $.bootstrapGrowl('<?php echo $this->lang->line('users')." ".$this->lang->line('added');?>', { type: "success" });                                                                                                
                             $("#dt_table_tools").dataTable().fnDraw();
                             $("#posnic_user_2").trigger('reset');
                             posnic_users_lists();
                            }else  if(response['responseText']=='already'){
                                   $.bootstrapGrowl($('#taxes_name').val()+' <?php echo $this->lang->line('users').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                            }else  if(response['responseText']=='false'){
                                   $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                            }else{
                                  $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('users');?>', { type: "error" });                           
                            }
                          
                       }
                }); }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields')." ".$this->lang->line('users');?>', { type: "error" });                           
                }<?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add Record')?>");  
                    <?php }?>
           */ 
    
 $('#update_users').click(function() { 
        <?php if($this->session->userdata['users_per']['edit']==1){ ?>
           if($('#parsley_reg').valid()){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/users/upadate_pos_users_details')?>",
                            data: inputs,
                            type:'POST',
                              complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                     $.bootstrapGrowl('<?php echo $this->lang->line('user').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                    
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_users_lists();
                                }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('users').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('users');?>', { type: "error" });                           
                                    }
                          }
                       
                 });
                  }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields')." ".$this->lang->line('users');?>', { type: "error" });                           
                }
                 <?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO permission To Edit This Records')?>");  
                    <?php }?>
        });
     });
function posnic_add_new(){
    <?php if($this->session->userdata['users_per']['add']==1){ ?>
      $("#user_list").hide();
      $('#add_user_form').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_users').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#users_lists').removeAttr("disabled");
      <?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add User')?>");  
                    <?php }?>
}
function posnic_users_lists(){
      $('#edit_user_form').hide('hide');
      $('#add_user_form').hide('hide');  
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_users').removeAttr("disabled");
      $('#users_lists').attr("disabled",'disabled');
}
function clear_add_users(){
      $("#posnic_user_2").trigger('reset');
}
function reload_update_user(){
    var id=$('#user_guid').val();
    edit_function(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_users" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-default" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete_user()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_users_lists()" class="btn btn-default" id="users_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('users') ?></a>
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('users/posnic_users',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title">Users</h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                          <th>Id</th>
                                          <th >Select</th>
                                          <th >User Id</th>
                                          <th>First Name</th>
                                          <th>Last Name</th>
                                          <th>Phone </th>
                                          <th>Email</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                         </tr>
                                      </thead>
                                      <tbody></tbody>
                                      </table>
                                  </div>
                             </div>
                          </div>
                <?php echo form_close(); ?>
             </div>
        </div>
</section>    
<section id="add_user_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'posnic_user_2',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('users/add_pos_users_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                     
                <div class="row">
                     <div class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Personal Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                                <label for="firstname" class="req"><?php echo $this->lang->line('first_name') ?></label>                     
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                     <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;"><img src="img/no_img_180.png" alt=""></div>
                                                       <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                       <div>
                                                            <span class="btn btn-default btn-file"><span class="fileupload-new"><?php echo $this->lang->line('select_image') ?></span><span class="fileupload-exists"><?php echo $this->lang->line('change') ?></span>
                                                            <input type="file" name="userfile" /></span>
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('remove') ?></a>
                                                       </div>
                                                 </div>
                                            </div> 
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                         <label for="firstname" class="req"><?php echo $this->lang->line('first_name') ?></label>                                                                                                       
                                                           <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'first_name',
                                                                                    'value'=>set_value('first_name'));
                                                           echo form_input($first_name)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="last_name" class="req"><?php echo $this->lang->line('last_name') ?></label>                                                                                                       
                                                                  <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required form-control',
                                                                                        'id'=>'last_name',
                                                                                        'value'=>set_value('last_name'));
                                                                   echo form_input($last_name)?> 
                                                    </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                            <label for="age" class="req"><?php echo $this->lang->line('age') ?></label>
                                                                       <?php $age=array('name'=>'age',
                                                                                        'class'=>'required number form-control',
                                                                                        'id'=>'age',
                                                                                        'maxlength'=>"2",
                                                                                        'value'=>set_value('age'));
                                                             echo form_input($age)?> 
                                                       </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                    <label for="address"><?php echo $this->lang->line('sex') ?></label>
                                                                    <select id="sex" name="sex" class="form-control required">
                                                                        <option value="<?php echo $this->lang->line('male') ?>"><?php echo $this->lang->line('male') ?></option>
                                                                        <option value="<?php echo $this->lang->line('female') ?>"><?php echo $this->lang->line('female') ?></option>
                                                                        <option value="<?php echo $this->lang->line('other') ?>"><?php echo $this->lang->line('other') ?></option>                                                                                                       
                                                                    </select>
                                                            </div>  
                                                        </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="dob" class="req"><?php echo $this->lang->line('date_of') ?></label>
                                                                <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $dob=array('name'=>'dob',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'dob',
                                                                                            'value'=>set_value('dob'));
                                                                             echo form_input($dob)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>

                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="dob" ><?php echo $this->lang->line('blood_group') ?></label>
                                                               
                                                                           <?php $blood=array('name'=>'blood',
                                                                                        'class'=>'form-control',
                                                                                        'id'=>'blood',
                                                                                        'maxlength'=>"4",
                                                                                        'value'=>set_value('blood'));
                                                                            echo form_input($blood)?> 
                                                               
                                                              
                                                        </div> 
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                          </div>
                     </div>
                
                     <div  class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Contact Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                              <label for="address" class="req"><?php echo $this->lang->line('address') ?></label>													
                                                    <?php 
                                                    $address = array(
                                                                    'name'        => 'address',
                                                                    'id'          => 'address',
                                                                    'value'       =>  set_value('address'),
                                                                    'rows'        => '7',
                                                                    'cols'        => '10',
                                                                    'class'       =>'form-control required'

                                                                  ); echo form_textarea($address);
                                                    ?>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="city" class="req"><?php echo $this->lang->line('city') ?></label>													
                                                                  <?php $city=array('name'=>'city',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'city',
                                                                                    'value'=>set_value('city'));
                                                                     echo form_input($city)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="state" class="req"><?php echo $this->lang->line('state') ?></label>													
                                                                     <?php $state=array('name'=>'state',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'state',
                                                                                        'value'=>set_value('state'));
                                                                         echo form_input($state)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                            <label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label>

                                                                       <?php $zip=array('name'=>'zip',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'zip',
                                                                                        'value'=>set_value('zip'));
                                                                         echo form_input($zip)?>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                        <label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													
                                                                               <?php $country=array('name'=>'country',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'country',
                                                                                                    'value'=>set_value('country'));
                                                                                     echo form_input($country)?>
                                                                </div>  
                                                     </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="email" class="req"><?php echo $this->lang->line('email') ?></label>													
                                                                         <?php $email=array('name'=>'email',
                                                                                            'class'=>'required  form-control email',
                                                                                            'id'=>'email',
                                                                                            'value'=>set_value('email'));
                                                                             echo form_input($email)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                            
                                                                <label for="phone" class="req"><?php echo $this->lang->line('phone') ?></label>

                                                                 <?php $phone=array('name'=>'phone',
                                                                                            'class'=>'required  form-control number',
                                                                                            'id'=>'phone',
                                                                                            'value'=>set_value('phone'));
                                                                             echo form_input($phone)?>
                                                        </div> 
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                          </div>
                     </div>
                </div>
                <div class="row">
                     <div class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">User Group Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                                    <label for="branch"><?php echo $this->lang->line('branch') ?></label>                                                                                                    
                                                    <select multiple id="branch" name="FromLJ"  class="form-control" style="width:150;height:128px;">
                                                        <?php if($this->session->userdata['user_type']==2){ 
                                                            foreach ($branch as $brow) {

                                                     ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch()" > <?php echo $brow->store_name ?></option><?php 
                                                            }}else{ foreach ($branch as $brow) {

                                                            ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch()" > <?php echo $brow->store_name ?></option>
                                                      <?php }}?></select>
                                                </div> 
                                      <input type="hidden" class="required" name="depa" id="depa">
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                    <div class="form_sep" ">
                                                    <label for="phone"><?php echo $this->lang->line('department') ?></label>  
                                                    <div id="user_group_parent_div">  <select multiple id="user_groups_list" class="form-control" name="ToLJ" style="width: 150;height:128px;">
                                                         </select>
                                                        </div>
                                                    </div> 
                                                <div id="parent_div"> 
                                                <div id="hidden_user_group_list">
                                                </div>    
                                                <div id="hidden_selected_user_group_list">
                                                </div>    
                                                </div>
                                                </div>
                                               
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('selected_department') ?></label>  
                                                    <select multiple id="selected_user_group_list"  name="lang" size="7" class="form-control "  style="width: 250">

                                                    </select>
                                                   
                                                    </div> 
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-default " onClick="select_user_group()" 
                                                           ><i class="icon icon-forward"></i></button>
                                                   
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-default " onClick="remove_select_user_group()"  
                                                           ><i class="icon icon-backward"></i></button>
                                                    
                                                    </div>
                                                   </div>
                                               </div>
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                     </div>
                
                     <div  class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Login Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                                    <label for="pos_users_id" class="req"><?php echo $this->lang->line('username') ?></label>
                                                          <?php $username=array('name'=>'pos_users_id',
                                                                                'class'=>'required  form-control ',
                                                                                'id'=>'pos_users_id',
                                                                                'value'=>set_value('pos_users_id'));
                                                                 echo form_input($username)?>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="password" class="req"><?php echo $this->lang->line('password') ?></label>												
                                                                      <?php $password=array('name'=>'password',
                                                                                            'class'=>'required  form-control ',
                                                                                            'id'=>'new_password',
                                                                                            'type'=>'password',
                                                                                            'value'=>set_value('password'));
                                                                             echo form_input($password)?>
                                                    </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                        <label for="reg_password_repeat" class="req"><?php echo $this->lang->line('confirm_password') ?></label>                                                                                               
                                                         <?php $confirm_password=array('name'=>'confirm_password',
                                                                                            'class'=>'required  form-control ',
                                                                                            'id'=>'confirm_password',
                                                                                            'type'=>'password',
                                                                                            'equalto'=>"#new_password",
                                                                                            'value'=>set_value('confirm_password'));
                                                                             echo form_input($confirm_password)?>
                                                    </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                     
                                                   </div>
                                                   <div class="col col-sm-6">
                                                        
                                                     </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                           
                          </div>
                     </div>
                    <div class="row">
                                  <div class="col col-lg-6 text-center"><br><br>
                                      <button id="add_new_user"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_users()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
                                  </div>
                              </div>
                </div>
          </div>
        </div>
    <?php echo form_close();?>
</section>    
<section id="edit_user_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('users/upadate_pos_users_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                     
                <div class="row">
                     <div class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Personal Details</h4>  
                                     <input type="hidden" name="guid" id="user_guid" >
                                     
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                                <label for="firstname" class="req"><?php echo $this->lang->line('first_name') ?></label>                     
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                     <div class="fileupload-new img-thumbnail" style="width: 178px; height: 120px;"><img src="img/no_img_180.png" alt=""></div>
                                                       <div class="fileupload-preview fileupload-exists img-thumbnail" style="width: 178px; height: 120px"></div>
                                                       <div>
                                                            <span class="btn btn-default btn-file"><span class="fileupload-new"><?php echo $this->lang->line('select_image') ?></span><span class="fileupload-exists"><?php echo $this->lang->line('change') ?></span>
                                                            <input type="file" name="userfile" /></span>
                                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload"><?php echo $this->lang->line('remove') ?></a>
                                                       </div>
                                                 </div>
                                            </div> 
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                         <label for="firstname" class="req"><?php echo $this->lang->line('first_name') ?></label>                                                                                                       
                                                           <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'first_name',
                                                                                    'value'=>set_value('first_name'));
                                                           echo form_input($first_name)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="last_name" class="req"><?php echo $this->lang->line('last_name') ?></label>                                                                                                       
                                                                  <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required form-control',
                                                                                        'id'=>'last_name',
                                                                                        'value'=>set_value('last_name'));
                                                                   echo form_input($last_name)?> 
                                                    </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                            <label for="age" class="req"><?php echo $this->lang->line('age') ?></label>
                                                                       <?php $age=array('name'=>'age',
                                                                                        'class'=>'required number form-control',
                                                                                        'id'=>'age',
                                                                                        'maxlength'=>"2",
                                                                                        'value'=>set_value('age'));
                                                             echo form_input($age)?> 
                                                       </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                    <label for="address"><?php echo $this->lang->line('sex') ?></label>
                                                                    <select id="sex" name="sex" class="form-control required">
                                                                        <option value="<?php echo $this->lang->line('male') ?>"><?php echo $this->lang->line('male') ?></option>
                                                                        <option value="<?php echo $this->lang->line('female') ?>"><?php echo $this->lang->line('female') ?></option>
                                                                        <option value="<?php echo $this->lang->line('other') ?>"><?php echo $this->lang->line('other') ?></option>                                                                                                       
                                                                    </select>
                                                            </div>  
                                                        </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="dob" class="req"><?php echo $this->lang->line('date_of') ?></label>
                                                                <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $dob=array('name'=>'dob',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'dob',
                                                                                            'value'=>set_value('dob'));
                                                                             echo form_input($dob)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>

                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="dob" ><?php echo $this->lang->line('blood_group') ?></label>
                                                               
                                                                           <?php $blood=array('name'=>'blood',
                                                                                        'class'=>'form-control',
                                                                                        'id'=>'blood',
                                                                                        'maxlength'=>"4",
                                                                                        'value'=>set_value('blood'));
                                                                            echo form_input($blood)?> 
                                                               
                                                              
                                                        </div> 
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                          </div>
                     </div>
                
                     <div  class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Contact Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                              <label for="address" class="req"><?php echo $this->lang->line('address') ?></label>													
                                                    <?php 
                                                    $address = array(
                                                                    'name'        => 'address',
                                                                    'id'          => 'address',
                                                                    'value'       =>  set_value('address'),
                                                                    'rows'        => '7',
                                                                    'cols'        => '10',
                                                                    'class'       =>'form-control required'

                                                                  ); echo form_textarea($address);
                                                    ?>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="city" class="req"><?php echo $this->lang->line('city') ?></label>													
                                                                  <?php $city=array('name'=>'city',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'city',
                                                                                    'value'=>set_value('city'));
                                                                     echo form_input($city)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                            <label for="state" class="req"><?php echo $this->lang->line('state') ?></label>													
                                                                     <?php $state=array('name'=>'state',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'state',
                                                                                        'value'=>set_value('state'));
                                                                         echo form_input($state)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                      <div class="form_sep">
                                                            <label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label>

                                                                       <?php $zip=array('name'=>'zip',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'zip',
                                                                                        'value'=>set_value('zip'));
                                                                         echo form_input($zip)?>
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                        <label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													
                                                                               <?php $country=array('name'=>'country',
                                                                                                    'class'=>'required  form-control',
                                                                                                    'id'=>'country',
                                                                                                    'value'=>set_value('country'));
                                                                                     echo form_input($country)?>
                                                                </div>  
                                                     </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                                <label for="email" class="req"><?php echo $this->lang->line('email') ?></label>													
                                                                         <?php $email=array('name'=>'email',
                                                                                            'class'=>'required  form-control email',
                                                                                            'id'=>'email',
                                                                                            'value'=>set_value('email'));
                                                                             echo form_input($email)?>
                                                        </div> 
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       <div class="form_sep">
                                                            
                                                                <label for="phone" class="req"><?php echo $this->lang->line('phone') ?></label>

                                                                 <?php $phone=array('name'=>'phone',
                                                                                            'class'=>'required  form-control number',
                                                                                            'id'=>'phone',
                                                                                            'value'=>set_value('phone'));
                                                                             echo form_input($phone)?>
                                                        </div> 
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                          </div>
                     </div>
                </div>
                <div class="row">
                     <div class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">User Group Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                                    <label for="branch"><?php echo $this->lang->line('branch') ?></label>                                                                                                    
                                                    <select multiple id="branch" name="FromLJ"  class="form-control" style="width:150;height:128px;">
                                                        <?php if($this->session->userdata['user_type']==2){ 
                                                            foreach ($branch as $brow) {

                                                     ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch_for_update()" > <?php echo $brow->store_name ?></option><?php 
                                                            }}else{ foreach ($branch as $brow) {

                                                            ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch_for_update()" > <?php echo $brow->store_name ?></option>
                                                      <?php }}?></select>
                                                </div> 
                                      <input type="hidden" class="required" name="depa" id="depa">
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                    <div class="form_sep" ">
                                                    <label for="phone"><?php echo $this->lang->line('department') ?></label>  
                                                    <div id="user_group_parent_div">  <select multiple id="user_groups_list" class="form-control" name="ToLJ" style="width: 150;height:128px;">
                                                         </select>
                                                        </div>
                                                    </div> 
                                                <div id="parent_div"> 
                                                <div id="hidden_user_group_list">
                                                </div>    
                                                <div id="hidden_selected_user_group_list">
                                                </div>    
                                                <div id="deleted_selected_group">
                                                </div>    
                                                    
                                                </div>
                                                </div>
                                               
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('selected_department') ?></label>  
                                                   <div id="selected_user_group_parent_div"> 
                                                       <select multiple id="selected_user_group_list"  name="lang" size="7" class="form-control "  style="width: 250">

                                                    </select>
                                                    </div>
                                                   
                                                    </div> 
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-default " onClick="select_user_group_for_update()" 
                                                           ><i class="icon icon-forward"></i></button>
                                                   
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-default " onClick="remove_select_user_group_for_update()"  
                                                           ><i class="icon icon-backward"></i></button>
                                                    
                                                    </div>
                                                   </div>
                                               </div>
                                           <br>
                                        </div>                              
                              </div>
                          </div>
                     </div>
                
                     <div  class="col-lg-6">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Login Details</h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                  <div class="col-sm-4" style="padding-left: 25px;">
                                           <div class="step_info">
                                                    <label for="pos_users_id" class="req"><?php echo $this->lang->line('username') ?></label>
                                                          <?php $username=array('name'=>'pos_users_id',
                                                                                'class'=>'required  form-control ',
                                                                                'id'=>'pos_users_id',
                                                                                'value'=>set_value('pos_users_id'));
                                                                 echo form_input($username)?>
                                            </div>  
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                   <div class="form_sep">
                                                        <label for="password" class="req"><?php echo $this->lang->line('password') ?></label>												
                                                                      <?php $password=array('name'=>'password',
                                                                                            'class'=>'form-control ',
                                                                                            'id'=>'password',
                                                                                            'type'=>'password',
                                                                                            'value'=>set_value('password'));
                                                                             echo form_input($password)?>
                                                    </div>
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                        <label for="reg_password_repeat" class="req"><?php echo $this->lang->line('confirm_password') ?></label>                                                                                               
                                                         <?php $confirm_password=array('name'=>'confirm_password',
                                                                                            'class'=>'form-control ',
                                                                                            'id'=>'confirm_password',
                                                                                            'type'=>'password',
                                                                                            'equalto'=>"#password",
                                                                                            'value'=>set_value('confirm_password'));
                                                                             echo form_input($confirm_password)?>
                                                    </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                     
                                                   </div>
                                                   <div class="col col-sm-6">
                                                        
                                                     </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                       
                                                   </div>
                                                   <div class="col col-sm-6">
                                                       
                                                   </div>
                                               </div><br>
                                        </div>                              
                              </div>
                           
                          </div>
                     </div>
                    <div class="row">
                                  <div class="col col-lg-6 text-center"><br><br>
                                      <button id="update_users"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('update') ?></button>
                                      <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('reload') ?></a>
                                  </div>
                              </div>
                </div>
          </div>
        </div>
    <?php echo form_close();?>
</section>    
           <div id="footer_space">
              
           </div>
		</div>
	
                <script type="text/javascript">
                    function posnic_group_active(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('users');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/users/active',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }
                  

                      }    
                      }
                    function posnic_delete_user(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('users');?>', { type: "warning" });
                      
                      }else{
                            bootbox.confirm("Are you Sure To Delete This Users ", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/users/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('deleted');?>', { type: "success" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }    
                      }
                      });
                      }    
                      }
                    
                    
                    
                    function posnic_group_deactive(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                         $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('users');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/users/deactive',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                    success: function(response)
                                    {
                                        if(response){
                                             $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }
                                    }
                                });

                          }

                      }
                  

                      }    
                      }
                    
                </script>
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
function select_branch()
{    
    var guid=$('#posnic_user_2 select[id="branch"] option:selected').val();
    var name=$('#posnic_user_2 select[id="branch"] option:selected').text();
    $.ajax({                                      
    url: "<?php echo base_url() ?>index.php/users/get_users_groups/",   
    type: "POST",
    data: {branch_id:guid}, 
    dataType: 'json',               
    success: function(data)        
    {    
        $('#posnic_user_2 #hidden_user_group_list').remove();
        $('#posnic_user_2 #parent_div').append('<div id="hidden_user_group_list"></div>');
        $('#posnic_user_2 #user_groups_list').remove();
        $('#posnic_user_2 #user_group_parent_div').append(' <select multiple id="user_groups_list" class="form-control" name="ToLJ" style="width: 150;height:128px;"></select>');
         for(var i=0;i<data.length;i++){
           if($('#posnic_user_2 #hidden_selected_user_group_list #group_id_'+data[i]['guid']).length == 0){                
            $('#posnic_user_2 #user_groups_list').append($('<option >', {
                 value:data[i]['guid'],
                 text: data[i]['group_name'],
                 id:'opstion_'+data[i]['guid']
             }));
            $('#posnic_user_2 #parent_div #hidden_user_group_list').append(' \n\
           <input type="hidden" id="group_id_'+data[i]['guid']+'" value="'+data[i]['guid']+'" >\n\
           <input type="hidden" id="group_name_'+data[i]['guid']+'" value="'+data[i]['group_name']+'" >\n\
           <input type="hidden" id="group_branch_id_'+data[i]['guid']+'" value="'+guid+'" >\n\
           <input type="hidden" id="group_branch_name_'+data[i]['guid']+'" value="'+name+'" >\n\
          ');
           }
    }
      $('#posnic_user_2 #parent_div #hidden_user_group_list').append('<input type="hidden" id="selected_branch_id_'+guid+'" value="'+guid+'" >'); 
     }
    });
}

function select_user_group(){
   var group=$('#posnic_user_2 select[id="user_groups_list"] option:selected').val();
  if(group){
   var group_name=$('#posnic_user_2 #hidden_user_group_list #group_name_'+group).val();
   var branch_id=$('#posnic_user_2 #hidden_user_group_list #group_branch_id_'+group).val();
   var branch_name=$('#posnic_user_2 #hidden_user_group_list #group_branch_name_'+group).val();
   $('#posnic_user_2 #selected_user_group_list').append($('<option >', {
                 value:group,
                 text: group_name+" ("+branch_name+")"
             }));
           $('#posnic_user_2 #parent_div #hidden_selected_user_group_list').append(' \n\
           <input type="hidden" name="user_groups[]" id="group_id_'+group+'" value="'+group+'" >\n\
           <input type="hidden" id="group_name_'+group+'" value="'+group_name+'" >\n\
           <input type="hidden" name="user_branchs[]" id="group_branch_id_'+group+'" value="'+branch_id+'" >\n\
           <input type="hidden" id="group_branch_name_'+group+'" value="'+branch_name+'" >\n\
          ');
        $('#posnic_user_2 #hidden_user_group_list #group_id_'+group).remove();
        $('#posnic_user_2 #hidden_user_group_list #group_name_'+group).remove();
        $('#posnic_user_2 #hidden_user_group_list #group_branch_id_'+group).remove();
        $('#posnic_user_2 #hidden_user_group_list #group_branch_name_'+group).remove();   
   
        $("#posnic_user_2 #user_groups_list option[value='"+group+"']").remove();
   }
   }
function remove_select_user_group(){
   var group=$('#posnic_user_2 select[id="selected_user_group_list"] option:selected').val();
   if(group){
   var group_name=$('#posnic_user_2 #hidden_selected_user_group_list #group_name_'+group).val();
   var branch_id=$('#posnic_user_2 #hidden_selected_user_group_list #group_branch_id_'+group).val();
   var branch_name=$('#posnic_user_2 #hidden_selected_user_group_list #group_branch_name_'+group).val();
      $('#posnic_user_2 #user_groups_list').append($('<option>', {
                 value:group,
                 text: group_name
            }));
            if($('#hidden_selected_user_group_list #selected_branch_id_'+branch_id).length == 0){  
                $('#posnic_user_2 #parent_div #hidden_user_group_list').append(' \n\
                <input type="hidden" id="group_id_'+group+'" value="'+group+'" >\n\
                <input type="hidden" id="group_name_'+group+'" value="'+group_name+'" >\n\
                <input type="hidden" id="group_branch_id_'+group+'" value="'+branch_id+'" >\n\
                <input type="hidden" id="group_branch_name_'+group+'" value="'+branch_name+'" >\n\
                ');
           }
        $('#posnic_user_2 #hidden_selected_user_group_list #group_id_'+group).remove();
        $('#posnic_user_2 #hidden_selected_user_group_list #group_name_'+group).remove();
        $('#posnic_user_2 #hidden_selected_user_group_list #group_branch_id_'+group).remove();
        $('#posnic_user_2 #hidden_selected_user_group_list #group_branch_name_'+group).remove(); 
        $("#posnic_user_2 #selected_user_group_list option[value='"+group+"']").remove();
    }
   }
function select_branch_for_update()
{    
    var guid=$('#parsley_reg select[id="branch"] option:selected').val();
    var name=$('#parsley_reg select[id="branch"] option:selected').text();
    $.ajax({                                      
    url: "<?php echo base_url() ?>index.php/users/get_users_groups/",   
    type: "POST",
    data: {branch_id:guid}, 
    dataType: 'json',               
    success: function(data)        
    {    
        $('#parsley_reg #hidden_user_group_list').remove();
        $('#parsley_reg #parent_div').append('<div id="hidden_user_group_list"></div>');
        $('#parsley_reg #user_groups_list').remove();
        $('#parsley_reg #user_group_parent_div').append(' <select multiple id="user_groups_list" class="form-control" name="ToLJ" style="width: 150;height:128px;"></select>');
         for(var i=0;i<data.length;i++){
           if($('#parsley_reg #hidden_selected_user_group_list #group_id_'+data[i]['guid']).length == 0){                
            $('#parsley_reg #user_groups_list').append($('<option >', {
                 value:data[i]['guid'],
                 text: data[i]['group_name'],
                 id:'opstion_'+data[i]['guid']
             }));
            $('#parsley_reg #parent_div #hidden_user_group_list').append(' \n\
           <input type="hidden" id="group_id_'+data[i]['guid']+'" value="'+data[i]['guid']+'" >\n\
           <input type="hidden" id="group_name_'+data[i]['guid']+'" value="'+data[i]['group_name']+'" >\n\
           <input type="hidden" id="group_branch_id_'+data[i]['guid']+'" value="'+guid+'" >\n\
           <input type="hidden" id="group_branch_name_'+data[i]['guid']+'" value="'+name+'" >\n\
          ');
           }
    }
    
    }
    });
}

function select_user_group_for_update(){
   var group=$('#parsley_reg select[id="user_groups_list"] option:selected').val();
  if(group){
   var group_name=$('#parsley_reg #hidden_user_group_list #group_name_'+group).val();
   var branch_id=$('#parsley_reg #hidden_user_group_list #group_branch_id_'+group).val();
   var branch_name=$('#parsley_reg #hidden_user_group_list #group_branch_name_'+group).val();
   $('#parsley_reg #selected_user_group_list').append($('<option >', {
                 value:group,
                 text: group_name+" ("+branch_name+")"
             }));
           $('#parsley_reg #parent_div #hidden_selected_user_group_list').append(' \n\
           <input type="hidden" name="user_groups[]" id="group_id_'+group+'" value="'+group+'" >\n\
           <input type="hidden" name="user_branchs[]" id="group_branch_id_'+group+'" value="'+branch_id+'" >\n\
           <input type="hidden" id="group_name_'+group+'" value="'+group_name+'" ><input type="hidden" id="group_branch_name_'+group+'" value="'+branch_name+'" >\n\
          ');
            if(!$('#orginal_branch_id_'+branch_id).length){
                    $('#parsley_reg #parent_div #hidden_selected_user_group_list').append(' <input type="text" name="new_user_branchs[]" id="group_branch_id_'+group+'" value="'+branch_id+'" >');

            } 
       
        
        
        $('#parsley_reg #hidden_user_group_list #group_id_'+group).remove();
        $('#parsley_reg #hidden_user_group_list #group_name_'+group).remove();
        $('#parsley_reg #hidden_user_group_list #group_branch_id_'+group).remove();
        $('#parsley_reg #hidden_user_group_list #group_branch_name_'+group).remove();   
   
        $("#parsley_reg #user_groups_list option[value='"+group+"']").remove();
   }
   }
function remove_select_user_group_for_update(){
   var group=$('#parsley_reg select[id="selected_user_group_list"] option:selected').val();
   if(group){
   var group_name=$('#parsley_reg #hidden_selected_user_group_list #group_name_'+group).val();
   var branch_id=$('#parsley_reg #hidden_selected_user_group_list #group_branch_id_'+group).val();
   var branch_name=$('#parsley_reg #hidden_selected_user_group_list #group_branch_name_'+group).val();
      $('#parsley_reg #user_groups_list').append($('<option>', {
                 value:group,
                 text: group_name
            }));
            if($('#hidden_selected_user_group_list #selected_branch_id_'+branch_id).length == 0){  
                $('#parsley_reg #parent_div #hidden_user_group_list').append(' \n\
                <input type="hidden" id="group_id_'+group+'" value="'+group+'" >\n\
                <input type="hidden" id="group_name_'+group+'" value="'+group_name+'" >\n\
                <input type="hidden" id="group_branch_id_'+group+'" value="'+branch_id+'" >\n\
                <input type="hidden" id="group_branch_name_'+group+'" value="'+branch_name+'" >\n\
                ');
           }
        $('#parsley_reg #deleted_selected_group').append('<input type="hidden" name="deleted_groups[]" value="'+group+'">');
        $('#parsley_reg #hidden_selected_user_group_list #group_id_'+group).remove();
        $('#parsley_reg #hidden_selected_user_group_list #group_name_'+group).remove();
        $('#parsley_reg #hidden_selected_user_group_list #group_branch_id_'+group).remove();
        $('#parsley_reg #hidden_selected_user_group_list #group_branch_name_'+group).remove(); 
        $("#parsley_reg #selected_user_group_list option[value='"+group+"']").remove();
    }
   }



</script>

      