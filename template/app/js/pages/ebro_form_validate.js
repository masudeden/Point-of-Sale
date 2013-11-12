/* [ ---- Ebro Admin - form validate ---- ] */

	$(function() {
		//* parsley validate
		ebro_validate.init();
		ebro_validate.extended();
	});
	
	//* parsley validate
	ebro_validate = {
		init: function() {
			if($('#parsley_reg').length) {
				$('#parsley_reg').parsley({
					errors: {
						classHandler: function ( elem, isRadioOrCheckbox ) {
							if(isRadioOrCheckbox) {
								return $(elem).closest('.form_sep');
							}
						},
						container: function (element, isRadioOrCheckbox) {
							if(isRadioOrCheckbox) {
								return element.closest('.form_sep');
							}
						}
					}
				});
			}
		},
		extended: function() {
			//* 2col multiselect
			if($('#2col_multiselect').length) {
				$('#2col_multiselect').multiSelect();
			}
			//* select2
			if($('#s2_basic').length) {
				$('#s2_basic').select2({
					allowClear: true,
					placeholder: "Select..."
				});
				//* remove default form-controll class
				setTimeout(function() {
					$('.select2-container').each(function() {
						$(this).removeClass('form-control')
					})
				})
			}
			//* datepicker
			if($('.ebro_datepicker').length) {
				$('.ebro_datepicker').datepicker({
					autoclose: true
				}).on('changeDate', function(ev){
					$(this).children('input').parsley( 'validate' );  
				})
			}
			//* iCheck
			if($('.icheck').length) {
				$('.icheck').iCheck({
					checkboxClass: 'icheckbox_minimal'
				}).on('ifChanged', function(event){
					$('.icheck[name="cust_checkbox"]').parsley( 'validate' );  
				});
			}
			if($('#parsley_ext').length) {
				
				//* workaround for multi selects null value
				$('#2col_multiselect,#s2_basic').append('<option disabled value=""/>').on('change',function() {
					if ($(this).val() === null ) {
						$(this).val("");
					}
				}).val('');
				
				$('#parsley_ext').parsley({
					validationMinlength: 0,
					errors: {
						classHandler: function ( elem, isRadioOrCheckbox ) {
							return $(elem).closest('.form_sep');
						},
						container: function (element, isRadioOrCheckbox) {
							return element.closest('.form_sep');
						}
					}
				});
			}
		}
	}
