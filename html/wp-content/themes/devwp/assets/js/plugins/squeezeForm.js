app.squeezeForm = {
    init: function (el) {

        var _this = this;
        var form = el.find('[data-squeeze-form]');
        var modal = el.find('[data-squeeze-modal]');
        var options = el.find('[data-squeeze-option]');

        options.click(function(){
            var type = $(this).attr('data-squeeze-option');
            _this.handleType(type, modal, form);
        });
        
    },
    handleType: function(type, modal, form) {
        // set type value in form to this type.
        form.find('[name="type"]').val(type);

        if (type == 'city') {
            modal.remove();
            return;
        }

        newForm = form.clone();
        
        modal.find('[data-squeeze-contents-hide]').hide();
        modal.find('[data-squeeze-modal-inner]').append(newForm);
    }
};