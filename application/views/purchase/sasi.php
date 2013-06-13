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
             
             //document.getElementById("project").focus();
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


	</script>
<div><div class="ui-widget item_details_css ">
        
        <input type="button" id="add_button" value="+">
<table><tr> 
        <td> <label>Item Code</label> </td>
        <td> description  </td><td><label>Quty</label> </td>
        <td><label>Cost</label></td><td><label>selling price</label></td>
        <td><label>M R P</label></td><td><label>Net Amount</label></td></tr>
    <tr><input type="hidden" id="item">
        <td><input type="hidden" id="item_pro"> <input id="project" name="project" type="text"   /><input type="hidden" id="project-id" /></td>
        <td><input type="text" id="item_dis" disabled /></td>
        <td><input type="hidden" id="item_quty1"> <input type="text" id="item_quty"  onkeyup="net_amount()" onKeyPress="add_new_q(event);  return numbersonly(event)"  /></td>
        <td><input type="hidden" id="item_cost1"> <input type="text" id="item_cost" onkeyup="net_amount()"  onKeyPress=" add_new_cost(event); return numbersonly(event)" /></td>
        <td><input type="hidden" id="item_sell1"> <input type="text" id="item_sell"  onKeyPress=" return numbersonly(event)" /></td>
        <td><input type="hidden" id="item_mrp1"> <input type="text" id="item_mrp" onKeyPress=" return numbersonly(event)"  /></td>
        <td><input type="hidden" id="item_net1"> <input type="text" id="item_net" disabled   /></td></tr> 
</table>
</div>
    </div>
    <div id="item_div" class="item_det_div">
        <table>
         
            <tr><td id="myDiv"></td><td><div id="item_image" class="details_size" ></div></td></tr>
        </table>
    </div>
</body>
</html>
