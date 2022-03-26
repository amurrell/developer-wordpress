app.animate = {
    init: function (els) {
        var _this = this;

        els.each(function () {
            var el = $(this);

            var animationAdd = el.attr('data-animation-add');
            var animationRemove = el.attr('data-animation-remove');
            var animationDelay = el.attr('data-animation-delay');
            var custom = el.attr('data-animation-custom');
            var waypoint = el.attr('data-waypoint');
            var animationFunc = function() {
                if (animationAdd !== undefined) {
                    el.addClass(animationAdd);
                }
                if (animationRemove !== undefined) {
                    el.removeClass(animationRemove);
                }
            };

            if (custom !== undefined) {
                
                if (app[custom] !== undefined) {
                    app[custom].beforeWaypoint(el);
                }
                
                animationFunc = function() {
                    if (app[custom] !== undefined) {
                        app[custom].beforeAnimation(el);
                        app[custom].animate(el);
                    }
                };
            }
            
            // Add animated class now
            el.addClass('animated');
            
            // Add the negative (fade OUT)
            if (animationRemove !== undefined) {
                el.addClass(animationRemove);
            }
            
            // No waypoint
            if (waypoint === undefined) {
                animationFunc();
                return;
            }

            el.waypoint(function (direction) {
                if (direction === 'down') {
                    
                    // Handle Delay
                    if (animationDelay !== undefined) {
                        el.css('animation-delay', animationDelay);
                    }
                    
                    animationFunc();
                }
            }, {
                offset: waypoint
            });


        });
    }
};