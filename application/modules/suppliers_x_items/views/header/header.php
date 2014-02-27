
<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
           
                    $('#add_customer_details_form').hide();
                    $('#edit_brand_form').hide();
                  $('#add_customer_form').validate();
                  
                              posnic_table();
                                
                                parsley_reg.onsubmit=function()
                                { 
                                  return false;
                                } 
                         
                        } );
                        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/suppliers_x_items/suppliers_data_table",
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
                   							return '<a href=javascript:posnic_deactive("'+oObj.aData[0]+'")><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('add_items') ?>"><i class="icon-edit"></i></span></a>';
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
           $('#edit_brand_form').show();
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
                                
                                
                                $('#parsley_reg #category').val(data[0]['c_name']);
                            
                                $('#loading').modal('hide');
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('brand');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


  