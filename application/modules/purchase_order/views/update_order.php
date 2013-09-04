

<script type="text/javascript" src="<?php echo base_url(); ?>auto/js/jquery-1.9.1.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.core.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.widget.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.menu.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/js/jquery.ui.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/css/demos.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/css/jquery.ui.base.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/css/jquery.ui.theme.css" />

    <script>    
        console.log();
        $('#form').find('.input').keypress(function(e){
    if ( e.which == 13 ) // Enter key = keycode 13
    {
        $(this).next().focus();  //Use whatever selector necessary to focus the 'next' input
    }
    return false;
});
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
            if (hasMatch(obj.label) || hasMatch(obj.name)) {
                matches.push(obj);				
            }
        }
        response(matches);
    }    
   
    $("#supplier").blur(function()
			{
                            document.getElementById("div_element").innerHTML="";
                           document.getElementById("div_element").innerHTML='<table id="item_copy_final"></table>';
                        document.getElementById('hidden_total_price').value=0;
                       discounte_amount();
                        document.getElementById('roll_no').value=1;
                            var item_name=document.getElementById('sup_guid').value;
                           document.getElementById('supplier_guid').value=item_name;
                        
                        var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.open("GET","<?php echo base_url() ?>index.php/purchase_order/set_seleted_item_suppier/"+item_name,false);

xmlhttp.send();
                        });
                        
                        
           
    $("#project").blur(function()
			{
                            data=document.getElementById('item').value;
                            if(document.getElementById(data)){
                            alert('This Item Is already Added');
                     
                              document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
    document.getElementById('item_net').value="";
    document.getElementById('item_date').value="";
    
    document.getElementById('item_edit').value='jibi';
    window.setTimeout(function ()
    {
         document.getElementById('project').focus();
    }, 0);
                            }
                        });             
                        
    $( "#project" ).autocomplete({
        
    
        minLength: 0,
        source:"<?php echo base_url() ?>index.php/purchase_order/get_item_details",
        focus: function( event, ui ) {
            $( "#project" ).val( ui.item.code );
            return false;
        },
        select: function( event, ui ) {
    
            $( "#project" ).val( ui.item.code );
            $( "#demo_project" ).val( ui.item.code );
            $('#item_dis').val(ui.item.name);   
            $('#item_cost').val(ui.item.cost_price);  
            $('#item_sell').val(ui.item.selling_price);  
            $('#item_mrp').val(ui.item.mrp);  
            $( "#item_pro" ).val( ui.item.code ); 
            $('#item_cost1').val(ui.item.cost_price);  
            $('#item_sell1').val(ui.item.selling_price );  
            $('#item_mrp1').val(ui.item.mrp);  
            $('#item').val(ui.item.guid);
            document.getElementById('project').focus();
            return false;
        
        }
    })    
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
            .append( "<a style=font-size:12px>" + item.code +"    "+ item.name+
                "</a>" )               
            .appendTo( ul );
    };
    $( "#supplier").autocomplete({
        minLength: 0,
        source:"<?php echo base_url() ?>index.php/purchase_order/get_selected_supplier/",
        focus: function( event, ui ) {
            $( "#supplier" ).val( ui.item.label );
            return false;
        },
        select: function(event, ui ) {
             $( "#supplier" ).val( ui.item.label);
            $( "#name" ).val( ui.item.company );
            $("#sup_guid").val(ui.item.guid);
  
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
xmlhttp.open("GET","<?php echo base_url() ?>index.php/purchase_order/get_item_details_for_view/"+item_name,false);

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
        if (unicode!=8 && unicode!=9 && unicode!=13 && unicode!=27 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
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
                   document.getElementById('item_date').focus();
                           
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
           if(isNaN(document.getElementById("item_cost").value)){
               document.getElementById("item_cost").value='';
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
            if(isNaN(document.getElementById("item_sell").value)){
               document.getElementById("item_sell").value='';
           }
        }
        
      

function copy_items(){
 
 if(document.getElementById('item_edit').value!='jibi'){
     var od=document.getElementById('item_edit').value;
     var id=document.getElementById('item').value;
    document.getElementById(od+"c").value=document.getElementById('demo_project').value;
    document.getElementById(od+"d").value=document.getElementById('item_dis').value;
    document.getElementById(od+"q").value=document.getElementById('item_quty').value;
    document.getElementById(od+"co").value=document.getElementById('item_cost').value;
    document.getElementById(od+"s").value=document.getElementById('item_sell').value;
    document.getElementById(od+"p").value=document.getElementById('item_mrp').value;
    document.getElementById(od+"n").value=document.getElementById('item_net').value;
    document.getElementById(od+"dd").value=document.getElementById('item_date').value;
    document.getElementById(od).id=id;
    document.getElementById(od+"c").id=id+"c";
    document.getElementById(od+"d").id=id+"d";
    document.getElementById(od+"q").id=id+"q";
    document.getElementById(od+"co").id=id+"co";
    document.getElementById(od+"s").id=id+"s";
    document.getElementById(od+"p").id=id+"p";
    document.getElementById(od+"n").id=id+"n";
    document.getElementById(od+"dd").id=id+"dd";
    document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('demo_project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
    document.getElementById('item_net').value="";
    document.getElementById('item_date').value="";
    document.getElementById("project").focus();
    document.getElementById('item_edit').value='jibi';
 }else{
   
    //document.getElementById('item_copy_final').getElementsByTagName('tr')[0].id=document.getElementById('item').value+'tr';
   
    code=document.getElementById('demo_project').value;
    dis=document.getElementById('item_dis').value;
    quty=document.getElementById('item_quty').value;
    cost=document.getElementById('item_cost').value;
    sell=document.getElementById('item_sell').value;
    mrp=document.getElementById('item_mrp').value;
    net=document.getElementById('item_net').value;
    item=document.getElementById('item').value;
    del_date=document.getElementById('item_date').value;
     code=document.getElementById('project').value;
     discri=document.getElementById('item_dis').value;
         roll=parseInt(document.getElementById('roll_no').value);
   $('<tr id='+item+'><td><label id='+item+'roll class=roll_class>'+roll+'</label></td><td><input type=text name="coding[]" value='+code+' id='+item+'c class=item_inputd readonly=readonly ></td><td><input type=text name=dis[] value='+discri+' id='+item+'d class=item_input_d readonly=readonly ></td><td><input type=text name=quty[] value='+quty+' id='+item+'q class=item_input readonly=readonly ></td><td><input type=text name=cost[] value='+cost+' id='+item+'co class=item_input readonly=readonly ></td><td><input type=text name=sell[] value='+sell+' id='+item+'s class=item_input readonly=readonly ></td><td><input type=text name=mrp[] value='+mrp+' id='+item+'p readonly=readonly class=item_input ></td><td><input type=text name=del_date[] value='+del_date+' id='+item+'dd class=item_input readonly=readonly> </td><td><input type=text name=net[] readonly=readonly value='+net+' id='+item+'n class=item_input ></td><td><input type=button name=item[] value=Edit id='+item+' onclick=edit_items_details(this.id)></td><td><input type=button value=x id='+item+' onclick=reduce_balance("'+item+'");$(this).closest("tr").remove() ></td><td><input type=hidden name=items[] value='+item+' id='+item+'></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
    document.getElementById(item+'c').value=code;
    document.getElementById(item+'d').value=discri;
      document.getElementById('roll_no').value=roll+1;
    document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('demo_project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
    document.getElementById('item_net').value="";
    document.getElementById('item_date').value='';
    document.getElementById("project").focus();
    
    
        }  
}
function edit_items_details(od){
    document.getElementById('item_edit').value=od;
    document.getElementById('item').value=od;
    document.getElementById('project').value=document.getElementById(od+'c').value;
    document.getElementById('demo_project').value=document.getElementById(od+'c').value;
    document.getElementById('item_dis').value=document.getElementById(od+'d').value;
    document.getElementById('item_quty').value=document.getElementById(od+'q').value;
    document.getElementById('item_cost').value=document.getElementById(od+'co').value;
    document.getElementById('item_sell').value=document.getElementById(od+'s').value;
    document.getElementById('item_mrp').value=document.getElementById(od+'p').value;
    document.getElementById('item_net').value=document.getElementById(od+'n').value;
    document.getElementById('item_date').value=document.getElementById(od+'dd').value;
    document.getElementById('item_date1').value=document.getElementById(od+'dd').value;
    
  //  document.getElementById('item_dis1').value= document.getElementById('item_dis').value;
    document.getElementById('item_quty1').value= document.getElementById('item_quty').value;
    document.getElementById('item_cost1').value=document.getElementById('item_cost').value;
    document.getElementById('item_sell1').value=document.getElementById('item_sell').value;
    document.getElementById('item_mrp1').value=document.getElementById('item_mrp').value;
    document.getElementById('item_net1').value=document.getElementById('item_net').value;
    document.getElementById('hidden_total_price').value=(parseFloat(document.getElementById('hidden_total_price').value))-(parseFloat(document.getElementById(id+'n').value));
    
    //document.getElementById('item_save').style.visibility="visible";
    console.log(document.getElementById('item_dis').value);
    document.getElementById("project").focus();
 
}
function remove_item(id){
    document.getElementById('total_price').value=parseFloat(document.getElementById('total_price').value)- parseFloat(document.getElementById(id+'n').value);
   document.getElementById(id).id="jibi";
}
function add_new_row(){
   if(document.getElementById('item_sell').value!="" && document.getElementById('item_date').value!="" && document.getElementById('item_cost').value!="" &&  document.getElementById('item_mrp').value!="" && document.getElementById('item_net').value!="" &&  document.getElementById('project').value!="" && document.getElementById('item_dis').value!="" && document.getElementById('item_quty').value!="")
   {
    if(document.getElementById('item_edit').value!='jibi'){
      
     document.getElementById('hidden_total_price').value=parseFloat(document.getElementById('hidden_total_price').value)+parseFloat(document.getElementById('item_net').value);
     document.getElementById('hidden_total_price').value=(parseFloat(document.getElementById('hidden_total_price').value))-(parseFloat(document.getElementById('item_net1').value));
// document.getElementById('hidden_total_price').value=parseFloat( document.getElementById('total_price').value);
    }else{
         document.getElementById('hidden_total_price').value=parseFloat(document.getElementById('hidden_total_price').value)+parseFloat(document.getElementById('item_net').value);

        }
        frieight_amount();
        copy_items();
   }else{
       alert('Please Select An item');
   }
}
function check_supplier_is_select(){
    if(document.getElementById('supplier_guid').value=='not'){
      // alert('Please Select Supplier');
      document.getElementById('supplier').focus();
      document.getElementById('project').value="";
      alert('Please Select Particular Supplier');
    }
}
function discounte_amount(){
    if(parseFloat(document.getElementById('hidden_total_price').value)>0){
        total=parseFloat(document.getElementById('hidden_total_price').value);
        discount=(total*parseFloat(document.getElementById('discount').value))/100;
        document.getElementById('total_price').value=parseFloat(document.getElementById('hidden_total_price').value)-discount;
       
        round_amt=parseFloat(document.getElementById('round_amt').value);
        freight=parseFloat(document.getElementById('freight').value)
        if(freight==""){freight=0;}
        if(round_amt==""){round_amt=0;}
         document.getElementById('discount_amt').value=discount;
        if (isNaN(document.getElementById('total_price').value)) 
    document.getElementById('total_price').value=00;
    
        if (isNaN(document.getElementById('discount_amt').value)) 
    document.getElementById('discount_amt').value=0;
        if (isNaN(document.getElementById('round_amt').value)) 
    document.getElementById('round_amt').value=00;
        if (isNaN(document.getElementById('freight').value)) 
    document.getElementById('freight').value=00;
    }
    if(document.getElementById('discount').value==0 || isNaN(document.getElementById('discount').value)){
        document.getElementById('total_price').value=parseFloat(document.getElementById('hidden_total_price').value)+round_amt+freight;
    }
    frieight_amount();
    total=parseFloat(document.getElementById('hidden_total_price').value);
    if(total=="" || total==0 || isNaN(total)){
        document.getElementById('total_price').value="0";
    }
}
function frieight_amount(){
         if(parseFloat(document.getElementById('hidden_total_price').value)>0){
discount=parseFloat(document.getElementById('discount_amt').value);
frieight=parseFloat(document.getElementById('freight').value);
round_amt=parseFloat(document.getElementById('round_amt').value);
    if (isNaN(discount) || discount=="") {
    discount=0;}
        if (isNaN(frieight)|| frieight=="") {
    frieight=00;}
        if (isNaN(round_amt)|| round_amt=="") {
    round_amt=00;}

     document.getElementById('total_price').value=(parseFloat(document.getElementById('hidden_total_price').value)-discount)+frieight+round_amt;
         }

}
function reduce_balance(id){
    
     document.getElementById('hidden_total_price').value=(parseFloat(document.getElementById('hidden_total_price').value)-parseFloat(document.getElementById(id+'n').value));
       frieight_amount();
       if(isNaN(parseFloat(document.getElementById('hidden_total_price').value)) || parseFloat(document.getElementById('hidden_total_price').value)=="" ||parseFloat(document.getElementById('hidden_total_price').value==0)){
           document.getElementById('total_price').value="00";
       }
        var elements = document.getElementsByClassName('roll_class');
var j=1;
console.log();
var my_id=id+'roll';
for (var i = 0; i < elements.length; i++) {
    elements[0].value=1;
   if(parseFloat(document.getElementById(my_id).innerHTML)==i){
     elements[i].innerHTML =parseFloat(elements[i-1].innerHTML)
   }else{
       if(i!=0){
         elements[i].innerHTML =parseFloat(elements[i-1].innerHTML)+1;
        j++;
       }
   }
     document.getElementById('roll_no').value=elements.length;
}
}
 function exp_date(e){      
     var unicode=e.charCode? e.charCode : e.keyCode
              if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57){       
                  if (unicode!=9 && unicode!=13){                        
                      if(unicode==27){
                        window.setTimeout(function ()
    {
         document.getElementById('supplier').focus();
    }, 0);
                      }
                      return false ;
        }
       else{
           if(document.getElementById('expdate').value!=""){
       window.setTimeout(function ()
    {
         document.getElementById('purchse_order_no').focus();
    }, 0);
               }else{
               return false;
           }
       }
        }
              }
 }
 function order_date(e){      
     var unicode=e.charCode? e.charCode : e.keyCode
              if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57){       
                  if (unicode!=9 && unicode!=13){                        
                      if(unicode==27){
                        window.setTimeout(function ()
    {
         document.getElementById('purchse_order_no').focus();
    }, 0);
                      }
                      return false ;
        }
       else{
           if(document.getElementById('purchase_order_date').value!=""){
       window.setTimeout(function ()
    {
         document.getElementById('discount').focus();
    }, 0);
               }else{
               return false;
           }
       }
        }
              }
 }
 function order_discount(e){      
     var unicode=e.charCode? e.charCode : e.keyCode
              if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57){       
                  if (unicode!=9 && unicode!=13){                        
                      if(unicode==27){
                        window.setTimeout(function ()
    {
         document.getElementById('purchase_order_date').focus();
    }, 0);
                      }
                      return false ;
        }
       else{
           if(document.getElementById('discount').value!=""){
       window.setTimeout(function ()
    {
         document.getElementById('freight').focus();
    }, 0);
               }else{
               return false;
           }
       }
        }
              }
 }
 function order_freight(e){      
     var unicode=e.charCode? e.charCode : e.keyCode
              if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57){       
                  if (unicode!=9 && unicode!=13){                        
                      if(unicode==27){
                        window.setTimeout(function ()
    {
         document.getElementById('discount').focus();
    }, 0);
                      }
                      return false ;
        }
       else{
           if(document.getElementById('freight').value!=""){
       window.setTimeout(function ()
    {
         document.getElementById('round_amt').focus();
    }, 0);
               }else{
               return false;
           }
       }
        }
              }
 }
 function order_round(e){      
     var unicode=e.charCode? e.charCode : e.keyCode
              if (unicode!=8 && unicode!=46 && unicode!=37 && unicode!=38 && unicode!=39 && unicode!=40 && unicode!=47 && unicode!=45){ //if the key isn't the backspace key (which we should allow)
        if (unicode<48||unicode>57){       
                  if (unicode!=9 && unicode!=13){                        
                      if(unicode==27){
                        window.setTimeout(function ()
    {
         document.getElementById('freight').focus();
    }, 0);
                      }
                      return false ;
        }
       else{
           if(document.getElementById('round_amt').value!=""){
       window.setTimeout(function ()
    {
         document.getElementById('project').focus();
    }, 0);
               }else{
               return false;
           }
       }
        }
              }
 }
 function order_number(e){      
     var unicode=e.charCode? e.charCode : e.keyCode
            
                  if (unicode!=9 && unicode!=13){
                      
                      if(unicode==27){
                        window.setTimeout(function ()
    {
         document.getElementById('expdate').focus();
    }, 0);
                      }
                   
        }
       else{
           if(document.getElementById('purchse_order_no').value!=""){
       
       window.setTimeout(function ()
    {
         document.getElementById('purchase_order_date').focus();
    }, 0);
               }else{
               return false;
           }
       }
 }
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
}
document.onkeypress = stopRKey;

	</script>
    
        
     
   <form action="purchase_order/update_items" method="post" id="form">
          <div style="width: 100%;  background: #ffcccc ">
       <input type="hidden" name="supplier_id" id="sup_guid">
       <?php foreach ($order as $po) {
     foreach ($sup as $sup_details){
           if($sup_details->guid===$po->supplier_id){
           ?>
       <table style="margin-left: 150px">
            <tr><td>    <input type="hidden" id="supplier_guid" value="<?php echo $po->supplier_id; ?>">
        <input type="hidden" name="roll_no" id="roll_no" value="<?php echo $po->total_items+1 ?>"><?php echo form_label($this->lang->line('supplier code'))?></td>
                <td><input type="text" id="supplier"  name="estado" readonly="readonly" value="<?php echo $sup_details->company_name; ?>" autocomplete="off" style="width: 100px" /></td>
                <td><?php echo form_label($this->lang->line('exp_date'))?></td><td><input type="text" name="expdate"  value="<?php echo $po->exp_date; ?>" onkeypress="return exp_date(event); " id="expdate" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('podate'))?></td><td><input type="text" name="podate" id="purchase_order_date" value="<?php echo $po->po_date; ?>" onkeypress="return order_date(event)"  style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('disamount'))?></td><td><input type="text" name="discount_amt" id="discount_amt" readonly="readonly" onkeypress="return numbersonly(event)"  style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('Round off Amount'))?></td><td><input type="text" name="round_amt" value="<?php echo $po->round_amt; ?>" id="round_amt" onkeyup="frieight_amount()" onkeypress="return order_round(event)"  style="width: 100px"></td>
            </tr>
            <tr><td><?php echo form_label($this->lang->line('supplier name'))?></td><td>
                    <input type="text" id="name" name="estado" value="<?php echo $sup_details->first_name; ?>" autocomplete="off" disabled style="width: 100px"/>
                    <input type="hidden"  value="<?php echo $sup_details->first_name; ?>" name="supplier"> </td>
                <td><?php echo form_label($this->lang->line('pono'))?></td><td><input type="text" name="pono" value="<?php echo $po->po_no; ?>" id="purchse_order_no" onkeypress="return order_number(event)" style="width: 100px"></td>
                <td><?php echo form_label($this->lang->line('discount'))?></td><td><input type="text" name="discount" value="<?php echo $po->discount; ?>" id="discount" maxlength="3" onkeyup="discounte_amount()" onkeypress="return order_discount(event)"  style="width: 100px"  ></td>
             <td><?php echo form_label($this->lang->line('Freight'))?></td><td><input type="text" name="freight" id="freight" value="<?php echo $po->freight; ?>" onkeyup="frieight_amount()" onkeypress="return order_freight(event)" style="width: 100px"></td>
            </tr>
              </table>
     <?php }}}?>
        </div> <div style="width: 100%;height: 350px;background:#ccccff "><div class="ui-widget item_details_css ">
     <div id="item_div" class="item_det_div" >
        <table>
         
            <tr><td id="myDiv"></td><td><div id="item_image" class="details_size" ></div></td></tr>
        </table>
    </div>
       
