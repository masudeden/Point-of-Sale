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
  table td + td + td + td + td + td + td + td + td {
 width: 120px !important;
}
</style>	
<script type="text/javascript">
     $(document).ready( function () {
         $('#add_new_tax_commodity').click(function() { 
                <?php if($this->session->userdata['tax_commodity_per']['edit']==1){ ?>
                var inputs = $('#add_tax_commodity').serialize();
                if($('#add_tax_commodity').valid()){
                      $.ajax ({
                            url: "<?php echo base_url('index.php/tax_commodity/add_tax_commodity')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                    $.bootstrapGrowl('<?php echo $this->lang->line('tax_commodity').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                    $("#dt_table_tools").dataTable().fnDraw();
                                    $("#add_tax_commodity").trigger('reset');
                                    posnic_tax_commodity_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#tax_commodity_name').val()+' <?php echo $this->lang->line('tax_commodity').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('tax_commodity');?>', { type: "error" });                           
                                    }
                       }
                });
                }else{
                      $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('tax_commodity');?>', { type: "error" });                       
                    <?php }?>
        });
         $('#update_tax_commodity').click(function() { 
                <?php if($this->session->userdata['tax_commodity_per']['edit']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                if($('#parsley_reg').valid()){
                      $.ajax ({
                            url: "<?php echo base_url('index.php/tax_commodity/update_tax_commodity')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                  if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('tax_commodity').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_tax_commodity_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#tax_commodity_name').val()+' <?php echo $this->lang->line('tax_commodity').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('tax_commodity');?>', { type: "error" });                           
                                    }
                       }
                 }); }else{
                       $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                 }
                 <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('tax_commodity');?>', { type: "error" });                        
                    <?php }?>
        });
     });
