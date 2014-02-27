
<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
           
                    $('#add_supplier_details_form').hide();
                    $('#edit_supplier_form').hide();
                  $('#add_supplier_form').validate();
                  
                              posnic_table();
                                add_supplier_form.onsubmit=function()
                                { 
                                  return false;
                                } 
                                parsley_reg.onsubmit=function()
                                { 
                                  return false;
                                } 
                         
                        } );
                        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/suppliers/suppliers_data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='supplier_name_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
								},
								
								
							},
        
        null, null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[8]==0){
                                                                            return '<span data-toggle="tooltip" class="label label-success hint--top hint--success" ><?php echo $this->lang->line('active') ?></span>';
                                                                        }else{
                                                                            return '<span data-toggle="tooltip" class="label label-danger hint--top data-hint="<?php echo $this->lang->line('active') ?>" ><?php echo $this->lang->line('deactive') ?></span>';
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                                if(oObj.aData[8]==0){
                   							return '<a href=javascript:posnic_deactive("'+oObj.aData[0]+'")><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="EDIT"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='DELETE'><i class='icon-trash'></i></span> </a>";
								}else{
                                                                        return '<a href=javascript:posnic_active("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('active') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="EDIT"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='DELETE'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}
    function user_function(guid){
    <?php if($_SESSION['suppliers_per']['delete']==1){ ?>
             bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')." ".$this->lang->line('supplier') ?> "+$('#supplier_name_'+guid).val(), function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/suppliers/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                           $.bootstrapGrowl($('#supplier_name_'+guid).val()+ ' <?php echo $this->lang->line('brand') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }}
            });
        

                        }
    }); <?php }else{?>
           $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('brand');?>', { type: "error" });                       
   <?php }
