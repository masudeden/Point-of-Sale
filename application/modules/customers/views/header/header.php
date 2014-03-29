
<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
           
                    $('#add_customer_details_form').hide();
                    $('#edit_brand_form').hide();
                  $('#add_customer_form').validate();
                  
                              posnic_table();
                                add_customer_form.onsubmit=function()
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
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/customers/customers_data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' ><input type='hidden' id='name_"+oObj.aData[0]+"' value='"+oObj.aData[2]+"'>";
								},
								
								
							},
        
        null, null, null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[9]==1){
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
                                                                if(oObj.aData[9]==1){
                   							return '<a href=javascript:posnic_deactive("'+oObj.aData[0]+'")><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
								}else{
                                                                        return '<a href=javascript:posnic_active("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('active') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php  echo $this->lang->line('edit') ?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete') ?>'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}
    function user_function(guid){
         var name=$('#name_'+guid).val();
    <?php if($this->session->userdata['customers_per']['delete']==1){ ?>
             bootbox.confirm("Are you Sure To Delete This customers ", function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/customers/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                           $.bootstrapGrowl('<?php echo $this->lang->line('customer') ?> ' +name+ ' <?php echo $this->lang->line('deleted');?>', { type: "error" });
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
                var name=$('#name_'+guid).val();
                $.ajax({
                url: '<?php echo base_url() ?>index.php/customers/deactive',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl(name+' <?php echo $this->lang->line('isdeactivated');?>', { type: "danger" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }
            function posnic_active(guid){
            var name=$('#name_'+guid).val();
                           $.ajax({
                url: '<?php echo base_url() ?>index.php/customers/active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl(name+' <?php echo $this->lang->line('isactivated');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }
           function edit_function(guid){
           $('#loading').modal('show');
                       $("#parsley_reg").trigger('reset');
                        <?php if($this->session->userdata['customers_per']['edit']==1){ ?>
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/customers/edit_customers/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 $("#user_list").hide();
                                 $('#edit_brand_form').show('slow');
                                 $('#delete').attr("disabled", "disabled");
                                 $('#posnic_add_customers').attr("disabled", "disabled");
                                 $('#active').attr("disabled", "disabled");
                                 $('#deactive').attr("disabled", "disabled");
                                 $('#customers_lists').removeAttr("disabled");
                                 $('#parsley_reg #guid').val(data[0]['guid']);
                                 $('#parsley_reg #first_name').val(data[0]['first_name']);
                                 $('#parsley_reg #last_name').val(data[0]['last_name']);
                                 $('#parsley_reg #title').val(data[0]['title']);
                             //   alert(strtotime('18-12-2011'));
                                 
                                $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/customers/get_date_in_strtotime",                      
                             type: "POST",
                             data: {
                              dob:data[0]['bday'],
                              mdate:data[0]['mday']
                             }, 
                             dataType: 'json',               
                             success: function(data)        
                             {
                                   $('#parsley_reg #dob').val(data['dob']); 
                                   $('#parsley_reg #marragedate').val(data['mdate']); 
                             }});
                              
                                 $('#parsley_reg #address').val(data[0]['address']);
                                 $('#parsley_reg #city').val(data[0]['city']);
                                 $('#parsley_reg #state').val(data[0]['state']);
                                 $('#parsley_reg #zip').val(data[0]['zip']);
                                 $('#parsley_reg #country').val(data[0]['country']);
                                 $('#parsley_reg #company').val(data[0]['company_name']);
                                 $('#parsley_reg #website').val(data[0]['website']);
                                 $('#parsley_reg #credit_days').val(data[0]['cdays']);
                                 $('#parsley_reg #credit_limit').val(data[0]['credit_limit']);
                                 $('#parsley_reg #balance').val(data[0]['month_credit_bal']);
                                 $('#parsley_reg #bank_name').val(data[0]['bank_name']);
                                 $('#parsley_reg #bank_location').val(data[0]['bank_location']);
                                 $('#parsley_reg #account_no').val(data[0]['account_number']);
                                 $('#parsley_reg #cst').val(data[0]['cst']);
                                 $('#parsley_reg #gst').val(data[0]['gst']);
                                 $('#parsley_reg #tax_no').val(data[0]['tax_no']);
                                 $('#parsley_reg #email').val(data[0]['email']);
                                 $('#parsley_reg #phone').val(data[0]['phone']);
                                 
                                 $("#parsley_reg #customer_category").select2('data', {id:data[0]['category_id'],text: data[0]['c_name']});
                                $('#parsley_reg #category').val(data[0]['category_id']);
                                 
                                 $("#parsley_reg #payment_type").select2('data', {id:data[0]['payment'],text: data[0]['type']});
                                $('#parsley_reg #payment').val(data[0]['payment']);
                                
                                $('#loading').modal('hide');
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('brand');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


  