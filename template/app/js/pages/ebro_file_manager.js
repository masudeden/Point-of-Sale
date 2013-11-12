/* [ ---- Ebro Admin - file manager ---- ] */

    $(function() {
		ebro_file_manager.init();
	})
	
	ebro_file_manager = {
		init: function() {
			if($('#elfinder').length) { 
				$('#elfinder').elfinder({
					url : 'file_manager/php/connector.minimal.php',  // connector URL (REQUIRED)
					// , lang: 'ru'                    				// language (OPTIONAL)
					uiOptions : {
						// toolbar configuration
						toolbar : [
							['back', 'forward'],
							//['netmount'],
							// ['reload'],
							// ['home', 'up'],
							//['mkdir', 'mkfile', 'upload'],
							['open', 'download', 'getfile'],
							['info'],
							['quicklook'],
							//['copy', 'cut', 'paste'],
							//['rm'],
							//['duplicate', 'rename', 'edit', 'resize'],
							//['extract', 'archive'],
							['search'],
							['view', 'sort'],
							['help']
						]
					},
					contextmenu : {
						// navbarfolder menu
						navbar : ['open', '|', 'info'],
						// current directory menu
						cwd    : ['reload', 'back', '|', 'sort', '|', 'info'],
						// current directory file menu
						files  : ['open', 'quicklook', '|', 'download', '|', 'info']
					},
					allowShortcuts : false,
					dragUploadAllow: false
				});
			}
		}
	}