<table id="parent_item"><tr> <td></td>
        <td> <label>Item Code</label> </td>
        <td> description  </td><td><label>Quty</label> </td>
        <td><label>Cost</label></td><td><label>selling price</label></td>
        <td><label>M R P</label></td><td><label>Delivery Date</label></td><td><label>Net Amount</label></td><td></td><td></td></tr>
    <tr> <td>&nbsp;</td><input type="hidden" id="item"><input type="hidden" id="item_edit" value="jibi">
    <td><input type="hidden" id="item_pro"> <input type="hidden" id="item_sl" value="0">
        <input id="project" name="project" type="text" onkeyup="check_supplier_is_select()" onclick="check_supplier_is_select()" class="item_inputd" /><input type="hidden" id="demo_project">
            <input type="hidden" id="project-id" /></td>
        <td><input type="text" id="item_dis" disabled class="item_input_d"/></td>
        <td><input type="hidden" id="item_quty1"> <input type="text" id="item_quty" class="item_input"  onkeyup="net_amount()" onKeyPress="add_new_q(event);  return numbersonly(event)"  /></td>
        <td><input type="hidden" id="item_cost1"> <input type="text" id="item_cost"class="item_input" onclick="items_cost_click();net_amount()"  onkeyup="net_amount()"  onKeyPress=" add_new_cost(event); return numbersonly(event)" /></td>
        <td><input type="hidden" id="item_sell1"> <input type="text" id="item_sell" class="item_input" onclick="item_sell_click();net_amount()"  onKeyPress="add_new_sell(event); return numbersonly(event)" /></td>
        <td><input type="hidden" id="item_mrp1"> <input type="text" id="item_mrp" class="item_input" onclick=""  onKeyPress="add_new_mrp(event); return numbersonly(event)"  /></td>
        <td><input type="hidden" id="item_date1" value="00" > <input type="text" id="item_date" class="item_input"  ></td>
        <td><input type="hidden" id="item_net1"> <input type="text" id="item_net" class="item_input" disabled   /></td><td><input type="button" onclick="add_new_row();discounte_amount()" value="+"></td></tr> 
