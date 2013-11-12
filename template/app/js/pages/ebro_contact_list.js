/* [ ---- Ebro Admin - contact list ---- ] */

    $(function() {
		ebro_contact_list.init();
	})

    ebro_contact_list = {
        init: function() {
            if($('#contact_list').length) {
				
				var $contact_list_header = $('#contact_list').find('h4').addClass('active_sect'),
					$contact_list_filter = $('#contact_list_filter');
				
				//* filters
				$contact_list_header.each(function() {
					var $this = $(this);
					$this.prepend('<i class="icon-angle-up">');
					$contact_list_filter.append('<option value="'+$this.data('contactFilter')+'">'+$this.text()+'</option>')
				})
				
				//* toggle sections
				$contact_list_header.on('click',function() {
					$this = $(this);
					
					if($this.hasClass('active_sect')) {
						$this.removeClass('active_sect').next('ul').stop().slideUp('200');
						$this.children('i').removeClass('icon-angle-up').addClass('icon-angle-down')
					} else {
						$this.addClass('active_sect').next('ul').stop().slideDown('200');
						$this.children('i').addClass('icon-angle-up').removeClass('icon-angle-down')
					}
				});
				
				//* contact list filter
				$contact_list_filter.on('change',function() {
					var this_val = $(this).val();
					
					if (this_val != 'filter_all') {
						var this_filter = $('#contact_list').find('[data-contact-filter='+this_val+']');
						$contact_list_header.each(function() {
							$this = $(this);
							if($this.data('contactFilter') == this_val) {
								$this.removeClass('active_sect').click();	
							} else {
								$this.addClass('active_sect').click();	
							}
						})	
					} else {
						$contact_list_header.each(function() {
							$(this).removeClass('active_sect').click();
						})
					}
				})
				
				ebro_contact_list.filter_list();
            }
        },
		filter_list: function() {
			//* quicksearch
			$('#contact_search').quicksearch('#contact_list li',{
				'delay': 100,
				'noResults': '.contact_list_no_result',
				'bind': 'keyup keydown',
				'hide': function () {
					$(this).hide();
					$('#contact_list > ul > li').removeClass('last_visible').filter(':visible:last').addClass('last_visible');
				},
				'show': function () {
					$(this).show();
					$('#contact_list > ul > li').removeClass('last_visible');
				}
			});
		}
    };