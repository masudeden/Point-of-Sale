/* [ ---- Ebro Admin - dashboard 2 ---- ] */

	$(function() {
		//* charts
		ebro_charts.overview();
		//* calendar
		ebro_calendar.init();
		//* todo list
		ebro_todo.init();
	});
	
	//* charts
	ebro_charts = {
		overview : function() {
			if($('#flot_overview').length) {
				var chart_placeholder = $('#flot_overview');

				// add 2h to match utc+2
				for (var i = 0; i < data_new_visits.length; ++i) {data_new_visits[i][0] += 60 * 120 * 1000};
			   
				var options = {
					grid: {
						clickable: true, 
						hoverable: true,
						autoHighlight: true,
						backgroundColor: null,
						borderWidth: 0,
						color: "#666",
						labelMargin: 10,
						axisMargin: 0,
						mouseActiveRadius: 10,
						minBorderMargin: 5
					},
					series: {
						lines: {
							show: true,
							lineWidth: 3,
							steps: false,
							fill: true
						},
						points: {
							show:true,
							radius: 4,
							symbol: "circle",
							fill: true
						}
					},
					tooltip: true,
					tooltipOpts: {
						content: "%x - %y",
						shifts: {
							x: 20,
							y: 0
						},
						defaultTheme: false
					},
					xaxis: {
						mode: "time",
						minTickSize: [1, "day"],
						timeformat: "%d/%m",
						labelWidth: "40"
					},
					yaxis: { min: 0 },
					legend: {
						noColumns: 0,
						position: "ne"
					},
					colors: ["#0892cd"],
					shadowSize: 0
				};

				$.plot(chart_placeholder,[{
					label: "New Visits",
					data:data_new_visits,
					points: {fillColor: '#fff'},
					lines: {fillColor: 'rgba(8,146,205,.2)'}
				}],options);
			}
		}
	}
	
	//* todo list
	ebro_todo = {
		init: function() {
			$('.todo-list li').each(function() {
				if($(this).hasClass('completed')) {
					$(this).find('.todo-check').attr('checked',true);
				}
			});
			$('.todo-list').on('click','input.todo-check',function(e){
				if( $(this).is(':checked') ) {
					$(this).closest('li').addClass('completed');
				} else {
					$(this).closest('li').removeClass('completed');
				}
			});
		}
	}
	
	//*  calendar
	ebro_calendar = {
		init: function() {
			if($('#ebro_cal').length) {
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				
				$('#ebro_cal').fullCalendar({
					header: {
						center: 'prev title next',
						left: 'month agendaWeek agendaDay today',
						right: ''
					},
					buttonText: {
						prev: '<i class="icon-chevron-left" />',
						next: '<i class="icon-chevron-right" />'
					},
					editable: true,
					events: [
						{
							title: 'All Day Event',
							start: new Date(y, m, 1)
						},
						{
							title: 'Long Event',
							start: new Date(y, m, d-5),
							end: new Date(y, m, d-2)
						},
						{
							id: 999,
							title: 'Repeating Event',
							start: new Date(y, m, d-3, 16, 0),
							allDay: false
						},
						{
							id: 999,
							title: 'Repeating Event',
							start: new Date(y, m, d+4, 16, 0),
							allDay: false
						},
						{
							title: 'Meeting',
							start: new Date(y, m, d, 10, 30),
							allDay: false
						},
						{
							title: 'Lunch',
							start: new Date(y, m, d, 12, 0),
							end: new Date(y, m, d, 14, 0),
							allDay: false
						},
						{
							title: 'Birthday Party',
							start: new Date(y, m, d+1, 19, 0),
							end: new Date(y, m, d+1, 22, 30),
							allDay: false
						},
						{
							title: 'Click for Google',
							start: new Date(y, m, 28),
							end: new Date(y, m, 29),
							url: 'http://google.com/'
						}
					]
				});
			}
		}	
	}