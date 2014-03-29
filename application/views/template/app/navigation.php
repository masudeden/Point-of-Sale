<nav id="side_fixed_nav">
			<div class="slim_scroll">
				<div class="side_nav_actions">
					<a href="javascript:void(0)" id="side_fixed_nav_toggle"><span class="icon-align-justify"></span></a>
					<div id="toogle_nav_visible" class="make-switch switch-mini" data-on="success" data-on-label="<i class='icon-lock'></i>" data-off-label="<i class='icon-unlock-alt'></i>">
						<input id="nav_visible_input" type="checkbox">
					</div>
				</div>
				<ul id="text_nav_side_fixed">
                                    <li <?php if($active==='home'){ ?> class="link_active" <?php }?> ><a href="<?php echo base_url()?>index.php/home/"><span class="icon-dashboard"></span>Dashboard</a></li>
                                             <?php  
                                      if($row>0){
                                      foreach ($cate as $m_cate){ ?>
                                    <li >
						
						<?php if($m_cate->no!=1) {?>
                                        <a href="javascript:void(0)"><span class="icon-dashboard"></span><?php echo $this->lang->line($m_cate->Category_name) ?></a>
                                                <ul>
                                                <?php                                          
                                                   foreach ($row as $mode){
                                                   if($m_cate->guid==$mode->cate_id){?>
							<li <?php if($active===$mode->module_name){ ?> class="link_active" <?php }?> ><a href="<?php echo base_url()?><?php echo $mode->module_name?>"><?php echo $this->lang->line($mode->module_name) ?></a></li>							
                                                        <?php } } ?>
						</ul>
                                                <?php }else{
                                                    ?>
                                        <a href="<?php echo base_url()?>index.php<?php echo $mode->module_name?>"><span class="icon-dashboard"></span><?php echo $this->lang->line($m_cate->Category_name) ?></a>
                                                        <?php
                                                } ?>
					</li>
                                        <?php } }?>
								
				</ul>
			</div>
</nav>