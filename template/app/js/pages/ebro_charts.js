/* [ ---- Ebro Admin - charts ---- ] */

    $(function() {
		ebro_charts.init();
	})
	
	ebro_charts = {
		init: function() {
			if($('#chart_tracking').length) {
				
				var sin = [], cos = [];
				for (var i = 0; i < 14; i += 0.1) {
					sin.push([i, Math.sin(i)]);
					cos.push([i, Math.cos(i)]);
				}
		
				var plot = $.plot("#chart_tracking", [
					{ data: sin, label: "sin(x) = -0.00"},
					{ data: cos, label: "cos(x) = -0.00" }
				], {
					series: {
						lines: {
							show: true
						}
					},
					crosshair: {
						mode: "x"
					},
					grid: {
						hoverable: true,
						autoHighlight: false,
						backgroundColor: null,
						borderWidth: 0
					},
					yaxis: {
						min: -1.2,
						max: 1.2
					},
					colors: ["#7baf42","#0892cd"]
				});
		
				var legends = $("#chart_tracking .legendLabel");
		
				legends.each(function () {
					// fix the widths so they don't jump around
					$(this).css('width', $(this).width()+5);
				});
		
				var updateLegendTimeout = null;
				var latestPosition = null;
		
				function updateLegend() {
					updateLegendTimeout = null;
					var pos = latestPosition;
					var axes = plot.getAxes();
					if (pos.x < axes.xaxis.min || pos.x > axes.xaxis.max ||
						pos.y < axes.yaxis.min || pos.y > axes.yaxis.max) {
						return;
					}
					var i, j, dataset = plot.getData();
					for (i = 0; i < dataset.length; ++i) {
						var series = dataset[i];
						// Find the nearest points, x-wise
						for (j = 0; j < series.data.length; ++j) {
							if (series.data[j][0] > pos.x) {
								break;
							}
						}
						// Now Interpolate
						var y,
							p1 = series.data[j - 1],
							p2 = series.data[j];
						if (p1 == null) {
							y = p2[1];
						} else if (p2 == null) {
							y = p1[1];
						} else {
							y = p1[1] + (p2[1] - p1[1]) * (pos.x - p1[0]) / (p2[0] - p1[0]);
						}
						legends.eq(i).text(series.label.replace(/=.*/, "= " + y.toFixed(2)));
					}
				}
		
				$("#chart_tracking").bind("plothover",  function (event, pos, item) {
					latestPosition = pos;
					if (!updateLegendTimeout) {
						updateLegendTimeout = setTimeout(updateLegend, 50);
					}
				});
			}
			if($('#chart_pie').length) {
				
				function labelFormatter(label, series) {
					return "<div style='font-size:11px;line-height:16px;text-align:center;padding:2px 4px;color:#fff;min-width:40px'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
				}
				
				var data = [
                    {
                        label: "Beef",
                        data: 560
                    },
                    {
                        label: "Vegetarian",
                        data: 360
                    },
                    {
                        label: "Chicken",
                        data: 320
                    },
                    {
                        label: "Pork",
                        data: 280
                    }
                ];
				
				$.plot('#chart_pie', data, {
					series: {
						pie: {
							show: true,
							radius: 3/4,
							label: {
								show: true,
								radius: 0.5,
								formatter: labelFormatter,
								background: {
									opacity: 0.5,
									color: '#000'
								}
							}
						}
					},
					legend: {
						show: false
					},
					colors: ["#7baf42","#0892cd","#efa91f","#f04b51"]
				});
			}
			if($('#chart_bars').length) {
				var data = [
					[10, 10], [20, 20], [30, 30], [40, 40], [50, 50]
				];
				$.plot($("#chart_bars"), [data], {
					series:{
						bars:{
							show: true
						}
					},
					bars:{
						horizontal:true,
						barWidth:5,
						lineWidth: 0,
						align: "center"
					},
					grid:{
						backgroundColor: null,
						borderWidth: 0,
						clickable: true, 
						hoverable: true
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
					colors: ["#efa91f"]
				});
				
			}
			
			if($('#chart_stacked').length) {
				var data24Hours = [
					[0, 601],[1, 520],[2, 337],[3, 261],[4, 157],[5, 78],[6, 58],[7, 48],[8, 54],[9, 38],[10, 88],[11, 214],[12, 364],
					[13, 449],[14, 558],[15, 282],[16, 379],[17, 429],[18, 518],[19, 470],[20, 330],[21, 245],[22, 358],[23, 260]
				];
			 
				var data48Hours = [
					[0, 445],[1, 592],[2, 738],[3, 532],[4, 234],[5, 143],[6, 147],[7, 63],[8, 64],[9, 43],[10, 86],[11, 201],[12, 315],
					[13, 397],[14, 512],[15, 281],[16, 360],[17, 479],[18, 425],[19, 453],[20, 422],[21, 355],[22, 340],[23, 400]
				];
			 
				var ticks = [
					[0, "22h"],[1, ""],[2, "00h"],[3, ""],[4, "02h"],[5, ""],[6, "04h"],[7, ""],[8, "06h"],[9, ""],[10, "08h"],
					[11, ""],[12, "10h"],[13, ""],[14, "12h"],[15, ""],[16, "14h"],[17, ""],[18, "16h"],[19, ""],[20, "18h"],
					[21, ""],[22, "20h"],[23, ""]
				];
				
				var data = [{
					label: "Last 24 Hours",
					data: data24Hours,
					points: {fillColor: '#0892cd'}
				},{
					label: "Last 48 Hours",
					data: data48Hours,
					points: {fillColor: '#efa91f'}
				}];
			 
				$.plot($("#chart_stacked"), data, {
					series: {
						lines: {
							show: true,
							lineWidth: 1,
							steps: false,
							fill: false
						},
						points: {
							show:true,
							radius: 2,
							symbol: "circle",
							fill: true
						}
					},
					xaxis: {
						ticks: ticks
					},
					grid:{
						backgroundColor: null,
						borderWidth: 1,
						borderColor: '#ddd',
						clickable: true, 
						hoverable: true
					},
					legend: {           
						noColumns: 0
					},
					colors: ["#0892cd","#efa91f"],
					tooltip: true,
					tooltipOpts: {
						content: function(xval,yval) {
							if(ticks[xval][1] == '') {
								x_value = ticks[xval-1][1]+':30m'
							} else {
								x_value = ticks[xval][1]
							}
							return x_value+' - '+yval;
						},
						shifts: {
							x: 20,
							y: 0
						},
						defaultTheme: false
					}
				});  
			
			}
			if($('#chart_live').length) {
                var container = $("#chart_live");
                var maximum = container.outerWidth() / 2 || 300;
                var data = [];

                function getRandomData() {
                    if (data.length) {
                        data = data.slice(1);
                    }
                    while (data.length < maximum) {
                        var previous = data.length ? data[data.length - 1] : 50;
                        var y = previous + Math.random() * 10 - 5;
                        data.push(y < 0 ? 0 : y > 100 ? 100 : y);
                    }
                    var res = [];
                    for (var i = 0; i < data.length; ++i) {
                        res.push([i, data[i]])
                    }
                    return res;
                }

                var series = [{
                    data: getRandomData(),
                    lines: {
                        fill: true
                    }
                }];

                var live_plot = $.plot(container, series, {
                    grid: {
                        borderWidth: 1,
                        borderColor: "#eee",
                        minBorderMargin: 20,
                        labelMargin: 10,
                        hoverable: false,
                        margin: {
                            top: 8,
                            bottom: 20,
                            left: 20
                        },
                        markings: function(axes) {
                            var markings = [];
                            var xaxis = axes.xaxis;
                            for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
                                markings.push({ xaxis: { from: x, to: x + xaxis.tickSize }, color: "#f7f7f7" });
                            }
                            return markings;
                        }
                    },
                    yaxis: {
                        min: 0,
                        max: 110
                    },
                    legend: {
                        show: true
                    },
                    colors: ["#86ae00"]
                });
            
                var yaxisLabel = $("<div class='axisLabel yaxisLabel'></div>")
                    .text("Response Time (ms)")
                    .appendTo(container);
            
                yaxisLabel.css("margin-top", yaxisLabel.width() / 2);

                setInterval(function updateRandom() {
                    series[0].data = getRandomData();
                    live_plot.setData(series);
                    live_plot.draw();
                }, 500);
				
            }
		}
	}