

<script > 

function languaged(value){
    var jibi=value;
  
	$.ajax({
            
		type: "post",
		url: "<?php echo base_url(); ?>index.php/userlogin/setlanguage/"+jibi
					
		
        });
        alert('Language is Changed To '+value);
         window.location.reload(true);

        
}

function set_language(){

var lang = document.getElementById("chnagelanged").value;
 
    languaged(lang);

}

</script>
<form action="">  
        <tr>                        
           <td><select  name="ToLB" id="chnagelanged" style="width:150">    
   <option name="english" value="english" onClick="set_language(this.form.ToLB)">English</option>
   <option name="malayalam" value="malayalam" onClick="set_language(this.form.ToLB)">Malayalam</option>
</select></td></tr>
           
</form>
         
