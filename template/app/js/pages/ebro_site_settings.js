/* [ ---- Ebro Admin - site settings ---- ] */

    $(function() {
		$('#s_lang_visitors,#s_lang_redirect').select2({
			placeholder: "Select...",
			tags:["English", "Chinese", "Dutch", "French", "German", "Hungarian", "Italian", "Lithuanian", "Russian", "Spanish", "Swedish", "Ukrainian"],
			tokenSeparators: [",", " "]
		});
	})