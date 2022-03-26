app.menu = {
    init: function (menu) {
        var toggle = menu.find('[data-toggle]');
        var hideClass = menu.attr('data-hide-class');
        var closeButton = menu.find('[data-close-button]');
        var hideItemClass = menu.attr('data-hide-item-class');
        var mobileToggleClass = menu.attr('data-alter-mobile-toggle-class');
        var fired = 0;
        var scrollFunction;
        
        // loaded closed & should be open on larger viewports
        // if opened automatically, the close button is awkward, so hide it.
        if (menu.hasClass(hideClass) && $(window).width() > 768) {
            closeButton.toggleClass(hideItemClass);
            menu.toggleClass(hideClass);
            
            scrollFunction = function() {
                fired = 1;
                menu.addClass(hideClass);
                closeButton.removeClass(hideItemClass);
            };
            
        } else {
            scrollFunction = function() {
                fired = 1;
                toggle.removeClass(mobileToggleClass);
            };
        }
        
        toggle.click(function () {
            
            if (fired === 0 && $(window).width() > 768){
                scrollFunction();
                return;
            }
            
            if (fired === 0) {
                scrollFunction();
            }
            
            menu.toggleClass(hideClass);
            closeButton.removeClass(hideItemClass);
            
        });

        $('body').waypoint(function (direction) {
            if (direction === 'down' && fired === 0) {
                scrollFunction();
            }
        }, {
            offset: '-100px'
        });
    }
};