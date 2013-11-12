/* [ ---- Ebro Admin - landing page ---- ] */

    $(function() {
		ebro_landing_page.init();
	})

    ebro_landing_page = {
		init: function() {
			//* one page nav
			ebro_landing_page.scroll_nav();
			//* contact map
			ebro_landing_page.contact_map();
			//* responsive carousel
			ebro_landing_page.slides();
			//* sortable portfolio
			ebro_landing_page.portfolio();
			
			// set theme from cookie
			if($.cookie('ebro_color') != undefined) {
				$('#theme').attr('href','css/theme/'+$.cookie('ebro_color')+'.css');
			}
			
		},
		scroll_nav: function() {
			$("section:last").css("min-height", $(window).height()-60);
			
			$('#landing_nav').onePageNav({
				currentClass: 'p_active',
				changeHash: false,
				scrollSpeed: 750,
				scrollOffset: ($(window).width() < 768) ? -2 : 59,
				filter: '',
				scrollThreshold: 0.1,
				begin: function() {
					//I get fired when the animation is starting
				},
				end: function() {
					//I get fired when the animation is ending
				},
				scrollChange: function($currentListItem) {
					//I get fired when you enter a section and I pass the list item of the section
				}
			});
			
		},
		slides: function() {
			$("#ebro_slider").owlCarousel({
				navigation : true, // Show next and prev buttons
				navigationText: ["<span class=\"glyphicon glyphicon-chevron-left\"></span>","<span class=\"glyphicon glyphicon-chevron-right\"></span>"],
				slideSpeed : 300,
				paginationSpeed : 400,
				singleItem:true
			});
		},
		portfolio: function() {
			if($('#portfolio_grid').length) { 
				
				var $this_portolio = $('#portfolio_grid');
				
				function portfolio_zoom() {
					$this_portolio.find('.mix:visible .gal_lightbox').magnificPopup({ 
						type: 'image',
						gallery: {
							enabled: true,
							arrowMarkup: '<i title="%title%" class="icon-chevron-%dir% mfp-nav"></i>'
						},
						image: {
							cursor: null,
							titleSrc: function(item) {
								return item.el.find('.mix_description_title').text() + '<br/><small>'+ item.el.find('.mix_description_tags').text() +'</small>';
							}
						},
						callbacks: {
							beforeOpen: function() {
							},
							beforeClose: function() {
							}
						},
						retina: {
							ratio: 2 // can also be function that should retun this number
						}
						
					});
				}
				
				//* galery grid
				$this_portolio.mixitup({
					layoutMode: 'grid', // Start in list mode (display: block) by default
					effects: ['fade','blur'], // List of effects
					onMixEnd: function() {
						portfolio_zoom();
					}
				});
				
				//* portolio lightbox
				portfolio_zoom();
				
			}
		},
		contact_map: function() {
			if($('#gmap_contact').length) {
				map_markers = new GMaps({
					el: '#gmap_contact',
					lat: 41.664160, 
					lng: -0.905607,
					panControl: false,
					//zoomControl: false,
					mapTypeControl: false,
					scaleControl: false,
					streetViewControl: false,
					overviewMapControl: false
				});
				map_markers.addMarker({
					lat: 41.664160,
					lng: -0.905607,
					title: 'Ebro Admin HQ',
					details: {
						// You can attach additional information, which will be passed to Event object (e) in the events previously defined.
					},
					click: function(e){
					},
					mouseover: function(e){
					}
				});
				
			}
		}
	}