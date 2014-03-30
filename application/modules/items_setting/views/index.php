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
         

         $('#set_new_code').click(function() { 
                <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
                var inputs = $('#add_item').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/items_setting/set_items_setting')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('items_setting').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('items_setting').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Set')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                                    }
                       }
                });<?php }else{ ?>
                  $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                    <?php }?>
        });
         $('#update_items').click(function() { 
                <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                       $.ajax ({
                            url: "<?php echo base_url('index.php/items_setting/set_items_setting')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('items_setting').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('items_setting').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Set')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                                    }
                       }
                 });
                 <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                    <?php }?>
        });
     });
function posnic_add_new(){
    <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
             $("#add_item").trigger('reset');
              $('#add_item_form #item_name_data').val('');
                 $("#add_item_form #item_name_data").select2('data', {id:'',text:''});
                 
                               
                                
      $("#user_list").hide();
      $('#add_item_form').show('slow');
      $('#posnic_add_items').attr("disabled", "disabled");    
      $('#items_lists').removeAttr("disabled");
      window.setTimeout(function ()
        {

          $("#add_item_form #item_name_data").select2('open');
        }, 500);
      <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
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
    posnic_items_lists();
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_items" class="btn btn-default" ><i class="glyphicon glyphicon-cog"></i> <?php echo $this->lang->line('setting') ?></a>  
                        <a href="javascript:posnic_items_lists()" class="btn btn-default" id="items_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('items') ?></a>
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
                                          
                                          <th ><?php echo $this->lang->line('sku'); ?></th>
                                          <th ><?php echo $this->lang->line('name'); ?></th>
                                          <th ><?php echo $this->lang->line('location'); ?></th>
                                          <th ><?php echo $this->lang->line('brand'); ?></th>
                                          <th ><?php echo $this->lang->line('category'); ?> </th>
                                          
                                          <th><?php echo $this->lang->line('status'); ?></th>
                                          <th><?php echo $this->lang->line('action'); ?></th>
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
                                       <h4 class="panel-title"><?php echo $this->lang->line('items_setting') ?></h4>  
                                       <input type="hidden" name="guid" id="guid">
                                     <input type="checkbox" style="display: none" >
                               </div>
                              <br>
                               <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep" id="select_item">
                                                         <label for="items_category_name" class="req"><?php echo $this->lang->line('item') ?></label>                                                                                                       
                                                           
                                                            <?php $name=array('name'=>'name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'item_name_data',
                                                                                    'value'=>set_value('name'));
                                                           echo form_input($name)?> 
                                                    </div>
                                                 </div>
                                                 <div class="col col-lg-1"></div>
                                                 </div>
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="sku" ><?php echo $this->lang->line('sku') ?></label>                                                                                                       
                                                           <?php $sku=array('name'=>'sku',
                                                                                    'class'=>'required form-control',
                                                                                    'disabled'=>'disabled',
                                                                                    'id'=>'sku',
                                                                                    'value'=>set_value('sku'));
                                                           echo form_input($sku)?> 
                                                    </div>                                                  
                                                 </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                             <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="location" ><?php echo $this->lang->line('location') ?></label>                                                                                                       
                                                           <?php $location=array('name'=>'location',
                                                                                    'class'=>'required form-control',
                                                                                    'disabled'=>'disabled',
                                                                                    'id'=>'location',
                                                                                    'value'=>set_value('location'));
                                                           echo form_input($location)?> 
                                                    </div>                                                   
                                                   </div>
                                                   <div class="col col-lg-1"></div>
                                                 </div>
                                               
                                        </div>                              
                             
                              
                                           <div class="row">
                                              <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="brand" ><?php echo $this->lang->line('brand') ?></label>                                                                                                       
                                                           <?php $brand=array('name'=>'brand',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'brand',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('brand'));
                                                           echo form_input($brand)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="category" ><?php echo $this->lang->line('category') ?></label>                                                                                                       
                                                           <?php $category=array('name'=>'category',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'category',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('category'));
                                                           echo form_input($category)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="department_name" ><?php echo $this->lang->line('department_name') ?></label>                                                                                                       
                                                           <?php $department_name=array('name'=>'department_name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'department_name',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('department_name'));
                                                           echo form_input($department_name)?> 
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                              
                                                                     
                                         </div>
                                           <div class="row">
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="min_quty" ><?php echo $this->lang->line('min_quty') ?></label>                                                                                                       
                                                              <?php $min_quty=array('name'=>'min_quty',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'min_quty',
                                                                                    'value'=>set_value('min_quty'));
                                                           echo form_input($min_quty)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="max_quty" ><?php echo $this->lang->line('max_quty') ?></label>                                                                                                       
                                                              <?php $max_quty=array('name'=>'max_quty',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'max_quty',
                                                                                    'value'=>set_value('max_quty'));
                                                           echo form_input($max_quty)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="allow_negative" ><?php echo $this->lang->line('allow_negative') ?></label>                                                                                                       
                                                         <select class="form-control" name="allow_negative" id="allow_negative">
                                                             <option value="0" id="yes"><?php  echo $this->lang->line('no') ?></option>
                                                             <option value="1" id="no" ><?php  echo $this->lang->line('yes') ?></option>
                                                         </select>
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                                                    
                              </div>
                                           <div class="row">
                                                 <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="sale_or_non_sale" ></label>                                                                                                       
                                                      <input type="radio" value="1" name="sales" id="sales_yes"> <label for="sales_yes" class="icheck_label"><?php echo $this->lang->line('sales') ?></label><br>
                                                      <input type="radio" value="0" name="sales" id="sales_no" > <label for="sales_No" class="icheck_label"><?php echo $this->lang->line('non_sales') ?></label>
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                              <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="brand" ></label>                                                                                                       
                                                    <input type="radio" value="1" name="sales_return" id="sales_return_yes"> <label for="sales_return_yes" class="icheck_label"><?php echo $this->lang->line('sales_return') ?></label><br>
                                                      <input type="radio" value="0" name="sales_return" id="sales_return_no" > <label for="sales_return_No" class="icheck_label"><?php echo $this->lang->line('non_sales_return') ?></label>
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="purchase" ></label>                                                                                                       
                                                         <input type="radio" autocomplete="o" value="1" name="purchase" id="purchase_yes"> <label for="purchase_yes" class="icheck_label"><?php echo $this->lang->line('purchase') ?></label><br>
                                                      <input type="radio" value="0" name="purchase" id="purchase_no" > <label for="purchase_No" class="icheck_label"><?php echo $this->lang->line('non_purchase') ?></label>
                                                    
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="purchase_return" ></label>                                                                                                       
                                                      <input type="radio" value="0" name="purchase_return" id="purchase_return_yes"> <label for="purchase_return_yes" class="icheck_label"><?php echo $this->lang->line('purchase_return') ?></label><br>
                                                      <input type="radio" value="1" name="purchase_return" id="purchase_return_no" > <label for="purchase_return_No" class="icheck_label"><?php echo $this->lang->line('non_purchase_return') ?></label>
                                                    
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                                                     
                              </div>
                              <br><br>
                          </div>
                     </div>
                </div>
                   <div class="row">
                        <div class="col-lg-4"></div>
                      <div class="col col-lg-4 text-center"><br><br>
                          <button id="set_new_code"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('set_or_reset') ?></button>
                          <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-cancel"> </i> <?php echo $this->lang->line('cancel') ?></a>
                      </div>
                  </div>
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
                     <div class="col-lg-12">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                       <h4 class="panel-title"><?php echo $this->lang->line('items_setting') ?></h4>  
                                     <input type="hidden" name="guid" id="guid">
                                  
                               </div>
                              <br>
                               <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep" id="select_item">
                                                         <label for="items_category_name" class="req"><?php echo $this->lang->line('item') ?></label>                                                                                                       
                                                           
                                                            <?php $name=array('name'=>'name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'item_name',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('name'));
                                                           echo form_input($name)?> 
                                                    </div>
                                                 </div>
                                                 <div class="col col-lg-1"></div>
                                                 </div>
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="sku" ><?php echo $this->lang->line('sku') ?></label>                                                                                                       
                                                           <?php $sku=array('name'=>'sku',
                                                                                    'class'=>'required form-control',
                                                                                    'disabled'=>'disabled',
                                                                                    'id'=>'sku',
                                                                                    'value'=>set_value('sku'));
                                                           echo form_input($sku)?> 
                                                    </div>                                                  
                                                 </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                             <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="location" ><?php echo $this->lang->line('location') ?></label>                                                                                                       
                                                           <?php $location=array('name'=>'location',
                                                                                    'class'=>'required form-control',
                                                                                    'disabled'=>'disabled',
                                                                                    'id'=>'location',
                                                                                    'value'=>set_value('location'));
                                                           echo form_input($location)?> 
                                                    </div>                                                   
                                                   </div>
                                                   <div class="col col-lg-1"></div>
                                                 </div>
                                               
                                        </div>                              
                             
                              
                                           <div class="row">
                                              <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="brand" ><?php echo $this->lang->line('brand') ?></label>                                                                                                       
                                                           <?php $brand=array('name'=>'brand',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'brand',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('brand'));
                                                           echo form_input($brand)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="category" ><?php echo $this->lang->line('category') ?></label>                                                                                                       
                                                           <?php $category=array('name'=>'category',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'category',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('category'));
                                                           echo form_input($category)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-4">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="department_name" ><?php echo $this->lang->line('department_name') ?></label>                                                                                                       
                                                           <?php $department_name=array('name'=>'department_name',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'department_name',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('department_name'));
                                                           echo form_input($department_name)?> 
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                              
                                                                     
                                         </div>
                                           <div class="row">
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="min_quty" ><?php echo $this->lang->line('min_quty') ?></label>                                                                                                       
                                                              <?php $min_quty=array('name'=>'min_quty',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'min_quty',
                                                                                    'value'=>set_value('min_quty'));
                                                           echo form_input($min_quty)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="max_quty" ><?php echo $this->lang->line('max_quty') ?></label>                                                                                                       
                                                              <?php $max_quty=array('name'=>'max_quty',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'max_quty',
                                                                                    'value'=>set_value('max_quty'));
                                                           echo form_input($max_quty)?> 
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="allow_negative" ><?php echo $this->lang->line('allow_negative') ?></label>                                                                                                       
                                                         <select class="form-control" name="allow_negative" id="allow_negative">
                                                             <option value="0" ><?php  echo $this->lang->line('no') ?></option>
                                                             <option value="1" ><?php  echo $this->lang->line('yes') ?></option>
                                                         </select>
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                                                    
                              </div>
                                           <div class="row">
                                                 <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="sale_or_non_sale" ></label>                                                                                                       
                                                      <input type="radio" value="1" name="sales" id="sales_yes"> <label for="sales_yes" class="icheck_label"><?php echo $this->lang->line('sales') ?></label><br>
                                                      <input type="radio" value="0" name="sales" id="sales_no" > <label for="sales_No" class="icheck_label"><?php echo $this->lang->line('non_sales') ?></label>
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                              <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="brand" ></label>                                                                                                       
                                                    <input type="radio" value="1" name="sales_return" id="sales_return_yes"> <label for="sales_return_yes" class="icheck_label"><?php echo $this->lang->line('sales_return') ?></label><br>
                                                      <input type="radio" value="0" name="sales_return" id="sales_return_no" > <label for="sales_return_No" class="icheck_label"><?php echo $this->lang->line('non_sales_return') ?></label>
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="purchase" ></label>                                                                                                       
                                                     <input type="radio" value="1" name="purchase" id="purchase_yes"> <label for="purchase_yes" class="icheck_label"><?php echo $this->lang->line('purchase') ?></label><br>
                                                      <input type="radio" value="0" name="purchase" id="purchase_no" > <label for="purchase_No" class="icheck_label"><?php echo $this->lang->line('non_purchase') ?></label>
                                                    
                                                    </div>
                                               </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                               <div class="col col-lg-3">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-10">
                                                    <div class="form_sep">
                                                         <label for="purchase_return" ></label>                                                                                                       
                                                      <input type="radio" value="1" name="purchase_return" id="purchase_return_yes"> <label for="purchase_return_yes" class="icheck_label"><?php echo $this->lang->line('purchase_return') ?></label><br>
                                                      <input type="radio" value="0" name="purchase_return" id="purchase_return_no" > <label for="purchase_return_No" class="icheck_label"><?php echo $this->lang->line('non_purchase_return') ?></label>
                                                    
                                                    </div>
                                                   </div>
                                                <div class="col col-lg-1"></div>
                                                </div>
                                                                     
                              </div>
                              <br><br>
                          </div>
                     </div>
                </div>
                   <div class="row">
                        <div class="col-lg-4"></div>
                      <div class="col col-lg-4 text-center"><br><br>
                          <button id="update_items"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('set_or_reset') ?></button>
                          <a href="javascript:reload_update_user()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-cancel"> </i> <?php echo $this->lang->line('cancel') ?></a>
                      </div>
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
                    $(document).ready(function() {
                    $('#add_item').validate();});
                </script>
        

      