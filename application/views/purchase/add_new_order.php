<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

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
    })    
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a>" + item.label + 
                "<span >" + item.desc + "</span></a>" )               
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
        if (unicode!=8 && unicode!=46){ //if the key isn't the backspace key (which we should allow)
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
                     alert('down')   ;
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
function item_sell_click(){
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
        
      
function item_mrp_click(){
      if(parseFloat(document.getElementById('item_sell').value) < parseFloat(document.getElementById('item_mrp').value)){
                     if(parseFloat(document.getElementById('item_cost').value) < parseFloat(document.getElementById('item_mrp').value)){
                     alert('down')   ;
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
function copy_items(){
    document.getElementById('item_copy').style.visibility="visible";
    var itm=document.getElementById("item_copy");
    var cln=itm.cloneNode(true);
    document.getElementById("parent_item").appendChild(cln);
    var item=document.getElementById('item_copy');
    item.getElementsByTagNet
}
///

//


  function myFunction(id)
{
    var itm=document.getElementById("item_deatils1");
    var cln=itm.cloneNode(true);
    document.getElementById("item_deatils2").appendChild(cln);
    document.getElementById(id).id=id+"w";
    itemid=document.getElementById('id_list').value;
    document.getElementById(itemid).value=document.getElementById('item_id2').value;
    document.getElementById('item_id2').value="";
    document.getElementById(itemid).className =document.getElementById('itemid').value;
    document.getElementById(itemid).id=itemid+"1";
    document.getElementById('id_list').value=itemid+"1";
    
     
    
    dis=document.getElementById('dis_list').value;
    document.getElementById(dis).value=document.getElementById('descri').value;
    document.getElementById(dis).className =document.getElementById('itemid').value+"2";
    document.getElementById(dis).id=dis+"1";
    document.getElementById('dis_list').value=dis+"1";
    document.getElementById('descri').value="";
    
    
    
    quty=document.getElementById('quty_list').value;
    document.getElementById(quty).value=document.getElementById('quty').value;
    document.getElementById(quty).className =document.getElementById('itemid').value+"3";
    document.getElementById(quty).id=quty+"1";
    document.getElementById('quty_list').value=quty+"1";
    document.getElementById('quty').value="";
   
    
    cost=document.getElementById('cost_list').value;
    document.getElementById(cost).value=document.getElementById('cost').value;
    document.getElementById(cost).className =document.getElementById('itemid').value+"4";
    document.getElementById(cost).id=cost+"1";
    document.getElementById('cost_list').value=cost+"1";
    document.getElementById('cost').value="";
    
   
    
    sell=document.getElementById('sell_list').value;
    document.getElementById(sell).value=document.getElementById('sell').value;
    document.getElementById(sell).className =document.getElementById('itemid').value+"5";
    document.getElementById(sell).id=sell+"1";
    document.getElementById('sell_list').value=sell+"1";
    document.getElementById('sell').value="";
    
    uniq=document.getElementById('final_list').value;
    document.getElementById(uniq).value=document.getElementById('final').value;
    
    document.getElementById(uniq).id=document.getElementById('final').value;
    document.getElementById('final_list').value=document.getElementById('final').value;
    
   
    remove=document.getElementById('remove_list').value;
    document.getElementById(remove).value=document.getElementById('final').value;
    
    document.getElementById(remove).id=document.getElementById('final').value;
    document.getElementById('remove_list').value=document.getElementById('final').value;
    
    
    
     idelete=document.getElementById('item_delete_list').value;
    document.getElementById(idelete).value=document.getElementById('final').value;
    
    document.getElementById(idelete).id=document.getElementById('final').value;
    document.getElementById('item_delete_list').value=document.getElementById('final').value;
   // document.getElementById('').value="";
 // documen.getElementById('final') .chi  //= document.getElementById('final').value;
}  
        function numbersonly(e){
var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=46){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57)

return false 
}
}
function remove_item(but){
           $("#"+but+"").remove();
}

    </script>
  </head>
  <body>
     
      
      <div style="margin-left:100px;"><table>
              <form action="supplier_vs_items/save_items" method="post" id="form">
	  
              <table>
            <tr><td><?php echo form_label($this->lang->line('supplier code'))?></td>
                <td><input type="text" id="supplier"  name="estado" onKeyPress="return disableEnterKey(event)" autocomplete="off" style="width: 100px" /></td>
                <td><?php echo form_label($this->lang->line('exp_date'))?></td><td><input type="text" name="expdate" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('podate'))?></td><td><input type="text" name="podate" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('disamount'))?></td><td><input type="text" name="date" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('Round off Amount'))?></td><td><input type="text" name="date" style="width: 100px"></td>
            </tr>
            <tr><td><?php echo form_label($this->lang->line('supplier name'))?></td><td>
                    <input type="text" id="name" name="estado" autocomplete="off" disabled style="width: 100px"/>
                    <input type="hidden"   name="supplier"> </td>
             <td><?php echo form_label($this->lang->line('pono'))?></td><td><input type="text" name="pono" style="width: 100px"></td>
             <td><?php echo form_label($this->lang->line('discount'))?></td><td><input type="text" name="date" style="width: 100px"></td>
             <td><?php echo form_label($this->lang->line('Freight'))?></td><td><input type="text" name="date" style="width: 100px"></td>
            </tr>
              </table>
               <input type="hidden" id="final_list" value="finald" > 
              <input type="hidden" id="id_list" value="item_id">
              <input type="hidden" id="dis_list" value="descri1">
              <input type="hidden" id="quty_list" value="quty1">
              <input type="hidden" id="cost_list" value="cost1">
              <input type="hidden" id="sell_list" value="sell1">
              <input type="hidden" id="itemid" value="">
              <input type="hidden" id="remove_list" value="remove">
              <input type="hidden" id="item_delete_list" value="item_delete">
                            
              <input type="hidden" id="final">
	<div><div class="ui-widget item_details_css ">
        
        <input type="button" id="add_button" value="+">
        <table id="parent_item"><tr> 
        <td> <label>Item Code</label> </td>
        <td> description  </td><td><label>Quty</label> </td>
        <td><label>Cost</label></td><td><label>selling price</label></td>
        <td><label>M R P</label></td><td><label>Net Amount</label></td></tr>
            
         <tr><td><input type="hidden" id="finalid " class="iclass1"  >
        <input type="text" name="code" id="project" class="iclass"  autocomplete="off" ></td>
