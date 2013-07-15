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
        for (i = 0, l = projects.length; i<l; i++) {
            obj = projects[i];
            if (hasMatch(obj.label) || hasMatch(obj.desc)) {
                matches.push(obj);	
            }
        }
        response(matches);
    }
    $( "#project" ).autocomplete({
        minLength: 0,
        source:"<?php echo base_url() ?>index.php/suppliers_x_items/get_item_details/",
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
            
            $('#item').val(ui.item.id);
            console.log();
            return false;
        }
        }
    })
  
      
   
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
xmlhttp.open("GET","<?php echo base_url() ?>index.php/suppliers_x_items/get_item_details_for_view/"+item_name,false);

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
    if(document.getElementById('item_cost').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           document.getElementById("item_sell").focus();
           
        }
         if (unicode!=27){
        }
       else{
               
             document.getElementById("item_quty").focus();
        }
        }
    }
    function add_new_sell(e){
       var unicode=e.charCode? e.charCode : e.keyCode
    if(document.getElementById('item_sell').value!=""){
                  if (unicode!=13 && unicode!=9){
        }
       else{
           document.getElementById("item_mrp").focus();
           
        }
         if (unicode!=27){
        }
       else{
               
             document.getElementById("item_cost").focus();
        }
        }
    }
    function add_new_mrp(e){
        var unicode=e.charCode? e.charCode : e.keyCode
    if(document.getElementById('item_mrp').value!="" && document.getElementById('item_quty').value!="" && document.getElementById('item_cost').value!="" && document.getElementById('item_sell').value!=""){
                  if (unicode!=13 && unicode!=9){
                    
        }
       else{ if(document.getElementById('item_dis').value!=""){
            
                            copy_items();
       }else{
           alert('You Must select an item');
           document.getElementById("project").focus();
        }
       }
         if (unicode!=27){
        }
       else{
               
             document.getElementById("item_sell").focus();
        }
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
   
    document.getElementById(od).id=id;
    document.getElementById(od+'id').value=id;
    document.getElementById(od+"c").id=id+"c";
    document.getElementById(od+"d").id=id+"d";
    document.getElementById(od+"q").id=id+"q";
    document.getElementById(od+"co").id=id+"co";
    document.getElementById(od+"s").id=id+"s";
    document.getElementById(od+"p").id=id+"p";
   // document.getElementById(od+"n").id=id+"n";
    document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
    
    document.getElementById("project").focus();
    document.getElementById('item_edit').value='jibi';
 }else{
   
    
    //document.getElementById('item_copy_final').getElementsByTagName('tr')[0].id=document.getElementById('item').value+'tr';
   
    code=document.getElementById('project').value;
    dis=document.getElementById('item_dis').value;
    quty=document.getElementById('item_quty').value;
    cost=document.getElementById('item_cost').value;
    sell=document.getElementById('item_sell').value;
    disc=document.getElementById('item_mrp').value;
    item=document.getElementById('item').value;
    var iid=document.getElementById('item').value;
      $('<tr id='+item+'><td><input type=text name="coding[]" value='+code+' id='+item+'c class=item_inputd readonly=readonly ></td><td><input type=text name=dis[] value='+dis+' id='+item+'d class=item_input_d readonly=readonly ></td><td><input type=text name=quty[] value='+quty+' id='+item+'q class=item_input readonly=readonly ></td><td><input type=text name=cost[] value='+cost+' id='+item+'co class=item_input readonly=readonly ></td><td><input type=text name=sell[] value='+sell+' id='+item+'s class=item_input readonly=readonly ></td><td><input type=text name=mrp value='+disc+' id='+item+'p class=item_input ></td><td><input type=button name=item[] value=Edit id='+item+' onclick=edit_items_details(this.id)></td><td><input type=button value=x id='+item+' onclick= $(this).closest("tr").remove() ></td><td><input type=hidden name=items[] value='+item+' id='+item+'></td></tr>').fadeIn("slow").appendTo('#item_copy_final');
      
console.log();
    document.getElementById('item').value="";
    document.getElementById('project').value="";
    document.getElementById('item_dis').value="";
    document.getElementById('item_quty').value="";
    document.getElementById('item_cost').value="";
    document.getElementById('item_sell').value="";
    document.getElementById('item_mrp').value="";
  
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
  
  // document.getElementById('item_dis1').value= document.getElementById('item_dis').value;
    document.getElementById('item_quty1').value= document.getElementById('item_quty').value;
    document.getElementById('item_cost1').value=document.getElementById('item_cost').value;
    document.getElementById('item_sell1').value=document.getElementById('item_sell').value;
    document.getElementById('item_mrp1').value=document.getElementById('item_mrp').value;
    
    document.getElementById('item').value=od;
    //document.getElementById('item_save').style.visibility="visible";
    console.log(document.getElementById('item_dis').value);
    document.getElementById("project").focus();
 
}
function remove_item(id){
    document.getElementById('total_price').value=parseFloat(document.getElementById('total_price').value)- parseFloat(document.getElementById(id+'n').value);
    document.getElementById(id).id="jibi";
}
function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
}
document.onkeypress = stopRKey;
    </script>
    <body >
          <form action="<?php echo base_url() ?>index.php/suppliers_x_items/save_items" method="post" id="form" >
        <div style="width: 100%; ; background: #ffcccc ">
          
       <input type="hidden" name="s_guid" value="<?php echo $supplier_id ?>">
       <table style="margin-left: 150px">
       