?>
                        }
            function posnic_deactive(guid){
                $.ajax({
                url: '<?php echo base_url() ?>index.php/suppliers/deactive',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl($('#supplier_name_'+guid).val()+ ' <?php echo $this->lang->line('isdeactivated');?>', { type: "danger" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }
            function posnic_active(guid){
                           $.ajax({
                url: '<?php echo base_url() ?>index.php/suppliers/active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl($('#supplier_name_'+guid).val()+ ' <?php echo $this->lang->line('isactivated');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }
           function edit_function(guid){
           $('#loading').modal('show');
                       $("#parsley_reg #contact_details").remove();
                       $("#parsley_reg #cover_div").append(' <div id="contact_details"></div>');
                       $("#parsley_reg").trigger('reset');
                        <?php if($_SESSION['suppliers_per']['edit']==1){ ?>
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/suppliers/edit_suppliers/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 $("#user_list").hide();
                                 $('#edit_supplier_form').show('slow');
                                 $('#delete').attr("disabled", "disabled");
                                 $('#posnic_add_suppliers').attr("disabled", "disabled");
                                 $('#active').attr("disabled", "disabled");
                                 $('#deactive').attr("disabled", "disabled");
                                 $('#suppliers_lists').removeAttr("disabled");
                                 $('#parsley_reg #guid').val(data[0]['guid']);
                                 $('#parsley_reg #first_name').val(data[0]['first_name']);
                                 $('#parsley_reg #last_name').val(data[0]['last_name']);
                                 $('#parsley_reg #title').val(data[0]['title']);
                             //   alert(strtotime('18-12-2011'));
                                 
                             
                              
                                 $('#parsley_reg #address').val(data[0]['address1']);
                                 $('#parsley_reg #comment').val(data[0]['comments']);
                                 $('#parsley_reg #city').val(data[0]['city']);
                                 $('#parsley_reg #state').val(data[0]['state']);
                                 $('#parsley_reg #zip').val(data[0]['zip']);
                                 $('#parsley_reg #country').val(data[0]['country']);
                                 $('#parsley_reg #company').val(data[0]['company_name']);
                                 $('#parsley_reg #website').val(data[0]['website']);
                                 $('#parsley_reg #credit_days').val(data[0]['credit_days']);
                                 $('#parsley_reg #credit_limit').val(data[0]['credit_limit']);
                                 $('#parsley_reg #balance').val(data[0]['monthly_credit_bal']);
                                 $('#parsley_reg #bank_name').val(data[0]['bank_name']);
                                 $('#parsley_reg #bank_location').val(data[0]['bank_location']);
                                 $('#parsley_reg #account_no').val(data[0]['account_number']);
                                 $('#parsley_reg #cst').val(data[0]['cst_no']);
                                 $('#parsley_reg #gst').val(data[0]['gst_no']);
                                 $('#parsley_reg #tax_no').val(data[0]['tex_reg_no']);
                                 $('#parsley_reg #email').val(data[0]['email']);
                                 $('#parsley_reg #phone').val(data[0]['phone']);
                                var co=0;
                                for(var i=0;i<data.length;i++){
                                  $('#parsley_reg #contact_details').append('<div class="panel panel-default" id="con_'+i+'"> <div class="panel-heading">  <h4 class="panel-title"><?php echo $this->lang->line('contact_details')." - ";  ?>'+parseFloat(i+1)+'</h4>  <a href=javascript:remove_contact_update_div("con_'+i+'") class="pull-right btn btn-danger" style="margin-top: -31px;"><i class="icon  icon-remove"></i></a></div><div class="row"> <div class="col-sm-4" style="padding-left: 25px;"> <div class="step_info"> <label for="address" class="req"><?php echo $this->lang->line('address') ?></label> <?php  $address = array(  'name'  => 'address[]',  'id' => 'address',  'value' =>  set_value('address'),  'rows'  => '7',  'cols'  => '10',  'class' =>'form-control '); echo form_textarea($address); ?>  </div></div><div class="col col-sm-8" style="padding-right: 25px;"><div class="row"><div class="col col-sm-6"><div class="form_sep"><label for="city" class="req"><?php echo $this->lang->line('city') ?></label><?php $city=array('name'=>'city[]','class'=>'  form-control','id'=>'city','value'=>set_value('city'));echo form_input($city)?></div></div><div class="col col-sm-6"><div class="form_sep"><label for="state" class="req"><?php echo $this->lang->line('state') ?></label><?php $state=array('name'=>'state[]','class'=>'  form-control','id'=>'state','value'=>set_value('state'));echo form_input($state)?></div></div></div><div class="row"><div class="col col-sm-6"><div class="form_sep"><label for="zip" class="req"><?php echo $this->lang->line('zip') ?></label><?php $zip=array('name'=>'zip[]','class'=>'  form-control','id'=>'zip','value'=>set_value('zip'));echo form_input($zip)?></div></div><div class="col col-sm-6"><div class="form_sep"><label for="country" class="req"><?php echo $this->lang->line('country') ?></label>													<?php $country=array('name'=>'country[]','class'=>'  form-control','id'=>'country','value'=>set_value('country'));echo form_input($country)?></div>  </div></div><div class="row"><div class="col col-sm-6"><div class="form_sep"><label for="email" class="req"><?php echo $this->lang->line('email') ?></label><?php $email=array('name'=>'email[]','class'=>'required  form-control email','id'=>'email','value'=>set_value('email'));echo form_input($email)?></div> </div><div class="col col-sm-6"><div class="form_sep"><label for="phone" class="req"><?php echo $this->lang->line('phone') ?></label><?php $phone=array('name'=>'phone[]','class'=>'required  form-control number','id'=>'phone','value'=>set_value('phone'));echo form_input($phone)?></div> </div></div><br></div></div></div>');   
                                 $('#parsley_reg #contact_details #con_'+i+' #address').val(data[i]['c_address']);
                                 $('#parsley_reg #contact_details #con_'+i+' #city').val(data[i]['c_city']);
                                 $('#parsley_reg #contact_details #con_'+i+' #state').val(data[i]['c_state']);
                                 $('#parsley_reg #contact_details #con_'+i+' #country').val(data[i]['c_country']);
                                 $('#parsley_reg #contact_details #con_'+i+' #zip').val(data[i]['c_zip']);
                                 $('#parsley_reg #contact_details #con_'+i+' #email').val(data[i]['c_email']);
                                 $('#parsley_reg #contact_details #con_'+i+' #phone').val(data[i]['c_phone']);
                                co=i;
                                }
                                  $("#parsley_reg #supplier_category").select2('data', {id:data[0]['category'],text: data[0]['c_name']});
                                $('#parsley_reg #category').val(data[0]['category']);
                             $('#parsley_reg #cotact_number').val(parseFloat(co+2));
                                $('#loading').modal('hide');
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('brand');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


  