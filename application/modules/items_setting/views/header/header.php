
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
                                   $('#item_name_data').change(function() {
                   var guid = $('#item_name_data').select2('data').id;
                   $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/items/edit_items/"+guid,                     
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                               
                                 $('#add_item_form #sku').val(data[0]['code']);
                                 $('#add_item_form #brand').val(data[0]['b_name']);
                                 $('#add_item_form #category').val(data[0]['c_name']);
                                 $('#add_item_form #location').val(data[0]['location']);
                                 $('#add_item_form #department_name').val(data[0]['department_name']);                               
                             } 
                           });
                        $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/items_setting/get_items_setting_details/"+guid,                     
                             data: "", 
                             dataType: 'json',  
//                              beforeSend: function() {
//                                $('#main_content').html('<img src="<?php echo base_url('loading.gif') ?>" />');
//                            },
                             success: function(data)        
                             {    
                                 
                                 $('#add_item_form #min_quty').val(data[1][0]['min_q']);
                                 $('#add_item_form #max_quty').val(data[1][0]['max_q']);
                                 $('#add_item_form #allow_negative').val(data[1][0]['allow_negative']);
                                 $('#add_item_form #tax_Inclusive').val(data[1][0]['tax_inclusive']);
                                 var sales=data[1][0]['sales'];
                                 if(sales==1){
                                  $('#add_item_form #sales_yes').attr('checked',true);
                                 }else{
                                      $('#add_item_form #sales_no').attr("checked", true );
                                 }
                               
                                 var salses_return=data[1][0]['salses_return'];
                                 if(salses_return==1){
                                  $('#add_item_form #sales_return_yes').attr('checked',true);
                                 }else{
                                      $('#add_item_form #sales_return_no').attr("checked", true );
                                 }
                               
                                 var purchase=data[1][0]['purchase'];
                                 if(purchase==1){
                                  $('#add_item_form #purchase_yes').attr('checked',true);
                                 }else{
                                      $('#add_item_form #purchase_no').attr("checked", true );
                                 }
                               
                                 var purchase_return=data[1][0]['purchase_return'];
                                 if(purchase_return==1){
                                  $('#add_item_form #purchase_return_yes').attr('checked',true);
                                 }else{
                                      $('#add_item_form #purchase_return_no').attr("checked", true );
                                 }
                                   $('#add_item_form #guid').val(data[1][0]['guid']);
                               
                             } 
                           });     
                           
                           
                           
          });
         $('#add_item_form #item_name_data').select2({
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('item') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/item_code/get_items_details',
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
                        } );
                        
           function posnic_table(){
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/items_setting/data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , 
        
         null,  null, null,  null,  null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[7]==1){
                                                                            return '<span data-toggle="tooltip" class="text-success hint--top hint--success" ><?php echo $this->lang->line('active') ?></span>';
                                                                        }else{
                                                                            return '<span data-toggle="tooltip" class="text-danger hint--top data-hint="<?php echo $this->lang->line('active') ?>" ><?php echo $this->lang->line('deactive') ?></span>';
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                                                               
                                                                        return '<a href=javascript:set_items_setting("'+oObj.aData[8]+'") ><span data-toggle="tooltip" class="label label-success hint--top hint--success" data-hint="<?php echo $this->lang->line('setting') ?>"><i class="glyphicon glyphicon-cog"></i></span></a>';
                                                                
                                                                },
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
                                   
			}

           
          
           function set_items_setting(guid){
                       $("#parsley_reg").trigger('reset');
                        <?php if($this->session->userdata['items_setting_per']['set']==1){ ?>
                                                               
                            $.ajax({                                      
                              url: "<?php echo base_url() ?>index.php/items_setting/get_items_setting_details/"+guid,                     
                             data: "", 
                             dataType: 'json',  
//                              beforeSend: function() {
//                                $('#main_content').html('<img src="<?php echo base_url('loading.gif') ?>" />');
//                            },
                             success: function(data)        
                             {    
                                 $("#user_list").hide();
                                 $('#edit_item_form').show('slow');
                                 $('#posnic_add_items').attr("disabled", "disabled");    
                                 $('#items_lists').removeAttr("disabled");
                                 $('#edit_item_form #guid').val(data[1][0]['guid']);
                                 $('#edit_item_form #sku').val(data[0][0]['code']);
                                 $('#edit_item_form #item_name').val(data[0][0]['name']);
                                 $('#edit_item_form #brand').val(data[0][0]['b_name']);
                                 $('#edit_item_form #category').val(data[0][0]['c_name']);
                                 $('#edit_item_form #location').val(data[0][0]['location']);
                                 $('#edit_item_form #department_name').val(data[0][0]['department_name']);
                                 $('#edit_item_form #min_quty').val(data[1][0]['min_q']);
                                 $('#edit_item_form #max_quty').val(data[1][0]['max_q']);
                                 $('#edit_item_form #allow_negative').val(data[1][0]['allow_negative']);
                                 
                               
                                 if(data[1][0]['allow_negative']==1){
                                    $('#edit_item_form #allow_negative').val(1); 
                                    
                                 }else{
                                    $('#edit_item_form #allow_negative').val(0); 
                                 }




                                 var sales=data[1][0]['sales'];
                                 if(sales==1){
                                         $('#edit_item_form #sales_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #sales_no').attr("checked", true );
                                 }
                               
                                 var salses_return=data[1][0]['salses_return'];
                                 if(salses_return==1){
                                  $('#edit_item_form #sales_return_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #sales_return_no').attr("checked", true );
                                 }
                               
                                 var purchase=data[1][0]['purchase'];
                                 if(purchase==1){
                                  $('#edit_item_form #purchase_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #purchase_no').attr("checked", true );
                                 }
                               
                                 var purchase_return=data[1][0]['purchase_return'];
                                 if(purchase_return==1){
                                  $('#edit_item_form #purchase_return_yes').attr('checked',true);
                                 }else{
                                      $('#edit_item_form #purchase_return_no').attr("checked", true );
                                 }
                               
                             } 
                           });
                         
                        
                              
                         
                        <?php }else{?>
                                $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('items_setting');?>', { type: "error" });                           
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>


  