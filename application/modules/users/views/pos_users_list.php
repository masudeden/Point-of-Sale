<!DOCTYPE html>
<html>

<!-- Mirrored from www.riaxe.com/envato/thin-admin/ios7/dynamic_table.html by HTTrack Website Copier/3.x [XR&CO'2013], Wed, 06 Nov 2013 08:45:05 GMT -->
<head>
<title>Thin Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/data_table/css/bootstrap.min.css.css">
<link href="<?php echo base_url() ?>template/home/css/bootstrap.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url() ?>template/home/css/thin-admin.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url() ?>template/home/css/font-awesome.css" rel="stylesheet" media="screen">
<link href="<?php echo base_url() ?>template/home/style/style.css" rel="stylesheet">
<link href="<?php echo base_url() ?>template/home/style/dashboard.css" rel="stylesheet">

<link href="<?php echo base_url() ?>template/home/css/demo_page.css" rel="stylesheet">
<link href="<?php echo base_url() ?>template/home/css/demo_table.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="<?php echo base_url() ?>template/home//assets/js/html5shiv.js"></script>
      <script src="<?php echo base_url() ?>template/home//assets/js/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/data_table/css/bootstrap.min.css">
               

        <script src="<?php echo base_url() ?>template/data_table/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.js"></script>
			<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
           $('#example1').dataTable({
                                      "bProcessing": true,
									  "bServerSide": true,
                                      "sAjaxSource": "http://localhost/dashboard/data.php",
					aoColumns: [  null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                   						"fnRender": function (oObj) {
                   							return "<a href='EditData.php?id=" + oObj.aData[0] + "'><i class='icon-edit'></i> </a><a href='EditData.php?id=" + oObj.aData[0] + "'><i class=' icon-remove-circle'></i> </a>";
								},
								
								
							}

 						]
						
						
                                    }
                                    );
			} );
                        console.log();
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>
</head>
<body>
<div class="container">
  <div class="top-navbar header b-b"> <a data-original-title="Toggle navigation" class="toggle-side-nav pull-left" href="#"><i class="icon-reorder"></i> </a>
    <div class="brand pull-left"> <a href="index.html"><img src="images/logo.png" width="147" height="33"></a></div>
    <ul class="nav navbar-nav navbar-right  hidden-xs">
      <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-warning-sign"></i> <span class="badge">5</span> </a>
        <ul class="dropdown-menu extended notification">
          <li class="title">
            <p>You have 5 new notifications</p>
          </li>
          <li> <a href="#"> <span class="label label-success"><i class="icon-plus"></i></span> <span class="message">New user registration.</span> <span class="time">1 mins</span> </a> </li>
          <li> <a href="#"> <span class="label label-danger"><i class="icon-warning-sign"></i></span> <span class="message">High CPU load on cluster #2.</span> <span class="time">5 mins</span> </a> </li>
          <li> <a href="#"> <span class="label label-success"><i class="icon-plus"></i></span> <span class="message">New user registration.</span> <span class="time">10 mins</span> </a> </li>
          <li> <a href="#"> <span class="label label-info"><i class="icon-bullhorn"></i></span> <span class="message">New items are in queue.</span> <span class="time">25 mins</span> </a> </li>
          <li> <a href="#"> <span class="label label-warning"><i class="icon-bolt"></i></span> <span class="message">Disk space to 85% full.</span> <span class="time">35 mins</span> </a> </li>
          <li class="footer"> <a href="#">View all notifications</a> </li>
        </ul>
      </li>
      <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-tasks"></i> <span class="badge">7</span> </a>
        <ul class="dropdown-menu extended notification">
          <li class="title">
            <p>You have 7 pending tasks</p>
          </li>
          <li> <a href="#"> <span class="task"> <span class="desc">Preparing new release</span> <span class="percent">30%</span> </span>
            <div class="progress progress-small">
              <div class="progress-bar progress-bar-info" style="width: 30%;"></div>
            </div>
            </a> </li>
          <li> <a href="#"> <span class="task"> <span class="desc">Change management</span> <span class="percent">80%</span> </span>
            <div class="progress progress-small progress-striped active">
              <div class="progress-bar progress-bar-danger" style="width: 80%;"></div>
            </div>
            </a> </li>
          <li> <a href="#"> <span class="task"> <span class="desc">Mobile development</span> <span class="percent">60%</span> </span>
            <div class="progress progress-small">
              <div class="progress-bar progress-bar-success" style="width: 60%;"></div>
            </div>
            </a> </li>
          <li> <a href="#"> <span class="task"> <span class="desc">Database migration</span> <span class="percent">20%</span> </span>
            <div class="progress progress-small">
              <div class="progress-bar progress-bar-warning" style="width: 20%;"></div>
            </div>
            </a> </li>
          <li class="footer"> <a href="#">View all tasks</a> </li>
        </ul>
      </li>
      <li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-envelope"></i> <span class="badge">1</span> </a>
        <ul class="dropdown-menu extended notification">
          <li class="title">
            <p>You have 3 new messages</p>
          </li>
          <li> <a href="#"> <span class="photo"> <img src="images/profile.png" width="34" height="34"></span> <span class="subject"> <span class="from">John Doe</span> <span class="time">Just Now</span> </span> <span class="text"> Consetetur sadipscing elitr... </span> </a> </li>
          <li> <a href="#"> <span class="photo"><img src="images/profile.png" width="34" height="34"></span> <span class="subject"> <span class="from">John Doe</span> <span class="time">35 mins</span> </span> <span class="text"> Sed diam nonumy... </span> </a> </li>
          <li> <a href="#"> <span class="photo"><img src="images/profile.png" width="34" height="34"></span> <span class="subject"> <span class="from">John Doe</span> <span class="time">5 hours</span> </span> <span class="text"> No sea takimata sanctus... </span> </a> </li>
          <li class="footer"> <a href="#">View all messages</a> </li>
        </ul>
      </li>
      <li class="dropdown user  hidden-xs"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-male"></i> <span class="username">John Doe</span> <i class="icon-caret-down small"></i> </a>
        <ul class="dropdown-menu">
          <li><a href="user_profile.html"><i class="icon-user"></i> My Profile</a></li>
          <li><a href="fullCalendar.html"><i class="icon-calendar"></i> My Calendar</a></li>
          <li><a href="#"><i class="icon-tasks"></i> My Tasks</a></li>
          <li class="divider"></li>
          <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
        </ul>
      </li>
    </ul>
    <form class="pull-right" >
      <input type="search" placeholder="Search..." class="search" id="search-input">
    </form>
  </div>
