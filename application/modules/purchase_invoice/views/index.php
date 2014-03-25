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
    .ordered_items_table tr td{
        text-align: center;
    }
   .supplier_select{
        width: 200px !important;
    }
   .item_select{
        width: 600px !important;
    }
    table tr td {
/*        width: 120px !important;*/
    }
    .form-control{
         height: 24px;
   
    padding: 0 8px;
    }
    .input-group-addon{
         height: 24px;
   
    padding: 0 8px;
    }
    .select2-container .select2-choice{
        height: 24px;
      line-height: 1.7;
    }
    #dt_table_tools tr td + td + td + td + td + td + td + td + td {
  width: 120px !important;
}
.editable-address {
    display: block;
    margin-bottom: 5px;  
}

.editable-address span {
    width: 70px;  
    display: inline-block;
}
.editable-buttons {
    text-align: center;
}
.popover-title {
    
    text-align: center;
}
.popover-content {
    padding: 6px 24px !important;
    width: 277px!important;
}
.small_inputs input{
    font-size: 11px;
    padding: 0 1px !important;
}
</style>	
<script type="text/javascript">
    var grn_number;
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function receive_quty(e,i){
        var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=13 && unicode!=9){          
            }
            else{
                   receive_quty_items(i);
                   $('#parsley_reg #r_free_id_'+i).focus();
            }
             if (unicode!=27){
            }
            else{  if(parseFloat(i)==0){ 
                     $('#parsley_reg #grn_date').focus();
                    window.setTimeout(function ()
                   { 
                       $('#parsley_reg #grn_date').focus();
                       document.getElementById('grn_date').focus();
                   }, 0);
                    receive_quty_items(i);
            }else{
                 $('#parsley_reg #r_free_id_'+parseFloat(+i-1)).focus();
             }
            }
    }
    function receive_free_items(i)
    {
        if(isNaN($('#parsley_reg #r_free_id_'+i).val())){
           $('#parsley_reg #r_free_id_'+i).val("");
        }else{
            var good=  $('#parsley_reg #r_free_id_'+i).val();
            var res=  $('#parsley_reg #o_free_id_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
                $('#parsley_reg #r_free_id_'+i).val(res);
                 
            }
        }
    }
    function receive_quty_items(i)
    {
        if(isNaN($('#parsley_reg #r_quty_id_'+i).val())){
           $('#parsley_reg #r_quty_id_'+i).val("");
        }else{
            var good=  $('#parsley_reg #r_quty_id_'+i).val();
            var res=  $('#parsley_reg #o_quty_id_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
                $('#parsley_reg #r_quty_id_'+i).val(res);
                 
            }
        }
    }
    function receive_free_items_update(i)
    {
        if(isNaN($('#parsley_reg #r_free_id_'+i).val())){
           $('#parsley_reg #r_free_id_'+i).val("");
        }else{
            var good=  $('#parsley_reg #r_free_id_'+i).val();
            var res=  $('#parsley_reg #o_free_id_'+i).val();
             var old=  $('#parsley_reg #grn_old_free_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
                $('#parsley_reg #r_free_id_'+i).val(res);
                
            }
        }
    }
    function receive_quty_items_update(i)
    {
        if(isNaN($('#parsley_reg #r_quty_id_'+i).val())){
           $('#parsley_reg #r_quty_id_'+i).val("");
        }else{
            var good=  $('#parsley_reg #r_quty_id_'+i).val();
            var res=  $('#parsley_reg #o_quty_id_'+i).val();
            var old=  $('#parsley_reg #grn_old_quantity_'+i).val();
            if(parseFloat(good)>parseFloat(res)){
               
                $('#parsley_reg #r_quty_id_'+i).val(res);
                 
            }
        }
    }
    function new_order_date(e){
    if($('#parsley_reg #purchase_invoice_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #order_date').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #r_quty_id_0').focus();
              window.setTimeout(function ()
    {
         $('#parsley_reg #r_quty_id_0').focus();
            }, 0);
        }
         if (unicode!=27){
        }
       else{
        
          $('#parsley_reg #demo_order_number').select2('open');
        }
        }
        }else{
         $.bootstrapGrowl('<?php echo $this->lang->line('please_select')." ".$this->lang->line('purchase_order');?>', { type: "warning" }); 
         $('#parsley_reg #demo_order_number').select2('open');

        }

    }
    function receive_free(e,i,n){
        var unicode=e.charCode? e.charCode : e.keyCode
            if (unicode!=13 && unicode!=9){          
            }
            else{
                if(parseFloat(n-1)==parseFloat(i)){
                    $('#parsley_reg #note').focus();
                }else{
                   $('#parsley_reg #r_quty_id_'+parseFloat(+i+1)).focus();
               }
               receive_free_items(i)
            }
             if (unicode!=27){
            }
            else{
                 $('#parsley_reg #r_quty_id_'+i).focus();
                 receive_free_items(i);
            }
    }
    function save_new_grn(){
         <?php if($_SESSION['purchase_invoice_per']['add']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_invoice/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_invoice').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_purchase_invoice_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                           
                                    }
                       }
                });
                    }else{
                  
                     $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>', { type: "success" });                         
                     $('#parsley_reg #demo_order_number').select2('open');
                     $("#parsley_reg").trigger('reset');
                      $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('please_select').' '.$this->lang->line('purchase_order')." ".$this->lang->line('for')." ".$this->lang->line('purchase_invoice') ?>');
                     $('#grn_no').val(grn_number);
                     $('#demo_grn_no').val(grn_number);
                    }
                    }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                    }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
                    <?php }?>
    }
    function update_order(){
         <?php if($_SESSION['purchase_invoice_per']['edit']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_invoice/update')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_invoice').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_purchase_invoice_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                           
                                    }
                       }
                });
                    }else{
                  
                   $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
                     $('#parsley_reg #items').select2('open');
                    }
                    }else{
                   $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('all_require_elements');?>', { type: "error" });                        
                    }<?php }else{ ?>
                   $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('supplier');?>', { type: "error" });                       
                    <?php }?>
    }
    
     $(document).ready( function () {
         
       
          $('#parsley_reg #items').change(function() {
              if(document.getElementById('new_item_row_id_'+$('#parsley_reg #items').select2('data').id) && $('#parsley_reg #diabled_item').val()!=$('#parsley_reg #items').select2('data').id){
                     $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #demo_order_number').val(), { type: "warning" });  
                       $('#parsley_reg #items').select2('open');
              }else{
                   var guid = $('#parsley_reg #items').select2('data').id;
                
                       
                $('#parsley_reg #item_id').val(guid);
                $('#parsley_reg #sku').val($('#parsley_reg #items').select2('data').value);
                $('#parsley_reg #item_name').val($('#parsley_reg #items').select2('data').text);
                $('#parsley_reg #cost').val($('#parsley_reg #items').select2('data').cost);
                $('#parsley_reg #price').val($('#parsley_reg #items').select2('data').price);
                $('#parsley_reg #mrp').val($('#parsley_reg #items').select2('data').mrp);
                $('#parsley_reg #supplier_quty').val($('#parsley_reg #items').select2('data').quty);
                $('#parsley_reg #tax_value').val($('#parsley_reg #items').select2('data').tax_value);
                $('#parsley_reg #tax_type').val($('#parsley_reg #items').select2('data').tax_type);
                var tax=$('#parsley_reg #items').select2('data').tax_Inclusive;
                $('#parsley_reg #tax_Inclusive').val(tax);
                if(tax==1){
                    $('#tax_label').text('Tax(Exc)');
                }else{
                    $('#tax_label').text('Tax(Inc)');   
                }
                disacount_and_amount_editable();
                  
                    $('#i_discount').val('0');
                    $('#i_dis_amt').val('0');
                      free_and_discount_input();
                   
               net_amount();
                $('#parsley_reg #extra_elements').click();
                $('#parsley_reg #quantity').focus();
                    window.setTimeout(function ()
                    {
                       //$('#parsley_reg #delivery_date').focus();
                        $('#parsley_reg #quantity').focus();
                    }, 0);
          }
          });
          function format_item(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+"<img src='<?php echo base_url() ?>/uploads/items/"+sup.image+"' style='float:right;height:59px'></img></p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.value+"</p><p style='float:left;width:130px;  margin-left: 10px'> "+sup.category+"</p> <p style='width:130px;  margin-left: 218px'> "+sup.brand+"</p><p style='width:120px;  margin-left: 380px;margin-top: -28px;'> "+sup.department+"</p>";
            }
          $('#parsley_reg #items').select2({
             
              dropdownCssClass : 'item_select',
                 formatResult: format_item,
                formatSelection: format_item,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('items') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/purchase_invoice/search_items/',
                     data: function(term, page) {
                            return {types: ["exercise"],
                                limit: 2,
                                term: term,
                               
                            };
                     },
                    type:'POST',
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term) {
                        return {
                            term: term,
                                     suppler:$('#parsley_reg #supplier_guid').val()
                        };
                    },
                    results: function (data) {
                      var results = [];
                      
                      $.each(data, function(index, item){
                        results.push({
                          id: item.i_guid,
                          text: item.name,
                          value: item.code,
                          image: item.image,
                          brand: item.b_name,
                          category: item.c_name,
                          department: item.d_name,
                          quty: item.quty,
                          cost: item.cost,
                          price: item.price,
                          mrp: item.mrp,
                          tax_type: item.tax_type_name,
                          tax_value: item.tax_value,
                          tax_Inclusive : item.tax_Inclusive ,
                        });
                      });   if($('#supplier_guid').val()==""){
                          $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
     $('#parsley_reg #items').select2('close');   
    $('#parsley_reg #demo_order_number').select2('open');
        
                      }
                      return {
                       
                          results: results
                      };
                    }
                }
            });
         function format_purchase_order(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+"    <br>"+sup.order_date+" "+sup.company+"   "+sup.supplier+"</p> ";
            }
        $('#parsley_reg #demo_order_number').change(function() {
            if($('#parsley_reg #demo_order_number').select2('data').expired==0){
               refresh_items_table();
             $('#loading').modal('show');
                   var guid = $('#parsley_reg #demo_order_number').select2('data').id;

                 $('#parsley_reg #purchase_invoice_guid').val($('#parsley_reg #demo_order_number').select2('data').id);
                 $('#parsley_reg #demo_order_number').val($('#parsley_reg #demo_order_number').select2('data').text);
                 $('#parsley_reg #company').val($('#parsley_reg #demo_order_number').select2('data').company);
                 $('#parsley_reg #first_name').val($('#parsley_reg #demo_order_number').select2('data').supplier);
                 $('#parsley_reg #order_date').val($('#parsley_reg #demo_order_number').select2('data').order_date);
                 $('#parsley_reg #expiry_date').val($('#parsley_reg #demo_order_number').select2('data').expiry);
                 $('#parsley_reg #id_discount').val($('#parsley_reg #demo_order_number').select2('data').discount);
                 $('#parsley_reg #discount_amount').val($('#parsley_reg #demo_order_number').select2('data').dis_amount);
                 $('#parsley_reg #freight').val($('#parsley_reg #demo_order_number').select2('data').freight);
                 $('#parsley_reg #round_off_amount').val($('#parsley_reg #demo_order_number').select2('data').round);
                 $('#parsley_reg #supplier_guid').val(guid);
               
                            $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/purchase_invoice/get_grn/"+guid,                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             { 
                             
                                $("#user_list").hide();
                                $('#add_new_order').show('slow');
                                $('#delete').attr("disabled", "disabled");
                                $('#posnic_add_purchase_invoice').attr("disabled", "disabled");
                                $('#active').attr("disabled", "disabled");
                                $('#deactive').attr("disabled", "disabled");
                                $('#purchase_invoice_lists').removeAttr("disabled");
                               
                             
                                $("#parsley_reg #supplier").val(data[0]['c_name']);
                                $("#parsley_reg #company").val(data[0]['c_name']);
                                $("#parsley_reg #address").val(data[0]['address']);
                                $("#parsley_reg #purchase_invoice_guid").val(guid);
                                $("#parsley_reg #demo_order_number").val(data[0]['po_no']);
                                $("#parsley_reg #order_number").val(data[0]['po_no']);
                                $("#parsley_reg #order_date").val(data[0]['po_date']);
                                $("#parsley_reg #expiry_date").val(data[0]['exp_date']);
                                
                                $("#parsley_reg #id_discount").val(data[0]['discount']);
                              
                                $("#parsley_reg #discount_amount").val(data[0]['discount_amt']);
                                $("#parsley_reg #freight").val(data[0]['freight']);
                                $("#parsley_reg #round_off_amount").val(data[0]['round_amt']);
                                $("#parsley_reg #demo_grand_total").val(data[0]['total_amt']);
                                $("#parsley_reg #grand_total").val(data[0]['total_amt']);
                                
                                $("#parsley_reg #demo_total_amount").val(data[0]['total_item_amt']);
                                $("#parsley_reg #total_amount").val(data[0]['total_item_amt']);
                                
                                  var num = parseFloat($('#demo_total_amount').val());
                                  $('#demo_total_amount').val(num.toFixed(point));
                                  
                                  var num = parseFloat($('#total_amount').val());
                                  $('#total_amount').val(num.toFixed(point));
                                  
                                  var num = parseFloat($('#grand_total').val());
                                  $('#grand_total').val(num.toFixed(point));
                                  
                                  var num = parseFloat($('#demo_grand_total').val());
                                  $('#demo_grand_total').val(num.toFixed(point));
                                  
                                $("#parsley_reg #supplier_guid").val(data[0]['s_guid']);
                                var tax;
                                var receive=0;
                                for(i=0;i<data.length;i++){
                               
                                  if(data[i]['received_quty']<data[i]['quty']){
                                      receive=1;
                                    var  name=data[i]['items_name'];
                                    var  sku=data[i]['i_code'];
                                    var  quty=data[i]['quty'];
                                    var  limit=data[i]['item_limit'];
                                    var  tax_type=data[i]['tax_type_name'];
                                    var  tax_value=data[i]['tax_value'];
                                    var  tax_Inclusive=data[i]['tax_Inclusive'];
                                  
                                    var  free=data[i]['free'];
                                    var  received_quty=data[i]['received_quty'];
                                    var  received_free=data[i]['received_free'];
                                   
                                    var  cost=data[i]['cost'];
                                    var  price=data[i]['sell'];
                                    var  mrp=data[i]['mrp'];
                                    var  o_i_guid=data[i]['o_i_guid'];
                                    var  date=data[i]['date'];
                                    var  items_id=data[i]['item'];
                                    if(data[i]['dis_per']!=0){
                                    var discount=(parseFloat(quty)*parseFloat(cost))*(data[i]['dis_per']/100);
                                    var per=data[i]['dis_per'];
                                     var num = parseFloat(discount);
                                      discount=num.toFixed(point);
                                    }else{
                                    var discount=data[i]['item_dis_amt'];
                                     var num = parseFloat(discount);
                                      discount=num.toFixed(point);
                                    var per="";
                                  
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
                                    cost,
                                    total,
                                    date,
                                    quty,
                                    received_quty,
                                    free,
                                    received_free,
                                    "<input type='hidden' name='items[]' value='"+data[i]['item']+"' ><input type='hidden' id='o_quty_id_"+i+"' value='"+parseFloat(quty-received_quty)+"' ><input type='text' id='r_quty_id_"+i+"' name='receive_quty[]' onkeyup='receive_quty_items("+i+")' onKeyPress='receive_quty(event,"+i+");return numbersonly(event)' class='form-control' style='width:100px'>",
                                    "<input type='hidden' name='order_items[]' value='"+data[i]['o_i_guid']+"' ><input type='hidden' id='o_free_id_"+i+"' value='"+parseFloat(free-received_free)+"' ><input type='text' id='r_free_id_"+i+"' name='receive_free[]' onkeyup='receive_free_items("+i+")' onKeyPress='receive_free(event,"+i+","+data.length+");return numbersonly(event)' class='form-control' style='width:90px'>",
                                   
                                
                                 ] );

                              var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
                              theNode.setAttribute('id','new_item_row_id_'+items_id)
                                }
                                }if(receive==0){
                                  $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>', { type: "success" });                         
                                  $('#selected_item_table .dataTables_empty').html('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('all_items_was_received') ?>');
                                  }
                             } 
                           });
                    
                      window.setTimeout(function ()
                    {
                       //$('#parsley_reg #delivery_date').focus();
                       document.getElementById('order_date').focus();
                       $('#loading').modal('hide');
                    }, 0);  
                    }else{
                     $('#parsley_reg #demo_order_number').select2('open');
                     $("#parsley_reg").trigger('reset');
                     $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')?> '+$('#parsley_reg #demo_order_number').select2('data').text+' <?php echo $this->lang->line('was_expired');?>', { type: "error" });                         
                     $('#grn_no').val(grn_number);
                     $('#demo_grn_no').val(grn_number);
                     
                    }
          });
          $('#parsley_reg #demo_order_number').select2({
              dropdownCssClass : 'supplier_select',
               formatResult: format_purchase_order,
                formatSelection: format_purchase_order,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('purchase_order') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/purchase_invoice/search_grn_order',
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
                          text: item.po_no,
                          company: item.c_name,
                          supplier: item.s_name,
                          order_date: item.po_date,
                          expiry: item.exp_date,
                          discount: item.discount,
                          dis_amount: item.discount_amt,
                          freight: item.freight,
                          round: item.round_amt,
                          expired: item.expired,
                        });
                      });
                      return {
                          results: results
                      };
                    }
                }
            });
      
    });
    
