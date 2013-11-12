/* [ ---- Ebro Admin - icons ---- ] */

    $(function() {
		$('.icon_code').each(function() {
			$(this).val('').next('.icon_addon').html('');
		});
		$('.icon_code').each(function() {
		});
		$('.icon_list li').on('click',function(e) {
			e.preventDefault();
			var $this = $(this);
			var $code = $this.children('span').length ? $(this).children('span').attr('class'):$(this).children('i').attr('class');
			$(this).closest('.panel').find('.icon_code').val('<span class="'+$code+'"></span>')
			$(this).closest('.panel').find('.icon_addon').html('<span class="'+$code+'"></span>')
		});
	})
