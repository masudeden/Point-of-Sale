<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); if($_SESSION['Setting']['Branch']==1){
?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<script>
    function change_branch(){
        var posnic = document.getElementById("branch").value;
        
    
     var xmlhttp;
        if (window.XMLHttpRequest)
        {
        xmlhttp=new XMLHttpRequest();
        }
        else
        {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
       
        xmlhttp.open("GET","<?php echo base_url() ?>index.php/posmain/change_user_branch/"+posnic,false);
        xmlhttp.send();
        alert('Branch Is Changed')
         setTimeout("location.reload(true);");

        $.get('branch.php', function(ret){
            $('body').php(ret);
        });
        document.getElementById("branch").value=jibi;
        }
</script>

<div id="wrapper_all">
			<header id="top_header">
				<div class="container">
					<div class="row">
						<div class="col-xs-6 col-sm-2">
		
						</div>
                                            <div class="col-sm-push-4 col-sm-3 text-right hidden-xs" style="margin-top:5px ">
												            <?php 
echo form_open('home/change_branch') ; ?>
                                                    <select id="branch" class="select form-control">
<?php
if($_SESSION['admin']==2){
    foreach ($row as $brow){ ?>
        <option onclick="change_branch()" value="<?php echo $brow->guid ?>" ><?php echo $brow->store_name  ?></option>
   <?php }
}else{
?>

<?php foreach ($row as $brow){ 
    
    ?><option onclick="change_branch()" value="<?php echo $brow->guid ?>" ><?php echo $brow->store_name ?></option>
    
   <?php }} ?>
</select>
    <?php echo form_close(); 
}
   ?>
						</div>
						<div class="col-xs-6 col-sm-push-4 col-sm-3">
							<div class="pull-right dropdown">
								<a href="#" class="user_info dropdown-toggle" title="Jonathan Hay" data-toggle="dropdown">
									<img src="img/user_avatar.png" alt="">
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="user_profile.html">Profile</a></li>									
                                                                        <li><a href="<?php echo base_url() ?>index.php/home/logout">Log Out</a></li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-pull-6 col-sm-4">
							<form class="main_search">
								<input type="text" id="search_query" name="search_query" class="typeahead form-control">
								<button type="submit" class="btn btn-primary btn-xs"><i class="icon-search icon-white"></i></button>
							</form> 
						</div>
					</div>
				</div>
			</header>
