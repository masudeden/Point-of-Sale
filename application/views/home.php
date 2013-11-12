						
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
			
			
			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->
					
           
						
						
						
						

					</div>
				</div>
			</section>
			<div id="footer_space"></div>
		</div>
	
        
        	
		<nav id="side_fixed_nav">
			<div class="slim_scroll">
				<div class="side_nav_actions">
					<a href="javascript:void(0)" id="side_fixed_nav_toggle"><span class="icon-align-justify"></span></a>
					<div id="toogle_nav_visible" class="make-switch switch-mini" data-on="success" data-on-label="<i class='icon-lock'></i>" data-off-label="<i class='icon-unlock-alt'></i>">
						<input id="nav_visible_input" type="checkbox">
					</div>
				</div>
				<ul id="text_nav_side_fixed">
                                    <li class="link_active"><a href="javascript:void(0)"><span class="icon-dashboard"></span>Dashboard</a></li>
                                             <?php  
                                      if($row>0){
                                      foreach ($cate as $m_cate){ ?>
					<li>
						<a href="javascript:void(0)"><span class="icon-dashboard"></span><?php echo $this->lang->line($m_cate->Category_name) ?></a>
						<?php if(count($row)>0) {?>
                                                <ul>
                                                    <?php                                          
                                                   foreach ($row as $mode){
                                                   if($m_cate->guid==$mode->cate_id){?>
							<li ><a href="<?php echo base_url()?>index.php/home/home_main/<?php echo $mode->module_name?>"><?php echo $this->lang->line($mode->module_name) ?></a></li>							
                                                        <?php } } ?>
						</ul>
                                                <?php } ?>
					</li>
                                        <?php } }?>
								
				</ul>
			</div>
		</nav>
