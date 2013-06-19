

<script type="text/javascript" src="<?php echo base_url(); ?>auto/js/jquery-1.9.1.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.core.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.widget.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.menu.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/css/demos.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/css/jquery.ui.base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/css/jquery.ui.theme.css" />

    <script>      
$(function() {   
    function lightwell(request, response) {
        function hasMatch(s) {
            return s.toLowerCase().indexOf(request.term.toLowerCase())!==-1;
        }
        var i, l, obj, matches = [];

        if (request.term==="") {
		    response([]);
            return;
        }           
        for  (i = 0, l = projects.length; i<l; i++) {
            obj = projects[i];
            if (hasMatch(obj.label) || hasMatch(obj.desc)) {
                matches.push(obj);				
            }
        }
        response(matches);
    }    
    $( "#project" ).autocomplete({
        minLength: 0,
        source:"<?php echo base_url() ?>index.php/purchase_main/get_item_details/",
        focus: function( event, ui ) {
            $( "#project" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
    if(document.getElementById(ui.item.id)){
        
        alert('This item is alreay order');
           document.getElementById("project").focus();
           document.getElementById('project').value="";
           return false;
    }else{
            $( "#project" ).val( ui.item.label );
            $('#item_dis').val(ui.item.desc);   
            $('#item_cost').val(ui.item.cost);  
            $('#item_sell').val(ui.item.sell);  
            $('#item_mrp').val(ui.item.mrp);  
            $( "#item_pro" ).val( ui.item.label ); 
            $('#item_cost1').val(ui.item.cost);  
            $('#item_sell1').val(ui.item.sell);  
            $('#item_mrp1').val(ui.item.mrp);  
            $('#item').val(ui.item.id);
            return false;
        }
        }
    })    
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a style=font-size:12px>" + item.label +"    "+ item.name+
                "</a>" )               
            .appendTo( ul );
    };
    $( "#supplier" ).autocomplete({
        minLength: 0,
        source:"<?php echo base_url() ?>index.php/purchase_main/get_selected_supplier/",
        focus: function( event, ui ) {
            $( "#supplier" ).val( ui.item.label );
            return false;
        },
        select: function( event, ui ) {
             $( "#supplier" ).val( ui.item.label);
            $( "#name" ).val( ui.item.company );
  
            return false;
        
        }
    })    
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a style=font-size:12px>" + item.label +"    "+ item.company+
                "</a>" )               
            .appendTo( ul );
    };
});
function set_item_details(value){
document.getElementById('item_div').style.visibility="visible";
                       var item_name=value.val();  
                       if(item_name=="") { item_name='pos'}
document.getElementById('item_image').style.backgroundImage="url(<?php echo base_url() ?>item_images/"+item_name+")";
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("GET","<?php echo base_url() ?>index.php/purchase_main/get_item_details_for_view/"+item_name,false);

xmlhttp.send();
document.getElementById("myDiv").innerHTML=xmlhttp.responseText;


}
function disable_item_div(){
    document.getElementById('item_div').style.visibility="hidden";
}
function numbersonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false 
    }
    }
    function datesonly(e){
        var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57)
        return false 
    }
    }
