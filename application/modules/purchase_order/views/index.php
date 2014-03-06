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
</style>	
<script type="text/javascript">
    function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false
          }
    }
    function save_new_order(){
         <?php if($_SESSION['purchase_order_per']['add']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_order/save')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order').' '.$this->lang->line('added');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_purchase_order_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_order');?>', { type: "error" });                           
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
    function update_order(){
         <?php if($_SESSION['purchase_order_per']['edit']==1){ ?>
                   if($('#parsley_reg').valid()){
                       var oTable = $('#selected_item_table').dataTable();
                       if(oTable.fnGetData().length>0){
                var inputs = $('#parsley_reg').serialize();
                      $.ajax ({
                            url: "<?php echo base_url('index.php/purchase_order/update')?>",
                            data: inputs,
                            type:'POST',
                            complete: function(response) {
                                if(response['responseText']=='TRUE'){
                                      $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order').' '.$this->lang->line('updated');?>', { type: "success" });                                                                                  
                                       $("#dt_table_tools").dataTable().fnDraw();
                                       $("#parsley_reg").trigger('reset');
                                       posnic_purchase_order_lists();
                                       refresh_items_table();
                                    }else  if(response['responseText']=='ALREADY'){
                                           $.bootstrapGrowl($('#parsley_reg #order_number').val()+' <?php echo $this->lang->line('supplier').' '.$this->lang->line('is_already_added');?>', { type: "warning" });                           
                                    }else  if(response['responseText']=='FALSE'){
                                           $.bootstrapGrowl('<?php echo $this->lang->line('Please Enter All Required Fields');?>', { type: "warning" });                           
                                    }else{
                                          $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('purchase_order');?>', { type: "error" });                           
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
                     $.bootstrapGrowl('<?php echo $this->lang->line('this item already added');?> '+$('#parsley_reg #first_name').val(), { type: "warning" });  
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
                 $('#parsley_reg #quantity').focus();
                 
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
                     url: '<?php echo base_url() ?>index.php/purchase_order/search_items/',
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
                        });
                      });   if($('#supplier_guid').val()==""){
                          $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
     $('#parsley_reg #items').select2('close');   
    $('#parsley_reg #first_name').select2('open');
        
                      }
                      return {
                       
                          results: results
                      };
                    }
                }
            });
         function format_supplier(sup) {
            if (!sup.id) return sup.text;
    return  "<p >"+sup.text+"    <br>"+sup.company+"   "+sup.address1+"</p> ";
            }
        $('#parsley_reg #first_name').change(function() {
            refresh_items_table();
                   var guid = $('#parsley_reg #first_name').select2('data').id;

                 $('#parsley_reg #first_name').val($('#parsley_reg #first_name').select2('data').text);
                 $('#parsley_reg #company').val($('#parsley_reg #first_name').select2('data').company);
                 $('#parsley_reg #address').val($('#parsley_reg #first_name').select2('data').address1);
                 $('#parsley_reg #supplier_guid').val(guid);
              
             
          });
          $('#parsley_reg #first_name').select2({
              dropdownCssClass : 'supplier_select',
               formatResult: format_supplier,
                formatSelection: format_supplier,
                
                escapeMarkup: function(m) { return m; },
                placeholder: "<?php echo $this->lang->line('search').' '.$this->lang->line('category') ?>",
                ajax: {
                     url: '<?php echo base_url() ?>index.php/purchase_order/search_supplier',
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
                          text: item.first_name,
                          company: item.company_name,
                          address1: item.address1,
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
$('#update_button').hide();
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
$("#parsley_reg #first_name").select2('data', {id:'',text: 'Search Supplier'});
    <?php if($_SESSION['purchase_order_per']['add']==1){ ?>
             $.ajax({                                      
                             url: "<?php echo base_url() ?>index.php/purchase_order/order_number/",                      
                             data: "", 
                             dataType: 'json',               
                             success: function(data)        
                             {    
                                 
                                
                                 $('#parsley_reg #order_number').val(data[0][0]['prefix']+data[0][0]['max']);
                                 $('#parsley_reg #demo_order_number').val(data[0][0]['prefix']+data[0][0]['max']);
                             }
                             });
            
            
            
      $("#user_list").hide();
    $('#add_new_order').show('slow');
      $('#delete').attr("disabled", "disabled");
      $('#posnic_add_purchase_order').attr("disabled", "disabled");
      $('#active').attr("disabled", "disabled");
      $('#deactive').attr("disabled", "disabled");
      $('#purchase_order_lists').removeAttr("disabled");
      <?php }else{ ?>
                    $.bootstrapGrowl('<?php echo $this->lang->line('You Have NO Permission To Add')." ".$this->lang->line('brand');?>', { type: "error" });                         
                    <?php }?>
}
function posnic_purchase_order_lists(){
      $('#edit_brand_form').hide('hide');
      $('#add_new_order').hide('hide');      
      $("#user_list").show('slow');
      $('#delete').removeAttr("disabled");
      $('#active').removeAttr("disabled");
      $('#deactive').removeAttr("disabled");
      $('#posnic_add_purchase_order').removeAttr("disabled");
      $('#purchase_order_lists').attr("disabled",'disabled');
}
function clear_add_purchase_order(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
}
function clear_update_purchase_order(){
      $("#parsley_reg").trigger('reset');
      refresh_items_table();
      edit_function($('#purchase_order_guid').val());
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
                        <a href="javascript:posnic_add_new()" id="posnic_add_purchase_order" class="btn btn-success" ><i class="icon icon-user"></i> <?php echo $this->lang->line('addnew') ?></a>  
                        <a href="javascript:posnic_group_deactive()" id="active" class="btn btn-warning" ><i class="icon icon-pause"></i> <?php echo $this->lang->line('deactive') ?></a>
                        <a href="javascript:posnic_group_active()" class="btn btn-success" id="deactive"  ><i class="icon icon-play"></i> <?php echo $this->lang->line('active') ?></a>
                        <a href="javascript:posnic_delete()" class="btn btn-danger" id="delete"><i class="icon icon-trash"></i> <?php echo $this->lang->line('delete') ?></a>
                        <a href="javascript:posnic_purchase_order_lists()" class="btn btn-success" id="purchase_order_lists"><i class="icon icon-list"></i> <?php echo $this->lang->line('purchase_order') ?></a>
                        
                </div>
            </div>
    </div>
</nav>
<nav id="mobile_navigation"></nav>
              
<section class="container clearfix main_section">
        <div id="main_content_outer" class="clearfix">
            <div id="main_content">
                        <?php $form =array('name'=>'posnic'); 
                    echo form_open('purchase_order/purchase_order_manage',$form) ?>
                        <div class="row">
                            <div class="col-sm-12" id="user_list"><br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                            <h4 class="panel-title"><?php echo $this->lang->line('purchase_order') ?></h4>                                                                               
                                    </div>
                                    <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                        <tr>
                                         <th>Id</th>
                                          <th ><?php echo $this->lang->line('select') ?></th>
                                          <th ><?php echo $this->lang->line('order_number') ?></th>
                                          
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
<div class="modal fade" id="loading">
    <div class="modal-dialog" style="width: 146px;margin-top: 20%">
                
        <img src="<?php echo base_url('loader.gif') ?>" style="margin: auto">
                    
        </div>
</div>
<script type="text/javascript">
    function discounte_amount(){
    if(parseFloat($('#parsley_reg #hidden_total_price').val())>0){
        total=parseFloat($('#parsley_reg #hidden_total_price').val());
        discount=(total*parseFloat($('#parsley_reg #discount').val()))/100;
        $('#parsley_reg #total_price').val(parseFloat($('#parsley_reg #hidden_total_price').val())-discount);
       
        round_amt=parseFloat($('#parsley_reg #round_amt').val());
        freight=parseFloat($('#parsley_reg #freight').val())
        if(freight==""){freight=0;}
        if(round_amt==""){round_amt=0;}
         $('#parsley_reg #discount_amt').val(discount);
        if (isNaN($('#parsley_reg #total_price').val())) 
    $('#parsley_reg #total_price').val('00');
    
        if (isNaN($('#parsley_reg #discount_amt').val())) 
    $('#parsley_reg #discount_amt').val('0');
        if (isNaN($('#parsley_reg #round_amt').val())) 
    $('#parsley_reg #round_amt').val('00');
        if (isNaN($('#parsley_reg #freight').val())) 
    $('#parsley_reg #dfreight').val('00');;
    }
    if($('#parsley_reg #discount').val()==0 || isNaN($('#parsley_reg #discount').val())){
        $('#parsley_reg #total_price').val(parseFloat($('#parsley_reg #hidden_total_price').val())+round_amt+freight);
    }
    new_grand_total();
    total=parseFloat($('#parsley_reg #hidden_total_price').val());
    if(total=="" || total==0 || isNaN(total)){
        $('#parsley_reg #total_price').val("0");
    }
}
function new_order_date(e){
    if($('#parsley_reg #supplier_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #order_date').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #expiry_date').focus();
            
        }
         if (unicode!=27){
        }
       else{
        
           $('#parsley_reg #first_name').select2('open');
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #items').select2('open');

        }

    }
function new_expiry_date(e){
    if($('#parsley_reg #supplier_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #expiry_date').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
                  window.setTimeout(function ()
    {
           $('#parsley_reg #id_discount').focus();
            }, 0);
           
           
        }
         if (unicode!=27){
        }
       else{
          
           $('#parsley_reg #order_date').focus();
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function new_discount(e){
    if($('#parsley_reg #supplier_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #discount_amount').focus();
             
        }
         if (unicode!=27){
        }
       else{
            
          document.getElementById("expiry_date").focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function new_discount_amount_press(e){

    if($('#parsley_reg #supplier_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
          
         
           $('#parsley_reg #freight').focus();
          
           
        }
         if (unicode!=27){
        }
       else{
            
            $('#parsley_reg #id_discount').focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function new_freight(e){
    if($('#parsley_reg #supplier_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #round_off_amount').focus();
          
        }
         if (unicode!=27){
        }
       else{
            
            $('#parsley_reg #discount_amount').focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function new_round_off_amount(e){
    if($('#parsley_reg #supplier_guid').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode

        
                  if (unicode!=13 && unicode!=9){
        }
       else{
          $('#parsley_reg #items').select2('open');
        }
         if (unicode!=27){
        }
       else{
            
            $('#parsley_reg #freight').focus();
        }
        
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_A_Supplier');?>', { type: "warning" }); 
         $('#parsley_reg #first_name').select2('open');

        }

    }
function add_new_quty(e){
    if($('#parsley_reg #item_id').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #quantity').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #free').focus();
           
        }
         if (unicode!=27){
        }
       else{
           
           $('#parsley_reg #items').select2('open');
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
         $('#parsley_reg #items').select2('open');

        }

    }
function add_new_free(e){
    if($('#parsley_reg #item_id').val()!=""){

     var unicode=e.charCode? e.charCode : e.keyCode
   if($('#parsley_reg #free').value!=""){
        
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #cost').focus();
         
        }
         if (unicode!=27){
        }
       else{
          
             $("#parsley_reg #quantity").focus();
        }
        }
        }else{
 $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
         $("#parsley_reg #items").focus();

        }

    }
function add_new_cost(e){          
  if($('#parsley_reg #item_id').val()!=""){
     var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #cost').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #price').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            $('#parsley_reg #free').focus();
        }
        }
    }else{
         $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    
       $('#parsley_reg #items').select2('open');
    }
    }
function add_new_price(e){          
  if($('#parsley_reg #item_id').val()!=""){
     var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #price').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           $('#parsley_reg #mrp').focus();
           
        }
         if (unicode!=27){
        }
       else{
               
            $('#parsley_reg #cost').focus();
        }
        }
    }else{
       $('#parsley_reg #items').select2('open');
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
    }
    }
 function add_new_mrp(e){
       if($('#parsley_reg #item_id').val()!=""){
   
        var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!="" && $('#parsley_reg #cost').val() && $('#parsley_reg #price').val()){
                  if (unicode!=13 && unicode!=9){
                    
        }
       else{ 
            if($('#parsley_reg #item_id').val()!=""){
           
     
        document.getElementById('parsley_reg delivery_date').focus();
                  
                            
       }else{
                                        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
          $('#parsley_reg #items').select2('open');
        }
       }
         if (unicode!=27){
        }
       else{
               
               $('#parsley_reg #price').focus();
        }
        }else{
        if($('#parsley_reg #quantity').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
           $('#parsley_reg #quantity').focus();
        }else if($('#parsley_reg #cost').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('cost');?>', { type: "warning" });          
           $('#parsley_reg #cost').focus();
        }else if($('#parsley_reg #price').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('price');?>', { type: "warning" });          
           $('#parsley_reg #price').focus();
        }
        else if($('#parsley_reg #mrp').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('mrp');?>', { type: "warning" });          
           $('#parsley_reg #mrp').focus();
    }else if($('#parsley_reg #delivery_date').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('delivery_date');?>', { type: "warning" });          
           
           window.setTimeout(function ()
    {
       //$('#parsley_reg #delivery_date').focus();
       document.getElementById('delivery_date').focus();
    }, 0);
        }    
    else{
             $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
       $('#parsley_reg #items').select2('open');
        }
        }
        }else{
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
       $('#parsley_reg #items').select2('open');
    }
    }
 function add_new_date(e){
       if($('#parsley_reg #item_id').val()!=""){
   
        var unicode=e.charCode? e.charCode : e.keyCode
    if($('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!="" && $('#parsley_reg #cost').val() && $('#parsley_reg #price').val()){
                  if (unicode!=13 && unicode!=9){
                    
        }
       else{ 
            if($('#parsley_reg #item_id').val()!=""){
                             copy_items();
                            
       }else{
                                        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" }); 
          $('#parsley_reg #items').select2('open');
        }
       }
         if (unicode!=27){
        }
       else{
               
               $('#parsley_reg #mrp').focus();
        }
        }
        }else{
        $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
        $('#parsley_reg #items').select2('open');
    }
    }
    function net_amount(){
        if(isNaN($('#parsley_reg #cost').val()) || isNaN($('#parsley_reg #quantity').val())){
            if(isNaN($('#parsley_reg #cost').val())){
                $('#parsley_reg #cost').val(0)
            }else{
                $('#parsley_reg #quantity').val(0)
            }
        }else{
            if(parseFloat($('#parsley_reg #quantity').val())>parseFloat($('#parsley_reg #supplier_quty').val()) && $('#parsley_reg #supplier_quty').val()!=0){
              $('#parsley_reg #quantity').val($('#parsley_reg #supplier_quty').val());
               $('#parsley_reg #total').val($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val());
                $.bootstrapGrowl('<?php echo $this->lang->line('not_able_to_order');?> '+$('#parsley_reg #first_name').val()+' <?php echo $this->lang->line('for');?> '+$('#parsley_reg #item_name').val(), { type: "warning" }); 
            }else{
                  $('#parsley_reg #total').val($('#parsley_reg #cost').val()*$('#parsley_reg #quantity').val());
            }
        }
    }
function copy_items(){
 if( $('#parsley_reg #item_id').val()!="" &&  $('#parsley_reg #cost').val()!="" && $('#parsley_reg #price').val()!="" && $('#parsley_reg #mrp').val()!="" && $('#parsley_reg #quantity').val()!="" && $('#parsley_reg #delivery_date').val()){
 
   if($('#parsley_reg #cost').val()<$('#parsley_reg #price').val()) { 
   if(parseFloat($('#parsley_reg #mrp').val())>=parseFloat($('#parsley_reg #price').val())) {
      
if(document.getElementById('new_item_row_id_'+$('#parsley_reg #item_id').val())){

  var  name=$('#parsley_reg #item_name').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  if($('#parsley_reg #free').val()!=""){
  var  free=$('#parsley_reg #free').val();
  }else{
      free=0;
  }
  var  cost=$('#parsley_reg #cost').val();
  var  price=$('#parsley_reg #price').val();
  var  mrp=$('#parsley_reg #mrp').val();
  var  date=$('#parsley_reg #delivery_date').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  supplier=$('#parsley_reg #supplier_guid').val();
  ///$('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()).remove();
 var old_total= $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val();
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(2)').html(name);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(3)').html(sku);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(4)').html(quty);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(5)').html(free);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(6)').html(cost);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(7)').html(price);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(8)').html(mrp);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(9)').html(date);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' td:nth-child(10)').html(parseFloat(quty)*parseFloat(cost));
 
  $('#newly_added #new_item_id_'+items_id).val(items_id);
  $('#newly_added #new_item_quty_'+items_id).val(quty);
  $('#newly_added #new_item_free_'+items_id).val(free);
  $('#newly_added #new_item_cost_'+items_id).val(cost);
  $('#newly_added #new_item_price_'+items_id).val(price);
  $('#newly_added #new_item_mrp_'+items_id).val(mrp);
  $('#newly_added #new_item_date_'+items_id).val(date);
  $('#newly_added #new_item_total_'+items_id).val(parseFloat(quty)*parseFloat(cost));
 
  
  
  
  
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_id').val(items_id);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_name').val(name);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_sku').val(sku);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_quty').val(quty);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_free').val(free);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_cost').val(cost);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_price').val(price);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_mrp').val(mrp);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_date').val(date);
  $('#selected_item_table #new_item_row_id_'+$('#parsley_reg #item_id').val()+' #items_total').val(parseFloat(quty)*parseFloat(cost));
    $.bootstrapGrowl('<?php echo $this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('updated');?> ', { type: "success" });  
      if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
if($('#parsley_reg #total_amount').val()==0){
      $('#parsley_reg #total_amount').val((parseFloat(quty)*parseFloat(cost))-parseFloat(old_total));
}else{
    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+(parseFloat(quty)*parseFloat(cost))-parseFloat(old_total));
}
$('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
   new_discount_amount();
    
    
    
    clear_inputs();
}else{
   

  var  name=$('#parsley_reg #item_name').val();
  var  sku=$('#parsley_reg #sku').val();
  var  quty=$('#parsley_reg #quantity').val();
  if($('#parsley_reg #free').val()!=""){
  var  free=$('#parsley_reg #free').val();
  }else{
  var  free=0;
  }
  var  cost=$('#parsley_reg #cost').val();
  var  price=$('#parsley_reg #price').val();
  var  mrp=$('#parsley_reg #mrp').val();
  var  date=$('#parsley_reg #delivery_date').val();
  var  items_id=$('#parsley_reg #item_id').val();
  var  supplier=$('#parsley_reg #supplier_guid').val();
  var  limit=$('#parsley_reg #supplier_quty').val();
   $('#newly_added').append('<div id="newly_added_items_list_'+items_id+'"> \n\
\n\
<input type="hidden" name="new_item_id[]" value="'+items_id+'"  id="new_item_id_'+items_id+'">\n\
<input type="hidden" name="new_item_quty[]" value="'+quty+'" id="new_item_quty_'+items_id+'"> \n\
<input type="hidden" name="new_item_free[]" value="'+free+'" id="new_item_free_'+items_id+'">\n\
<input type="hidden" name="new_item_cost[]" value="'+cost+'" id="new_item_cost_'+items_id+'"> \n\
<input type="hidden" name="new_item_price[]" value="'+price+'" id="new_item_price_'+items_id+'">\n\
<input type="hidden" name="new_item_mrp[]" value="'+mrp+'" id="new_item_mrp_'+items_id+'">\n\
<input type="hidden" name="new_item_date[]" value="'+date+'" id="new_item_date_'+items_id+'">\n\
<input type="hidden" name="new_item_total[]"  value="'+parseFloat(quty)*parseFloat(cost)+'" id="new_item_total_'+items_id+'">\n\
</div>');
   var addId = $('#selected_item_table').dataTable().fnAddData( [
      null,
      name,
      sku,
      quty,
      free,
      cost,
      price,
      mrp,
      date,
      parseFloat(quty)*parseFloat(cost),
      '<input type="hidden" name="index" id="index">\n\
<input type="hidden" name="item_name" id="row_item_name" value="'+name+'">\n\
<input type="hidden" name="items_id[]" id="items_id" value="'+items_id+'">\n\
<input type="hidden" name="items_sku[]" value="'+sku+'" id="items_sku">\n\
      <input type="hidden" name="item_limit" id="item_limit" value="'+limit+'">\n\
<input type="hidden" name="items_quty[]" value="'+quty+'" id="items_quty"> \n\
<input type="hidden" name="items_free[]" value="'+free+'" id="items_free">\n\
<input type="hidden" name="items_cost[]" value="'+cost+'" id="items_cost"> \n\
<input type="hidden" name="items_price[]" value="'+price+'" id="items_price">\n\
   <input type="hidden" name="items_order_guid[]" value="" id="items_order_guid">\n\
<input type="hidden" name="items_mrp[]" value="'+mrp+'" id="items_mrp">\n\
<input type="hidden" name="items_date[]" value="'+date+'" id="items_date">\n\
<input type="hidden" name="items_total[]"  value="'+parseFloat(quty)*parseFloat(cost)+'" id="items_total">\n\
        <a href=javascript:edit_order_item("'+items_id+'") ><span data-toggle="tooltip" class="label label-info hint--top hint--info" data-hint="<?php echo $this->lang->line('edit')?>"><i class="icon-edit"></i></span></a>'+"&nbsp;<a href=javascript:delete_order_item('"+items_id+"'); ><span data-toggle='tooltip' class='label label-danger hint--top hint--error' data-hint='<?php echo $this->lang->line('delete')?>'><i class='icon-trash'></i></span> </a>" ] );

var theNode = $('#selected_item_table').dataTable().fnSettings().aoData[addId[0]].nTr;
theNode.setAttribute('id','new_item_row_id_'+items_id)
    $.bootstrapGrowl('<?php echo $this->lang->line('new')." ".$this->lang->line('item') ?> '+name+' <?php echo $this->lang->line('added');?> ', { type: "success" });  
     if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
if($('#parsley_reg #total_amount').val()==0){
      $('#parsley_reg #total_amount').val(parseFloat(quty)*parseFloat(cost));
}else{
    $('#parsley_reg #total_amount').val(parseFloat($('#parsley_reg #total_amount').val())+(parseFloat(quty)*parseFloat(cost)));
}
$('#parsley_reg #demo_total_amount').val($('#parsley_reg #total_amount').val());
   new_discount_amount();
    
    
    clear_inputs();
    
      }  
        }else{
       
          $.bootstrapGrowl('<?php echo $this->lang->line('Selling Price Must Less Than MRP price');?>', { type: "warning" });          
       $('#parsley_reg #mrp').focus();
        }
        }else{
      
         $.bootstrapGrowl('<?php echo $this->lang->line('Cost Must Less Than Sell price');?>', { type: "warning" }); 
        $('#parsley_reg #cost').focus();
        }
        
        }else{
         if($('#parsley_reg #item_id').val()==""){
            $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
           $('#parsley_reg #items').select2('open');
        }
          else if($('#parsley_reg #quantity').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('quantity');?>', { type: "warning" });          
           $('#parsley_reg #quantity').focus();
        }else if($('#parsley_reg #cost').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('cost');?>', { type: "warning" });          
           $('#parsley_reg #cost').focus();
        }else if($('#parsley_reg #price').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('price');?>', { type: "warning" });          
           $('#parsley_reg #price').focus();
        }
        else if($('#parsley_reg #mrp').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('mrp');?>', { type: "warning" });          
           $('#parsley_reg #mrp').focus();
        }else if($('#parsley_reg #delivery_date').val()==""){
          $.bootstrapGrowl('<?php echo $this->lang->line('please_enter')." ".$this->lang->line('delivery_date');?>', { type: "warning" });          
           
           window.setTimeout(function ()
    {
       //$('#parsley_reg #delivery_date').focus();
       document.getElementById('delivery_date').focus();
    }, 0);
        }
        else{
             $.bootstrapGrowl('<?php echo $this->lang->line('Please_Select_An_Item');?>', { type: "warning" });          
       $('#parsley_reg #items').select2('open');
        }
        }
       
}
function edit_order_item(guid){
   

    $('#parsley_reg #item_name').val($('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val());
    $('#parsley_reg #sku').val($('#selected_item_table #new_item_row_id_'+guid+' #items_sku').val());
    $('#parsley_reg #supplier_quty').val($('#selected_item_table #new_item_row_id_'+guid+' #item_limit').val());
    $('#parsley_reg #quantity').val($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val());
    $('#parsley_reg #free').val($('#selected_item_table #new_item_row_id_'+guid+' #items_free').val());
    $('#parsley_reg #cost').val($('#selected_item_table #new_item_row_id_'+guid+' #items_cost').val());
    $('#parsley_reg #price').val($('#selected_item_table #new_item_row_id_'+guid+' #items_price').val());
    $('#parsley_reg #mrp').val($('#selected_item_table #new_item_row_id_'+guid+' #items_mrp').val());
    $('#parsley_reg #delivery_date').val($('#selected_item_table #new_item_row_id_'+guid+' #items_date').val());
    $('#parsley_reg #item_id').val(guid);
    $('#parsley_reg #total').val(parseFloat($('#selected_item_table #new_item_row_id_'+guid+' #items_cost').val())*parseFloat($('#selected_item_table #new_item_row_id_'+guid+' #items_quty').val()));
     $("#parsley_reg #items").select2('data', {id:guid,text:$('#selected_item_table #new_item_row_id_'+guid+' #row_item_name').val() });
}
function delete_order_item(guid){
    var net=$('#selected_item_table #new_item_row_id_'+guid+' #items_total').val();
    var total=$("#parsley_reg #total_amount").val();
    $("#parsley_reg #total_amount").val(parseFloat(total)-parseFloat(net));
    $("#parsley_reg #demo_total_amount").val(parseFloat(total)-parseFloat(net));
    new_discount_amount();
    $("#parsley_reg #total_amount").val()
     var order=$('#selected_item_table #new_item_row_id_'+guid+' #items_order_guid').val();
      $('#deleted').append('<input type="text" id="r_items" name="r_items[]" value="'+order+'">');
    var index=$('#selected_item_table #new_item_row_id_'+guid+' #index').val();
     var anSelected =  $("#selected_item_table").dataTable();
       anSelected.fnDeleteRow(index-1);
    if(document.getElementById('newly_added_items_list_'+guid)){
        $('#newly_added_items_list_'+guid).remove();
    }
}
function clear_inputs(){
  $('#parsley_reg #item_name').val('');
  $('#parsley_reg #sku').val('');
  $('#parsley_reg #quantity').val('');
  $('#parsley_reg #free').val('');
  $('#parsley_reg #total').val('');
  $('#parsley_reg #cost').val('');
  $('#parsley_reg #price').val('');
  $('#parsley_reg #mrp').val('');
  $('#parsley_reg #item_id').val('')
    $("#parsley_reg #items").select2('data', {id:'',text: 'Search Item'});
     $('#parsley_reg #items').select2('open');
}
function new_grand_total(){
         if(parseFloat($("#parsley_reg #total_amount").val())>0){
var discount=parseFloat($("#parsley_reg #discount_amount").val());
var frieight=parseFloat($("#parsley_reg #freight").val());
var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
    if (isNaN(discount) || discount=="") {
    discount=0;}
        if (isNaN(frieight)|| frieight=="") {
    frieight=00;}
        if (isNaN(round_amt)|| round_amt=="") {
    round_amt=00;}


     $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt);
     $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount+frieight+round_amt);
         }
   if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val(0)
        if (isNaN($("#parsley_reg #demo_total_amount").val())) 
    $("#parsley_reg #demo_total_amount").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #demo_grand_total").val(0)
    
        if (isNaN($("#parsley_reg #demo_grand_total").val())) 
    $("#parsley_reg #grand_total").val(0)
    
}
function new_discount_amount(){
 if(parseFloat($("#parsley_reg #total_amount").val())>0){
      var total=parseFloat($("#parsley_reg #total_amount").val());
      var discount=(total*parseFloat($("#parsley_reg #id_discount").val()))/100;
         $("#parsley_reg #demo_grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount);
         $("#parsley_reg #grand_total").val(parseFloat($("#parsley_reg #total_amount").val())-discount);
       $("#parsley_reg #discount_amount").val(discount);
        var round_amt=parseFloat($("#parsley_reg #round_off_amount").val());
        var freight=parseFloat($("#parsley_reg #freight").val())
        if(freight==""){freight=0;}
        if(round_amt==""){round_amt=0;}
         
        if (isNaN($("#parsley_reg #total_amount").val())) 
    $("#parsley_reg #total_amount").val(0)    
        if (isNaN($("#parsley_reg #discount_amount").val())) 
    $("#parsley_reg #discount_amount").val(0);
        if (isNaN($("#parsley_reg #round_off_amount").val())) 
    $("#parsley_reg #round_off_amount").val(0);
        if (isNaN($("#parsley_reg #freight").val())) 
    $("#parsley_reg #freight").val()
    }
    
    new_grand_total();
    total=parseFloat($("#parsley_reg #total_amount").val());
    if(total=="" || total==0 || isNaN(total)){
      $("#parsley_reg #total_amount").val(0);
    }
}
</script>

  
<section id="add_new_order" class="container clearfix main_section">
     <?php   $form =array('id'=>'parsley_reg',
                          'runat'=>'server',
                          'name'=>'items_form',
                          'class'=>'form-horizontal');
       echo form_open_multipart('purchase_order/upadate_pos_purchase_order_details/',$form);?>
        
    <div id="main_content" style="padding: 0 14px !important;">
                     
                
                         <div class="row">
                          <div class="panel panel-default">
                              <div class="panel-heading" >
                                     <h4 class="panel-title"><?php echo $this->lang->line('purchase_order')." ".$this->lang->line('details') ?></h4>                                                                               
                               </div>
                            
                                 
                                       <div id="" class="col col-sm-12" style="padding-right: 25px;padding-left: 25px">
                                           <div class="row">
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep supplier_select_2">
                                                        <label for="first_name" ><?php echo $this->lang->line('name') ?></label>													
                                                                  <?php $first_name=array('name'=>'first_name',
                                                                                    'class'=>'required  form-control',
                                                                                    'id'=>'first_name',
                                                                                   
                                                                                    'value'=>set_value('first_name'));
                                                                     echo form_input($first_name)?>
                                                        <input type="hidden" id="purchase_order_guid" name="purchase_order_guid">
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
                                                            <label for="order_number" ><?php echo $this->lang->line('order_number') ?></label>													
                                                                     <?php $order_number=array('name'=>'demo_order_number',
                                                                                        'class'=>'required  form-control',
                                                                                        'id'=>'demo_order_number',
                                                                                        'disabled'=>'disabled',
                                                                                        'value'=>set_value('order_number'));
                                                                         echo form_input($order_number)?>
                                                            <input type="hidden" name="order_number" id="order_number">
                                                       </div>
                                                    </div>
                                               <div class="col col-sm-2" >
                                                   <div class="form_sep">
                                                            <label for="order_date" ><?php echo $this->lang->line('order_date') ?></label>													
                                                                     <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $order_date=array('name'=>'order_date',
                                                                                            'class'=>'required form-control',
                                                                                            'id'=>'order_date',
                                                                                          'onKeyPress'=>"new_order_date(event)", 
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
                                                                                            'onKeyPress'=>"new_expiry_date(event)", 
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
                                                                                         'onkeyup'=>'new_discount_amount()',
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
                                                                                       'onkeyup'=>"new_grand_total()",
                                                                                        'onKeyPress'=>"new_discount_amount_press(event);return numbersonly(event)", 
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
                                                                                        'onkeyup'=>"new_grand_total()",
                                                                                       'onKeyPress'=>"new_freight(event);return numbersonly(event)",
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
                                                                                        'onkeyup'=>"new_grand_total()",    
                                                                                        'onKeyPress'=>"new_round_off_amount(event);return numbersonly(event)",
                                                                                        'value'=>set_value('round_off_amount'));
                                                                         echo form_input($round_off_amount)?>
                                                       </div>
                                                    </div>
                                           </div>
                                     <br>
                                        </div>                              
                             
                          </div>
                          </div>
                         
                         
         
                    <div class="row small_inputs" >
                    <div class="col col-lg-12">
                      
                         
                             
                              <div class="row" style="padding-top: 1px;">
                                 
                                  <div class="col col-sm-2" style="padding-right: 0px;padding-left: 0;">
                                       
                                             <label for="items" ><?php echo $this->lang->line('items') ?></label>	
                                                     <div class="form_sep" id='display_none_div'>
                                                      												
                                                                  <?php $items=array('name'=>'items',
                                                                                    'class'=>'form-control',
                                                                                    'id'=>'items',
                                                                                    'value'=>set_value('items'));
                                                                     echo form_input($items)?>
                                                  </div>
                                         
                                                 <input type="hidden" id='diabled_item' class="form-control">
                                                 
                                                 <input type="hidden" name="item_id" id="item_id">
                                           <input type="hidden" name="item_name" id="item_name">
                                           <input type="hidden" name="sku" id="sku">
                                           <input type="hidden" name="seleted_row_id" id="seleted_row_id">
                                           <input type="hidden" name="supplier_quty" id="supplier_quty">
                                                  </div>
                                                <div class="col col-sm-10" style="padding-right:0px;">
                                                    <table style=" margin-left: -13px !important; max-width: 102%"><tr>
                                                       
                                             <td>
                                                 <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="quantity" ><?php echo $this->lang->line('quantity') ?></label>

                                                                 <?php $quantity=array('name'=>'quantity',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'quantity',
                                                                                            'onkeyup'=>"net_amount()", 
                                                                     'onKeyPress'=>"add_new_quty(event); return numbersonly(event)",
                                                                                            'value'=>set_value('quantity'));
                                                                             echo form_input($quantity)?>
                                                               
                                                        </div>
                                                        </div>
                                                </td>
                                             <td>
                                                  <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="free" ><?php echo $this->lang->line('free') ?></label>

                                                                 <?php $free=array('name'=>'free',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'free',
                                                                                            
                                                                     'onKeyPress'=>"add_new_free(event); return numbersonly(event)",
                                                                                            'value'=>set_value('free'));
                                                                             echo form_input($free)?>
                                                               
                                                        </div>
                                                        </div>
                                                </td>
                                                <td>
                                                     <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="cost" ><?php echo $this->lang->line('cost') ?></label>

                                                                 <?php $cost=array('name'=>'cost',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'cost',
                                                                       'onkeyup'=>"net_amount()",
                                                                     'onKeyPress'=>"add_new_cost(event); return numbersonly(event)",
                                                                                            'value'=>set_value('cost'));
                                                                             echo form_input($cost)?>
                                                        </div>
                                                        </div>
                                               </td><td>
                                                    <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="price" ><?php echo $this->lang->line('price') ?></label>

                                                                 <?php $price=array('name'=>'price',
                                                                                            'class'=>' form-control small_length text-right',
                                                                                            'id'=>'price',
                                                                   'onKeyPress'=>"add_new_price(event); return numbersonly(event)",
                                                                                            'value'=>set_value('price'));
                                                                             echo form_input($price)?>
                                                        </div>
                                                        </div>
                                            </td>
                                            <td>
                                                <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="mrp" ><?php echo $this->lang->line('mrp') ?></label>

                                                                 <?php $mrp=array('name'=>'mrp',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'mrp',
                                                                     'onKeyPress'=>"add_new_mrp(event); return numbersonly(event)",
                                                                                            'value'=>set_value('mrp'));
                                                                             echo form_input($mrp)?>
                                                        </div>
                                                    </div>
                                               </td>
                                             <td>
                                                <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="delivery_date" ><?php echo $this->lang->line('delivery_date') ?></label>

                                                             <div class="input-group date ebro_datepicker" data-date-format="dd.mm.yyyy" data-date-autoclose="true" data-date-start-view="2">
                                                                           <?php $delivery_date=array('name'=>'delivery_date',
                                                                                            'class'=>' form-control',
                                                                                            'id'=>'delivery_date',
                                                                                          
                                                                                       'onKeyPress'=>"add_new_date(event); ",
                                                                                            'value'=>set_value('delivery_date'));
                                                                             echo form_input($delivery_date)?>
                                                                <span class="input-group-addon"><i class="icon-calendar"></i></span>
                                                                </div>
                                                        </div>
                                                    </div>
                                               </td>
                                            <td>
                                                <div class="col col-lg-12" style="padding:0px">
                                                   <div class="form_sep">
                                                            
                                                                <label for="total" ><?php echo $this->lang->line('total') ?></label>

                                                                 <?php $total=array('name'=>'total',
                                                                                            'class'=>' form-control text-right',
                                                                                            'id'=>'total',
                                                                                            'disabled'=>'disabled',
                                                                                            'value'=>set_value('total'));
                                                                             echo form_input($total)?>
                                                        </div>
                                                    </div>
                                               </td>
                                              
                                               <td>  
                                                    <label for="mrp" ><?php echo $this->lang->line('save') ?></label>
                                                    <a class="btn btn-success" href="javascript:copy_items()" style="padding: 2px 12px"><i class="icon icon-save"></i></a>
                                                  
                                                  </td>
                                               <td>  
                                                    <label for="mrp" ><?php echo $this->lang->line('clear') ?></label>
                                                  
                                                    <a class="btn btn-warning pull-right" style="padding: 2px 12px" href="javascript:clear_inputs()"><i class="icon icon-refresh"></i></a>
                                                 </td>
                                               </tr>
                                               
                                               
                                               </table>
                                          
                                     <br>
                                        </div>                              
                              </div>
                          
                          
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
                                    <th><?php echo $this->lang->line('quantity') ?></th>
                                    <th><?php echo $this->lang->line('free') ?></th>
                                    <th><?php echo $this->lang->line('cost') ?></th>
                                    <th><?php echo $this->lang->line('price') ?></th>
                                    <th><?php echo $this->lang->line('mrp') ?></th>
                                    <th><?php echo $this->lang->line('delivery_date') ?></th>
                                    <th><?php echo $this->lang->line('total') ?></th>
                                    <th><?php echo $this->lang->line('action') ?></th>
                                    </tr>
                                    </thead>
                                    <tbody id="new_order_items" >
                                       
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
                                                       <a href="javascript:save_new_order()" class="btn btn-success"  ><i class="icon icon-save"></i> <?php echo " ".$this->lang->line('save') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_button" style=" margin-top: 0 !important;padding-left: 50px">
                                                       <label for="" >&nbsp;</label>	
                                                       <a href="javascript:update_order()" class="btn btn-success"  ><i class="icon icon-edit"></i> <?php echo " ".$this->lang->line('update') ?></a>
                                                  </div>
                                               </div>
                                          <div class="col col-sm-3" style="padding-top: 50px"  >
                                                   <div class="form_sep " id="save_clear">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_add_purchase_order()" class="btn btn-warning"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
                                                  </div>
                                              <div class="form_sep " id="update_clear" style="margin-top:0 !important">
                                                       <label for="remark" >&nbsp;</label>	
                                                        <a href="javascript:clear_update_purchase_order()" class="btn btn-warning"  ><i class="icon icon-refresh"></i> <?php echo " ".$this->lang->line('clear') ?></a>
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
                    function posnic_group_active(){
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
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/purchase_order/active',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }
                  

                      }    
                      }
                    function posnic_group_item_active(){
                     var flag=0;
                     var field=document.forms.items_form;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                              $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('brand');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>index.php/purchase_order/item_active',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('activated');?>', { type: "success" });
                                        $("#selected_item_table").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }
                  

                      }    
                      }
                    function posnic_delete(){
                     var flag=0;
                     var field=document.forms.posnic;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                        
                          $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('paruchase_order');?>', { type: "warning" });
                      }else{
                            bootbox.confirm("<?php echo $this->lang->line('Are you Sure To Delete')."".$this->lang->line('Are you Sure To Delete') ?>", function(result) {
             if(result){
              
             
                        var posnic=document.forms.posnic;
                        for (i = 0; i < posnic.length; i++){
                          if(posnic[i].checked==true){                             
                              $.ajax({
                                url: '<?php echo base_url() ?>/index.php/purchase_order/delete',
                                type: "POST",
                                data: {
                                    guid:posnic[i].value

                                },
                                success: function(response)
                                {
                                    if(response){
                                         $.bootstrapGrowl('<?php echo $this->lang->line('purchase_order')." ".$this->lang->line('deleted');?>', { type: "error" });
                                        $("#dt_table_tools").dataTable().fnDraw();
                                    }
                                }
                            });

                          }

                      }    
                      }
                      });
                      }    
                      }
                    
                    
                    
                    function posnic_group_deactive(){
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
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>/index.php/purchase_order/deactive',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                    success: function(response)
                                    {
                                        if(response){
                                             $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                            $("#dt_table_tools").dataTable().fnDraw();
                                        }
                                    }
                                });

                          }

                      }
                  

                      }    
                      }
                    function posnic_group_item_deactive(){
                     var flag=0;
                     var field=document.forms.items_form;
                      for (i = 0; i < field.length; i++){
                          if(field[i].checked==true){
                              flag=flag+1;

                          }

                      }
                      if (flag<1) {
                                               $.bootstrapGrowl('<?php echo $this->lang->line('Select Atleast One')."".$this->lang->line('brand');?>', { type: "warning" });
                      
                      }else{
                            var posnic=document.forms.items_form;
                      for (i = 0; i < posnic.length-1; i++){
                          if(posnic[i].checked==true){                             
                                 $.ajax({
                                    url: '<?php echo base_url() ?>index.php/purchase_order/item_deactive',
                                    type: "POST",
                                    data: {
                                        guid: posnic[i].value

                                    },
                                    success: function(response)
                                    {
                                        if(response){
                                             $.bootstrapGrowl('<?php echo $this->lang->line('deactivated');?>', { type: "danger" });
                                            $("#selected_item_table").dataTable().fnDraw();
                                        }
                                    }
                                });

                          }

                      }
                  

                      }    
                      }
                    
                </script>
        

      