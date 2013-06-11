
<style>
    .myrow{
        border-width: 1px;
        
    }
    .myrow td{
        border: none;
    }
    .data{
        list-style: none;
    }
    .data li{
        width: 12%;
         float:left;
       
    }
    .labeled{
        list-style: none;
    }
    
    .labeled li{
        width: 12%;
        float: left;
    }
     .labeleded{
        list-style: none;
    }
    
    .labeleded li{
        width: 12%;
        float: left;
    }
    .labeled input{
        width: 80px;
    }
</style>
<script>
function addTextTag(txt)
{
document.getElementById("text_tag_input").value+=txt;
}
function removeTextTag(e,id)
{
	var unicode=e.charCode? e.charCode : e.keyCode
if (unicode!=8 && unicode!=46){ //if the key isn't the backspace key (which we should allow)
if (unicode<48||unicode>57)
{
var strng=document.getElementById(id).value;
title=document.getElementById(id).title;
document.getElementById(id).value=strng.replace(strng,title);
}
}
}
function removeElement(parentDiv, childDiv){
     if (childDiv == parentDiv) {
          alert("The parent div cannot be removed.");
     }
     else if (document.getElementById(childDiv)) {     
          var child = document.getElementById(childDiv);
          var parent = document.getElementById(parentDiv);
          parent.removeChild(child);
     }
     else {
          alert("Child div has already been removed or does not exist.");
          return false;
     }
}
function disableEnterKey(e){   
var key;
    if(window.event){
    key = window.event.keyCode;
    } else {
    key = e.which;     
    }
    if(key == 13){
    return false;

    } else {
      
    return true;
    }
    
} 


</script>
<script type="text/javascript" src="<?php echo base_url(); ?>auto/lib/jquery.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/lib/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/lib/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/lib/thickbox-compressed.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/jquery.autocomplete.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>auto/demo/localdata.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/demo/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/jquery.autocomplete.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>auto/lib/thickbox.css" />
    <script type="text/javascript" src="<?php echo base_url();?>src/js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>src/js/simpleAutoComplete.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>src/css/simpleAutoComplete.css" />
    <script type="text/javascript">
        function get_mag(but){             
                        $("#"+but+"").remove();
 
        }
	$(document).ready(function()
	{
	    $('#supplier').simpleAutoComplete('http://localhost/PointOfSale/index.php/purchase_main/get_selected_supplier',{}, get_supplier);
           
        });
	
	function get_supplier( par )
	{
             
	    $("#id_estado").val( par[0] );
           name=par[1] ;
           discri=par[0];          
           item=par[2];
        
           if(document.getElementById(item)){          
               alert('this item is already added in this supplier');
              document.getElementById("supplier").value="";
           }else{
              
           // $('#yourTableId').append("<div id="+item+"><ul   class=data  ><li><input type=hidden name=itemsid[] value="+item+" style=width: 80px> <input type=text value="+name+" disabled style=width: 80px > </li><li ><input type=text value="+discri+" disabled style=width: 80px > </li><li ><input type=text name=quty[] title=0 id="+item+"5 value=0 onkeyup=removeTextTag(event,"+item+"5) style=width: 80px > </li><li ><input type=text value="+cost+" title="+cost+" id="+item+"6 name=cost[] onkeyup=removeTextTag(event,"+item+"6)style=width: 80px  > </li><li ><input type=text value="+sell+"  name=price[] title="+sell+" id="+item+"7 onkeyup=removeTextTag(event,"+item+"7) style=width: 80px  > </li><li ><input type=text name=disco[] value=0 title=0 id="+item+"8  onkeyup=removeTextTag(event,"+item+"8) style=width: 80px ></li><li><input type=checkbox name="+item+" <?php echo set_checkbox("+iteme+", '1'); ?> style=width: 80px ></li><li ><input type=button value=X name=send  onclick=get_mag("+item+") ><input type=hidden name=items[] value="+item+" ></li></ul></div>");	         
           document.getElementById('name').value=discri;
           document.getElementById('supplierid').value=item;
             //document.getElementById("supplier").value="";                        
	    }
	}
        function  disable_arows(e){
var key;
    if(window.event){
    key = window.event.keyCode;
    } else {
    key = e.which;     
    }
    if(key == 37){
    return false;

    } else {
      
    return true;
    }
        }
function get_item_details(item){
	
     var  jibi1=document.activeElement.id;
   
	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
               
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	
$().ready(function() {
	
        $("#suggest5").autocomplete('http://localhost/PointOfSale/index.php/purchase_main/get_new', {
		width: 300,
		multiple: true,
		matchContains: true,
		formatItem: formatItem,
		formatResult: formatResult
	});
	

	
	
	
	
	
	$("#suggest5").result(function(event, data, formatted) {
	document.getElementById('suggest5').value="";
                 document.getElementById('item_ided1').value=data[4];
	});
  
	$("#scrollChange").click(changeScrollHeight);
	
	
	
	$("#clear").click(function() {
		$(":input").unautocomplete();
	});

//            function get_items( par )
//            {
//               if(document.getElementById(par[4])){
//                             alert("This Item Is already added");
//                         }else{
//                 var dis=document.getElementById(item).className  ; 
//                 var ddata
//                            $(function() {
//                   $('.'+dis+"2").each(function () {
//                       ddata = this.id;
//
//                   });
//               });
//                var qdata
//                            $(function() {
//                   $('.'+dis+"3").each(function () {
//                       qdata = this.id;
//
//                   });
//               });
//                var cdata
//                            $(function() {
//                   $('.'+dis+"4").each(function () {
//                       cdata = this.id;
//
//                   });
//               });
//                var sdata
//                            $(function() {
//                   $('.'+dis+"5").each(function () {
//                       sdata = this.id;
//
//                   });
//               });
//                var iddata
//                            $(function() {
//                   $('.'+dis+"2").each(function () {
//                       iddata = this.id;
//
//                   });
//               });
//
//                               document.getElementById('itemid').value=par[4];
//
//                         document.getElementById('final').value=par[4];
//
//                            document.getElementById(ddata).value=par[0];   
//                            document.getElementById(cdata).value= par[2];  
//                            document.getElementById(sdata).value= par[3];  
//
//
//                }
//                // document.getElementById('descri').class=par[1];
//            }
});
        }
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
	<ul class="labeled">
            <li> <label>Item Code</label> </li><li> description  </li><li><label>Quty</label> </li><li><label>Cost</label></li><li><label>selling price</label></li><li><label>Remove</label></li></ul>
                  </br></br>
                  <table>
          
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
    <form >
		
		<p>
			
                    <input type="text" id='suggest5' onkeypress=" return  disable_arows(event)" onkeyup=" get_item_details(this.id) " >
                        
		</p>
                <input type="text" id="item_ided" >
                <input type="text" id="item_ided1" >
	</form>
  </body>
</html>