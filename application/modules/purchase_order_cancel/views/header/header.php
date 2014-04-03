
<script type="text/javascript" charset="utf-8">
    var point=3;
          $(document).ready( function () {
              
        	 
                 $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_order') ?>');
                     $('#add_new_order').show();
                            
                                
                                parsley_reg.onsubmit=function()
                                { 
                                  return false;
                                } 
                         
                        } );
                function refresh_items_table(){
                    $('#selected_item_table').dataTable().fnClearTable();
                     if($('#selected_item_table').length) {
                   
                $('#selected_item_table').dataTable({
                     "bProcessing": true,
                                      "bDestroy": true ,
				    
                    "sPaginationType": "bootstrap_full",
                    "fnRowCallback" : function(nRow, aData, iDisplayIndex){
                $("td:first", nRow).html(iDisplayIndex +1);
                $("#index", nRow).val(iDisplayIndex +1);
               return nRow;
            },
                });
            }
              $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('items')." ".$this->lang->line('for')." ".$this->lang->line('purchase_order') ?>');
                }        
          

           function posnic_item_table(guid){
           var supplier=$('#edit_brand_form #supplier_guid').val();
           if($('#edit_brand_form #supplier_guid').val()==""){
               supplier=guid;
           }
           
         		 if($('#selected_item_table').length) {
                $('#selected_item_table').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }	
                                   
			}

           
          
        

          
           function edit_function(guid){
           
        
                        <?php if($this->session->userdata['purchase_order_per']['edit']==1){ ?>
                                
                            $('#deleted').remove();
                            $('#parent_items').append('<div id="deleted"></div>');
                            $('#newly_added').remove();
                            $('#parent_items').append('<div id="newly_added"></div>');
                            refresh_items_table();
                            $('#update_button').show();
                            $('#save_button').hide();
                            $('#update_clear').show();
                            $('#save_clear').hide();
                            $('#loading').modal('show');
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/purchase_order/get_purchase_order/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                                $("#user_list").hide();
                                $('#add_new_order').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_purchase_order').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#purchase_order_lists').removeAttr("disabled");
                                $('#loading').modal('hide');
                                $("#parsley_reg").trigger('reset');
                           
                                $("#parsley_reg #first_name").select2('data', {id:'1',text: data[0]['s_name']});
                                $("#parsley_reg #company").val(data[0]['c_name']);
                                $("#parsley_reg #address").val(data[0]['address']);
                                $("#parsley_reg #purchase_order_guid").val(guid);
                                $("#parsley_reg #demo_order_number").val(data[0]['po_no']);
                                $("#parsley_reg #order_number").val(data[0]['po_no']);
                                $("#parsley_reg #order_date").val(data[0]['po_date']);
                                $("#parsley_reg #expiry_date").val(data[0]['exp_date']);
                                
                                $("#parsley_reg #id_discount").val(data[0]['discount']);
                                $("#parsley_reg #note").val(data[0]['note']);
                                $("#parsley_reg #remark").val(data[0]['remark']);
                                $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                                $("#parsley_reg #freight").val(data[0]['freight']);
                                $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                                $("#parsley_reg #demo_grand_total").val(data[0]['total_amt']);
                                $("#parsley_reg #grand_total").val(data[0]['total_amt']);
                                
                              
                                 
                                  
                                $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                                var tax;
                                for(i=0;i<data.length;i++){
                                      if(!$('#'+data[i]['o_i_guid']).length){
                                  
                                    var  name=data[i]['items_name'];
                                    var  sku=data[i]['i_code'];
                                    var  quty=data[i]['quty'];
                                    var  limit=data[i]['item_limit'];
                                    var  tax_type=data[i]['tax_type_name'];
                                    var  tax_value=data[i]['tax_value'];
                                    var  tax_Inclusive=data[i]['tax_Inclusive'];
                                  
                                    var  free=data[i]['free'];
                                   
                                    var  cost=data[i]['cost'];
                                    var  price=data[i]['sell'];
                                    var  mrp=data[i]['mrp'];
                                    var  o_i_guid=data[i]['o_i_guid'];
                                    var  items_id=data[i]['item'];
                                    if(data[i]['dis_per']!=0){
                                    var discount=(parseFloat(quty)*parseFloat(cost))*(data[i]['dis_per']/100);
                                    var per=data[i]['dis_per'];
                                    }else{
                                    var discount=data[i]['item_dis_amt'];
                                     var num = parseFloat(discount);
                                      discount=num.toFixed(point);
                                    var per=0
                                    if(discount==""){
                                        discount=0;
                                    }
                                  
                                    }
                                   if(data[i]['tax_Inclusive']==1){
                                     var tax=data[i]['order_tax'];
                                    
                                      var total=+tax+ +(parseFloat(quty)*parseFloat(cost))-discount;
                                      var type='Exc';
                                      var num = parseFloat(total);
                                      total=num.toFixed(point);
                                  }else{
                                      var type="Inc";
                                  
                                      var tax=data[i]['order_tax'];
                                      var total=(parseFloat(quty)*parseFloat(cost))-discount;
                                      var num = parseFloat(total);
                                      total=num.toFixed(point);
                                  }
                                    var addId = $('#selected_item_table').dataTable().fnAddData( [
                                    null,
                                    name,
                                    sku,
                                    quty,
                                    free,
                                    cost,
                                    price,
                                    parseFloat(quty)*parseFloat(cost),
                                    tax+' : '+tax_type+'('+type+')',
                                    discount,
                                    total,
                                    '<input type="hidden" name="index" id="index"><input type="hidden" id="'+o_i_guid+'">\n\
                                <input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
                                <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
                                <input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
                                <input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
                                <input type="hidden" name="items_order_guid[]" value="'+o_i_guid+'" id="items_order_guid">\n\
                                <input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
                                <input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
                                <input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost"> \n\
                                <input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
                                <input type="hidden" name="items_mrp[]" value="'+mrp+'" id="items_mrp">\n\
                                <input type="hidden" name="items_tax[]" value="'+tax+'" id="items_tax">\n\
                                <input type="hidden" name="items_tax_type[]" value="'+tax_type+'" id="items_tax_type">\n\
                                <input type="hidden" name="items_tax_value[]" value="'+tax_value+'" id="items_tax_value">\n\
                                <input type="hidden" name="items_tax_inclusive[]" value="'+tax_Inclusive+'" id="items_tax_inclusive">\n\
                                <input type="hidden" name="items_discount[]" value="'+discount+'" id="items_discount">\n\
                                <input type="hidden" name="items_discount_per[]" value="'+per+'" id="items_discount_per">\n\
                                <input type="hidden" name="items_sub_total[]"  value="'+parseFloat(quty)*parseFloat(cost)+'" id="items_sub_total">\n\
                                <input type="hidden" name="items_total[]"  value="'+total+'" id="items_total">\n\
                                <a href=javascript:edit_order_item("'+items_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+items_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

                              var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                              theNode.setAttribute('id','new_item_row_id_'+items_id)
                                }
                                }
                             } 
                           });
                      
                        
                         
                        <?php }else{?>
                                 $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Edit')." ".$this->lang->line('purchase_order');?>', { type: "error" });                       
                        <?php }?>
                       }
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>

            
              


  