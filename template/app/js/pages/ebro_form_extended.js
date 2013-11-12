/* [ ---- Ebro Admin - extended form elements ---- ] */

	$(function() {
		//* 2 col multiselect
		ebro_2col_multiselect.init();
		//* select2
		ebro_select2.init();
		//* chained select
		ebro_chained.init();
		//* masked inputs
		ebro_maskedInputs.init();
		//* password strength meter
		ebro_password_meter.init();
		//* datepicker
		ebro_datepicker.init();
		//* timepicker
		ebro_timepicker.init();
		//* colorpicker
		ebro_colorpicker.init();
		//* icheck checkboxes & radio buttons
		ebro_icheck.init()
		//* switch buttons
		ebro_switchButtons.init();
		//* slider
		ebro_slider.init();
		//* textare autosize
		ebro_autosize_textarea.init();
		//* textare counter
		ebro_textarea_counter.init();
	});
	
	
	//* 2col multiselect
	ebro_2col_multiselect = {
		init: function() {
			if($('#2col_preselected').length) {
				$('#2col_preselected').multiSelect();
			}
			if($('#2col_callbacks').length) {
				$('#2col_callbacks').multiSelect({
					afterSelect: function(values){
						alert("Select value: "+values);
					},
					 afterDeselect: function(values){
						alert("Deselect value: "+values);
					}
				});
			}
			if($('#2col_optgroup').length) {
				$('#2col_optgroup').multiSelect({ selectableOptgroup: true });
			}
			if($('#2col_public_method').length) {
				$('#2col_public_method').multiSelect();
				$('#select-all').click(function(){
					$('#2col_public_method').multiSelect('select_all');
					return false;
				});
				$('#deselect-all').click(function(){
					$('#2col_public_method').multiSelect('deselect_all');
					return false;
				});
				$('#select-20').click(function(){
					$('#2col_public_method').multiSelect('select', ['elem_1','elem_2','elem_3','elem_4','elem_5','elem_6','elem_7','elem_8','elem_9','elem_10','elem_11','elem_12','elem_13','elem_14','elem_15','elem_16','elem_17','elem_18','elem_19','elem_20']);
					return false;
				});
				$('#deselect-20').click(function(){
					$('#2col_public_method').multiSelect('deselect', ['elem_1','elem_2','elem_3','elem_4','elem_5','elem_6','elem_7','elem_8','elem_9','elem_10','elem_11','elem_12','elem_13','elem_14','elem_15','elem_16','elem_17','elem_18','elem_19','elem_20']);
					return false;
				});
			}
			if($('#2col_custom').length) {
				$('#2col_custom').multiSelect({
					selectableHeader: "<div class='custom-header'>Selectable items</div>",
					selectionHeader: "<div class='custom-header'>Selection items</div>",
					selectableFooter: "<div class='custom-footer'>Selectable footer</div>",
					selectionFooter: "<div class='custom-footer'>Selection footer</div>"
				});
			}
			if($('#2col_searchable').length) {
				$('#2col_searchable').multiSelect({
					selectableHeader: '<div class="custom-header-search"><input type="text" class="search-input input-sm form-control" autocomplete="off" placeholder="Selectable..."></div>',
					selectionHeader: '<div class="custom-header-search"><input type="text" class="search-input input-sm form-control" autocomplete="off" placeholder="Selection..."></div>',
					afterInit: function(ms){
						var that = this,
						$selectableSearch = that.$selectableUl.prev('div').children('input'),
						$selectionSearch = that.$selectionUl.prev('div').children('input'),
						selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
						selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';
						
						that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
						.on('keydown', function(e){
							if (e.which === 40){
								that.$selectableUl.focus();
								return false;
							}
						});
						
						that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
						.on('keydown', function(e){
							if (e.which == 40){
								that.$selectionUl.focus();
								return false;
							}
						});
					},
					afterSelect: function(){
						this.qs1.cache();
						this.qs2.cache();
					},
					afterDeselect: function(){
						this.qs1.cache();
						this.qs2.cache();
					}
				});
			}
		}
	}
	
	//* select2
	ebro_select2 = {
		init: function() {
			if($('#s2_basic').length) {
				$('#s2_basic').select2({
					allowClear: true,
					placeholder: "Select..."
				});
			}
			if($('#s2_multi_value').length) {
				$('#s2_multi_value').select2({
					placeholder: "Select..."
				});
			}
			if($('#s2_tokenization').length) {
				$('#s2_tokenization').select2({
					placeholder: "Select...",
					tags:["red", "green", "blue", "black", "orange", "white"],
					tokenSeparators: [",", " "]
				});
			}
			if($('#s2_ext_value').length) {
				
				function format(state) {
					if (!state.id) return state.text;
					return '<i class="flag-' + state.id + '"></i>' + state.text;
				}
				
				$('#s2_ext_value').select2({
					placeholder: "Select Country",
					formatResult: format,
					formatSelection: format,
					escapeMarkup: function(markup) { return markup; }
				}).val("AU").trigger("change");
				
				$("#s2_ext_us").click(function(e) { e.preventDefault(); $("#s2_ext_value").val("US").trigger("change"); });
				$("#s2_ext_br_gb").click(function(e) { e.preventDefault(); $("#s2_ext_value").val(["BR","GB"]).trigger("change"); });
			}
			//* remove default form-controll class
			setTimeout(function() {
				$('.select2-container').each(function() {
					$(this).removeClass('form-control')
				})
			})
		}
	}
	
	//* chained selects
	ebro_chained = {
		init: function() {
			//* local
			if($('#chn_country').length && $('#chn_state').length) {
				$("#chn_state").chained("#chn_country");  
			}
			if($('#chn_city').length && $('#chn_state').length) {
				$("#chn_city").chained("#chn_state");
				//* show button only if city is selected
				$("#chain_btn").hide();
				$("#chn_city").on("change", function(event) {
					if ("" != $("option:selected", this).val() && "" != $("option:selected", $("#chn_state")).val()) {
						$("#chain_btn").fadeIn();
					} else {
						$("#chain_btn").hide();          
					}
				});
			}
			//* remote
			if($('#chn_year').length && $('#chn_month').length) {
				$("#chn_month").remoteChained("#chn_year","js/lib/chained/years.php");  
			}
			if($('#chn_day').length && $('#chn_month').length) {
				$("#chn_day").remoteChained("#chn_month","js/lib/chained/years.php");
				//* show button only if day is selected
				$("#chain_remote_btn").hide();
				$("#chn_day").on("change", function(event) {
					if ("" != $("option:selected", this).val() && "" != $("option:selected", $("#chn_month")).val()) {
						$("#chain_remote_btn").fadeIn();
					} else {
						$("#chain_remote_btn").hide();          
					}
				});
			}
				/* For jquery.chained.remote.js */    
				$("#series-remote").remoteChained("#mark-remote", "js/lib/chained/json.php");
				$("#model-remote").remoteChained("#series-remote", "js/lib/chained/json.php");
				
		}
	}
	
	//* masked inputs
	ebro_maskedInputs = {
		init: function() {
			$("#mask_date").inputmask("dd/mm/yyyy",{ "placeholder": "dd/mm/yyyy", showMaskOnHover: false });
			$("#mask_phone").inputmask("mask", {"mask": "(999) 999-9999"});
			$("#mask_plate").inputmask({"mask": "[9-]AAA-999"});
			$("#mask_numeric").inputmask('€ 999.999,99', { numericInput: false });
			$("#mask_mac").inputmask({"mask": "**:**:**:**:**:**"});
			$("#mask_callback").inputmask("mm/dd/yyyy",{ "placeholder": "mm/dd/yyyy", "oncomplete": function(){ alert('Date entered: '+$(this).val()); } });
			$('[data-inputmask]').inputmask();
		}
	};
	
	//* password strength meter
	ebro_password_meter = {
		init: function() {
			if($('#password_meter').length) {
				$("#password_meter").complexify({}, function (valid, complexity) {
					$('#pass_progress').css({'width':complexity + '%'});
					if (complexity < 40) {
						$('#pass_progress').removeClass('progress-bar-warning').addClass('progress-bar-danger');
					} else if(complexity < 70 ) {
						$('#pass_progress').removeClass('progress-bar-danger progress-bar-success').addClass('progress-bar-warning');
					} else {
						$('#pass_progress').removeClass('progress-bar-warning').addClass('progress-bar-success');
					}
					$('#complexity').html(Math.round(complexity) + '%');
				});
			}
		}
	};
	
	//* datepicker
	ebro_datepicker = {
		init: function() {
			if($('.ebro_datepicker').length) {
				$('.ebro_datepicker').datepicker()
			}
			if( ($('#dpStart').length) && ($('#dpEnd').length) ) {
				$('#dpStart').datepicker().on('changeDate', function(e){
					$('#dpEnd').datepicker('setStartDate', e.date);
				});
				$('#dpEnd').datepicker().on('changeDate', function(e){
					$('#dpStart').datepicker('setEndDate', e.date)
				});
			}
		}
	};
	
	//* timepicker
	ebro_timepicker = {
		init: function() {
			if($('#tp-default').length) {
				$('#tp-default').timepicker()
			}
			if($('#tp-24h').length) {
				$('#tp-24h').timepicker({
					minuteStep: 1,
					template: 'modal',
					showSeconds: true,
					showMeridian: false
				})
			}
			if($('#tp-noTemplate').length) {
				$('#tp-noTemplate').timepicker({
					template: false,
					showInputs: false,
					minuteStep: 5
				})
			}
			if($('#tp-modal').length) {
				$('#tp-modal').timepicker({
					minuteStep: 1,
					secondStep: 5,
					showInputs: false,
					modalBackdrop: true,
					showSeconds: true,
					showMeridian: false
				})
			}
		}
	};

	//* colorpicker
	ebro_colorpicker = {
		init: function() {
			if($('#cp1').length) {
				$('#cp1').colorpicker({
					format: 'hex'
				})
			}
			if($('#cp2').length) {
				$('#cp2').colorpicker()
			}
			if($('#cp3').length) {
				$('#cp3').colorpicker()
			}
		}
	};

	//* icheck checkboxes & radio buttons
	ebro_icheck = {
		init: function() {
			if($('.icheck').length) {
				$('.icheck').iCheck({
					checkboxClass: 'icheckbox_minimal',
					radioClass: 'iradio_minimal'
				});
			}
			//* icheck color change
			$('#icheck_colors li').click(function(){
				if(!$(this).hasClass('active_color')) {
					$('#icheck_colors li').removeClass('active_color');
					var act_color = $(this).addClass('active_color').data('icolor');
					if(act_color != '') {
						// icheck theme <link href="js/lib/iCheck/skins/minimal/-- color --.css" rel="stylesheet">
						$("#icheck_theme").prop('href', 'js/lib/iCheck/skins/minimal/'+act_color+'.css')
						act_color = "-"+act_color;
					} else {
						// icheck theme <link href="js/lib/iCheck/skins/minimal/-- color --.css" rel="stylesheet">
						$("#icheck_theme").prop('href', 'js/lib/iCheck/skins/minimal/minimal.css')
					}
					$('.icheck').iCheck('destroy').iCheck({
						checkboxClass: 'icheckbox_minimal'+act_color,
						radioClass: 'iradio_minimal'+act_color
					});
				}
			})
		}
	};

	//* switch buttons
	ebro_switchButtons = {
		init: function() {
			if($('.radio1').length) {
				$('.radio1').on('switch-change', function () {
					$('.radio1').bootstrapSwitch('toggleRadioState');
				});
			}
			if($('.radio2').length) {
				$('.radio2').on('switch-change', function () {
					$('.radio2').bootstrapSwitch('toggleRadioStateAllowUncheck', true);
				});
			}
		}
	};

	//* noUI slider
	ebro_slider = {
		init: function() {
			//* ion Range Sliders
			if($('#range_slider_a').length) {
				$("#range_slider_a").ionRangeSlider({
				   type: "single",
				   step: 10,
				   postfix: " pounds",
				   from: 200,
				   hasGrid: true
				});
			}
			
			if($('#range_slider_b').length) {
				$("#range_slider_b").ionRangeSlider();
			}
			
			if($('#range_slider_c').length) {
				$("#range_slider_c").ionRangeSlider({
				   type: "single",
				   step: 100,
				   postfix: " light years",
				   from: 55000,
				   hideText: true
				});
			}
			if($('#range_slider_d').length) {
				$("#range_slider_d").ionRangeSlider({
				   type: "double",
				   postfix: " miles",
				   step: 1000,
				   from: 25000,
				   to: 35000
				});
			}
			
			//* noUi Sliders
			if($('.ebro_slider_a').length) {
				$(".ebro_slider_a").noUiSlider({
					range: [0, 100],
					start: 50,
					handles: 1,
					connect: "lower"
				}); 
			}
			if($('.ebro_slider_b').length) {
				$(".ebro_slider_b").noUiSlider({
					range: [0, 200],
					start: [80, 120],
					step: 10,
					handles: 2,
					serialization: {
						to: [$("#bind_1"),$("#bind_2")]
					}
				});
			}
			if($('.ebro_slider_c').length) {
				$(".ebro_slider_c").noUiSlider({
					range: [0, 100],
					start: [20, 60],
					step: 5,
					slide: function(){
						var values = $(this).val();
						$(".ebro_slider_val").text(
							values[0] +
							" - " +
							values[1]
						);
					}
				});
			}
			if($('.ebro_slider_d').length) {
				$(".ebro_slider_d").noUiSlider({
					range: [0, 100],
					start: 50,
					handles: 1
				}).attr("disabled","disabled");
			}
		}
	};

	//* autosize textarea
	ebro_autosize_textarea = {
		init: function() {
			if($('.autosize_textarea').length) {
				$('.autosize_textarea').each(function() {
					if($(this).hasClass('animated')) {
						$(this).autosize({append: "\n"});
					} else {
						$(this).autosize();
					}
				})
			}
		}
	};

	//* textarea counter
	ebro_textarea_counter = {
		init: function() {
			if($('#count-textarea1').length) {
				$('#count-textarea1').textareaCount({
					maxCharacterSize: -2,
					originalStyle: 'originalTextareaInfo',
					warningStyle : 'warningTextareaInfo',
					warningNumber: 40
				})
			}
			if($('#count-textarea2').length) {
				$('#count-textarea2').textareaCount({
					maxCharacterSize: 200,
					originalStyle: 'originalTextareaInfo',
					warningStyle : 'warningTextareaInfo',
					warningNumber: 40,
					displayFormat : '#input/#max | #words words'
				})
			}
		}
	};
