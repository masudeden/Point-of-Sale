/* [ ---- Ebro Admin - contact page ---- ] */

    $(function() {
		ebro_contact_page.init();
	})

    ebro_contact_page = {
		init: function() {
			if($('#gmap_contact_page').length) {
				map_markers = new GMaps({
					el: '#gmap_contact_page',
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