function net_amount(){
    document.getElementById('item_net').value=document.getElementById('item_cost').value*document.getElementById('item_quty').value;
}
function add_new_item(e){
    if(document.getElementById('item_quty').value!="" && document.getElementById('item_cost').value!="" && document.getElementById('item_sell').value!=""){
        if(document.getElementById('item_cost').value < document.getElementById('item_sell').value){
            if(document.getElementById('item_sell').value<document.getElementById('item_mrp').value){
                  var unicode=e.charCode? e.charCode : e.keyCode
        if (unicode!=13 && unicode!=9){
           
        }else{
            alert('sasi');
        }
            }else{
                 alert('Seelling price should Less than MRP ');
            }
        }
        else{
            alert('Seelling price should More than Cost ');
        }
    }
}
function add_new_q(e){
     var unicode=e.charCode? e.charCode : e.keyCode
    if(document.getElementById('item_quty').value!=""){
        
                  if (unicode!=13 && unicode!=9){           
        }
       else{
           document.getElementById("item_cost").focus();        
             //document.getElementById("project").focus();
        }
         if (unicode!=27){           
        }
       else{
           //document.getElementById("item_cost").focus();        
             document.getElementById("project").focus();
        }
        }
      
    }
    function add_new_cost(e){
        var unicode=e.charCode? e.charCode : e.keyCode
         if(document.getElementById('item_quty').value!=""){        
                  if (unicode!=13 && unicode!=9){           
        }
       else{
           if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_sell').value)){
                     if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_mrp').value)){
                     document.getElementById("item_sell").focus();      
           }else{
               alert('Cost should lessthan Price');
               document.getElementById("item_cost").value=parseFloat(document.getElementById('item_cost1').value);
               document.getElementById("item_cost").focus();
           }
           }else{
                alert('Cost should lessthan MRP');
                document.getElementById("item_cost").value=parseFloat(document.getElementById('item_cost1').value);
                document.getElementById("item_cost").focus();
           }              
        }
         if (unicode!=27){           
        }
       else{
           //document.getElementById("item_cost").focus();        
             document.getElementById("item_quty").focus();
        }
        }else{
             document.getElementById("item_quty").focus();    
        }
    }
    function add_new_sell(e){
        var unicode=e.charCode? e.charCode : e.keyCode
         if(document.getElementById('item_quty').value!=""){        
                  if (unicode!=13 && unicode!=9){           
        }
       else{
           if(parseFloat(document.getElementById('item_sell').value) < parseFloat(document.getElementById('item_mrp').value)){
                     if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_sell').value)){
                     document.getElementById("item_mrp").focus();      
           }else{
                alert('Sell should morethan Cost');
               document.getElementById("item_sell").value=parseFloat(document.getElementById('item_sell1').value);
               document.getElementById("item_sell").focus();
           }
           }else{
               alert('price should lessthan MRP');
                document.getElementById("item_sell").value=parseFloat(document.getElementById('item_sell1').value);
                document.getElementById("item_sell").focus();
           }              
        }
         if (unicode!=27){           
        }
       else{
           //document.getElementById("item_cost").focus();        
             document.getElementById("item_cost").focus();
        }
        }else{
             document.getElementById("item_quty").focus();    
        }
    }
    function add_new_mrp(e){
        var unicode=e.charCode? e.charCode : e.keyCode
         if(document.getElementById('item_quty').value!=""){        
                  if (unicode!=13 && unicode!=9){           
        }
       else{
           if(parseFloat(document.getElementById('item_sell').value) < parseFloat(document.getElementById('item_mrp').value)){
                     if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_mrp').value)){
                     if(document.getElementById('item_edit').value!='jibi'){
                        document.getElementById('total_price').value=parseFloat(document.getElementById('total_price').value)-parseFloat(document.getElementById('item_net1').value)+parseFloat(document.getElementById('item_net').value);
                     }else{
                         document.getElementById('total_price').value=parseFloat(document.getElementById('total_price').value)+parseFloat(document.getElementById('item_net').value);
                     }
                            copy_items();
           }else{
                alert('MRP should morethan price');
               document.getElementById("item_mrp").value=parseFloat(document.getElementById('item_mrp1').value);
               document.getElementById("item_mrp").focus();
           }
           }else{
               alert('MRP should morethan cost');
               document.getElementById("item_mrp").value=parseFloat(document.getElementById('item_mrp1').value);
               document.getElementById("item_mrp").focus();
           }              
        }
         if (unicode!=27){           
        }
       else{
           //document.getElementById("item_cost").focus();        
             document.getElementById("item_sell").focus();
        }
        }else{
             document.getElementById("item_quty").focus();    
        }
    }
