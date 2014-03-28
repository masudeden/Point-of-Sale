
<script type="text/javascript" charset="utf-8">
          $(document).ready( function () {
           
                    $('#add_item_form').hide();
                    $('#edit_item_form').hide();
                              posnic_table();
                                add_item.onsubmit=function()
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
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/item_code/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , 
        
        null, null,  null, null,  null,  null, 

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
                                                               
                                                                        return '<a href=javascript:set_item_code("'+oObj.aData[9]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('set_code') ?>"><i class="glyphicon glyphicon-barcode"></i></span></a>';
                                                                
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           
          
           function set_item_code(guid){
                       $("#parsley_reg").trigger('reset');
                        <?php if($this->session->userdata['item_code_per']['edit']==1){ ?>
                                                               
                            $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/items/edit_items/"+guid,                     
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 $("#user_list").hide();
                                 $('#edit_item_form').show('slow');
                                 $('#posnic_add_items').attr("disabled", "disabled");    
                                 $('#items_lists').removeAttr("disabled");
                                 $('#edit_item_form #guid').val(guid);
                                 $('#edit_item_form #sku').val(data[0]['code']);
                                 $('#edit_item_form #item_name').val(data[0]['name']);
                                 $('#edit_item_form #brand').val(data[0]['b_name']);
                                 $('#edit_item_form #category').val(data[0]['c_name']);
                                 $('#edit_item_form #location').val(data[0]['location']);
                                 $('#edit_item_form #ean_upc_code').val(data[0]['upc_ean_code']);
                                 
                               
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('item_code');?>', { type: "error" });                           
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


  