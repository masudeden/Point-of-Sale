	<script src="<?php echo base_url() ?>template/login/js/minif92b.php?files=libs/jquery-1.6.3.min,old-browsers,common,standard,jquery.tip.js"></script>
	<!--[if lte IE 8]><script src="<?php echo base_url() ?>template/login/js/standard.ie.js"></script><![endif]-->
	
	<!-- example login script -->
	<script>
	
		$(document).ready(function()
		{
			// We'll catch form submission to do it in AJAX, but this works also with JS disabled
			$('#login_form').submit(function(event)
			{
				// Stop full page load
				event.preventDefault();
				
				// Check fields
				var login = $('#login').val();
				var pass = $('#pass').val();
				
				if (!login || login.length == 0)
				{
					$('#login-block').removeBlockMessages().blockMessage('Please enter your user name', {type: 'warning'});
				}
				else if (!pass || pass.length == 0)
				{
					$('#login-block').removeBlockMessages().blockMessage('Please enter your password', {type: 'warning'});
				}
				else
				{
					var submitBt = $(this).find('button[type=submit]');
					submitBt.disableBt();
					
					// Target url
					var target = $(this).attr('action');
					if (!target || target == '')
					{
						// Page url without hash
						target = document.location.href.match(/^([^#]+)/)[1];
					}
					
					// Request
					var data = {
						
						username: login,
						password: pass,
                                                login:'login'
						
					};
					var redirect = $('#redirect');
					if (redirect.length > 0)
					{
						data.redirect = redirect.val();
					}
					
					// Start timer
					var sendTimer = new Date().getTime();
					
					// Send
					$.ajax({
						url: '<?php echo base_url() ?>index.php/userlogin/login',
						data:data,
						type: 'POST',
						success: function(response,textStatus, XMLHttpRequest)
						{
                                                 
                             if(response==1){
                               window.location.assign("<?php echo base_url()?>index.php/posmain/set_user_default_branch")
                             }else {
							    $('#login-block').removeBlockMessages().blockMessage(response, {type: 'error'});  
                           		submitBt.enableBt();
							 }
						},
						error: function(XMLHttpRequest, textStatus, errorThrown)
						{
							console.log();// Message
							$('#login-block').removeBlockMessages().blockMessage('Error while contacting server, please try again', {type: 'error'});
							
							submitBt.enableBt();
						}
					});
					
					// Message
					$('#login-block').removeBlockMessages().blockMessage('Please wait, cheking login...', {type: 'loading'});
				}
			});
		});
	
	</script>
	
	<script>
	
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-10643639-3']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	
	</script>
</body>


</html>      
    
  