function items_cost_click(){
    if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_sell').value)){
                     if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_mrp').value)){
                     document.getElementById("item_cost").focus();      
           }else{
               alert('Cost should lessthan Price');
               document.getElementById("item_cost").value=parseFloat(document.getElementById('item_cost1').value);
               document.getElementById("item_cost").focus();
           }
           }else{
                alert('Cost should lessthan MRP');
                document.getElementById("item_cost").value=parseFloat(document.getElementById('item_cost1').value);
                document.getElementById("item_cost").focus();
           }  
}
function item_sell_click(){
     if(parseFloat(document.getElementById('item_sell').value) < parseFloat(document.getElementById('item_mrp').value)){
                     if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_sell').value)){
                     document.getElementById("item_sell").focus();      
           }else{
                alert('Sell should morethan Cost');
               document.getElementById("item_sell").value=parseFloat(document.getElementById('item_sell1').value);
               document.getElementById("item_sell").focus();
           }
           }else{
               alert('price should lessthan MRP');
                document.getElementById("item_sell").value=parseFloat(document.getElementById('item_sell1').value);
                document.getElementById("item_sell").focus();
           }              
        }
        
      

function copy_items(){
 
 if(document.getElementById('item_edit').value!='jibi'){
     var od=document.getElementById('item_edit').value;
     var id=document.getElementById('item').value;
    document.getElementById(od+"c").value=document.getElementById('project').value;
    document.getElementById(od+"d").value=document.getElementById('item_dis').value;
    document.getElementById(od+"q").value=document.getElementById('item_quty').value;
    document.getElementById(od+"co").value=document.getElementById('item_cost').value;
    document.getElementById(od+"s").value=document.getElementById('item_sell').value;
    document.getElementById(od+"p").value=document.getElementById('item_mrp').value;
    document.getElementById(od+"n").value=document.getElementById('item_net').value;
    document.getElementById(od).id=id;
    document.getElementById(od+"c").id=id+"c";
    document.getElementById(od+"d").id=id+"d";
    document.getElementById(od+"q").id=id+"q";
    document.getElementById(od+"co").id=id+"co";
    document.getElementById(od+"s").id=id+"s";
    document.getElementById(od+"p").id=id+"p";
    document.getElementById(od+"n").id=id+"n";
    document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
    document.getElementById('item_net').value="";
    document.getElementById("project").focus();
    document.getElementById('item_edit').value='jibi';
 }else{
    document.getElementById('item_copy').style.visibility="visible";
    //document.getElementById('item_copy_final').getElementsByTagName('tr')[0].id=document.getElementById('item').value+'tr';
   
     document.getElementById('item_copy').getElementsByTagName('input')[0].value=document.getElementById('project').value;
    document.getElementById('item_copy').getElementsByTagName('input')[1].value=document.getElementById('item_dis').value;
    document.getElementById('item_copy').getElementsByTagName('input')[2].value=document.getElementById('item_quty').value;
    document.getElementById('item_copy').getElementsByTagName('input')[3].value=document.getElementById('item_cost').value;
    document.getElementById('item_copy').getElementsByTagName('input')[4].value=document.getElementById('item_sell').value;
    document.getElementById('item_copy').getElementsByTagName('input')[5].value=document.getElementById('item_mrp').value;
    document.getElementById('item_copy').getElementsByTagName('input')[6].value=document.getElementById('item_net').value;
    document.getElementById('item_copy').getElementsByTagName('input')[7].id=document.getElementById('item').value;
    document.getElementById('item_copy').getElementsByTagName('input')[8].id=document.getElementById('item').value;
    var iid=document.getElementById('item').value;
    
    document.getElementById('item_copy').getElementsByTagName('input')[0].id=iid+"c";
    document.getElementById('item_copy').getElementsByTagName('input')[1].id=iid+"d";
    document.getElementById('item_copy').getElementsByTagName('input')[2].id=iid+"q";
    document.getElementById('item_copy').getElementsByTagName('input')[3].id=iid+"co";
    document.getElementById('item_copy').getElementsByTagName('input')[4].id=iid+"s";
    document.getElementById('item_copy').getElementsByTagName('input')[5].id=iid+"p";
    document.getElementById('item_copy').getElementsByTagName('input')[6].id=iid+"n";
    document.getElementById('item_copy').getElementsByTagName('input')[7].id=document.getElementById('item').value;
    document.getElementById('item_copy').getElementsByTagName('input')[8].id=iid;
    document.getElementById('sl_no').innerHTML =parseFloat(1)+parseFloat(document.getElementById('item_sl').value);
    document.getElementById('item_sl').value=1+parseFloat(document.getElementById('item_sl').value);
     document.getElementById('item_sl').id=1+parseFloat(document.getElementById('item_sl').value);
    document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
    document.getElementById('item_net').value="";
    document.getElementById("project").focus();
    document.getElementById('item_copy').id=document.getElementById('item').value+'tr';
    var trid=document.getElementById('item').value+'tr';
        $('#'+trid)
                .clone()                    
                    .show()
         
                    .appendTo( $('#parent_item').parent() );
         
    document.getElementById('item_copy_final').getElementsByTagName('tr')[0].id='item_copy';
    document.getElementById('item_copy').getElementsByTagName('input')[0].id="c";
    document.getElementById('item_copy').getElementsByTagName('input')[1].id="d";
    document.getElementById('item_copy').getElementsByTagName('input')[2].id="q";
    document.getElementById('item_copy').getElementsByTagName('input')[3].id="co";
    document.getElementById('item_copy').getElementsByTagName('input')[4].id="s";
    document.getElementById('item_copy').getElementsByTagName('input')[5].id="p";
    document.getElementById('item_copy').getElementsByTagName('input')[6].id="n";
    document.getElementById('item_copy').getElementsByTagName('input')[7].id=document.getElementById('item').value;
    document.getElementById('item_copy').getElementsByTagName('input')[8].id=iid;
   document.getElementById('item_copy_final').getElementsByTagName('tr')[0].style.visibility="hidden";
     document.getElementById('item_copy').getElementsByTagName('label')[0].id='sl_no';
        }  
}
function edit_items_details(od){
    document.getElementById('item_edit').value=od;
    document.getElementById('project').value=document.getElementById(od+'c').value;
    document.getElementById('item_dis').value=document.getElementById(od+'d').value;
    document.getElementById('item_quty').value=document.getElementById(od+'q').value;
    document.getElementById('item_cost').value=document.getElementById(od+'co').value;
    document.getElementById('item_sell').value=document.getElementById(od+'s').value;
    document.getElementById('item_mrp').value=document.getElementById(od+'p').value;
    document.getElementById('item_net').value=document.getElementById(od+'n').value;
    
  //  document.getElementById('item_dis1').value= document.getElementById('item_dis').value;
    document.getElementById('item_quty1').value= document.getElementById('item_quty').value;
    document.getElementById('item_cost1').value=document.getElementById('item_cost').value;
    document.getElementById('item_sell1').value=document.getElementById('item_sell').value;
    document.getElementById('item_mrp1').value=document.getElementById('item_mrp').value;
    document.getElementById('item_net1').value=document.getElementById('item_net').value;
    
    document.getElementById('item').value=od;
    //document.getElementById('item_save').style.visibility="visible";
    console.log(document.getElementById('item_dis').value);
    document.getElementById("project").focus();
 
}
function remove_item(id){
    document.getElementById('total_price').value=parseFloat(document.getElementById('total_price').value)- parseFloat(document.getElementById(id+'n').value);
   document.getElementById(id).id="jibi";
}
	</script>
        <div style="width: 100%; ; background: #ffcccc ">
   <form action="supplier_vs_items/save_items" method="post" id="form">
	  
       <table style="margin-left: 150px">
            <tr><td><?php echo form_label($this->lang->line('supplier code'))?></td>
                <td><input type="text" id="supplier"  name="estado"  autocomplete="off" style="width: 100px" /></td>
                <td><?php echo form_label($this->lang->line('exp_date'))?></td><td><input type="text" name="expdate" onkeypress="return datesonly(event)" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('podate'))?></td><td><input type="text" name="podate" onkeypress="return datesonly(event)" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('disamount'))?></td><td><input type="text" name="discount_amt" onkeypress="return numbersonly(event)"  style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('Round off Amount'))?></td><td><input type="text" name="round_amt" onkeypress="return numbersonly(event)"  style="width: 100px"></td>
            </tr>
            <tr><td><?php echo form_label($this->lang->line('supplier name'))?></td><td>
                    <input type="text" id="name" name="estado" autocomplete="off" disabled style="width: 100px"/>
                    <input type="hidden"   name="supplier"> </td>
             <td><?php echo form_label($this->lang->line('pono'))?></td><td><input type="text" name="pono" onkeypress="return datesonly(event)" style="width: 100px"></td>
             <td><?php echo form_label($this->lang->line('discount'))?></td><td><input type="text" name="discount" onkeypress="return numbersonly(event)"  style="width: 100px" maxlength="2" ></td>
             <td><?php echo form_label($this->lang->line('Freight'))?></td><td><input type="text" name="freight" onkeypress="return numbersonly(event)" style="width: 100px"></td>
            </tr>
              </table>
        </div> <div style="width: 100%;height: 350px;background:#ccccff "><div class="ui-widget item_details_css ">
     <div id="item_div" class="item_det_div" >
        <table>
         
            <tr><td id="myDiv"></td><td><div id="item_image" class="details_size" ></div></td></tr>
        </table>
    </div>