function posnic_add_new(){
    <?php if($this->session->userdata['tax_commodity_per']['add']==1){ ?>
      $("#user_list").hide();
      $('#add_tax_commodity_form').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_tax_commodity').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#tax_commodity_lists').removeAttr("disabled");
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('tax_commodity');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_tax_commodity_lists(){
      $('#edit_tax_commodity_form').hide('hide');
      $('#add_tax_commodity_form').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_tax_commodity').removeAttr("disabled");
      $('#tax_commodity_lists').attr("disabled",'disabled');
}
function clear_add_tax_commodity(){
      $("#posnic_user_2").trigger('reset');
}
function reload_update_user(){
    var id=$('#guid').val();
    edit_function(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_tax_commodity" class="btn btn-default" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-default" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-default" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-default" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_tax_commodity_lists()" class="btn btn-default" id="tax_commodity_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('tax_commodity') ?></a>
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('tax_commodity/tax_commodity_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('tax_commodity') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                          <th>Id</th>
                                          
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('code') ?></th>
                                          <th ><?php echo $this->lang->line('schedule') ?></th>
                                          <th ><?php echo $this->lang->line('description') ?></th>
                                          <th ><?php echo $this->lang->line('tax_area') ?></th>
                                          <th ><?php echo $this->lang->line('tax_types') ?></th>
                                          <th ><?php echo $this->lang->line('value') ?></th>
                                          <th ><?php echo $this->lang->line('status') ?></th>
                                          <th ><?php echo $this->lang->line('action') ?></th>
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
<section id="add_tax_commodity_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'add_tax_commodity',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('tax_commodity/add_pos_tax_commodity_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                 <div class="row">
                     <div class="col-lg-2"></div>
                     <div class="col-lg-8">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('tax_commodity') ?></h4>   
                                   
                               </div>
                              <br>
                              <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="code" class="req"><?php echo $this->lang->line('commodity_code') ?></label>                                                                                                       
                                                           <?php $code=array('name'=>'code',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'code',
                                                                                    'value'=>set_value('code'));
                                                           echo form_input($code)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="schedule" class="req"><?php echo $this->lang->line('schedule') ?></label>                                                                                                       
                                                           <?php $schedule=array('name'=>'schedule',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'schedule',
                                                                                    'value'=>set_value('schedule'));
                                                           echo form_input($schedule)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="part" class="req"><?php echo $this->lang->line('commodity_part') ?></label>                                                                                                       
                                                           <?php $part=array('name'=>'part',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'part',
                                                                                    'value'=>set_value('part'));
                                                           echo form_input($part)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="tax_area" class="req"><?php echo $this->lang->line('tax_area') ?></label>                                                                                                       
                                                         <select name="tax_area" id="tax_commodity_type" class="required form-control">
                                                          
                                                            <?php foreach ($area as $row){ ?>
                                                             <option value="<?php echo $row->guid ?>"><?php echo $row->name ?></option>
                                                             <?php } ?>
                                                         </select>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="tax" class="req"><?php echo $this->lang->line('taxes') ?></label>                                                                                                       
                                                         <select name="taxes"  id="tax_commodity_type" class="required form-control">
                                                          
                                                            <?php foreach ($taxes as $row){ ?>
                                                             <option value="<?php echo $row->guid ?>"><?php echo $row->type." : ".$row->value ?></option>
                                                             <?php } ?>
                                                         </select>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="description" ><?php echo $this->lang->line('description') ?></label>                                                                                                       
                                                         <?php $description=array('name'=>'description',
                                                                           'class'=>'form-control',
                                                                           'id'=>'description',
                                                                           'rows'=>2 );
                                                         echo form_textarea($description)?>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <br><br>
                          </div>
                     </div>
                </div>
                    <div class="row">
                                <div class="col-lg-4"></div>
                                  <div class="col col-lg-4 text-center"><br><br>
                                      <button id="add_new_tax_commodity"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_tax_commodity()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
                                  </div>
                              </div>
                </div>
          </div>
    <?php echo form_close();?>
</section>    
<section id="edit_tax_commodity_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('tax_commodity/upadate_pos_tax_commodity_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                <div class="row">
                     <div class="col-lg-2"></div>
                     <div class="col-lg-8">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                    <h4 class="panel-title"><?php echo $this->lang->line('tax_commodity') ?></h4>  
                                     <input type="hidden" name="guid" id="guid" >
                               </div>
                              <br>
                               <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="code" class="req"><?php echo $this->lang->line('commodity_code') ?></label>                                                                                                       
                                                           <?php $code=array('name'=>'code',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'code',
                                                                                    'value'=>set_value('code'));
                                                           echo form_input($code)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="schedule" class="req"><?php echo $this->lang->line('schedule') ?></label>                                                                                                       
                                                           <?php $schedule=array('name'=>'schedule',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'schedule',
                                                                                    'value'=>set_value('schedule'));
                                                           echo form_input($schedule)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="part" class="req"><?php echo $this->lang->line('commodity_part') ?></label>                                                                                                       
                                                           <?php $part=array('name'=>'part',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'part',
                                                                                    'value'=>set_value('part'));
                                                           echo form_input($part)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="tax_area" class="req"><?php echo $this->lang->line('tax_area') ?></label>                                                                                                       
                                                         <select name="tax_area" id="tax_area" class="required form-control">
                                                          
                                                            <?php foreach ($area as $row){ ?>
                                                             <option value="<?php echo $row->guid ?>"><?php echo $row->name ?></option>
                                                             <?php } ?>
                                                         </select>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="tax" class="req"><?php echo $this->lang->line('taxes') ?></label>                                                                                                       
                                                         <select name="taxes"  id="tax_commodity_type" class="required form-control">
                                                          
                                                            <?php foreach ($taxes as $row){ ?>
                                                             <option value="<?php echo $row->guid ?>"><?php echo $row->type." : ".$row->value ?></option>
                                                             <?php } ?>
                                                         </select>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="description" ><?php echo $this->lang->line('description') ?></label>                                                                                                       
                                                         <?php $description=array('name'=>'description',
                                                                           'class'=>'form-control',
                                                                           'id'=>'description',
                                                                           'rows'=>2 );
                                                         echo form_textarea($description)?>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <br><br>
                          </div>
                     </div>
                </div>
                   <div class="row">
                        <div class="col-lg-4"></div>
                      <div class="col col-lg-4 text-center"><br><br>
                          <button id="update_tax_commodity"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('update') ?></button>
                          <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('reload') ?></a>
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
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('tax_commodity');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/tax_commodity/active',
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
                    function posnic_delete(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('tax_commodity');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/tax_commodity/delete',
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
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('tax_commodity');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/tax_commodity/deactive',
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
        

      