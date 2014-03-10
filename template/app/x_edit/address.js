/**
Address editable input.
Internally value stored as {i_discount: "Moscow", i_dis_amt: "Lenina", free: "15"}

@class address
@extends abstractinput
@final
@example
<a href="#" id="address" data-type="address" data-pk="1">awesome</a>
<script>
$(function(){
    $('#address').editable({
        url: '/post',
        title: 'Enter i_discount, i_dis_amt and free #',
        value: {
            i_discount: "Moscow", 
            i_dis_amt: "Lenina", 
            free: "15"
        }
    });
});
</script>
**/
(function ($) {
    "use strict";
    
    var Address = function (options) {
        this.init('address', options, Address.defaults);
    };

    //inherit from Abstract input
    $.fn.editableutils.inherit(Address, $.fn.editabletypes.abstractinput);

    $.extend(Address.prototype, {
        /**
        Renders input from tpl

        @method render() 
        **/        
        render: function() {
           this.$input = this.$tpl.find('input');
        },
        
        /**
        Default method to show value in element. Can be overwritten by display option.
        
        @method value2html(value, element) 
        **/
        value2html: function(value, element) {
            if(!value) {
                $(element).empty();
                return; 
            }
            var html = $('<div>').text(value.i_discount).html() + ', ' + $('<div>').text(value.i_dis_amt).html() + ' st., bld. ' + $('<div>').text(value.free).html();
            $(element).html(html); 
        },
        
        /**
        Gets value from element's html
        
        @method html2value(html) 
        **/        
        html2value: function(html) {        
          /*
            you may write parsing method to get value by element's html
            e.g. "Moscow, st. Lenina, bld. 15" => {i_discount: "Moscow", i_dis_amt: "Lenina", free: "15"}
            but for complex structures it's not recommended.
            Better set value directly via javascript, e.g. 
            editable({
                value: {
                    i_discount: "Moscow", 
                    i_dis_amt: "Lenina", 
                    free: "15"
                }
            });
          */ 
          return null;  
        },
      
       /**
        Converts value to string. 
        It is used in internal comparing (not for sending to server).
        
        @method value2str(value)  
       **/
       value2str: function(value) {
           var str = '';
           if(value) {
               for(var k in value) {
                   str = str + k + ':' + value[k] + ';';  
               }
           }
           return str;
       }, 
       
       /*
        Converts string to value. Used for reading value from 'data-value' attribute.
        
        @method str2value(str)  
       */
       str2value: function(str) {
           /*
           this is mainly for parsing value defined in data-value attribute. 
           If you will always set value by javascript, no need to overwrite it
           */
           return str;
       },                
       
       /**
        Sets value of input.
        
        @method value2input(value) 
        @param {mixed} value
       **/         
       value2input: function(value) {
           if(!value) {
             return;
           }
           this.$input.filter('[name="i_discount"]').val(value.i_discount);
           this.$input.filter('[name="i_dis_amt"]').val(value.i_dis_amt);
           this.$input.filter('[name="free"]').val(value.free);
       },       
       
       /**
        Returns value of input.
        
        @method input2value() 
       **/          
       input2value: function() { 
           return {
              i_discount: this.$input.filter('[name="i_discount"]').val(), 
              i_dis_amt: this.$input.filter('[name="i_dis_amt"]').val(), 
              free: this.$input.filter('[name="free"]').val()
           };
       },        
       
        /**
        Activates input: sets focus on the first field.
        
        @method activate() 
       **/        
       activate: function() {
            this.$input.filter('[name="i_discount"]').focus();
       },  
       
       /**
        Attaches handler to submit form in case of 'showbuttons=false' mode
        
        @method autosubmit() 
       **/       
       autosubmit: function() {
           this.$input.keydown(function (e) {
                if (e.which === 13) {
                    $(this).closest('form').submit();
                }
           });
       }       
    });

    Address.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<div class="row"><div class="col col-lg-7"><label><span>Discount %: </span></div><div class="col col-lg-5"><input type="text" name="i_discount" id="i_discount" onKeyPress="item_discount(event);return numbersonly(event)" maxlength="2" onkeyup="item_editable_discount()" class="form-control"></label></div></div>'+
             '<div class="row"><div class="col col-lg-7"><label><span>Discount Amount: </span></div><div class="col col-lg-5"><input type="text" name="i_dis_amt" id="i_dis_amt" onKeyPress="item_discount_amount(event);return numbersonly(event)" onkeyup="item_editable_discount()" class="form-control"></label></div></div>'+
             '<div class="row"><div class="col col-lg-7"><label  id="tax_lablel">Tax</div><div class="col col-lg-5"><input type="text" name="free" id="i_free"  onKeyPress="item_free(event);return numbersonly(event)"  class="form-control"></label></div></div>',
             
        inputclass: ''
    });

    $.fn.editabletypes.address = Address;

}(window.jQuery));