function posnic_add_new(){
refresh_items_table();
   $("#parsley_reg").trigger('reset');
    <?php if($_SESSION['purchase_invoice_per']['add']==1){ ?>
            $('#update_button').hide();
            $(".supplier_select_2").show();
            $(".porchase_order_for_grn").hide();
            $('#save_button').show();
            $('#update_clear').hide();
            $('#save_clear').show();
            $('#total_amount').val('');
            $('#items_id').val('');
            $('#supplier_guid').val('');
            $("#parsley_reg").trigger('reset');
            $('#deleted').remove();
            $('#parent_items').append('<div id="deleted"></div>');
            $('#newly_added').remove();
            $('#parent_items').append('<div id="newly_added"></div>');
            $("#parsley_reg #demo_order_number").select2('data', {id:'',text: 'Search PO'});
             $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/purchase_invoice/order_number/",                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 
                                
                                 $('#parsley_reg #demo_grn_no').val(data[0][0]['prefix']+data[0][0]['max']);
                                 $('#parsley_reg #grn_no').val(data[0][0]['prefix']+data[0][0]['max']);
                                 grn_number=data[0][0]['prefix']+data[0][0]['max'];
                             }
                             });
            
            
            
                  $("#user_list").hide();
                  $('#add_new_order').show('slow');
                  $('#delete').attr("disabled", "disabled");
                  $('#posnic_add_purchase_invoice').attr("disabled", "disabled");
                  $('#active').attr("disabled", "disabled");
                  $('#deactive').attr("disabled", "disabled");
                  $('#purchase_invoice_lists').removeAttr("disabled");
       
                     window.setTimeout(function ()
                    {
                       $('#parsley_reg #demo_order_number').select2('open');
                    }, 1000);
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('brand');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_purchase_invoice_lists(){
      $('#edit_brand_form').hide('hide');
      $('#add_new_order').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_purchase_invoice').removeAttr("disabled");
      $('#purchase_invoice_lists').attr("disabled",'disabled');
}
function clear_add_purchase_invoice(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
}
function clear_update_purchase_invoice(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
      edit_function($('#purchase_invoice_guid').val());
}
function reload_update_user(){
    var id=$('#guid').val();
    supplier_function(id);
}
</script>
<nav id="top_navigation">
    <div class="container">
            <div class="row">
                <div class="col col-lg-7">
                        <a href="javascript:posnic_add_new()" id="posnic_add_purchase_invoice" class="btn btn-success" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew')." ".$this->lang->line('invoice') ?></a>  
                      
                        <a href="javascript:posnic_purchase_invoice_lists()" class="btn btn-success" id="purchase_invoice_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('purchase_invoice') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<div class="modal fade" id="loading">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('purchase_invoice/purchase_invoice_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('purchase_invoice') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('purchase_order') ?></th>
                                          <th ><?php echo $this->lang->line('grn_number') ?></th>
                                          
                                          <th><?php echo $this->lang->line('company') ?></th>
                                           <th><?php echo $this->lang->line('name') ?></th>
                                          <th><?php echo $this->lang->line('order_date') ?></th>
                                          <th><?php echo $this->lang->line('number_of_items') ?></th>
                                          <th><?php echo $this->lang->line('total_amount') ?></th>
                                         
                                      
                                          <th><?php echo $this->lang->line('status') ?></th>
                                          <th style="width: 120px"><?php echo $this->lang->line('action') ?></th>
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

               
       

  
<section id="add_new_order" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('purchase_invoice/upadate_pos_purchase_invoice_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
        <input type="hidden" name="dummy_discount" id="dummy_discount" >
        <input type="hidden" name="dummy_discount_amount" id="dummy_discount_amount" >
        <input type="hidden" name="grn_guid" id="grn_guid" >
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('purchase_invoice')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep supplier_select_2">
                                                        <label for="demo_order_number" ><?php echo $this->lang->line('order_number') ?></label>													
                                                                  <?php $demo_order_number=array('name'=>'demo_order_number',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_order_number',
                                                                                   
                                                                                    'value'=>set_value('demo_order_number'));
                                                                     echo form_input($demo_order_number)?>
                                                        <input type="hidden" id="purchase_invoice_guid" name="purchase_invoice_guid">
                                                       
                                                  </div> 
                                                   <div class="form_sep porchase_order_for_grn" style="margin-top:0px">
                                                         <label for="demo_order_number" ><?php echo $this->lang->line('order_number') ?></label>	
                                                         <input type="text" disabled="disabled" id="edit_grn_node" class='form-control'>
                                                   </div>
                                               </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="name" ><?php echo $this->lang->line('name') ?></label>													
                                                                     <?php $name=array('name'=>'name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'first_name',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('name'));
                                                                         echo form_input($name)?>
                                                            <input type="hidden" name="order_number" id="order_number">
                                                       </div>
                                                    </div>
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="company" ><?php echo $this->lang->line('company') ?></label>													
                                                                     <?php $last_name=array('name'=>'last_name',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'company',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('company'));
                                                                         echo form_input($last_name)?>
                                                    </div><input type="hidden" value="" name='supplier_guid' id='supplier_guid'>
                                               </div>
                                              
                                               <div class="col col-sm-2" >
                                                    <div class="form_sep">
                                                            <label for="address" ><?php echo $this->lang->line('address') ?></label>													
                                                                     <?php $address=array('name'=>'address',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'address',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('address'));
                                                                         echo form_input($address)?>
                                                       </div>
                                               </div>
                                              
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="order_date" ><?php echo $this->lang->line('order_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $order_date=array('name'=>'order_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'order_date',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('order_date'));
                                                                             echo form_input($order_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                               <div class="col col-sm-2" >
                                                     <div class="form_sep">
                                                            <label for="expiry_date" ><?php echo $this->lang->line('expiry_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $expiry_date=array('name'=>'expiry_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'expiry_date',
                                                                                             'disabled'=>'disabled',
                                                                                            'value'=>set_value('expiry_date'));
                                                                             echo form_input($expiry_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                              
                                              
                                               </div>
                                           <div class="row">
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="discount" ><?php echo $this->lang->line('discount') ?>%</label>													
                                                                     <?php $discount=array('name'=>'discount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'id_discount',
                                                                                        'maxlength'=>2,
                                                                                        'disabled'=>'disabled',
                                                                                      
                                                                                        'onKeyPress'=>"new_discount(event);return numbersonly(event)",
                                                                                        'value'=>set_value('discount'));
                                                                         echo form_input($discount)?>
                                                       </div>
                                                    </div>
                                          
                                                
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="discount_amount" ><?php echo $this->lang->line('discount_amount') ?></label>													
                                                                     <?php $discount_amount=array('name'=>'discount_amount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'discount_amount',
                                                                                     
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('discount_amount'));
                                                                         echo form_input($discount_amount)?>
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="freight" ><?php echo $this->lang->line('freight') ?></label>													
                                                                     <?php $freight=array('name'=>'freight',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'freight',
                                                                                     
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('freight'));
                                                                         echo form_input($freight)?>
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="round_off_amount" ><?php echo $this->lang->line('round_off_amount') ?></label>													
                                                                     <?php $round_off_amount=array('name'=>'round_off_amount',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'round_off_amount',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('round_off_amount'));
                                                                         echo form_input($round_off_amount)?>
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="grn_no" ><?php echo $this->lang->line('grn_no') ?></label>													
                                                                     <?php $round_off_amount=array('name'=>'demo_grn_no',
                                                                                        'class'=>'  form-control',
                                                                                        'id'=>'demo_grn_no',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('demo_grn_no'));
                                                                         echo form_input($round_off_amount)?>
                                                            <input type="hidden" name="grn_no" id="grn_no">
                                                       </div>
                                                    </div>
                                                <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="grn_date" ><?php echo $this->lang->line('grn_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $grn_date=array('name'=>'grn_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'grn_date',
                                                                                            'onKeyPress'=>"new_order_date(event)", 
                                                                                            'value'=>set_value('grn_date'));
                                                                             echo form_input($grn_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                       </div>
                                                   </div>
                                           </div>
                                     <br>
                                        </div>                              
                             
                          </div>
                          </div>
                         
                         
         
                  <div class="row small_inputs" >
                    <div class="col col-lg-12">
                      <div class="row" ><input type="hidden" value="0" id='sl_number'>
             
                            <div class="image_items">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('order_items') ?></h4>                                                                               
                                    </div>
                                <table id='selected_item_table' class="table table-striped dataTable ">
                                    <thead>
                                        <tr>
                                            
                                    <th><?php echo $this->lang->line('sl_no') ?></th>
                                    <th><?php echo $this->lang->line('name') ?></th>
                                    <th><?php echo $this->lang->line('sku') ?></th>
                                    <th><?php echo $this->lang->line('cost') ?></th>
                                    <th><?php echo $this->lang->line('total') ?></th>
                                    <th><?php echo $this->lang->line('delivery_date') ?></th>
                                    <th><?php echo $this->lang->line('ordered_quty') ?></th>
                                    <th><?php echo $this->lang->line('received_quty') ?></th>
                                    
                                    <th><?php echo $this->lang->line('ordered_free') ?></th>
                                    <th><?php echo $this->lang->line('received_free') ?></th>
                                    
                                   
                                  
                                    <th><?php echo $this->lang->line('quantity') ?></th>
                                    <th><?php echo $this->lang->line('free') ?></th>
                                 
                                 
                                   
                              
                                    
                                 
                                    </tr>
                                    </thead>
                                    <tbody id="new_order_items" class="ordered_items_table" >
                                       
                                    </tbody >
                                </table>
                                </div>
                                
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col col-lg-12" id="parent_items">
                            <div class="row">
                         
                             
                                 
                                       <div id="" class="col col-lg-6" style="padding-right: 0px;padding-left: 0px">
                                           <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('note')." ".$this->lang->line('and')." ".$this->lang->line('remark') ?></h4>                                                                               
                              </div> <div class="row" style="padding-left:25px;padding-right:25px;padding-bottom:  25px">
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep ">
                                                        <label for="note" ><?php echo $this->lang->line('note') ?></label>													
                                                                  <?php $note=array('name'=>'note',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'note',
                                                                                   'rows'=>3,
                                                                                    'value'=>set_value('note'));
                                                                     echo form_textarea($note)?>
                                                        
                                                  </div>
                                               </div>
                                               <div class="col col-sm-6" >
                                                   <div class="form_sep ">
                                                         <label for="remark" ><?php echo $this->lang->line('remark') ?></label>													
                                                                  <?php $remark=array('name'=>'remark',
                                                                                    'class'=>' form-control',
                                                                                    'id'=>'remark',
                                                                                   'rows'=>3,
                                                                                    'value'=>set_value('remark'));
                                                                     echo form_textarea($remark)?>
                                                        
                                                  </div>
                                               </div>
                                               
                                               
                                               
                                              
                                           </div>
                                           </div>
                                     <br>
                                        </div> 
                                <div class="col col-sm-6" style="padding-right: 0">
                                      <div class="row">
                                          <div class="col col-sm-3" style="padding-top: 50px" >
                                              <div class="form_sep " id="save_button" style="padding-left: 50px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:save_new_grn()" class="btn btn-success"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;padding-left: 50px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_order()" class="btn btn-success"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-3" style="padding-top: 50px"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_purchase_invoice()" class="btn btn-warning"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_purchase_invoice()" class="btn btn-warning"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                               </div>
                                         
                                               
                                               <div class="col col-sm-6" >
                                                     <div class="panel panel-default">
                                                    <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('amount') ?></h4>                                                                               
                              </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="total_amount" ><?php echo $this->lang->line('total_amount') ?></label>													
                                                                  <?php $total_amount=array('name'=>'demo_total_amount',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_total_amount',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('total_amount'));
                                                                     echo form_input($total_amount)?>
                                                        <input type="hidden" name="total_amount" id="total_amount">
                                                        
                                                  </div>
                                                         <div class="form_sep " style="padding: 0 25px">
                                                        <label for="grand_total" ><?php echo $this->lang->line('grand_total') ?></label>													
                                                                  <?php $grand_total=array('name'=>'demo_grand_total',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'demo_grand_total',
                                                                                    'disabled'=>'disabled',
                                                                                    'value'=>set_value('grand_total'));
                                                                     echo form_input($grand_total)?>
                                                        <input type="hidden" name="grand_total" id="grand_total">
                                                        
                                                  </div><br>
                                                  </div>
                                               </div>
                                      </div>
                                  </div>
                             
                          
                          </div>
                                <div id="deleted">
                                    
                                </div>
                                <div id="newly_added">
                                    
                                </div>
                            </div>
                        </div>
                    
          </div>  </div>  </div>
    <?php echo form_close();?>
</section>    
           <div id="footer_space">
              
           </div>
		</div>
	
    <script type="text/javascript">
        function posnic_group_approve(){
              <?php if($_SESSION['purchase_invoice_per']['approve']==1){ ?>
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
                          var guid=posnic[i].value;
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/purchase_invoice/good_receiving_note_approve',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                 complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                        $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('approved');?>', { type: "success" });
                                       $("#dt_table_tools").dataTable().fnDraw();
                                   }else if(response['responseText']=='approve'){
                                        $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is')." ".$this->lang->line('already')." ".$this->lang->line('approved');?>', { type: "warning" });
                                   }else if(response['responseText']=='Noop'){
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
                                   }
                               }
                            });

                          }

                      }
                  

                      }  
               <?php }else{?>
                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
                <?php }?>
               }
                      
                   
    function grn_group_delete(){
                     <?php if($_SESSION['purchase_invoice_per']['delete']==1){ ?>
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('purchase_invoice');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('purchase_invoice') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){   
                              var guid=posnic[i].value;
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/purchase_invoice/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                 complete: function(response) {
                                    if(response['responseText']=='TRUE'){
                                           $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('purchase_invoice') ?>  <?php echo $this->lang->line('deleted');?>', { type: "error" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }else if(response['responseText']=='Approved'){
                                         $.bootstrapGrowl($('#order__number_'+guid).val()+ ' <?php echo $this->lang->line('is') ?>  <?php echo $this->lang->line('is');?> <?php echo $this->lang->line('already');?> <?php echo $this->lang->line('approved');?>', { type: "warning" });
                                    }else{
                                         $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission')." ".$this->lang->line('to')." ".$this->lang->line('approve')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
                                    }
                                    }
                            });

                          }

                      }    
                      }
                      });
                      }  
                      <?php }else{?>
                               $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Delete')." ".$this->lang->line('purchase_invoice');?>', { type: "error" });                       
                       <?php }
                    ?>
                      }
                    
                    
                    
                 
                    
                </script>
        

      