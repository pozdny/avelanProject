// JavaScript Document
+function ($) {
    'use strict';
// значения по умолчанию 
    var defaults = { 
		calcName:'cond',
		square : 0,
		topSize: 0,
		rezcalcSize: 0,
	    rezcalcPower: 0,
		rezcalcSizeId: '#rezcalcSize',
		rezcalcPowerId: '#rezcalcPower'
	};
    var opts;
    // наши публичные методы
    var methods = {
        // инициализация плагина
        init:function(params) {
            // актуальные настройки, будут индивидуальными при каждом запуске
            var options = $.extend({}, defaults, params);

            return this.each(function(){
                var $this = $(this);
                $this.data(options);
            });

        },
        calc:function(){
            return this.each(function(){console.log('222');
                var $this = $(this);
                var calcName = $this.data('calcName');
                if(calcName == 'pushki')
                {
                    calcPushki($this);
                }
                else if(calcName == 'cond')
                {
                    calcCond($this);
                }

                //alert(inputArr[0]['name']);
            });

        }
    };
    function calcPushki(form)
    {
        var $this = form;
        var tempOut, tempIn, radio, tempRazn, squareId, topSizeId;
        var inputArr   = [];
        var rezcalcSizeId  = $this.data('rezcalcSizeId');
        var rezcalcPowerId = $this.data('rezcalcPowerId');
        inputArr = $this.serializeArray();
        var square   = Math.abs(inputArr[0]['value']);
        var topSize  = Math.abs(inputArr[1]['value']);
        squareId  = inputArr[0]['name'];
        topSizeId = inputArr[1]['name'];
        $('#' + squareId).val(square);
        $('#' + topSizeId).val(topSize);
        $this.data('square', square);
        $this.data('topSize', topSize);
        tempOut  = inputArr[2]['value'];
        tempIn   = inputArr[3]['value'];
        radio    = inputArr[4]['value'];
        //объем помещения
        var rezcalcSize = multiplication([square, topSize]);
        $this.data('rezcalcSize', rezcalcSize);
        $(rezcalcSizeId).val(rezcalcSize);
        //разность температур
        tempRazn = subtraction(tempIn, tempOut);
        if(radio == '0')
        {
            radio = avarage($this);
        }
        var rezcalcPower = ((rezcalcSize*tempRazn*radio)/860).toFixed(2);
        $this.data('rezcalcPower', rezcalcPower);
        $(rezcalcPowerId).val(rezcalcPower);
    }
    function calcCond(form)
    {
        var $this = form;
        var mens, comp, other, sumKf, mensRez, compRez, otherRez, squareId, topSizeId;
        var inputArr = [];
        var sumArr   = [];
        var kf1 = 30;
        var kf2 = 0.1;
        var kf3 = 0.25;
        var kf4 = 1000;
        var rezcalcSizeId  = $this.data('rezcalcSizeId'); console.log(rezcalcSizeId);
        var rezcalcPowerId = $this.data('rezcalcPowerId');
        inputArr = $this.serializeArray();
        var square   = Math.abs(inputArr[0]['value']);
        var topSize  = Math.abs(inputArr[1]['value']);
        squareId  = inputArr[0]['name'];
        topSizeId = inputArr[1]['name'];
        $('#' + squareId).val(square);
        $('#' + topSizeId).val(topSize);
        $this.data('square', square);
        $this.data('topSize', topSize);
        mens  = inputArr[2]['value'];
        comp  = inputArr[3]['value'];
        other = inputArr[4]['value'];
        //объем помещения
        var rezcalcSize = multiplication([square, topSize]);
        $this.data('rezcalcSize', rezcalcSize);
        $(rezcalcSizeId).val(rezcalcSize);
        //умножение на коэффициенты
        var rezcalcSizeRez  = rezcalcSize/kf1;
        mensRez  = mens*kf2;
        sumArr.push(mensRez);
        compRez  = comp*kf3;
        sumArr.push(compRez);
        otherRez = other/kf4;
        sumArr.push(otherRez);
        sumKf = avarage2(sumArr);
        var rezcalcPower = (rezcalcSizeRez + sumKf).toFixed(2);
        $this.data('rezcalcPower', rezcalcPower);
        $(rezcalcPowerId).val(rezcalcPower);
    }
    function multiplication(arr)
    {
        var arr_length = arr.length;
        var i, rez;
        for(i = 0, rez = 1; i < arr_length; i++)
        {
            rez*=arr[i];
        }
        return rez.toFixed(2);

    }
    function subtraction(val1, val2)
    {
        var rez;
        return rez = val1 - val2;
    }
    function avarage(form)
    {
        var $this = form;
        var arr = $this.find('input[type="radio"]');
        var rez = 0;
        var value;
        var length = arr.length-1;
        $.each(arr, function(key, val)
        {
            value = parseFloat($(val).val());
            if(value)
            {
                rez+=value;
            }
        });
        rez/= length;
        rez = Math.round(parseFloat(rez) * 100) / 100;
        return rez;
    }
    function avarage2(arr)
    {
        var cel, dr;
        var arr_length = arr.length;
        var i, rez, value;
        for(i = 0, rez = 0; i < arr_length; i++)
        {
            value = parseFloat(arr[i]);
            rez+=value;
        }
        rez = Math.round(parseFloat(rez) * 100) / 100;
        return rez;

    }
    $.fn.valCalcPlugin = function(method){

        // немного магии
        if ( methods[method] ) {
            // если запрашиваемый метод существует, мы его вызываем
            // все параметры, кроме имени метода прийдут в метод
            // this так же перекочует в метод
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            // если первым параметром идет объект, либо совсем пусто
            // выполняем метод init
            return methods.init.apply( this, arguments );
        } else {
            // если ничего не получилось
            $.error( 'Метод "' +  method + '" не найден в плагине jQuery.mySimplePlugin' );
        }
    };
//..................................................................calc-plagin
    $('#form-pushki').valCalcPlugin({calcName:'pushki'});
    $('#form-cond').valCalcPlugin({calcName:'cond'});
}(jQuery);