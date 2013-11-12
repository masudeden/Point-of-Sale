/* [ ---- Ebro Admin - dashboard 3 ---- ] */

	$(function() {
		//* video embed
		ebro_video.init();
		//* photo carousel
		ebro_carousel.init();
	});
	
	//* video embed
	ebro_video = {
		init: function() {
			if ($('.fit_vid').length) {
				$(".fit_vid").fitVids();
			}
		}
	}
	
	//* photo carousel
	ebro_carousel = {
		init: function() {
			if ($('.photo-carousel').length) {
				
				$(".photo-carousel").owlCarousel({
					navigation : true,
					navigationText: ["<span class=\"glyphicon glyphicon-chevron-left\"></span>","<span class=\"glyphicon glyphicon-chevron-right\"></span>"],
					items : 4,
					itemsDesktop : [1199,3],
					itemsDesktopSmall : [979,3]
				});
				 
				$(".photo-carousel").find('.gal_lightbox').magnificPopup({ 
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
						},
						beforeClose: function() {
						}
					},
					retina: {
						ratio: 2
					}
					
				});
			}
		}
	}