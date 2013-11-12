/* [ ---- Ebro Admin - responsive table ---- ] */

    $(function() {
		ebro_responsive_table.init();
	})
	
	ebro_responsive_table = {
		init: function() {
			if($('#resp_table').length) { 
				$('#resp_table').footable().on('footable_filtering', function (e) {
					var selected = $('#un_member').find(':selected').text().toLowerCase();
					var selected = $('#un_member').val();
					if (selected && selected.length > 0) {
						e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
						e.clear = !e.filter;
					}
				});
				
				//* clear all filters
				$('#clear-filter').click(function (e) {
					e.preventDefault();
					$('#un_member').val('');
					$('#resp_table').trigger('footable_clear_filter');
				});
				
				//* apply all filters on select change
				$('#un_member').change(function (e) {
					e.preventDefault();
					$('#resp_table').trigger('footable_filter', {filter: $('#table_search').val()});
				});	
			}
		}
	}