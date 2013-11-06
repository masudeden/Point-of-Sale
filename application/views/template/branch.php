<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); if($_SESSION['Setting']['Branch']==1){
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script>
    function change_branch(){
        var jibi = document.getElementById("branch").value;
        
    
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
        alert('Branch Is Changed')
         setTimeout("location.reload(true);");

        $.get('branch.php', function(ret){
            $('body').php(ret);
        });
        document.getElementById("branch").value=jibi;
        }
</script>
<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a href="index.html"><img src="images/logo.png" width="147" height="33"></a></div>
    <ul class="nav navbar-nav navbar-right  hidden-xs">
        <li class="dropdown user  hidden-xs"><select id="branch">
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
   ?></li>
      
      <li class="dropdown user  hidden-xs"> <a href="user_profile.html"><i class="icon-user"></i> My Profile</a>
      </li>
      <li class="dropdown user  hidden-xs"> <a href="login.html"><i class="icon-key"></i> Log Out</a>
      </li>
    </ul>
    <form class="pull-right" >
      <input type="search" placeholder="Search..." class="search" id="search-input">
    </form>
  </div>
</div>