<td><input type="text" name="discri" id="descri" class="iclass2" style="width: 100px" ></td>
<td><input type="text" id="quty" name="quty[]" class="iclass3" onKeyPress="return numbersonly(event)" style="width: 100px" ></td>
<td><input type="text" name="cost[]" id="cost" class="iclass4" onKeyPress="return numbersonly(event)" style="width: 100px"></td>
<td><input type="text" name="sell[[]" id="sell" class="iclass5" onKeyPress="return numbersonly(event)" style="width: 100px"></td>
<td><input type="button" value="Add" id="item_id1" onclick="myFunction(this.id)" style="width: 100px"></td></tr>
           
            
            
        </table>
         <tr><td><ul class="labeleded" id="item_deatils3"><table> 
                         <tr><td><input type="hidden" id="finalid" class="iclass1"  > <input type="text" name="code" id="item_id2" class="iclass"  onkeypress="get_item_details(this.id) ; return disableEnterKey(event)"  style="width: 100px"    autocomplete="off" ></td><td><input type="text" name="discri" id="descri" class="iclass2" style="width: 100px" ></td><td><input type="text" id="quty" name="quty[]" class="iclass3" onKeyPress="return numbersonly(event)" style="width: 100px" ></td><td><input type="text" name="cost[]" id="cost" class="iclass4" onKeyPress="return numbersonly(event)" style="width: 100px"></td><td><input type="text" name="sell[[]" id="sell" class="iclass5" onKeyPress="return numbersonly(event)" style="width: 100px"></td><td><input type="button" value="Add" id="item_id1" onclick="myFunction(this.id)" style="width: 100px"></li></tr>
           </table> </ul></td></tr>
         <tr><td> <ul class="labeleded" ><table id="item_deatils2">
                         
                         
                     </table>
              
          </ul></td></tr>
       <tr><td style="visibility: hidden"><ul class="labeleded" id="item_deatils1"><table> 
                       <tr id="item_delete"><td><input type="hidden" id="finald" class="sasi"  > <input type="text" name="code" id="item_id" class="one" style="width: 100px"  onkeypress="get_item_details(this.id) ; return disableEnterKey(event)"   autocomplete="off" ></td><td><input type="text" name="discri" id="descri1" class="one" style="width: 100px" ></td><td><input type="text" name="quty[]" id="quty1" class="one" onKeyPress="return numbersonly(event)" style="width: 100px" ></td><td><input type="text" name="cost[]" id="cost1" class="one"  onKeyPress="return numbersonly(event)" style="width: 100px"></td><td><input type="text" name="sell[[]" id="sell1" class="one" onKeyPress="return numbersonly(event)" style="width: 100px"></td><td><input type="button" value="X" onclick="remove_item(this.id)"  id="remove" style="width: 100px"></li></tr>
           </table> </ul></td></tr>
           
                  </table>
           
               
           <div id="yourTableId" border="1" class="myrow" >
                
          <tr><td> <?php echo form_submit('save',$this->lang->line('save')); ?> <?php echo form_submit('cancel',$this->lang->line('cancel')); ?></td></tr>
             
 <?php echo form_close();?>
      </div>
      </div>
  
  </body>
</html>