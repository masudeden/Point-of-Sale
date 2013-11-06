
	
	<section id="login-block">
		<div class="block-border"><div class="block-content">
			
			<!--
			IE7 compatibility: if you want to remove the <h1>,
			add style="zoom:1" to the above .block-content div
			-->
			<h1>POSNIC1.03</h1>
			<div class="block-header"><?php echo $this->lang->line('please_login') ?></div>
			<?php $form=array('name'=>'login_form',
                            'id'=>'login_form',
                            'class'=>'form with_margin');
                        echo form_open('#',$form);?>
			
				<input type="hidden" name="a" id="a" value="send">
				<p class="inline-small-label">
                                    
					<label for="login"><span class="big"><?php echo $this->lang->line('user_name') ?></span></label>
					<input type="text" name="username" id="login" class="full-width" value="">
				</p>
				<p class="inline-small-label">
					<label for="pass"><span class="big"><?php echo $this->lang->line('password') ?></span></label>
					<input type="password" name="password" id="pass" class="full-width" value="">
				</p>
                                
			
				<button type="submit" name="login" class="float-right"><?php echo  $this->lang->line('login') ?></button>
				<p class="input-height">
					<input type="checkbox" name="keep-logged" id="keep-logged" value="1" class="mini-switch" checked="checked">
					<label for="keep-logged" class="inline">Keep me logged in</label>
				</p>
			</form>
			
			<form class="form" id="password-recovery" method="post" action="#">
				<fieldset class="grey-bg no-margin collapse">
					<legend><a href="javascript:void(0)">Lost password?</a></legend>
					<p class="input-with-button">
						<label for="recovery-mail">Enter your e-mail address</label>
						<input type="text" name="recovery-mail" id="recovery-mail" value="">
						<button type="button">Send</button>
					</p>
				</fieldset>
			</form>
		</div></div>
	</section>