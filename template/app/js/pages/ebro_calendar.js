/* [ ---- Ebro Admin - calendar ---- ] */

    $(function() {
		ebro_calendar.init();
	})
	
	ebro_calendar = {
		init: function() {
			if($('#calendar_phases').length) {
				$('#calendar_phases').fullCalendar({
					header: {
						center: 'prev title next',
						left: 'month agendaWeek agendaDay today',
						right: ''
					},
					buttonText: {
						prev: '<i class="icon-chevron-left" />',
						next: '<i class="icon-chevron-right" />'
					},
					aspectRatio: 2.2,
					// Phases of the Moon
					events: 'https://www.google.com/calendar/feeds/ht3jlfaac5lfd6263ulfh4tql8%40group.calendar.google.com/public/basic',
					eventClick: function(event) {
						// opens events in a popup window
						window.open(event.url, 'gcalevent', 'width=700,height=600');
						return false;
					},
					loading: function(bool) {
						if (bool) {
							$('#loading').show();
						}else{
							$('#loading').hide();
						}
					}
				})
			}
			if($('#calendar_json').length) {
				$('#calendar_json').fullCalendar({
					header: {
						center: 'prev title next',
						left: 'month agendaWeek agendaDay today',
						right: ''
					},
					buttonText: {
						prev: '<i class="icon-chevron-left" />',
						next: '<i class="icon-chevron-right" />'
					},
					aspectRatio: 2.2,
					editable: true,
					events: "js/lib/fullcalendar/json-events.php",
					eventDrop: function(event, delta) {
						alert(event.title + ' was moved ' + delta + ' days\n' +
							'(should probably update your database)');
					},
					loading: function(bool) {
						if (bool) $('#loading').show();
						else $('#loading').hide();
					}
					
				})
			}
		}
	}