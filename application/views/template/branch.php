<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); if($_SESSION['Setting']['Branch']==1){
?>
<script>
    function change_branch(){
        var jibi = document.getElementById("branch").value;
        alert('Branch Is Changed')
    
     var xmlhttp;
        if (window.XMLHttpRequest)
        {
        xmlhttp=new XMLHttpRequest();
        }
        else
        {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
       
        xmlhttp.open("GET","<?php echo base_url() ?>index.php/posmain/change_user_branch/"+jibi,false);
        xmlhttp.send();
        }
</script>
<select id="branch">
<?php 
echo form_open('home/change_branch') ; 
if($_SESSION['admin']==2){
    foreach ($row as $brow){ ?>
        <option onclick="change_branch()" value="<?php echo $brow->id ?>" ><?php echo $brow->store_name  ?></option>
   <?php }
}else{
?>

<?php foreach ($row as $brow){ 
     for($i=0;$i<count($a_row);$i++){
         if($a_row[$i]==$brow->branch_id){
    ?><option onclick="change_branch()" value="<?php echo $brow->branch_id ?>" ><?php echo $brow->branch_name ?></option>
    
   <?php }}}} ?>
</select>
    <?php echo form_close(); 
}
   ?>