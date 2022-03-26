app.showbyhash = {
    init: function (el) {
        this.el = el;

        var winHash = window.location.hash;
        var hash = el.attr('data-hash');

        // data-hash needs the hash symbol too
        if (winHash === hash) {
            el.show();
        }
    }
};