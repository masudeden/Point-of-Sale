
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
                   							return '<a href=javascript:posnic_deactive("'+oObj.aData[0]+'")><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:supplier_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('add_items') ?>"><i class="icon-edit"></i></span></a>';
								}
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}
           function posnic_item_table(guid){
           $('#selected_item_table').dataTable({
                                      "bProcessing": true,
                                      "bDestroy": true ,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/suppliers_x_items/suppliers_x_items_table/"+$('#edit_brand_form #supplier_guid').val(),
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='item_name_"+oObj.aData[0]+"' value='"+oObj.aData[1]+"'>";
								},
								
								
							},
        
         null, null, null, null,  null,  null, 

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
                                                                if(oObj.aData[9]==0){
                   							return '<a href=javascript:posnic_items_deactive("'+oObj.aData[0]+'")><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="EDIT"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='DELETE'><i class='icon-trash'></i></span> </a>";
								}else{
                                                                        return '<a href=javascript:posnic_item_active("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('active') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="EDIT"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='DELETE'><i class='icon-trash'></i></span> </a>";
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
                        $("#selected_item_table").dataTable().fnDraw();
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
                        $("#selected_item_table").dataTable().fnDraw();
                    }
                }
            });
            }
            function posnic_items_deactive(guid){
                $.ajax({
                url: '<?php echo base_url() ?>index.php/suppliers_x_items/item_deactive',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl($('#item_name_'+guid).val()+ ' <?php echo $this->lang->line('isdeactivated');?>', { type: "danger" });
                           $("#selected_item_table").dataTable().fnDraw();
                    }
                }
            });
            }
            function posnic_item_active(guid){
                           $.ajax({
                url: '<?php echo base_url() ?>index.php/suppliers_x_items/item_active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl($('#item_name_'+guid).val()+ ' <?php echo $this->lang->line('isactivated');?>', { type: "success" });
                         $("#selected_item_table").dataTable().fnDraw();
                    }
                }
            });
            }
           function supplier_function(guid){
        
           $('#loading').modal('show');
           $('#edit_brand_form').show();
                      
                       $("#parsley_reg").trigger('reset');
                        <?php if($_SESSION['suppliers_per']['add']==1){ ?>
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
                                
                                 $('#parsley_reg #first_name').val(data[0]['first_name']);
                                 $('#parsley_reg #company').val(data[0]['company_name']);
                                 $('#parsley_reg #email').val(data[0]['email']);
                                 $('#parsley_reg #phone').val(data[0]['phone']);
                                $('#parsley_reg #category').val(data[0]['c_name']);
                                $('#edit_brand_form #supplier_guid').val(guid);
                                $('#loading').modal('hide');
                             } 
                           });
                           $('#edit_brand_form #supplier_guid').val(guid);
                         posnic_item_table(guid);
                        
                              // $("#selected_item_table").dataTable().fnDraw();
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('suppliers_x_items');?>', { type: "error" });                       
                        <?php }?>
                       }
           function edit_function(guid){
        
           $('#loading').modal('show');
        
                        <?php if($_SESSION['suppliers_per']['edit']==1){ ?>
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/suppliers_x_items/get_suppliers_x_items/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                               
                                
                                 $('#parsley_reg #quantity').val(data[0]['quty']);
                                 $('#parsley_reg #cost').val(data[0]['cost']);
                                 $('#parsley_reg #price').val(data[0]['price']);
                                 $('#parsley_reg #sku').val(data[1]['code']);
                                 $('#parsley_reg #mrp').val(data[0]['mrp']);
                                   $("#parsley_reg #supplier_category").select2('data', {id:data[0]['category'],text: data[0]['c_name']});
                                $('#loading').modal('hide');
                             } 
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('suppliers_x_items');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


  