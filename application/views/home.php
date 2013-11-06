


<div class="wrapper">
   <div class="left-nav">
    <div id="side-nav">
      <ul id="nav">
        <li class="current"> <a href="index.html"> <i class="icon-dashboard"></i> Dashboard </a> </li>
        
        
        
        <li> <a href="chart.html"> <i class="icon-bar-chart"></i> Charts &amp; Statistics </a> </li>
        <li> <a href="gallery.html"> <i class="icon-picture"></i> Gallery </a> </li>
        <li> <a href="timeline.html"> <i class="icon-time"></i> Timeline </a> </li>
       
      </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
            
            <!-- /widget-header -->
            
              <div class="shortcuts"> 
                  <?php

?>
                    <?php $i=0; 
       if($row>0){
       foreach ($row as $mid){
     foreach ($mode as $mo_id){
         if($mid->module_id ==$mo_id->guid){
            
             if($i%9==0){  }
             
        ?>
           
                  <a class="shortcut" href="<?php echo base_url()?>index.php/home/home_main/<?php echo $mo_id->module_name?>" ><i class="shortcut-icon icon-bookmark"></i><span class="shortcut-label"><?php echo $this->lang->line($mo_id->module_name) ?></span> </a>
        <?php    $i++;
}} } }?>
                  
              
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
          </div>
        </div>
       
      </div>
     
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-2 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading">Profit</div>
              <div class="stats-body-alt"> 
                <!--i class="fa fa-bar-chart-o"></i-->
                <div class="text-center"><span class="text-top">$</span>345</div>
                 </div>
           
              </a> </div>
            <div class="col-md-2 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading">Revenue</div>
              <div class="stats-body-alt"> 
                <!--i class="fa fa-bar-chart-o"></i-->
                <div class="text-center"><span class="text-top">$</span>34.7k</div>
               </div>
             
              </a> </div>
            <div class="col-md-2 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading">Members</div>
              <div class="stats-body-alt"> 
                <!--i class="fa fa-bar-chart-o"></i-->
                <div class="text-center"><span class="text-top"></span>207</div>
                </div>
              
              </a> </div>
            <div class="col-md-2 col-xs-12 col-sm-6"> <a href="#" class="stats-container">
              <div class="stats-heading">Orders</div>
              <div class="stats-body-alt"> 
                <!--i class="fa fa-bar-chart-o"></i-->
                <div class="text-center"><span class="text-top">$</span>345</div>
                 </div>
              
              </a> </div>
          </div>
        </div>
      </div>
     
    </div>
  </div>
</div>
<div class=" footer "> <p class="center" style="margin-left:400px ">2013 &copy; POSNIC. </p></div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="js/smooth-sliding-menu.js"></script> 

<!--switcher html start-->
