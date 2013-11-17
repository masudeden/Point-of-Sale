<!doctype html>
<html lang="en">
	
<!-- Mirrored from ebro-admin.tzdthemes.com/datatables.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 12 Nov 2013 05:36:07 GMT -->
<head>
		<meta charset="UTF-8">
		<title>Ebro Admin Template v1.2</title>
		
		<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		
	<!-- bootstrap framework-->
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/bootstrap/css/bootstrap.min.css">
	<!-- todc-bootstrap -->
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/todc-bootstrap.min.css">
	<!-- font awesome -->        
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/font-awesome/css/font-awesome.min.css">
	<!-- flag icon set -->        
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/img/flags/flags.css">
	<!-- retina ready -->
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/retina.css">
	<!-- bootstrap switch -->
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/stylesheets/bootstrap-switch.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/stylesheets/ebro_bootstrapSwitch.css">	
	
	<!-- aditional stylesheets -->
        <!-- datatbles -->
			<link  rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.css">
			<link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/extras/TableTools/media/css/TableTools.css">

	<!-- ebro styles -->
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/style.css">
	<!-- ebro theme -->
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/theme/color_1.css" id="theme">
		  <link rel="stylesheet" href="<?php echo base_url() ?>template/app/validate/css/wizard.css">
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo base_url() ?>template/app/css/ie.css">
		<script src="<?php echo base_url() ?>template/app/js/ie/html5shiv.js"></script>
		<script src="<?php echo base_url() ?>template/app/js/ie/respond.min.js"></script>
		<script src="<?php echo base_url() ?>template/app/js/ie/excanvas.min.js"></script>
	<![endif]-->

	<!-- custom fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
		 <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>template/data_table/css/bootstrap.min.css">
        <link  rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>template/app/js/lib/dataTables/extras/TableTools/media/css/TableTools.css">     

        <script src="<?php echo base_url() ?>template/app/js/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.min.js" type="text/javascript"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo base_url() ?>template/data_table/js/jquery.dataTables.js"></script>
			<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
           $('#dt_table_tools').dataTable({
                                      "bProcessing": true,
				      "bServerSide": true,
                                      "sAjaxSource": "<?php echo base_url() ?>index.php/users/users_data_table",
                                       aoColumns: [  
                                    
         { "bVisible": false} , {	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<input type=checkbox >";
								},
								
								
							},
        
        null, null, null, null, null, 

 							{	"sName": "ID",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							if(oObj.aData[8]==0){
                                                                            return "<p>Active</p>";
                                                                        }else{
                                                                            return "<p>Deactive</p>";
                                                                        }
								},
								
								
							},
 							{	"sName": "ID1",
                   						"bSearchable": false,
                   						"bSortable": false,
                                                                
                   						"fnRender": function (oObj) {
                   							return "<a href='edit/" + oObj.aData[0] + "'><i class='icon-edit'></i></a><a href='edit/" + oObj.aData[0] + "'><i class=' icon-remove-circle'></i> </a>";
								},
								
								
							},

 							

 						]
		}
						
						
                                    
                                    );
			} );
                        console.log();
		</script>
                <script type="text/javascript" charset="utf-8" language="javascript" src="<?php echo base_url() ?>template/data_table/js/DT_bootstrap.js"></script>
	
	</head>
	<body class=" sidebar_hidden side_fixed">
		<div id="wrapper_all">
			<header id="top_header">
				<div class="container">
					<div class="row">
						<div class="col-xs-6 col-sm-2">
							<a href="dashboard1.html" class="logo_main" title="Ebro Admin Template:"><img src="img/logo_main.png" alt=""></a>
						</div>
						<div class="col-sm-push-4 col-sm-3 text-right hidden-xs">
							<div class="notification_dropdown dropdown">
								<a href="#" class="notification_icon dropdown-toggle" data-toggle="dropdown">
									<span class="label label-danger">8</span>
									<i class="icon-comment-alt icon-2x"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<div class="dropdown_heading">Comments</div>
										<div class="dropdown_content">
											<ul class="dropdown_items">
												<li>
													<h3><span class="small_info">12:43</span><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet&hellip;</p>
												</li>
												<li>
													<h3><span class="small_info">Today</span><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet&hellip;</p>
												</li>
												<li>
													<h3><span class="small_info">14 Aug</span><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet&hellip;</p>
												</li>
											</ul>
										</div>
										<div class="dropdown_footer"><a href="#" class="btn btn-sm btn-default">Show all</a></div>
									</li>
								</ul>
							</div>
							<div class="notification_separator"></div>
							<div class="notification_dropdown dropdown">
								<a href="#" class="notification_icon dropdown-toggle" data-toggle="dropdown">
									<span class="label label-danger">12</span>
									<i class="icon-envelope-alt icon-2x"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-wide">
									<li>
										<div class="dropdown_heading">Messages</div>
										<div class="dropdown_content">
											<ul class="dropdown_items">
												<li>
													<h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
													<p class="large_info">Sean Walter, 24.05.2014</p>
													<i class="icon-exclamation-sign indicator"></i>
												</li>
												<li>
													<h3><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aliquam assumenda&hellip;</p>
													<p class="large_info">Sean Walter, 24.05.2014</p>
												</li>
												<li>
													<h3><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet, consectetur&hellip;</p>
													<p class="large_info">Sean Walter, 24.05.2014</p>
													<i class="icon-exclamation-sign indicator"></i>
												</li>
											</ul>
										</div>
										<div class="dropdown_footer">
											<a href="#" class="btn btn-sm btn-default">Show all</a>
											<div class="pull-right dropdown_actions">
												<a href="#"><i class="icon-refresh"></i></a>
												<a href="#"><i class="icon-cog"></i></a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-6 col-sm-push-4 col-sm-3">
							<div class="pull-right dropdown">
								<a href="#" class="user_info dropdown-toggle" title="Jonathan Hay" data-toggle="dropdown">
									<img src="img/user_avatar.png" alt="">
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="user_profile.html">Profile</a></li>
									<li><a href="javascript:void(0)">Another action</a></li>
									<li><a href="login_page.html">Log Out</a></li>
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
			<nav id="top_navigation">
				<div class="container">
					<ul id="icon_nav_h" class="top_ico_nav clearfix">
						<li>
							<a href="#">
								<i class="icon-home icon-2x"></i>
								<span class="menu_label">Home</span>
							</a>
						</li>
						<li>             
							<a href="#">
								<i class="icon-edit icon-2x"></i>
								<span class="menu_label">Content</span>
							</a>
						</li>
						<li>             
							<a href="#">
								<i class="icon-group icon-2x"></i>
								<span class="menu_label">Users</span>
							</a>
						</li>
						<li>             
							<a href="#">
								<span class="label label-danger">12</span>
								<i class="icon-tasks icon-2x"></i>
								<span class="menu_label">Tasks</span>
							</a>
						</li>
						<li>             
							<a href="#">
								<i class="icon-beaker icon-2x"></i>
								<span class="menu_label">Plugins</span>
							</a>
						</li>
						<li class="active">             
							<a href="#">
								<i class="icon-book icon-2x"></i>
								<span class="menu_label">Help</span>
							</a>
						</li>
						<li>             
							<a href="#">
								<span class="label label-success">$2 347</span>
								<i class="icon-tags icon-2x"></i>
								<span class="menu_label">E-Commerce</span>
							</a>
						</li>
						<li>             
							<a href="#">
								<i class="icon-wrench icon-2x"></i>
								<span class="menu_label">Settings</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- mobile navigation -->
			<nav id="mobile_navigation"></nav>
			
			<section id="breadcrumbs">
				<div class="container">
					<ul>
						<li><a href="#">Ebro Admin</a></li>
						<li><a href="#">Components</a></li>
						<li><span>Datatables</span></li>						
					</ul>
				</div>
			</section>
			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->
						
					
								<div class="widget-content form-container">
											<form id="wizard-demo-2" class="form-horizontal" data-forward-only="false">
												<fieldset class="wizard-step">
													<legend class="wizard-label"><i class="icon-book"></i> Account</legend>
													<div class="control-group">
														<label class="control-label">Username <span class="required">*</span></label>
														<div class="controls">
															<input type="text" name="wizard[username]" class="required span12">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Email <span class="required">*</span></label>
														<div class="controls">
															<input type="text" name="wizard[email]" class="required email span12" />
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Password <span class="required">*</span></label>
														<div class="controls">
															<input type="password" name="wizard[password]" class="required span12">
														</div>
													</div>
												</fieldset>
												<fieldset class="wizard-step">
													<legend class="wizard-label"><i class="icon-user"></i> Member</legend>
													<div class="control-group">
														<label class="control-label">Fullname <span class="required">*</span></label>
														<div class="controls">
															<input type="text" name="wizard[fullname]" class="required span12">
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Address <span class="required">*</span></label>
														<div class="controls">
															<textarea name="wizard[address]" class="required span12"></textarea>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Gender <span class="required">*</span></label>
														<div class="controls">
															<label class="radio"><input type="radio" name="wizard[gender]" class="required"> Male</label>
															<label class="radio"><input type="radio" name="wizard[gender]" class="required"> Female</label>
															<label for="wizard[gender]" class="error" generated="true" style="display:none"></label>
														</div>
													</div>
												</fieldset>
												<fieldset class="wizard-step">
													<legend class="wizard-label"><i class="icon-pencil"></i> Membership</legend>
													<div class="control-group">
														<label class="control-label">Membership Period <span class="required">*</span></label>
														<div class="controls">
															<select name="wizard[period]" class="required">
																<option>1 Month</option>
																<option>3 Months</option>
																<option>6 Months</option>
																<option>1 Year</option>
															</select>
														</div>
													</div>
													<div class="control-group">
														<label class="control-label">Package <span class="required">*</span></label>
														<div class="controls">
															<label class="radio"><input type="radio" name="wizard[package]" class="required"> Basic</label>
															<label class="radio"><input type="radio" name="wizard[package]" /> Full</label>
															<label class="radio"><input type="radio" name="wizard[package]" /> Premium</label>
															<label for="wizard[package]" class="error" generated="true" style="display:none"></label>
														</div>
													</div>
												</fieldset>
												<fieldset class="wizard-step">
													<legend class="wizard-label"><i class="icon-ok"></i> Confirmation</legend>
													<div class="control-group">
														<label class="control-label">Payment Method <span class="required">*</span></label>
														<div class="controls">
															<select name="wizard[payment]" class="required">
																<option>PayPal</option>
																<option>Visa</option>
																<option>Mastercard</option>
																<option>Wire Transfer</option>
															</select>
														</div>
													</div>
													<div class="control-group">
														<div class="controls">
															<label class="checkbox"><input type="checkbox" name="wizard[tos]" class="required"> I agree to the terms of service <span class="required">*</span></label>
															<label for="wizard[tos]" class="error" generated="true" style="display:none"></label>
														</div>
													</div>
												</fieldset>
											</form>
										</div>
					</div>
				</div>
			</section>
			<div id="footer_space"></div>
		</div>
	
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        &copy; 2013 Your Company
                    </div>
                    <div class="col-sm-8">
                        <ul>
                            <li><a href="#">Dashboard</a></li>
                            <li>&middot;</li>
                            <li><a href="#">Terms of Service</a></li>
                            <li>&middot;</li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li>&middot;</li>
                            <li><a href="#">Contact us</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-1 text-right">
                        <small class="text-muted">v1.2</small>
                    </div>
                </div>
            </div>
        </footer>
        	
		<nav id="side_fixed_nav">
			<div class="slim_scroll">
				<div class="side_nav_actions">
					<a href="javascript:void(0)" id="side_fixed_nav_toggle"><span class="icon-align-justify"></span></a>
					<div id="toogle_nav_visible" class="make-switch switch-mini" data-on="success" data-on-label="<i class='icon-lock'></i>" data-off-label="<i class='icon-unlock-alt'></i>">
						<input id="nav_visible_input" type="checkbox">
					</div>
				</div>
				<ul id="text_nav_side_fixed">
					<li>
						<a href="javascript:void(0)"><span class="icon-dashboard"></span>Dashboard</a>
						<ul>
							<li><a href="dashboard1.html">Dashboard 1</a></li>
							<li><a href="dashboard2.html">Dashboard 2</a></li>
							<li><a href="dashboard3.html">Dashboard 3</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0)"><span class="icon-th-list"></span>Forms</a>
						<ul>
							<li><a href="form_regular_elements.html">Regular elements</a></li>
							<li><a href="form_extended_elements.html">Extended elements</a></li>
							<li><a href="form_multiupload.html">Multiupload</a></li>
							<li><a href="form_validation.html">Form validation</a></li>
							<li><a href="wizard.html">Wizard</a></li>
							<li><a href="wysiwg.html">WYSIWG Editor</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0)"><span class="icon-puzzle-piece"></span>Components</a>
						<ul>
							<li><a href="calendar.html">Calendar</a></li>
							<li><a href="charts.html">Charts</a></li>
							<li><a href="contact_list.html">Contact List</a></li>
							<li><a href="file_manager.html">File manager</a></li>
							<li><a href="gallery.html">Gallery</a></li>
							<li><a href="gmaps.html">Google Maps</a></li>
							<li>
								<a href="javascript:void(0)">Tables</a>
								<ul>
									<li class="link_active"><a href="datatables.html">Datatables</a></li>
									<li><a href="regular_tables.html">Regular</a></li>
									<li><a href="slick_grid.html">Slick Grid</a></li>
									<li><a href="table_responsive.html">Responsive Table</a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0)"><span class="icon-beaker"></span>UI Elements</a>
						<ul>
							<li><a href="alerts_buttons.html">Alerts, Buttons</a></li>
							<li><a href="grid.html">Grid</a></li>
							<li><a href="icons.html">Icons</a></li>
							<li><a href="notifications.html">Notifications</a></li>
							<li><a href="panels.html">Panels</a></li>
							<li><a href="tabs_accordions.html">Tabs, Accordions</a></li>
							<li><a href="tooltips_popovers.html">Tooltips, Popovers</a></li>
							<li><a href="typography.html">Typography</a></li>
						</ul>
					</li>
					<li>
						<a href="javascript:void(0)"><span class="icon-leaf"></span>Other Pages</a>
						<ul>
							<li><a href="blank.html">Blank page</a></li>
							<li><a href="chat.html">Chat</a></li>
							<li><a href="contact_page.html">Contact Page</a></li>
							<li><a href="error_404.html">Error 404</a></li>
							<li><a href="help_faq.html">Help/Faq</a></li>
							<li><a href="invoices.html">Invoices</a></li>
							<li><a href="landing_page.html">Landing Page</a></li>
							<li><a href="login_page.html">Login Page</a></li>
							<li><a href="mailbox.html">Mailbox</a></li>
							<li><a href="user_profile.html">User profile</a></li>
							<li><a href="search_page.html">Search Page</a></li>
							<li><a href="settings.html">Site Settings</a></li>
						</ul>
					</li>				
				</ul>
			</div>
		</nav>
                    <script src="<?php echo base_url() ?>template/app/validate/js/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url() ?>template/app/validate/js/bootstrap.min"></script>
        <script src="<?php echo base_url() ?>template/app/validate/js/jquery.validate.min.js"></script>
	
	<script src="<?php echo base_url() ?>template/app/validate/js/wizard.min.js"></script>
    <script src="<?php echo base_url() ?>template/app/validate/js/form_wizard.js"></script>

	<!--[[ common plugins ]]-->
	
	<!-- jQuery -->
		<script src="<?php echo base_url() ?>template/app/js/jquery.min.js"></script>
	<!-- bootstrap framework -->
		<script src="<?php echo base_url() ?>template/app/bootstrap/js/bootstrap.min.js"></script>
	<!-- jQuery resize event -->
		<script src="<?php echo base_url() ?>template/app/js/jquery.ba-resize.min.js"></script>
	<!-- jquery cookie -->
		<script src="<?php echo base_url() ?>template/app/js/jquery_cookie.min.js"></script>
	<!-- retina ready -->
		<script src="<?php echo base_url() ?>template/app/js/retina.min.js"></script>
	<!-- typeahead -->
		<script src="<?php echo base_url() ?>template/app/js/lib/typeahead.js/typeahead.min.js"></script>
		<script src="<?php echo base_url() ?>template/app/js/lib/typeahead.js/hogan-2.0.0.js"></script>

	<!-- tinyNav -->
		<script src="<?php echo base_url() ?>template/app/js/tinynav.js"></script>
	<!-- slimscroll -->
		<script src="<?php echo base_url() ?>template/app/js/lib/jQuery-slimScroll/jquery.slimscroll.min.js"></script>
	
	<!-- bootstrap switch -->
		<script src="<?php echo base_url() ?>template/app/js/lib/bootstrap-switch/js/bootstrap-switch.min.js"></script>
		
	<!-- Navgoco -->
		<script src="<?php echo base_url() ?>template/app/js/lib/navgoco/jquery.navgoco.min.js"></script>
		
	<!-- ebro common scripts/functions -->
		<script src="<?php echo base_url() ?>template/app/js/ebro_common.js"></script>
	
	
	<!--[[ page specific plugins ]]-->
		<!-- datatables -->
			<script src="<?php echo base_url() ?>template/app/js/lib/dataTables/media/js/jquery.dataTables.min.js"></script>
	
			<script src="<?php echo base_url() ?>template/app/js/lib/dataTables/media/DT_bootstrap.js"></script>
			
			<script src="<?php echo base_url() ?>template/app/js/pages/ebro_datatables.js"></script>


	<!--[if lte IE 9]>
		<script src="js/ie/jquery.placeholder.js"></script>
		<script>
			$(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
    <!-- style switcher -->
		<div id="style_switcher" class="switcher_open">
            <a href="#" class="switcher_toggle"><i class="icon-cog"></i></a>
			<div class="style_items">
				<p class="style_title">Theme</p>
				<ul class="clearfix" id="theme_switch">
					<li class="style_active" style="background:#48ac2e" title="color_1">Color 1</li>
					<li style="background:#993399" title="color_2">Color 2</li>
					<li style="background:#168cbe" title="color_3">Color 3</li>
					<li style="background:#d61110" title="color_4">Color 4</li>
					<li style="background:#e96710" title="color_5">Color 5</li>
					<li style="background:#262626" title="color_6">Color 6</li>
					<li style="background:#01aaad" title="color_7">Color 7</li>
					<li style="background:#9c5100" title="color_8">Color 8</li>
					<li style="background:#e31a8f" title="color_9">Color 9</li>
					<li style="background:#ffbb0e" title="color_10">Color 10</li>
					<li style="background:#79be0b" title="color_11">Color 11</li>
					<li style="background:#887171" title="color_12">Color 12</li>
					<li style="background:#28abe2" title="color_13">Color 13</li>
					<li style="background:#2f7138" title="color_14">Color 14</li>
					<li style="background:#ce4627" title="color_15">Color 15</li>
					<li style="background:#693986" title="color_16">Color 16</li>
					<li style="background:#7f8c8d" title="color_17">Color 17</li>
					<li style="background:#2c3e50" title="color_18">Color 18</li>
					<li style="background:#34495e" title="color_19">Color 19</li>
					<li style="background:#1abc9c" title="color_20">Color 20</li>
				</ul>
			</div>
			<div class="style_items" id="sidebar_switch">
				<p class="style_title">Sidebar position</p>
				<label class="radio-inline">
					<input type="radio" name="sidebar_position" id="sidebar_left" value="left" checked> Left
				</label>
				<label class="radio-inline">
					<input type="radio" name="sidebar_position" id="sidebar_right" value="right"> Right
				</label>
			</div>
			<div class="style_items" id="layout_switch">
				<p class="style_title">Layout</p>
				<select name="layout_style" id="layout_style" class="form-control">
					<option value="fixed">Fixed</option>
					<option value="full_width" class="hidden-sm hidden-md">Full Width</option>
					<option value="boxed" class="hidden-sm hidden-md">Boxed</option>
				</select>
			</div>
			<div class="style_items" id="style_pattern">
				<p class="style_title">Pattern (boxed layout)</p>
				<ul class="clearfix">
					<li class="pattern_active" style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_1.png) no-repeat 0 0" title="pattern_1">Pattern 1</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_2.png) no-repeat 0 0" title="pattern_2">Pattern 2</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_3.png) no-repeat 0 0" title="pattern_3">Pattern 3</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_4.png) no-repeat 0 0" title="pattern_4">Pattern 4</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_5.png) no-repeat 0 0" title="pattern_5">Pattern 5</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_6.png) no-repeat 0 0" title="pattern_6">Pattern 6</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_7.png) no-repeat 0 0" title="pattern_7">Pattern 7</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_8.png) no-repeat 0 0" title="pattern_8">Pattern 8</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_9.png) no-repeat 0 0" title="pattern_9">Pattern 9</li>
					<li style="background:url(<?php echo base_url() ?>template/app/img/patterns/pattern_10.png) no-repeat 0 0" title="pattern_10">Pattern 10</li>
				</ul>
			</div>
			<div class="text-center">
				<button class="btn btn-default" id="style_reset">Reset</button>
			</div>
        </div>
	
	</body>

<!-- Mirrored from ebro-admin.tzdthemes.com/datatables.html by HTTrack Website Copier/3.x [XR&CO'2013], Tue, 12 Nov 2013 05:36:16 GMT -->
</html>