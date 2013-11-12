/* [ ---- Ebro Admin - wysiwg editor  ---- ] */

    $(function() {
		ebro_wysiwg.init();
	})
	
	ebro_wysiwg = {
		init: function() {
			if($('#wysiwg_editor').length) { 
				CKEDITOR.replace( 'wysiwg_editor',
					CKEDITOR.tools.extend (
					{
						height: 200,
						extraPlugins: 'autogrow',
						autoGrow_maxHeight: 400
					})
				);
			}
			if($('#wysiwg_simple').length) {
				var basicConfig = {
					height:200,
					plugins: 'basicstyles,clipboard,list,indent,enterkey,entities,link,pastetext,toolbar,undo,wysiwygarea,smiley,autogrow',
					forcePasteAsPlainText : true,
					removeButtons: 'Anchor,Strike,Subscript,Superscript',
					toolbarGroups: [
						{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
						{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
						{ name: 'forms' },
						{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
						{ name: 'paragraph',   groups: [ 'list', 'blocks', 'align' ] },
						{ name: 'insert' },
						{ name: 'tools' },
					]
				};

				CKEDITOR.replace( 'wysiwg_simple' ,
					CKEDITOR.tools.extend( basicConfig )
				);
			}
		}
	}