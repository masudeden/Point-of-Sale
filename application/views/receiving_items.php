
<style>
    .myrow{
        border-width: 1px;
        
    }
    .myrow td{
        border: none;
    }
</style>


    
    <script type="text/javascript" src="<?php echo base_url();?>src/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>src/js/simpleAutoComplete.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>src/css/simpleAutoComplete.css" />
    <script type="text/javascript">
	$(document).ready(function()
	{
	    $('#estado_autocomplete').simpleAutoComplete('http://localhost/PointOfSale/index.php/receiving/get_selected_item',{}, get_items);

        });
	
	function get_items( par )
	{
             
	    $("#id_estado").val( par[0] );
           name=par[2] ;
           price=par[1];
           stock=par[0];
           item=par[3];
           amo=0;
          
           if(document.getElementById(item)){
               var jibi = document.getElementById(item).value;
               qua=Number(jibi)+Number(1);
                 amo= document.getElementById('amount').value;
               
            document.getElementById("amount").value=Number(amo)+Number(price)
              document.getElementById(item).value=qua;
              document.getElementById("estado_autocomplete").value="";
           }else{
          
          
            $('#yourTableId').append("<tr><td><input type=text value="+name+"  disabled> </td><td><input type=text value="+price+"> </td><td><input type=text value="+1+" id="+item+"><td><input type=text value="+stock+" disabled > </td></tr>").val('jibi');;
	     amo= document.getElementById('amount').value;               
             document.getElementById("amount").value=Number(amo)+Number(price)
             document.getElementById("estado_autocomplete").value="";
             document.getElementById("amount").value=price+amoun;
            
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
     
	  <div style="float: right"><table><tr><td><label>amount</label></td><td><input type="text" id="amount" value="" disabled></td></tr></table></div>
      <div style="margin-left:100px;">
	  
	  <input type="text" id="estado_autocomplete" name="estado" autocomplete="off" style="width: 250px; height: 23px;" />
          <table id="yourTableId" border="1" class="myrow" ><tr><td ><label>Item Name</label> </td><td>item cost</td><td>Qty.</td><td>item stock</td><tr>
	  
          </table>
          <input type="hidden" id="chack">
         
      </div>
      
  </body>
</html>