<table id="parent_item"><tr> 
        <td> <label>Item Code</label> </td>
        <td> description  </td><td><label>Quty</label> </td>
        <td><label>Cost</label></td><td><label>selling price</label></td>
        <td><label>M R P</label></td><td><label>Net Amount</label></td></tr>
    <tr><input type="hidden" id="item"><input type="hidden" id="item_edit" value="jibi">
    <td><input type="hidden" id="item_pro"> <input type="hidden" id="item_sl" value="0">
            <input id="project" name="project" type="text"  class="item_inputd" />
            <input type="hidden" id="project-id" /></td>
        <td><input type="text" id="item_dis" disabled class="item_input_d"/></td>
        <td><input type="hidden" id="item_quty1"> <input type="text" id="item_quty" class="item_input"  onkeyup="net_amount()" onKeyPress="add_new_q(event);  return numbersonly(event)"  /></td>
        <td><input type="hidden" id="item_cost1"> <input type="text" id="item_cost"class="item_input" onclick="items_cost_click();net_amount()"  onkeyup="net_amount()"  onKeyPress=" add_new_cost(event); return numbersonly(event)" /></td>
        <td><input type="hidden" id="item_sell1"> <input type="text" id="item_sell" class="item_input" onclick="item_sell_click();net_amount()"  onKeyPress="add_new_sell(event); return numbersonly(event)" /></td>
        <td><input type="hidden" id="item_mrp1"> <input type="text" id="item_mrp" class="item_input" onclick=""  onKeyPress="add_new_mrp(event); return numbersonly(event)"  /></td>
        <td><input type="hidden" id="item_net1" value="00" > <input type="text" id="item_net" class="item_input" disabled   /></td></tr> 
