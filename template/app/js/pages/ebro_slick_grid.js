/* [ ---- Ebro Admin - slick grid ---- ] */

    $(function() {
		ebro_slick_grid.init();
	})
	
	ebro_slick_grid = {
		init: function() {
			if($('#sg_large').length) { 
				/* slick grid functions */
				function requiredFieldValidator(value) {
					if (value == null || value == undefined || !value.length) {
					  return {valid: false, msg: "This is a required field"};
					}
					else {
					  return {valid: true, msg: null};
					}
				}
				
				function myFilter(item, args) {
					if (item["percentComplete"] < args.percentCompleteThreshold) {
						return false;
					}
					if (args.searchString != "" && item["title"].indexOf(args.searchString) == -1) {
						return false;
					}
					return true;
				}
				
				function percentCompleteSort(a, b) {
					return a["percentComplete"] - b["percentComplete"];
				}
				
				function comparer(a, b) {
					var x = a[sortcol], y = b[sortcol];
					return (x == y ? 0 : (x > y ? 1 : -1));
				}
				
				/* slick grid variables */
				var dataView;
				var grid;
				var data = [];
				var columns = [
					{id: "sel", name: "#", field: "num", behavior: "select", cssClass: "cell-selection", minWidth: 60, cannotTriggerInsert: true, resizable: false, selectable: false },
					{id: "title", name: "Title", field: "title", minWidth: 100, cssClass: "cell-title", editor: Slick.Editors.Text, validator: requiredFieldValidator, sortable: true},
					{id: "desc", name: "Description", field: "description", minWidth: 260, editor: Slick.Editors.LongText},
					{id: "duration", name: "Duration", field: "duration", minWidth: 80, cssClass: "text-center", editor: Slick.Editors.Text, sortable: true},
					{id: "%", defaultSortAsc: false, name: "% Complete", field: "percentComplete", width: 120, resizable: false, formatter: Slick.Formatters.PercentCompleteBar, editor: Slick.Editors.PercentComplete, sortable: true},
					{id: "start", name: "Start", field: "start", minWidth: 100, cssClass: "text-center", editor: Slick.Editors.Date, sortable: true},
					{id: "finish", name: "Finish", field: "finish", minWidth: 100, cssClass: "text-center", editor: Slick.Editors.Date, sortable: true},
					{id: "effort-driven", name: "Effort Driven", minWidth: 100, cssClass: "text-center cell-effort-driven", field: "effortDriven", formatter: Slick.Formatters.Checkmark, editor: Slick.Editors.Checkbox, cannotTriggerInsert: true, sortable: true}
				];
				
				/* slick grid options */
				var options = {
					editable: true,
					enableAddRow: false,
					enableCellNavigation: true,
					asyncEditorLoading: true,
					forceFitColumns: true,
					topPanelHeight: 30,
					rowHeight: 38,
				};
				
				var sortcol = "title";
				var sortdir = 1;
				var percentCompleteThreshold = 0;
				var searchString = "";
				
				$(function () {
					// prepare the data
					for (var i = 0; i < 100000; i++) {
						var d = (data[i] = {});
						d["id"] = "id_" + i;
						d["num"] = i;
						d["title"] = "Task " + i;
						d["description"] = "This is a sample task description.\n  It can be multiline";
						d["duration"] = Math.floor((Math.random()*6)+2) + " days";
						d["percentComplete"] = Math.round(Math.random() * 100);
						d["start"] = "11/09/2013";
						d["finish"] = "15/09/2013";
						d["effortDriven"] = (i % 5 == 0);
					}
				
					dataView = new Slick.Data.DataView({ inlineFilters: true });
					grid = new Slick.Grid("#sg_large", dataView, columns, options);
					grid.setSelectionModel(new Slick.RowSelectionModel());
				  
					var pager = new Slick.Controls.Pager(dataView, grid, $("#pager"));
					var columnpicker = new Slick.Controls.ColumnPicker(columns, grid, options);
				
					grid.onCellChange.subscribe(function (e, args) {
						dataView.updateItem(args.item.id, args.item);
					});
				
					grid.onAddNewRow.subscribe(function (e, args) {
						var item = {"num": data.length, "id": "new_" + (Math.round(Math.random() * 10000)), "title": "New task", "duration": "1 day", "percentComplete": 0, "start": "11/09/2013", "finish": "01/09/2013", "effortDriven": false};
						$.extend(item, args.item);
						dataView.addItem(item);
					});
				
					grid.onKeyDown.subscribe(function (e) {
						// select all rows on ctrl-a
						if (e.which != 65 || !e.ctrlKey) {
						  return false;
						}
					
						var rows = [];
						for (var i = 0; i < dataView.getLength(); i++) {
						  rows.push(i);
						}
					
						grid.setSelectedRows(rows);
						e.preventDefault();
					});
				
					grid.onSort.subscribe(function (e, args) {
						sortdir = args.sortAsc ? 1 : -1;
						sortcol = args.sortCol.field;
					
						if ($.browser.msie && $.browser.version <= 8) {
						  // using temporary Object.prototype.toString override
						  // more limited and does lexicographic sort only by default, but can be much faster
					
							var percentCompleteValueFn = function () {
								var val = this["percentComplete"];
								if (val < 10) {
									return "00" + val;
								} else if (val < 100) {
									return "0" + val;
								} else {
									return val;
								}
							};
					
							// use numeric sort of % and lexicographic for everything else
							dataView.fastSort((sortcol == "percentComplete") ? percentCompleteValueFn : sortcol, args.sortAsc);
						} else {
							// using native sort with comparer
							// preferred method but can be very slow in IE with huge datasets
							dataView.sort(comparer, args.sortAsc);
						}
					});
				
					// wire up model events to drive the grid
					dataView.onRowCountChanged.subscribe(function (e, args) {
						grid.updateRowCount();
						grid.render();
					});
				  
					dataView.onRowsChanged.subscribe(function (e, args) {
						grid.invalidateRows(args.rows);
						grid.render();
					});
				  
					dataView.onPagingInfoChanged.subscribe(function (e, pagingInfo) {
						var isLastPage = pagingInfo.pageNum == pagingInfo.totalPages - 1;
						var enableAddRow = isLastPage || pagingInfo.pageSize == 0;
						var options = grid.getOptions();
					
						if (options.enableAddRow != enableAddRow) {
						  grid.setOptions({enableAddRow: enableAddRow});
						}
					});
				
					var h_runfilters = null;
					
					// percentage slider
					$("#pcSlider").ionRangeSlider({
						type: "single",
						step: 1,
						postfix: " %",
						from: 0,
						min: 0,
						max:100,
						hasGrid: false,
						onChange: function(obj){
							Slick.GlobalEditorLock.cancelCurrentEdit();
							var thisVal = obj.fromNumber;
							if (percentCompleteThreshold != thisVal) {
								window.clearTimeout(h_runfilters);
								h_runfilters = window.setTimeout(updateFilter, 10);
								percentCompleteThreshold = thisVal;
							}
						}
					});
				
					// wire up the search textbox to apply the filter to the model
					$("#txtSearch").keyup(function (e) {
						Slick.GlobalEditorLock.cancelCurrentEdit();
					
						// clear on Esc
						if (e.which == 27) {
							this.value = "";
						}
					
						searchString = this.value;
						updateFilter();
					});
				
					function updateFilter() {
						dataView.setFilterArgs({
							percentCompleteThreshold: percentCompleteThreshold,
							searchString: searchString
						});
						dataView.refresh();
					}
				
					// initialize the model after all the events have been hooked up
					dataView.beginUpdate();
					dataView.setItems(data);
					dataView.setFilterArgs({
						percentCompleteThreshold: percentCompleteThreshold,
						searchString: searchString
					});
					dataView.setFilter(myFilter);
					dataView.endUpdate();
				
					// if you don't want the items that are not visible (due to being filtered out
					// or being on a different page) to stay selected, pass 'false' to the second arg
					dataView.syncGridSelection(grid, true);
				
					$("#gridContainer").resizable();
					
					var cols = grid.getColumns();
					grid.setColumns(cols);
					
				})
				
			}
		}
	}