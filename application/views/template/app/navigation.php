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