</div>
<div class="wrapper">
  <div class="left-nav">
    <div id="side-nav">
      <ul id="nav">
        <li> <a href="index.html"> <i class="icon-2x icon-remove-circle"></i> Dashboard </a> </li>
       
       
        <li class="current"> <a href="#"> <i class="icon-user"></i> Users </a> 
        
        </li>        
      
      </ul>
    </div>
  </div>
  <div class="page-content">
    <div class="content container">
      
      <div class="row">
        <div class="col-lg-12">
          <div class="widget">
           
              <div class="widget-content" style="background: linear-gradient( #05639B,#153450) repeat scroll 0 0 rgba(0, 0, 0, 0);">
         
<div class="example_alt_pagination">
      <div id="container">
        <div class="full_width big"></div>
  <div id="demo">
      <div id="dynamic">
    <table cellpadding="0" cellspacing="0" border="0" class="display  table-striped " id="example1">
      <thead>
        <tr>
          <th>Rendering engine</th>
          <th >Browser</th>
          <th >Platform(s)</th>
          <th>Engine version</th>
          <th>Action</th>
          </tr>
        </thead>
        <tbody style="background: linear-gradient(#05639B, #153450) repeat scroll 0 0 rgba(0, 0, 0, 0);">
        
        
       
        </tbody>
      <tfoot>
        <tr>
          <th> </th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          </tr>
        </tfoot>
  </table></div>
    </div>
        
        
      
        </div>
    </div>
    
    
            </div>
          </div>
        </div>
      </div>
      
      
      
      
      
    </div>
  </div>
</div>
<div class="bottom-nav footer"> 2013 &copy; Thin Admin by Riaxe Systems. </div>



              
 </body>


</html>

