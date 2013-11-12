/* [ ---- Ebro Admin - gallery ---- ] */

    $(function() {
		ebro_gallery.init();
	})
	
	ebro_gallery = {
		init: function() {
			if($('#gallery_grid').length) { 
				var $this_gallery = $('#gallery_grid');
				
				//* galery grid
				$this_gallery.mixitup({
					layoutMode: 'grid', // Start in list mode (display: block) by default
					listClass: 'list', // Container class for when in list mode
					gridClass: 'grid', // Container class for when in grid mode
					effects: ['fade','blur'], // List of effects
					onMixEnd: function() {
						ebro_gallery.light_Box();
					}
				});
				
				//* layout change
				$('#gal_toList').on('click',function(){
					$('.gal_lay_change').removeClass('lay_active');
					$(this).addClass('lay_active');
					$this_gallery.mixitup('toList');
				});

				$('#gal_toGrid').on('click',function(){
					$('.gal_lay_change').removeClass('lay_active');
					$(this).addClass('lay_active');
					$this_gallery.mixitup('toGrid');
				});
				
				ebro_gallery.filters($this_gallery);
				$('#gal_filter_a,#gal_filter_b').multipleSelect('checkAll');
				
			}
		},
		filters: function() {
			var $this_gallery = $('#gallery_grid');
			
			//* filters
			function filterSelected() {
				var filter_a = false,
					filter_b = false;
				
				if($('#gal_filter_a').multipleSelect('getSelects') != '') {
					var filter_a = true,
						filter_a_val = $('#gal_filter_a').multipleSelect('getSelects').join(' ');
				}
				if($('#gal_filter_b').multipleSelect('getSelects') != '') {
					var filter_b = true,
						filter_b_val = $('#gal_filter_b').multipleSelect('getSelects').join(' ');
				}
				
				if(filter_a && filter_b) {
					$this_gallery.mixitup('filter', [filter_a_val,filter_b_val])
				} else if(filter_a){
					$this_gallery.mixitup('filter', filter_a_val)
				} else if(filter_b){
					$this_gallery.mixitup('filter', filter_b_val)
				} else {
					$this_gallery.mixitup('filter', '')
				}
				
			}
				
			$('#gal_filter_a').multipleSelect({
				placeholder: "Filter by User",
				filter: true,
				onClick: function(view) {
					filterSelected();
				},
				onCheckAll: function() {
					filterSelected();
				},
				onUncheckAll: function() {
					filterSelected();
				}
			});
			
			$('#gal_filter_b').multipleSelect({
				placeholder: "Filter by Category",
				onClick: function(view) {
					filterSelected();
				},
				onCheckAll: function() {
					filterSelected();
				},
				onUncheckAll: function() {
					filterSelected();
				}
			});

		},
        light_Box: function() { 
            $('#gallery_grid .mix:visible .gal_lightbox').magnificPopup({ 
                type: 'image',
                gallery: {
                    enabled: true,
                    arrowMarkup: '<i title="%title%" class="icon-chevron-%dir% mfp-nav"></i>'
                },
                image: {
                    cursor: null
                },
				callbacks: {
					beforeOpen: function() {
						$('body').addClass('modal-open');
					},
					beforeClose: function() {
						$('body').removeClass('modal-open');
					}
				},
				retina: {
					ratio: 2 // can also be function that should retun this number
				}
            });
        }
	}