/* [ ---- Ebro Admin - datatables ---- ] */

    $(function() {
		ebro_datatables.basic();
		ebro_datatables.fixed_col();
		ebro_datatables.colReorder_visibility();
		ebro_datatables.scroll();
		ebro_datatables.table_tools();
		
		//* add placeholder to search input
        $('.dataTables_filter input').each(function() {
            $(this).attr("placeholder", "Search...");
        })
	})
	
	ebro_datatables = {
		//* basic example
        basic: function() {
            if($('#dt_basic').length) {
                $('#dt_basic').dataTable({
                    "sPaginationType": "bootstrap_full"
                });
            }
        },
        //* fixed columns
        fixed_col: function() {
            if($('#dt_fixed_col').length) {
                var oTable = $('#dt_fixed_col').dataTable( {
					"sScrollX": "100%",
					"sScrollXInner": "150%",
					"bScrollCollapse": true
				} );
				new FixedColumns( oTable, {
					"iLeftColumns": 2,
					"iLeftWidth": 200
				} );
            }
        },
        //* column reorder & toggle visibility
        colReorder_visibility: function() {
            if($('#dt_colVis_Reorder').length) {
                $('#dt_colVis_Reorder').dataTable({
                    "sPaginationType": "bootstrap",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-default btn-sm').html('Columns');
                    }
                });
            }
        },
        //* horizontal scroll
        scroll: function() {
            if($('#dt_scroll').length) {
                $('#dt_scroll').dataTable({
                "sScrollX": "100%",
                "sScrollXInner": '150%',
                "sPaginationType": "bootstrap",
                "bScrollCollapse": true 
            });
            }
        },
        //* column reorder & toggle visibility
        table_tools: function() {
            if($('#dt_table_tools').length) {
                $('#dt_table_tools').dataTable({
					"sDom": "<'dt-top-row'Tlf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "oTableTools": {
                        "aButtons": [
                            "copy",
                            "print",
                            {
                                "sExtends":    "collection",
                                "sButtonText": 'Save <span class="caret" />',
                                "aButtons":    [ "csv", "xls", "pdf" ]
                            }
                        ],
                        "sSwfPath": "js/lib/dataTables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
                    },
                    "fnInitComplete": function(oSettings, json) {
                        $(this).closest('#dt_table_tools_wrapper').find('.DTTT.btn-group').addClass('table_tools_group').children('a.btn').each(function(){
                            $(this).addClass('btn-sm btn-default');
                        });
                    }
                });
            }
		}
	}