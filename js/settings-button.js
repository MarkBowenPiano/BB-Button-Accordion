(function ($) {
    ZestSMSButtonSettings = {

        _init: function () {
            this._bindEvents();
        },

        _bindEvents: function () {
            $('body').delegate('.fl-builder-button-settings #fl-field-click_action select', 'change', this._manageValidation);
        },

        _manageValidation: function (e) {
            var linkField = $('.fl-builder-button-settings #fl-field-link .fl-link-field-input');

            if (e.target.value === 'collapse') {
                linkField.addClass('fl-ignore-validation');
            }
            else {
                linkField.removeClass('fl-ignore-validation');
            }
        }
    }

    ZestSMSButtonSettings._init()
})(jQuery);