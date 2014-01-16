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
         $('#add_new_item').click(function() { 
                <?php if($_SESSION['items_per']['add']==1){ ?>
                var inputs = $('#add_item').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/items/add_items')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('item').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('item').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item');?>', { type: "error" });                           
                                    }
                       }
                });<?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add Record')?>");  
                    <?php }?>
        });
         $('#update_items').click(function() { 
                <?php if($_SESSION['items_per']['edit']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/items/update_items')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                  if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('item').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('item').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('item');?>', { type: "error" });                           
                                    }
                       }
                 });
                 <?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO permission To Edit This Records')?>");  
                    <?php }?>
        });
     });
function posnic_add_new(){
    <?php if($_SESSION['items_per']['add']==1){ ?>
      $("#user_list").hide();
      $('#add_item_form').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_items').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#items_lists').removeAttr("disabled");
      <?php }else{ ?>
                  bootbox.alert("<?php echo $this->lang->line('You Have NO Permission To Add User')?>");  
                    <?php }?>
}
function posnic_items_lists(){
      $('#edit_item_form').hide('hide');
      $('#add_item_form').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_items').removeAttr("disabled");
      $('#items_lists').attr("disabled",'disabled');
}
function clear_add_items(){
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
                        <a href="javascript:posnic_add_new()" id="posnic_add_items" class="btn btn-success" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-warning" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-success" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-danger" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_items_lists()" class="btn btn-success" id="items_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('items') ?></a>
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('items/items_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('items') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                          <th>Id</th>
                                          <th >Select</th>
                                          <th >S K U</th>
                                          <th >Name</th>
                                          <th >Location</th>
                                          <th >Brand Name</th>
                                          <th >Category </th>
                                          
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
<section id="add_item_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'add_item',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/add_pos_items_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                 <div class="row">
                     <div class="col-lg-12">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('item_details') ?></h4>  
                                   
                               </div>
                              <br>
                              <div class="row">
                                       <div class="col col-lg-3" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="sku" class="req"><?php echo $this->lang->line('sku') ?></label>                                                                                                       
                                                           <?php $sku=array('name'=>'sku',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'sku',
                                                                                    'value'=>set_value('sku'));
                                                           echo form_input($sku)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-3" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="bar_code" class="req"><?php echo $this->lang->line('bar_code') ?></label>                                                                                                       
                                                           <?php $bar_code=array('name'=>'bar_code',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'bar_code',
                                                                                    'value'=>set_value('bar_code'));
                                                           echo form_input($bar_code)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-3" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="name" class="req"><?php echo $this->lang->line('name') ?></label>                                                                                                       
                                                           <?php $name=array('name'=>'name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'name',
                                                                                    'value'=>set_value('name'));
                                                           echo form_input($name)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-3" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="brand" class="req"><?php echo $this->lang->line('brand') ?></label>                                                                                                       
                                                             <select id="brand" name="brand" class="form-control required"></select>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="location" class="req"><?php echo $this->lang->line('location') ?></label>                                                                                                       
                                                           <?php $location=array('name'=>'location',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'location',
                                                                                    'value'=>set_value('location'));
                                                           echo form_input($location)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="category" class="req"><?php echo $this->lang->line('category') ?></label>                                                                                                       
                                                            <select id="category" name="category" class="form-control required"></select>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="name" class="req"><?php echo $this->lang->line('name') ?></label>                                                                                                       
                                                           <?php $name=array('name'=>'name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'name',
                                                                                    'value'=>set_value('name'));
                                                           echo form_input($name)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="cost" class="req"><?php echo $this->lang->line('cost') ?></label>                                                                                                       
                                                           <?php $cost=array('name'=>'cost',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'cost',
                                                                                    'value'=>set_value('cost'));
                                                           echo form_input($cost)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="mrp" class="req"><?php echo $this->lang->line('mrp') ?></label>                                                                                                       
                                                           <?php $mrp=array('name'=>'mrp',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'mrp',
                                                                                    'value'=>set_value('mrp'));
                                                           echo form_input($mrp)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="selling_price" class="req"><?php echo $this->lang->line('selling_price') ?></label>                                                                                                       
                                                           <?php $selling_price=array('name'=>'selling_price',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'selling_price',
                                                                                    'value'=>set_value('selling_price'));
                                                           echo form_input($selling_price)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div>
                              <div class="row">
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="discount_per" class="req"><?php echo $this->lang->line('discount_per') ?></label>                                                                                                       
                                                           <?php $discount_per=array('name'=>'discount_per',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'discount_per',
                                                                                    'value'=>set_value('discount_per'));
                                                           echo form_input($discount_per)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="starting_date" class="req"><?php echo $this->lang->line('starting_date') ?></label>                                                                                                       
                                                          <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                       <?php $starting_date=array('name'=>'starting_date',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'starting_date',
                                                                                    'value'=>set_value('starting_date'));
                                                           echo form_input($starting_date)?> 
                                                              <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                                       <div class="col col-lg-4" >
                                           <div class="row">
                                               <div class="col col-lg-1">
                                                   
                                               </div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="ending_date" class="req"><?php echo $this->lang->line('ending_date') ?></label>                                                                                                       
                                                         <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                          <?php $ending_date=array('name'=>'ending_date',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'ending_date',
                                                                                    'value'=>set_value('ending_date'));
                                                           echo form_input($ending_date)?> 
                                                         <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
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
                                      <button id="add_new_item"  type="submit" name="save" class="btn btn-success"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_items()" name="clear" id="clear_user" class="btn btn-warning"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
                                  </div>
                              </div>
                </div>
          </div>
    <?php echo form_close();?>
</section>    
<section id="edit_item_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('items/upadate_pos_items_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
           <div id="main_content">
                <div class="row">
                     <div class="col-lg-4"></div>
                     <div class="col-lg-4">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title">Brand Details</h4>  
                                     <input type="hidden" name="guid" id="guid" >
                               </div>
                              <br>
                              <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="items_name" class="req"><?php echo $this->lang->line('items_name') ?></label>                                                                                                       
                                                           <?php $items_name=array('name'=>'items_name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'items_name',
                                                                                    'value'=>set_value('items_name'));
                                                           echo form_input($items_name)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-1"></div>
                                               </div>
                                        </div>                              
                              </div><br><br>
                          </div>
                     </div>
                </div>
                   <div class="row">
                        <div class="col-lg-4"></div>
                      <div class="col col-lg-4 text-center"><br><br>
                          <button id="update_items"  type="submit" name="save" class="btn btn-success"><i class="icon icon-save"> </i> <?php echo $this->lang->line('update') ?></button>
                          <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-warning"><i class="icon icon-list"> </i> <?php echo $this->lang->line('reload') ?></a>
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
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/items/active',
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
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/items/delete',
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
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('item');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/items/deactive',
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
        

      