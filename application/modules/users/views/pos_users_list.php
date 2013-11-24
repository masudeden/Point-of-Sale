<style type="text/css">
    .my_select{
         -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #FFFFFF;
    border-color: #C0C0C0 #D9D9D9 #D9D9D9;
    border-image: none;
    border-radius: 1px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-style: solid;
    border-width: 1px;
    box-shadow: none;
    font-size: 13px;
  
    line-height: 1.4;
    padding:1px 1px 1px 3px;
    transition: none 0s ease 0s;
    }
 
</style>	

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
						<?php echo form_open('users/posnic_users') ?>
						<!-- main content -->
                                                <div class="row">
							<div class="col-sm-12">
                                                            <button class="btn btn-success" type="submit" name="add_new" value="add_new"><?php echo $this->lang->line('addnew') ?></button>
                                                            
                                                         </div>
                                                    <div class="col-sm-12"><br>
								<div class="panel panel-default">
                                                                    
									<div class="panel-heading">
										<h4 class="panel-title">Users</h4>
                                                                                
									</div>
                                                                        <table id="dt_table_tools" class="table-striped table-condensed" style="width: 100%"><thead>
                                                                        <tr>
                                                                          <th>Id</th>
                                                                          <th >Select</th>
                                                                          <th >User Id</th>
                                                                          <th>First Name</th>
                                                                          <th>Last Name</th>
                                                                          <th>Phone </th>
                                                                          <th>Email</th>
                                                                          <th>Status</th>
                                                                          <th>Action</th>
                                                                          </tr>
                                                                        </thead>
                                                                        <tbody >



                                                                        </tbody>

                                                                  </table>
                                                                   
                                                                                                                </div>
      
                                                            </div>
                                                    </div>
					</div>
				</div>
                           
        
			</section>
                        
			<div id="footer_space"></div>
		</div>
	
        
        	
      