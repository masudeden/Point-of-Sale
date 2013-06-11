
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
</script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>src/js/simpleAutoComplete.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>src/css/simpleAutoComplete.css" />
    <script type="text/javascript">
        function get_mag(but){             
                        $("#"+but+"").remove();
 
        }
	$(document).ready(function()
	{
	    $('#estado_autocomplete').simpleAutoComplete('http://localhost/PointOfSale/index.php/supplier_vs_items/get_selected_item',{}, get_items);

        });
	
	function get_items( par )
	{
             
	    $("#id_estado").val( par[0] );
           name=par[1] ;
           discri=par[0];          
           item=par[5];
           sell=par[3];
           cost=par[2];
           
          
          
           if(document.getElementById(item)){          
               alert('this item is already added in this supplier');
              document.getElementById("estado_autocomplete").value="";
           }else{
              
            $('#yourTableId').append("<div id="+item+"><ul   class=data  ><li><input type=hidden name=itemsid[] value="+item+" style=width: 80px> <input type=text value="+name+" disabled style=width: 80px > </li><li ><input type=text value="+discri+" disabled style=width: 80px > </li><li ><input type=text name=quty[] title=0 id="+item+"5 value=0 onkeyup=removeTextTag(event,"+item+"5) style=width: 80px > </li><li ><input type=text value="+cost+" title="+cost+" id="+item+"6 name=cost[] onkeyup=removeTextTag(event,"+item+"6)style=width: 80px  > </li><li ><input type=text value="+sell+"  name=price[] title="+sell+" id="+item+"7 onkeyup=removeTextTag(event,"+item+"7) style=width: 80px  > </li><li ><input type=text name=disco[] value=0 title=0 id="+item+"8  onkeyup=removeTextTag(event,"+item+"8) style=width: 80px ></li><li><input type=checkbox name="+item+" <?php echo set_checkbox("+iteme+", '1'); ?> style=width: 80px ></li><li ><input type=button value=X name=send  onclick=get_mag("+item+") ><input type=hidden name=items[] value="+item+" ></li></ul></div>");	         
             document.getElementById("estado_autocomplete").value="";                        
	    }
	}

	function cidadeCallback( par )
	{
                       $('#yourTableId').append('<tr><td>new row</td></tr>');
	    $("#id_cidade").val( par[0] );
	    $("#uf2").val( par[1] );
	}
	
        

    </script>
  </head>
  <body>
     
	 
      <div style="margin-left:100px;">
	  <?php echo form_open('supplier_vs_items/save_items'); echo form_hidden('id',$supplier_id) ?>
           <tr><td> <?php echo form_submit('save',$this->lang->line('save')); ?> <?php echo form_submit('cancel',$this->lang->line('cancel')); ?></td></tr>
           <?php if(count($row)>0){ ?> <input type="text" id="estado_autocomplete" name="estado" autocomplete="off"  /><?php ?>
	<ul class="labeled"><li> <label>Item Code</label> </li><li> description  </li><li><label>Quty</label> </li><li><label>Cost</label></li><li><label>selling price</label></li><li><label>Discount</label></li><li><label>Deactivate</label></li><li><label>Remove</label></li></ul>
           
            <?php } if(count($row)>0){
                
                foreach ($row as $irow){ 
                    foreach ($item as $itrow){
                        if($itrow->id==$irow->item_id){
                            
                     
                    ?>
        
          <div id="<?php echo $irow->item_id ?>"><ul   class="data"  >
                  <li><input type="hidden" name="itemsid[]" value="<?php echo $irow->item_id; ?>"> 
                    <input type="text" value="<?php echo $itrow->code; ?>" disabled style="width: 80px;" > </li>
                  <li ><input type="text" value="<?php echo $itrow->description; ?>" disabled style="width: 80px;" > </li>
                  <li ><input type="text" name="quty[]" title="0" id="<?php echo $irow->item_id."5"; ?>" value="0" onkeyup="removeTextTag(event,<?php echo $irow->item_id."5";?>)" style="width: 80px;" > </li>
                  <li ><input type="text" value="<?php echo $irow->cost;?> "title="<?php echo $irow->cost;?>" id="<?php echo $irow->item_id."6"; ?>" name="cost[]" onkeyup="removeTextTag(event,<?php echo $irow->item_id."6";?>)" style="width: 80px;" > </li>
                  <li ><input type="text" value="<?php echo $irow->price;?>"  name="price[]" title="<?php echo $irow->price; ?>" id="<?php echo $irow->item_id."7"; ?>" onkeyup="removeTextTag(event,<?php echo $irow->item_id."7"; ?>)" style="width: 80px;"  > </li>
                  <li ><input type="text" name="disco[]" value="0" title="0" id="<?php echo $irow->item_id."8"; ?>"  onkeyup="removeTextTag(event,<?php echo $irow->item_id."8"; ?>)" style="width: 80px;" ></li>
                  <li ><input type="checkbox" name="<?php echo $irow->item_id ?>" <?php if($irow->active_status==1){?> checked<?php } ?> <?php echo set_checkbox($irow->item_id, '1'); ?>></li>
                  <li > <input type="button" value="X" name="send"  onclick="get_mag(<?php echo $irow->item_id; ?>)" > <input type=hidden name=items[] value="+item+"></li></ul></div>        
              <?php    }
                    }}}else{  ?>
                 <input type="text" id="estado_autocomplete" name="estado" autocomplete="off"  />
             <?php }?>
               
           <div id="yourTableId" border="1" class="myrow" >
              
          
         <?php echo form_close();?>
      </div>
      </div>
     
    
  </body>
</html>