</table>       <div id="div_element">
    <table id="item_copy_final">
        <?php $i=1;
        foreach ($order_items as $items) { 
            foreach ($item as $op_item ){
                if($op_item->guid===$items->item){
            ?>
        <tr id="<?php echo $op_item->guid ?>"><td><label id='<?php echo $op_item->guid.'roll' ?>' class=roll_class><?php echo $i++; ?></label></td>
            <td><input type="text" class="item_inputd" id="<?php echo $op_item->guid.'c' ?>" readonly="readonly" value="<?php echo $op_item->code ?>" ></td>
            <td><input type="text" class="item_input_d" id="<?php echo $op_item->guid.'d' ?>" readonly="readonly" value="<?php echo $op_item->name  ?>" ></td>
            <td><input type="text" class="item_input" id="<?php echo $op_item->guid.'q' ?>" readonly="readonly" value="<?php echo $items->quty  ?>" ></td>
            <td><input type="text" class="item_input" id="<?php echo $op_item->guid.'co' ?>" readonly="readonly" value="<?php echo $items->cost ?>" ></td>
            <td><input type="text" class="item_input" id="<?php echo $op_item->guid.'s' ?>" readonly="readonly" value="<?php echo $items->sell ?>" ></td>
            <td><input type="text" class="item_input" id="<?php echo $op_item->guid.'p' ?>" readonly="readonly" value="<?php echo $items->mrp ?>" ></td>
            <td><input type="text" class="item_input" id="<?php echo $op_item->guid.'dd' ?>" readonly="readonly" value="<?php echo $items->date ?>" ></td>
            <td><input type="text" class="item_input" id="<?php echo $op_item->guid.'n' ?>" readonly="readonly" value="<?php echo $items->amount  ?>" ></td>
            <td><input type="button" id="<?php echo $op_item->guid ?>" onclick="edit_items_details(this.id)" name="items[]"  value="edit" ></td>
            <td><input type="button" id="<?php echo $op_item->guid ?>" onclick="reduce_balance('<?php echo $op_item->guid ?>');$(this).closest('tr').remove()"  value="x" ></td>
            
        </tr>
            
                <?php }}}?>
    </table>
                </div>
     
</div>
    </div>
        <div style="width: 100%;height:200px;background:#99ffcc ">
            <table>
                <tr><td>Remarks</td><td><textarea rows="4" cols="50" name="remark"></textarea> </td><td>Note</td><td><textarea rows="4" cols="50" name="note"></textarea> </td><td>Total amount</td><td><input type="text" disabled  name="total_price" id="total_price" value="00"><input type="hidden" disabled  name="hidden_total_price" id="hidden_total_price" value="00"></td></tr>
                <tr><td></td><td></td><td></td><td></td><td><?php echo form_submit('save',$this->lang->line('save')) ?><?php echo form_submit('cancel',$this->lang->line('cancel')) ?></td></tr>
            
            </table>
       </div>
   </form>
        <?php echo validation_errors();
 ?>
</body>
</html>
