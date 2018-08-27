/**
 * Created by alejandro.gomez on 1/04/16.
 */

//Funcion
$(function() {
    $.fn.numeric = function(options) {
        var options = $.extend({
            prefix: '$',
            cents: true
        }, options);

        var format = function(cnt, cents) {
            cnt = cnt.toString().replace(/\$|\u20AC|\,/g,'');
            if (isNaN(cnt))
                return 0;
            var sgn = (cnt == (cnt = Math.abs(cnt)));
            cnt = Math.floor(cnt * 100 + 0.5);
            cvs = cnt % 100;
            cnt = Math.floor(cnt / 100).toString();
            if (cvs < 10)
                cvs = '0' + cvs;
            for (var i = 0; i < Math.floor((cnt.length - (1 + i)) / 3); i++)
                cnt = cnt.substring(0, cnt.length - (4 * i + 3)) + ',' + cnt.substring(cnt.length - (4 * i + 3));

            return (((sgn) ? '' : '-') + cnt) + ( cents ?  '.' + cvs : '');
        };

        var keypress = function(e) {
            var i = 0;
            var val = this.value;
            if ((i = val.indexOf('.')) != -1) {
                if (e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
                    return false;
            } else {
                if (e.which!=8 && e.which!=190 && e.which != 46 && e.which!=0 && (e.which<48 || e.which>57))
                    return false;
            }
            return true;
        };

        return this.each(function(i, e) {
            var self = $(this);
            if (self.is(':input')) {
                $(this).blur(function() {
                    this.value = options.prefix + format(this.value, options.cents);
                }).keypress(keypress);

                this.value = options.prefix + format(this.value, options.cents);
            } else {
                self.html(options.prefix + format(self.html(), options.cents));
            }

        });
    };
});
