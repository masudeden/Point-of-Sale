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
         $('#add_new_user').click(function() { 
              
                var inputs = $('#posnic_user_2').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/users/add_pos_users_details')?>",
                            data: inputs,
                            type:'POST',
                            success: function(response) {
                          if(response){
                                       bootbox.alert('New User Added ');                                                                            
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#posnic_user_2").trigger('reset');
                          }
                       }
                 });
        });
         $('#update_users').click(function() { 
              
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/users/upadate_pos_users_details')?>",
                            data: inputs,
                            type:'POST',
                            success: function(response) {
                          if(response){
                                       bootbox.alert('Users Updated');                                                                            
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_users_lists();
                          }
                       }
                 });
        });
     });
function posnic_add_new(){
      $("#user_list").hide();
      $('#add_user_form').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_users').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#users_lists').removeAttr("disabled");
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
                        <a href="javascript:posnic_add_new()" id="posnic_add_users" class="btn btn-success" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-warning" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-success" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete_user()" class="btn btn-danger" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_users_lists()" class="btn btn-success" id="users_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('users') ?></a>
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
                                                        <?php if($_SESSION['admin']==2){ 
                                                            foreach ($branch as $brow) {

                                                     ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->store_name ?></option><?php 
                                                            }}else{ foreach ($branch as $brow) {

                                                            ?> <option name="<?php echo $brow->branch_id ?>" value="<?php echo $brow->branch_id ?>" onClick="select_branch(this.form.lang)" > <?php echo $brow->branch_name ?></option>
                                                      <?php }}?></select>
                                                </div> 
                                      <input type="hidden" class="required" name="depa" id="depa">
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('department') ?></label>  
                                                         <select multiple id="myDiv" class="form-control" name="ToLJ" style="width: 150;height:128px;">
                                                         </select>
                                                    </div> 
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('selected_department') ?></label>  
                                                    <select multiple  name="lang" size="7" class="form-control "  style="width: 250">

                                                    </select>
                                                   
                                                    </div> 
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-success " onClick="move(this.form.ToLJ,this.form.lang),get_selected(this.form.lang)" 
                                                           ><i class="icon icon-forward"></i></button>
                                                   
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-success " onClick="backmove(this.form.lang,this.form.ToLJ),get_selected(this.form.lang)"  
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
                                                                                            'class'=>'required  form-control ',
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
                                      <button id="add_new_user"  type="submit" name="save" class="btn btn-success"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_users()" name="clear" id="clear_user" class="btn btn-warning"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
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
                                                        <?php if($_SESSION['admin']==2){ 
                                                            foreach ($branch as $brow) {

                                                     ?> <option name="<?php echo $brow->guid ?>" value="<?php echo $brow->guid ?>" onClick="select_branch_for_edit(this.form.lang)" > <?php echo $brow->store_name ?></option><?php 
                                                            }}else{ foreach ($branch as $brow) {

                                                            ?> <option name="<?php echo $brow->branch_id ?>" value="<?php echo $brow->branch_id ?>" onClick="select_branch_for_edit(this.form.lang)" > <?php echo $brow->branch_name ?></option>
                                                      <?php }}?></select>
                                                </div> 
                                      <input type="hidden" class="required" name="department" id="department">
                                       </div>
                                       <div class="col col-sm-8" style="padding-right: 25px;">
                                           <div class="row">
                                               <div class="col col-sm-6">
                                                    <div class="form_sep">
                                                    <label for="phone"><?php echo $this->lang->line('department') ?></label>  
                                                         <select multiple id="myDiv_depart" class="form-control" name="ToLJ" style="width: 150;height:128px;">
                                                         </select>
                                                    </div> 
                                                   </div>
                                               <div class="col col-sm-6">
                                                    <div class="form_sep" >
                                                    <label for="phone"><?php echo $this->lang->line('selected_department') ?></label>  
                                                    <select multiple id="selected_departmenet" name="lang" size="7"  class="form-control "  style="width: 250">

                                                    </select>
                                                   
                                                    </div> 
                                                   </div>
                                               </div>
                                           <div class="row">
                                                  <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-success " onClick="move(this.form.ToLJ,this.form.lang),get_selected_departments(this.form.lang)" 
                                                           ><i class="icon icon-forward"></i></button>
                                                   
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-6">
                                                    <div class="form_sep text-center">
                                                        <button type="button" class="btn btn-success " onClick="backmove(this.form.lang,this.form.ToLJ),get_selected_departments(this.form.lang)"  
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
                                      <button id="update_users"  type="submit" name="save" class="btn btn-success"><i class="icon icon-save"> </i> <?php echo $this->lang->line('update') ?></button>
                                      <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-warning"><i class="icon icon-list"> </i> <?php echo $this->lang->line('reload') ?></a>
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
                         bootbox.alert("<?php echo $this->lang->line('Select Atleast One User') ?>");
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
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
                         bootbox.alert("<?php echo $this->lang->line('Select Atleast One User') ?>");
                      
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
                         bootbox.alert("<?php echo $this->lang->line('Select Atleast One User') ?>");
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
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
function select_branch_for_edit(tbTo)
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
document.getElementById("myDiv_depart").innerHTML=xmlhttp.responseText;
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
document.getElementById("depa").value="";
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
function get_selected_departments(tbTo){
document.getElementById("department").value="";
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
             document.getElementById("department").value = xmlhttp.responseText;
            
           }else{
                document.getElementById("department").innerHTML="";
           }
}
</script>

      