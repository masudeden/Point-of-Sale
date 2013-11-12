/* [ ---- Ebro Admin - wizard ---- ] */

	$(function() {
		ebro_wizard.init();
	});
	
	ebro_wizard = {
		init: function() {
			if($('#wizard_a').length) {
				var wizard_form = $('#wizard_a');
				//* wizard
				wizard_form.steps({
					headerTag: "h4",
					bodyTag: "fieldset",
					transitionEffect: "slideLeft",
					labels: {
						next: "Next",
						previous: "Previous",
						finish: "<i class=\"icon-ok\"></i> Submit"
					},
					titleTemplate: "<span class=\"number\">#index#</span> #title#",
					onStepChanging: function (event, currentIndex, newIndex) {
						
						// Allways allow previous action even if the current form is not valid!
						if (currentIndex > newIndex) {
							return true;
						}
			
                        var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onStepChanged: function (event, currentIndex, priorIndex) {
						//* resize wizard step to fit error messages
                        ebro_wizard.setHeight();
					},
					onFinishing: function (event, currentIndex) {
						var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onFinished: function (event, currentIndex) {
						alert("Submitted!");
                        //* uncomment the following to submit form
                        //wizard_form.submit();
					}
				});
				//* validate
				wizard_form.parsley({
                    errors: {
						classHandler: function ( elem, isRadioOrCheckbox ) {
							if(isRadioOrCheckbox) {
								return $(elem).closest('div');
							}
						},
						container: function (element, isRadioOrCheckbox) {
							if(isRadioOrCheckbox) {
								return element.closest('div');
							}
						}
					},
					listeners: {
						onFieldError: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						},
						onFieldSuccess: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						}
					}
				});
				
                //* resize wizard step
				ebro_wizard.setHeight();
				
			}
		},
		setHeight: function() {
			setTimeout(function() {
				var cur_height = $('#wizard_a .body.current').filter(':visible').outerHeight();
				$('#wizard_a > .content').height(cur_height);
			},300);
		}
	}