</table><table id="item_copy_final">
<tr id="item_copy"  style="visibility: hidden" >
    <td >
        <label  id="sl_no" ></label> <input type="input" name="code[]" disabled   id="it_2" class="item_inputd"></td>
    <td><input type="input" name="dis[]"  disabled  id="it_3" class="item_input_d"></td>
       <td><input type="input" name="quty[]"  disabled  id="it_4" class="item_input"></td>
       <td><input type="input" name="cost[]"  disabled  id="it_5" class="item_input"></td>
       <td><input type="input" name="sell[]"  disabled  id="it_6"class="item_input"></td>
       <td><input type="input" name="mrp[]"  disabled  id="it_7"class="item_input"></td>
       <td><input type="input" name="net[]"  disabled  id="it_8"class="item_input"></td>
       <td><input type="button" name="item[]" onclick="edit_items_details(this.id)" value="Edit" id="it_1">
           <input type="button" name="code[]" onclick="remove_item(this.id); $(this).closest('tr').remove()" value="X" id="it_8"></td>
   </tr>
</table>
     
</div>
    </div>
        <div style="width: 100%;height:200px;background:#99ffcc ">
            <table>
                <tr><td>Remarks</td><td><textarea rows="4" cols="50"></textarea> </td><td>Note</td><td><textarea rows="4" cols="50"></textarea> </td><td>Total amount</td><td><input type="text" disabled  name="total_price" id="total_price" value="00"></td></tr>
                <tr><td></td><td></td><td></td><td></td><td><?php echo form_submit('save',$this->lang->line('save')) ?><?php echo form_submit('cancel',$this->lang->line('cancel')) ?></td></tr>
            
            </table
       </div>

</body>
</html>
