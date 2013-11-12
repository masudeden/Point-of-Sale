/* [ ---- Ebro Admin - mailbox ---- ] */

	$(function() {
		ebro_mailbox.init();
	})
	
	ebro_mailbox = {
		init: function() {
			if($('#mailbox_table').length) {
				
				var $mailbox_table = $('#mailbox_table')
				
				function countAll() {
					return $mailbox_table.find('tbody tr').length
				}
				
				$mailbox_table.find('.mbox_star span').on('click', function(){
					$(this).toggleClass('icon-star icon-star-empty');
				});
				
				$('input[name=msg_sel]').on('click',function() {
					if($(this).is(':checked')) {
						$(this).closest('tr').addClass('active')
					} else {
						$(this).closest('tr').removeClass('active')
					}
				});
				
				$mailbox_table.on('click', '.mbox_select_all', function () {
					var $this = $(this);
					
					$mailbox_table.find('input[name=msg_sel]').filter(':visible').each(function() {
						if($this.is(':checked')) {
							$(this).prop('checked',true).closest('tr').addClass('active')
						} else {
							$(this).prop('checked',false).closest('tr').removeClass('active')
						}
					})
					
				})
								
				$mailbox_table.on('mouseenter', '.mbox_star', function(){
					$(this).children('span').addClass('star_hover');
				}).on('mouseleave', '.mbox_star', function(){
					$(this).children('span').removeClass('star_hover');
				});
				
				$mailbox_table.on({
					'footable_paging': function(e) {
						var allRows = countAll(),
							page_size = e.size,
							act_page = e.page,
							pages = Math.ceil(allRows / page_size);
							first_visble = (page_size * act_page)+1;
						
						if(pages == act_page+1) {
							var last_visible = allRows;
						} else {
							var last_visible = (page_size * act_page) + page_size;
						};
						
						$('.page_start_row').text(first_visble);
						$('.page_end_row').text(last_visible);
					},
					'footable_initialized': function(e) {
						$('.all_rows').text(countAll());
						
					}
				}).footable({
					breakpoints: {
						phone: 640,
						tablet: 778
					}
				});
				
				$mailbox_table.on('click','tr.rowlink td:not(.nolink)',function(){
					$('.mbox_table_actions').hide();
					$('.mailbox_content').slideUp('normal',function() {
						$('#mbox_preview').slideDown('normal');
					});
				});
				
			}
		}
	}