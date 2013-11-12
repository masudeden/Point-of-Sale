/* [ ---- Ebro Admin - multiupload ---- ] */

	$(function() {
		//* multiupload
		ebro_multiupload.init();
	});
	
	//* multiupload
	ebro_multiupload = {
		init: function() {
			if($('#fileupload').length) {
				// Initialize the jQuery File Upload widget:
				$('#fileupload').fileupload({
					// Uncomment the following to send cross-domain cookies:
					//xhrFields: {withCredentials: true},
					// Uncomment the following to upload files using php (https://github.com/blueimp/jQuery-File-Upload/wiki)
					//url: 'js/lib/jQuery-File-Upload/server/php/',
					maxNumberOfFiles: 5
				});
			}
		}
	}