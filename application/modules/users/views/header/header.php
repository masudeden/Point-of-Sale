
<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
           
                    $('#add_user_form').hide();
                    $('#edit_user_form').hide();
                  
     
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
                            $('#parsley_reg #selected_user_group_list').remove();
                            $('#parsley_reg #selected_user_group_parent_div').append(' <select multiple id="selected_user_group_list" class="form-control" name="ToLJ" style="width: 150;height:128px;"></select>');
                            $('#parsley_reg #hidden_user_group_list').remove();
                            $('#parsley_reg #parent_div').append('<div id="hidden_user_group_list"></div>');
                            $('#parsley_reg #user_groups_list').remove();
                            $('#parsley_reg #user_group_parent_div').append(' <select multiple id="user_groups_list" class="form-control" name="ToLJ" style="width: 150;height:128px;"></select>');

        
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
                                 $('#parsley_reg #first_name').val(data[0]['first_name']);
                                 $('#parsley_reg #last_name').val(data[0]['last_name']);
                                 $('#parsley_reg #age').val(data[0]['age']);
                                 $('#parsley_reg #blood').val(data[0]['blood']);
                                 $('#parsley_reg #city').val(data[0]['city']);
                                 $('#parsley_reg #state').val(data[0]['state']);
                                 $('#parsley_reg #country').val(data[0]['country']);
                                 $('#parsley_reg #dob').val(data[0]['dob']);
                                 $('#parsley_reg #email').val(data[0]['email']);
                                 $('#parsley_reg #phone').val(data[0]['phone']);
                                 $('#parsley_reg #sex').val(data[0]['sex']);
                                 $('#parsley_reg #address').val(data[0]['address']);
                                 $('#parsley_reg #zip').val(data[0]['zip']);
                                 $('#parsley_reg #user_guid').val(data[0]['guid']);
                                 $('#parsley_reg #pos_users_id').val(data[0]['username']);
                                for(var i=0;i<data.length;i++){
                                    var group=data[i]['user_group_id'];
                                    var group_name=data[i]['group_name'];
                                    var branch_id=data[i]['branch_guid'];
                                    var branch_name=data[i]['branch_name'];
                                
                                     $('#parsley_reg #selected_user_group_list').append($('<option >', {
                                            value:group,
                                            text: group_name+" ("+branch_name+")"
                                        }));
                                      $('#parsley_reg #parent_div #hidden_selected_user_group_list').append(' \n\
                                      <input type="hidden"  id="group_id_'+group+'" value="'+group+'" >\n\
                                      <input type="hidden" id="group_name_'+group+'" value="'+group_name+'" >\n\
                                      <input type="hidden"  id="group_branch_id_'+group+'" value="'+branch_id+'" >\n\
                                      <input type="hidden" id="group_branch_name_'+group+'" value="'+branch_name+'" >\n\
                                     ');
                                       
                                        if(!$('#orginal_branch_id_'+branch_id).length){
                                     
                                         $('#parsley_reg #parent_div #hidden_selected_user_group_list').append(' <input type="hidden"  id="orginal_branch_id_'+branch_id+'" value="'+branch_id+'" >');

                                        }
                                }
                             } 
                           });
                          
                          
                              
                         
                        <?php }else{?>
                                bootbox.alert("<?php echo $this->lang->line('You Have NO permission To Edit This Records') ?>");
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>
                 <script type="text/javascript" src="<?php echo base_url('template/form_post/jquery.form.js') ?>"></script>

<script type="text/javascript">
   
         $(function() {
               <?php if(isset($msg)){ ?>
             $.bootstrapGrowl("<?php echo $this->lang->line($msg) ?>", { typ1e: "<?php echo $type ?>" });
                   setTimeout(function() {
        $.bootstrapGrowl("This is another test.", { type: 'success' });
    }, 1000);
               <?php }  ?>
               
            });


    </script>
  