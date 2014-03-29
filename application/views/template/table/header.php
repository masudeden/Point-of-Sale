	<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
                    $('#add_user_form').hide();
                    $('#edit_user_form').hide();
                              posnic_table();
                                posnic_user_2.onsubmit=function()
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
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/users/users_data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox value='"+oObj.aData[0]+"' >";
								},
								
								
							},
        
        null, null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[9]==0){
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
                   							return '<a href=javascript:posnic_deactive("'+oObj.aData[2]+'","'+oObj.aData[0]+'")><span data-toggle="tooltip" class="label label-warning hint--top hint--warning" data-hint="<?php echo $this->lang->line('deactive') ?>"><i class="icon-pause"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'")  ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="EDIT"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[2]+"','"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='DELETE'><i class='icon-trash'></i></span> </a>";
								}else{
                                                                        return '<a href=javascript:posnic_active("'+oObj.aData[2]+'","'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('active') ?>"><i class="icon-play"></i></span></a>&nbsp<a href=javascript:edit_function("'+oObj.aData[0]+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="EDIT"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:user_function('"+oObj.aData[2]+"','"+oObj.aData[0]+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='DELETE'><i class='icon-trash'></i></span> </a>";
                                                                }
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}
    function user_function(users,guid){
    <?php if($this->session->userdata['users_per']['delete']==1){ ?>
             bootbox.confirm("Are you Sure To Delete This Users ("+users+")", function(result) {
             if(result){
            $.ajax({
                url: '<?php echo base_url() ?>/index.php/users/delete',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                          bootbox.alert('User '+users+' Is Deleted');
                        $("#dt_table_tools").dataTable().fnDraw();
                    }}
            });
        

                        }
    }); <?php }else{?>
           bootbox.alert("<?php echo $this->lang->line('You Have NO permission To Delete This Records') ?>");
   <?php }
?>
                        }
            function posnic_deactive(user,guid){
                $.ajax({
                url: '<?php echo base_url() ?>/index.php/users/deactive',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl(user+'<?php echo $this->lang->line('isdeactivated');?>', { type: "danger" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
            }
            function posnic_active(user,guid){
                           $.ajax({
                url: '<?php echo base_url() ?>/index.php/users/active',
                type: "POST",
                data: {
                    guid: guid
                    
                },
                success: function(response)
                {
                    if(response){
                         $.bootstrapGrowl(user+'<?php echo $this->lang->line('isactivated');?>', { type: "success" });
                        $("#dt_table_tools").dataTable().fnDraw();
                    }
                }
            });
                        }
                       function edit_function(guid){
                       $("#parsley_reg").trigger('reset');
                        <?php if($this->session->userdata['users_per']['edit']==1){ ?>
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/users/edit_users/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 $("#user_list").hide();
                                 $('#edit_user_form').show('slow');
                                 $('#delete').attr("disabled", "disabled");
                                 $('#posnic_add_users').attr("disabled", "disabled");
                                 $('#active').attr("disabled", "disabled");
                                 $('#deactive').attr("disabled", "disabled");
                                 $('#users_lists').removeAttr("disabled");
                                 $('#parsley_reg #first_name').val(data[0][0]['first_name']);
                                 $('#parsley_reg #last_name').val(data[0][0]['last_name']);
                                 $('#parsley_reg #age').val(data[0][0]['age']);
                                 $('#parsley_reg #blood').val(data[0][0]['blood']);
                                 $('#parsley_reg #city').val(data[0][0]['city']);
                                 $('#parsley_reg #state').val(data[0][0]['state']);
                                 $('#parsley_reg #country').val(data[0][0]['country']);
                                 $('#parsley_reg #dob').val(data[0][1]);
                                 $('#parsley_reg #email').val(data[0][0]['email']);
                                 $('#parsley_reg #phone').val(data[0][0]['phone']);
                                 $('#parsley_reg #sex').val(data[0][0]['sex']);
                                 $('#parsley_reg #address').val(data[0][0]['address']);
                                 $('#parsley_reg #zip').val(data[0][0]['zip']);
                                 $('#parsley_reg #user_guid').val(data[0][0]['guid']);
                                 $('#parsley_reg #pos_users_id').val(data[0][0]['user_id']);
                                 $('#parsley_reg #department').val(data[1]);
                             } 
                           });
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/users/selected_user_group/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             complete: function(data)        
                             {    
                              
                               $('#selected_departmenet').html(data['responseText']);
                             } 
                            
                           });
                            $("#myDiv_depart option").remove();
                              
                         
                        <?php }else{?>
                                bootbox.alert("<?php echo $this->lang->line('You Have NO permission To Edit This Records') ?>");
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

<script type="text/javascript">
   
         $(function() {
               <?php if(isset($msg)){ ?>
             $.bootstrapGrowl("<?php echo $this->lang->line($msg) ?>", { type: "<?php echo $type ?>" });
               
               <?php }  ?>
               
            });


    </script>
  