<?php foreach ($sup as $i_sup) { ?>
<tr><td><label><?php echo $this->lang->line('suppler_company') ?><label></td><td><label><?php echo $i_sup->company_name ?><label></td></tr>
<tr><td><label><?php echo $this->lang->line('name') ?><label></td><td><label><?php echo $i_sup->first_name ?><label></td></tr>
<?php } ?>
</table>
</div>
<div style="width: 100%;height: 350px;background:#ccccff "><div class="ui-widget item_details_css ">
<div id="item_div" class="item_det_div" >
<table>
<tr><td id="myDiv"></td><td><div id="item_image" class="details_size" ></div></td></tr>
</table>
</div>
<table id="parent_item"><tr>
<td> <label>Item Code</label> </td>
<td> Name</td><td><label>Quty</label> </td>
<td><label>Cost</label></td><td><label>selling price</label></td>
<td><label>Discount</label></td><td></td></tr>
<tr><input type="hidden" id="item"><input type="hidden" id="item_edit" value="jibi">
<td><input type="hidden" id="item_pro"> <input type="hidden" id="item_sl" value="0">
<input id="project" name="project" type="text" class="item_inputd" />
<input type="hidden" id="project-id" /></td>
<td><input type="text" id="item_dis" disabled class="item_input_d"/></td>
<td><input type="hidden" id="item_quty1"> <input type="text" id="item_quty" class="item_input" onKeyPress="add_new_q(event); return numbersonly(event)" /></td>
<td><input type="hidden" id="item_cost1"> <input type="text" id="item_cost"class="item_input" onKeyPress=" add_new_cost(event); return numbersonly(event)" /></td>
<td><input type="hidden" id="item_sell1"> <input type="text" id="item_sell" class="item_input" onKeyPress="add_new_sell(event); return numbersonly(event)" /></td>
<td><input type="hidden" id="item_mrp1"> <input type="text" id="item_mrp" class="item_input" onKeyPress="add_new_mrp(event); return numbersonly(event)" /></td>
</tr>
</table>
<table>
<?php if(count($row)>0){
     foreach ($row as $it_row){
         foreach ($items as $i_row){
             if($it_row->item_id==$i_row->guid){
         ?>
    
<tr id="<?php echo $i_row->guid ?>">
<td >
<label id="sl_no" ></label>
<input type="input" name="coding[]" value="<?php echo $i_row->code ?>" id="<?php echo $i_row->guid."c" ?>" class="item_inputd"></td>
<td><input type="input" name="dis[]" value="<?php echo $i_row->name ?>" readonly="readonly" id="<?php echo $i_row->guid."d" ?>" class="item_input_d"></td>
<td><input type="input" name="quty[]" value="<?php echo $it_row->quty  ?>" readonly="readonly" id="<?php echo $i_row->guid."q" ?>" class="item_input"></td>
<td><input type="input" name="cost[]" value="<?php echo $it_row->cost ?>" readonly="readonly" id="<?php echo $i_row->guid."co" ?>" class="item_input"></td>
<td><input type="input" name="sell[]" value="<?php echo $it_row->price  ?>" readonly="readonly" id="<?php echo $i_row->guid."s" ?>"class="item_input"></td>
<td><input type="input" name="mrp[]" value="<?php echo $it_row->discount ?>" readonly="readonly" id="<?php echo $i_row->guid."p" ?>"class="item_input"></td>
<td><input type="button" name="item[]" onclick="edit_items_details(this.id)" value="Edit" id="<?php echo $i_row->guid ?>">
<input type="button" onclick=" $(this).closest('tr').remove()" value="X" id="<?php echo $i_row->guid ?>"></td>
<td><input type='hidden' name='items[]' value="<?php echo $i_row->guid ?>" id="<?php echo $i_row->guid.'id' ?>"></td>
</tr>
<?php } } }
    } ?>
</table>
<table id="item_copy_final">

</table>
</div>
</div>
<div style="width: 100%;height:200px;background:#99ffcc ">
<table>
<tr><td></td><td></td><td></td><td></td><td><?php echo form_submit('save',$this->lang->line('save')) ?><?php echo form_submit('cancel',$this->lang->line('cancel')) ?></td></tr>
</table
</div>
<div id="my_table">
</div>

</form>
</body>
</html>