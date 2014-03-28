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
                   $('#search_item').change(function() {
                   var guid = $('#search_item').select2('data').id;
                   $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/items/edit_items/"+guid,                     
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 $('#add_item_form #guid').val(guid);
                                 $('#add_item_form #sku').val(data[0]['code']);
                                 $('#add_item_form #brand').val(data[0]['b_name']);
                                 $('#add_item_form #category').val(data[0]['c_name']);
                                 $('#add_item_form #location').val(data[0]['location']);
                                 $('#add_item_form #ean_upc_code').val(data[0]['upc_ean_code']);                               
                             } 
                           });
          });
         $('#search_item').select2({
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('item') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>/index.php/item_code/get_items_details',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: -1,
                                term: term
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term
                        };
                    },
                    results: function (data) {
                      var results = [];
                      $.each(data, function(index, item){
                        results.push({
                          id: item.guid,
                          text: item.name
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });

         $('#set_new_code').click(function() { 
                <?php if($this->session->userdata['item_code_per']['add']==1){ ?>
                var inputs = $('#add_item').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/item_code/set_item_code')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('item_code').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('item_code').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_code');?>', { type: "error" });                           
                                    }
                       }
                });<?php }else{ ?>
                  $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_code');?>', { type: "error" });                           
                    <?php }?>
        });
         $('#update_items').click(function() { 
                <?php if($this->session->userdata['item_code_per']['edit']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                       $.ajax ({
                            url: "<?php echo base_url('index.php/item_code/set_item_code')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('item_code').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_item").trigger('reset');
                                       posnic_items_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#items_name').val()+' <?php echo $this->lang->line('item_code').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_code');?>', { type: "error" });                           
                                    }
                       }
                 });
                 <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('item_code');?>', { type: "error" });                           
                    <?php }?>
        });
     });
function posnic_add_new(){
    <?php if($this->session->userdata['item_code_per']['add']==1){ ?>
      $("#user_list").hide();
      $('#add_item_form').show('slow');
      $('#posnic_add_items').attr("disabled", "disabled");    
      $('#items_lists').removeAttr("disabled");
      <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_code');?>', { type: "error" });                           
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
    var id=$('#parsley_reg #guid').val();
    set_item_code(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_items" class="btn btn-default" ><i class="glyphicon glyphicon-barcode"></i> <?php echo $this->lang->line('add_code') ?></a>  
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
                                          <th ><?php echo $this->lang->line('ean_upc_code'); ?></th>
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
                     <div class="col-lg-2"></div>
                     <div class="col-lg-8">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                     <h4 class="panel-title"><?php echo $this->lang->line('ean_upc_code') ?></h4>  
                                     <input type="hidden" name="guid" id="guid">
                               </div>
                              <br>
                              <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-4">
                                                    <div class="form_sep" id="select_item">
                                                         <label for="items_category_name" class="req"><?php echo $this->lang->line('item') ?></label>                                                                                                       
                                                           
                                                            <?php $sku=array('name'=>'sku',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'search_item',
                                                                                    'value'=>set_value('sku'));
                                                           echo form_input($sku)?> 
                                                    </div>
                                                   </div>
                                               <div class="col col-lg-3">
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
                                              <div class="col col-lg-3">
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
                              </div>
                              <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-4">
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
                                               <div class="col col-lg-3">
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
                                               <div class="col col-lg-3">
                                                    <div class="form_sep">
                                                         <label for="ean_upc_code" class="req"><?php echo $this->lang->line('ean_upc_code') ?></label>                                                                                                       
                                                           <?php $ean_upc_code=array('name'=>'ean_upc_code',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'ean_upc_code',
                                                                                    'value'=>set_value('ean_upc_code'));
                                                           echo form_input($ean_upc_code)?> 
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
                                      <button id="set_new_code"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('save') ?></button>
                                      <a href="javascript:clear_add_items_category()" name="clear" id="clear_user" class="btn btn-default"><i class="icon icon-list"> </i> <?php echo $this->lang->line('clear') ?></a>
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
                     <div class="col-lg-2"></div>
                     <div class="col-lg-8">
                          <div class="panel panel-default">
                               <div class="panel-heading">
                                       <h4 class="panel-title"><?php echo $this->lang->line('ean_upc_code') ?></h4>  
                                     <input type="hidden" name="guid" id="guid">
                               </div>
                              <br>
                               <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-4">
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
                                               <div class="col col-lg-3">
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
                                              <div class="col col-lg-3">
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
                              </div>
                              <div class="row">
                                       <div class="col col-lg-12" >
                                           <div class="row">
                                               <div class="col col-lg-1"></div>
                                               <div class="col col-lg-4">
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
                                               <div class="col col-lg-3">
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
                                               <div class="col col-lg-3">
                                                    <div class="form_sep">
                                                         <label for="ean_upc_code" class="req"><?php echo $this->lang->line('ean_upc_code') ?></label>                                                                                                       
                                                           <?php $ean_upc_code=array('name'=>'ean_upc_code',
                                                                                    'class'=>'required form-control',
                                                                                    'id'=>'ean_upc_code',
                                                                                    'value'=>set_value('ean_upc_code'));
                                                           echo form_input($ean_upc_code)?> 
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
                          <button id="update_items"  type="submit" name="save" class="btn btn-default"><i class="icon icon-save"> </i> <?php echo $this->lang->line('set_or_reset') ?></button>
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
                    $(document).ready(function() {
                    $('#add_item').validate();});
                </script>
        

      