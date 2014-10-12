(function($){
	$.fn.validatorRM = function(options) {
    	
		var settings = {
			iconStatusOk: 'icon-ok',
			iconStatusErr: 'icon-info',
			formNameId: '#form-pushki',
			parentElement: '.form-group',
			rezcalcSizeId: '#rezcalcSize',
		    rezcalcPowerId: '#rezcalcPower',
			errorClass: 'error',
			validClass: 'valid',
			infoError: '.error-box i',
			requiredF: [],
			minCountF: [],
			validE: [],
			immediately: false, 
			submitButtonDisabled: false,
			messages: {
				required: "<i class=\"icon-info\"></i>",
				iconStatusErrTitle: "Поле не может быть пустым!",
				minCoun: "",
				email: ""
			}
        };
                                
		return this.each(function() {
    		
			if (options) {
				$.extend(settings, options);
			}                        
        	
			var $this = $(this);
			var iconStatusOk = settings.iconStatusOk;
			var iconStatusErr = settings.iconStatusErr;
			var formNameId = settings.formNameId;
			var parentElement = settings.parentElement;
			var rezcalcSizeId = settings.rezcalcSizeId;
			var rezcalcPowerId = settings.rezcalcPowerId;
			var errorClass = settings.errorClass;
			var validClass = settings.validClass;
			var infoError = settings.infoError;
			var requiredF = settings.requiredF;
			var minCountF = settings.minCountF;
			var messages = settings.messages;
			var validE = settings.validE;
			var immediately = settings.immediately;
			var submitButtonDisabled = settings.submitButtonDisabled;
			var submitButton =  $this.find(':submit');		
        	var calcName = formNameId.substr(6);
			var rezcalcSize  = $(rezcalcSizeId);
			var rezcalcPower = $(rezcalcPowerId);
			var inputValue;
			var inputId;
			var num;
			var strLength;
			
			$this.find('input.form-control').on('keyup input click', function(e)
			{
				if(e.type == 'click')
				{
					this.select();
				}
				else
				{
					inputId = $(this).prop('id');
					inputValue = $(this).val();
					num = 6;
					if(inputId == 'tempOut' || inputId == 'tempIn')
					{
						reg = /^\.|-\d+-|\d+\..*\.|[^-?\d\.{1}]|[-][\.]+|[-][-]+|[\d]+[-]/;
						if(reg.test(inputValue))
						{
							$(this).val(inputValue.slice(0,-1));
							
						}
						else
						{
							$(this).val(inputValue);
							
						}
					}
					else
					{
						reg = /^\.|\d+\..*\.|[^\d\.{1}]/;
						if(reg.test(inputValue))
						{
							$(this).val(inputValue.slice(0,-1));
							
						}
						else
						{
							$(this).val(inputValue);
							
						}
					}
				}
	
			});
			
			
			function required(id) {
				var element = $(id);
				var elementParent = element.closest(parentElement);
				var elementError = elementParent.find(infoError);
				var elementErrorText = messages.required;
				var elementErrorTitle = messages.iconStatusErrTitle;
				var rezcalcSizeValue  = rezcalcSize.val();
				var rezcalcPowerValue = rezcalcPower.val();
				if (element.val() == '') {
					elementParent.removeClass(validClass).addClass(errorClass);
					elementError.removeClass().addClass(iconStatusErr).prop('title', elementErrorTitle);
					if(rezcalcSizeValue)
					{
						rezcalcSize.val('');
					}
					if(rezcalcPowerValue)
					{
						rezcalcPower.val('');
					}
					return false; 
				}
				else {
					return true;
				}
				
			}

			
			function minCount(id, count) {
				var c = count;
				if (c < 0) c = 0;
				var f = false;
				if (c > 1) f = true;	
				var element = $(id);
				var elementParent = element.closest(parentElement);
				var elementError = elementParent.find(infoError);
				var elementErrorText = messages.minCoun + c;
    			if (element.val().length < c && element.val() != '' && f) {
					elementParent.removeClass(validClass).addClass(errorClass);
					elementError.removeClass().addClass(iconStatusErr);
					return false; 
				}
				else {
					return true;
				}
			}
			
			
			function validEmail(id) {
				element = $(id);
				elementParent = element.closest(parentElement);
				var elementError = elementParent.find(infoError);
				var elementErrorText = messages.email;
				reg = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i;
				if (!element.val().match(reg) && element.val() != '') {
					elementParent.removeClass(validClass).addClass(errorClass);
					elementError.removeClass().addClass(iconStatusErr);
					return false;		
				}
				else {
					return true;
				}
			}
			
			function validForm() {
				
				var validF = true;	
	
				for(var i=0; i<requiredF.length; i++) {
					r = required('#' + requiredF[i]);
					if (!r) validF = false;
				}

				
				for(var i=0; i<validE.length; i++) {
					r = validEmail('#' + validE[i]);
					if (!r) validF = false;
				}
				
				for(var i=0; i<minCountF.length; i++) {
					var str = minCountF[i];
					var indexS = str.indexOf(':');
					nameF = str.slice(0, indexS);
					countF = str.slice(indexS + 1);
					r = minCount('#' + nameF, countF);
					if (!r) validF = false;
				}
	
				if (!validF) {
					return false;
				}
				else {
					return true;
				}
				
			}
			
			function validItem(id) {
				
					elementId = id;
				
					var valid = true;					
					var inputValue;
					for(var i=0; i<requiredF.length; i++) {
						if (elementId.attr('id') == requiredF[i]){
							inputValue = parseFloat(elementId.val());
							if(!inputValue)
							{
					 			elementId.val('');
							}
							else 
							{
								elementId.val(inputValue);
							}
							if (!required(elementId)) valid = false;
						}
					}					
	
					for(var i=0; i<validE.length; i++) {
						if (elementId.attr('id') == validE[i]){
							if (!validEmail(elementId)) valid = false;
						}
					}
	
					for(var i=0; i<minCountF.length; i++) {
						var str = minCountF[i];
						var indexS = str.indexOf(':');
						nameF = str.slice(0, indexS);
						countF = str.slice(indexS + 1);
						if (elementId.attr('id') == nameF){
							if (!minCount(elementId, countF)) valid = false;
						}
					}
					
					elementParent = elementId.closest(parentElement);
					var elementError = elementParent.find(infoError);
					if (valid){
						elementParent.removeClass(errorClass).addClass(validClass);
						elementError.removeClass().addClass(iconStatusOk).prop('title', '');
						return true;
					} 
					else {						
						return false;
					}
				
			}

			
			
			
			if (submitButtonDisabled){
				submitButton.attr('disabled', 'disabled');
				immediately = true;
			}
			
			$this.find('input, textarea').on('blur', function () {	
	
				validItem($(this));
	
			});
			
			
			if (immediately) {
			
				$this.find('input, textarea').on('keyup', function(){
					
					valid = validItem($(this));					
					
					if (!valid && submitButtonDisabled) {
						submitButton.attr('disabled', 'disabled');
					}
					else
					{
						if (validForm()) submitButton.removeAttr('disabled');
					}
	
				}).keyup();
			
			}
			else {
				
				$this.find('input, textarea').on('keypress', function() {
					$(this).closest(parentElement).removeClass(errorClass);
				});
			
			}			

			submitButton.on('click', function(){
	
				valid = validForm();
				
				if (!valid) return false;
				else
				{
					$('#form-' + calcName).mySimplePlugin('calc');
					return false;
				}
			});
			
			$this.find(parentElement).removeClass(errorClass);

			
		});
		
		
		
	};
})(jQuery);