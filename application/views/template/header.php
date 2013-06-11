<html >
<head>
  <meta charset="utf-8">
  <title>POS</title>
<head>

<script src="<?php echo base_url();?>js/jquery-1.9.1.js"></script>
<script src="<?php echo base_url();?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="<?php echo base_url();?>js/ajaxupload.3.5.js" ></script>
<script > 

function languaged(value){
    var jibi=value;
  
	$.ajax({
            
		type: "post",
		url: "http://localhost/PointOfSale/index.php/userlogin/setlanguage/"+jibi
					
		
        });
        alert('Language is Changed To '+value);
         window.location.reload(true);

        
}

function set_language(){

var lang = document.getElementById("chnagelanged").value;
 
    languaged(lang);

}

</script>

</head>
<body><form action="">  
        <tr>                        
           <td><select  name="ToLB" id="chnagelanged" style="width:150">    
   <option name="english" value="english" onClick="set_language(this.form.ToLB)">English</option>
   <option name="malayalam" value="malayalam" onClick="set_language(this.form.ToLB)">Malayalam</option>
</select></td></tr>
           
</form>
         
