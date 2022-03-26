app.counter = {
    init: function (els) {
        var _this = this;
        
        els.each(function(){
            var el = $(this);
            
            if (!el.is('[data-manual]')) {
                _this.animate(el);
            }
        });
    },
    beforeWaypoint: function(el) {
        el.css('opacity', '0');
    },
    beforeAnimation: function(el) {
        el.css('opacity', '1');
    },
    animate: function (el) {
        var _this = this;
        
        if (el.is('[data-counter-done]')) {
            return;
        }
        
        el.attr('data-counter-done', true);
        
        var origin = Number(el.attr('data-origin'));
        var duration = Number(el.attr('data-duration'));
        var easing = el.attr('data-easing');
        var number = Number(el.text().trim());
        var decimal = Number(el.attr('data-decimal'));
        
        if (isNaN(origin)) {
            origin = 0;
        }
        
        if (isNaN(duration)) {
            duration = 2500;
        }
        
        if (isNaN(decimal)) {
            decimal = 2;
        }
        
        if (isNaN(number)) {
            console.log('final number is not a number');
            return;
        }
        
        var isInt = number % 1 === 0;
        
        if (easing === 'undefined') {
            easing = 'swing';
        }
        
        el.prop('Counter', origin).animate({
            Counter: number
        }, {
            duration: duration,
            easing: easing,
            step: function (now) {
                if (isInt) {
                    el.text(Math.ceil(now));
                } else {
                    el.text(now.toFixed(decimal));
                }
            }
        });
    }
};