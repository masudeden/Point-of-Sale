/* [ ---- Ebro Admin - google maps ---- ] */

    $(function() {
		ebro_gmaps.m_basic();
        ebro_gmaps.m_geocoding();
        ebro_gmaps.m_markers();
        ebro_gmaps.m_static();
	})
	
	ebro_gmaps = {
		m_basic: function() {
			if($('#gmap_basic').length) {
				map_basic = new GMaps({
					el: '#gmap_basic',
					lat: 40.705628,
					lng: -73.985138,
					zoom: 10,
					zoomControl : true,
					zoomControlOpt: {
						style : 'SMALL',
						position: 'TOP_LEFT'
					},
					panControl : false,
					streetViewControl : false,
					mapTypeControl: false,
					overviewMapControl: false
				});
			}
		},
		m_geocoding: function() {
			if($('#gmap_geocoding').length) {
				map_geocode = new GMaps({
					el: '#gmap_geocoding',
					lat: 55.478853,
					lng: 15.117188,
					zoom: 3
				});
				$('#geocoding_form').submit(function(e){
					e.preventDefault();
					GMaps.geocode({
						address: $('#gmaps_address').val().trim(),
						callback: function(results, status){
							if(status=='OK'){
								var latlng = results[0].geometry.location;
								map_geocode.setCenter(latlng.lat(), latlng.lng());
								map_geocode.addMarker({
									lat: latlng.lat(),
									lng: latlng.lng()
								});
								map_geocode.map.setZoom(15);
								$('#gmaps_address').val('');
							}
						}
					});
				});
			}
		},
		m_markers: function() {
			if($('#gmap_markers').length) {
				map_markers = new GMaps({
					el: '#gmap_markers',
					lat: 51.500902,
					lng: -0.124531
				});
				map_markers.addMarker({
					lat: 51.497714,
					lng: -0.12991,
					title: 'Westminster',
					details: {
						// You can attach additional information, which will be passed to Event object (e) in the events previously defined.
					},
					click: function(e){
						alert('You clicked in this marker');
					},
					mouseover: function(e){
						if(console.log) console.log(e);
					}
				});
				map_markers.addMarker({
					lat: 51.500891,
					lng: -0.123347,
					title: 'Westminster Bridge',
					infoWindow: {
						content: '<div class="infoWindow_content"><p>Westminster Bridge is a road and foot traffic bridge over the River Thames...</p><a href="http://en.wikipedia.org/wiki/Westminster_Bridge" target="_blank">wikipedia</a></div>'
					}
				});
			}
		},
		m_static: function() {
			if($('#gmap_static').length) {
				if(window.devicePixelRatio >= 2) {
					var img_scale = '&scale=2'
						background_size = 'background-size: 640px 640px;';
					
				} else {
					var img_scale = '',
					background_size = '';
				}
				url = GMaps.staticMapURL({
					size: [640, 640],
					lat: -37.824972,
					lng: 144.958735,
					zoom: 10
				});
				$('#gmap_static').append('<span class="gmap-static" style="height:100%;display:block;background: url('+url+img_scale+') no-repeat 50% 50%;'+background_size+'"><img src="'+url+'" style="visibility:hidden" alt="" /></span>');
			}
		}
	}