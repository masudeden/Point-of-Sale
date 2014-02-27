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
    .select2-drop{
        width: 500px !important;
    }
 
</style>	
<script type="text/javascript">
     $(document).ready( function () {
          $('#add_customer_details_form #customer_category').change(function() {
                   var guid = $('#add_customer_details_form #customer_category').select2('data').id;
                   alert(guid);
                $('#add_customer_details_form #category').val(guid);
          });
          $('#add_customer_details_form #customer_category').select2({
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/suppliers/get_category',
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
                          text: item.category_name
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
        
          $('#add_customer_details_form #payment_type').change(function() {
                   var guid = $('#add_customer_details_form #payment_type').select2('data').id;
                $('#add_customer_details_form #payment').val(guid);
          });
          $('#add_customer_details_form #payment_type').select2({
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/suppliers/get_payment',
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
                          text: item.type
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
        
          $('#parsley_reg #items').change(function() {
                   var guid = $('#parsley_reg #items').select2('data').id;
                   
                $('#parsley_reg #items').val(guid);
          });
          function format_item(sup) {
            if (!sup.id) return sup.text; // optgroup
          //  return "<img class='flag' src='images/flags/" + state.id.toLowerCase() + ".png'/>" + state.text;
         

    return  sup.text+" ( "+sup.value+" )<img src='' style='float:right'>";
            }
          $('#parsley_reg #items').select2({
                 formatResult: format_item,
                formatSelection: format_item,
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/suppliers/get_category',
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
                          text: item.category_name,
                          value: item.active
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
        
        
        
        
        
        $('#add_new_customer').click(function() { 
                <?php if($_SESSION['suppliers_per']['add']==1){ ?>
                var inputs = $('#add_customer_form').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/suppliers/add_suppliers')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('brand').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#add_customer_details").trigger('reset');
                                       posnic_suppliers_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#suppliers_name').val()+' <?php echo $this->lang->line('brand').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('brand');?>', { type: "error" });                           
                                    }
                       }
                });<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('brand');?>', { type: "error" });                       
                    <?php }?>
        });
         $('#update_suppliers').click(function() { 
                <?php if($_SESSION['suppliers_per']['edit']==1){ ?>
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/suppliers/update_suppliers')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                  if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('brand').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_suppliers_lists();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#suppliers_name').val()+' <?php echo $this->lang->line('brand').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('brand');?>', { type: "error" });                           
                                    }
                       }
                 });
                 <?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('brand');?>', { type: "error" });                        
                    <?php }?>
        });
     });
function posnic_add_new(){
    <?php if($_SESSION['suppliers_per']['add']==1){ ?>
      $("#user_list").hide();
      $('#add_customer_details_form').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_suppliers').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#suppliers_lists').removeAttr("disabled");
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('brand');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_suppliers_lists(){
      $('#edit_brand_form').hide('hide');
      $('#add_customer_details_form').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_suppliers').removeAttr("disabled");
      $('#suppliers_lists').attr("disabled",'disabled');
}
function clear_add_suppliers(){
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
                        <a href="javascript:posnic_add_new()" id="posnic_add_suppliers" class="btn btn-success" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-warning" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                   
                       
                        <a href="javascript:posnic_suppliers_lists()" class="btn btn-success" id="suppliers_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('suppliers') ?></a>
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('suppliers/suppliers_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('suppliers') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('name') ?></th>
                                          
                                          <th><?php echo $this->lang->line('company') ?></th>
                                           <th><?php echo $this->lang->line('category') ?></th>
                                          <th><?php echo $this->lang->line('phone') ?></th>
                                          <th><?php echo $this->lang->line('email') ?></th>
                                         
                                      
                                          <th><?php echo $this->lang->line('status') ?></th>
                                          <th><?php echo $this->lang->line('action') ?></th>
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
<div class="modal fade" id="loading">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>
 

<section id="edit_brand_form" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'class'=>'form-horizontal');
       echo form_open_multipart('suppliers/upadate_pos_suppliers_details/',$form);?>
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                     
                <div class="row">
                    <div  class="col-lg-2" style="padding:0px 25px;">
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('supplier')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                       <div class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                   <div class="form_sep">
                                                        <label for="first_name" ><?php echo $this->lang->line('first_name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                  </div>
                                                   </div>
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                    <div class="form_sep">
                                                            <label for="company" ><?php echo $this->lang->line('company') ?></label>													
                                                                     <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'company',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('company'));
                                                                         echo form_input($last_name)?>
                                                       </div>
                                                   </div>
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                    <div class="form_sep">
                                                            <label for="category" ><?php echo $this->lang->line('category') ?></label>													
                                                                     <?php $category=array('name'=>'category',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'category',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('category'));
                                                                         echo form_input($category)?>
                                                       </div>
                                                   </div>
                                               </div>
                                           <div class="row">
                                               <div class="col col-sm-12" style="margin-top: 10px">
                                                      <div class="form_sep">
                                                                 <label for="email" ><?php echo $this->lang->line('email') ?></label>
                                                               
                                                                           <?php $email=array('name'=>'email',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'email',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('email'));
                                                                             echo form_input($email)?>
                                                                
                                                    </div>
                                                   </div>
                                                   <div class="col col-sm-12" style="margin-top: 10px">
                                                        <div class="form_sep">
                                                                 <label for="phone" ><?php echo $this->lang->line('phone') ?></label>
                                                               
                                                                           <?php $phone=array('name'=>'phone',
                                                                                            'class'=>' form-control',
                                                                                            'disabled'=>'disabled',
                                                                                            'id'=>'phone',
                                                                                            'value'=>set_value('phone'));
                                                                             echo form_input($phone)?>
                                                                
                                                    </div> 
                                                     </div>
                                               </div>
                                     <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                         
                         
          </div>
                    <div class="col col-lg-10">
                        <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('items')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                              <div class="row">
                                 
                                       <div class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2">
                                                     <div class="form_sep">
                                                        <label for="items" class="req"><?php echo $this->lang->line('items') ?></label>													
                                                                  <?php $items=array('name'=>'items',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'items',
                                                                                    'value'=>set_value('items'));
                                                                     echo form_input($items)?>
                                                  </div>
                                                   </div>
                                               
                                               </div>
                                          
                                     <br>
                                        </div>                              
                              </div>
                          </div>
                          </div>
                        <div class="row">
                            <div class="image_items"></div>
                        </div>
                    </div>
          </div>  </div>  </div>
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
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('brand');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/suppliers/active',
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
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('brand');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/suppliers/delete',
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
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('brand');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.posnic;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/suppliers/deactive',
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
        

      