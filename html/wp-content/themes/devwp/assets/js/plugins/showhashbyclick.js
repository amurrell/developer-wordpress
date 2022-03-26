app.showhashbyclick = {
    init: function (el) {
        this.el = el; // the clickable element

        el.click(function(){
            setTimeout(function(){
                var winHash = window.location.hash;
                var target = $('[data-hash="' + winHash + '"]');
                console.log(winHash);

                app.showbyhash.init(target);
                $('html, body').animate({
                    scrollTop: target.offset().top - parseInt(30)
                }, 800);
            }, 500);
        });
    }
};