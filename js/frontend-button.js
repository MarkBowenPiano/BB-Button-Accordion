(function ($) {

    ZestSMSExtendButton = {
        _init: function () {
            var button_container = $('.button-has-collapse'),
                button = button_container.find('a.fl-button');

            button.on('click', $.proxy(this._buttonCollapseClick, this));
        },

        _buttonCollapseClick: function (e) {
            e.preventDefault();

            var button = $(e.currentTarget),
                collapse_item,
                parent_module = button.closest('.button-has-collapse'),
                next_module = parent_module.next('.fl-module'),
                column_modules = parent_module.nextUntil('.button-has-collapse'),
                parent_classes = parent_module.attr('class').split(' ');

            for (var i = 0, len = parent_classes.length; i < len; i++) {
                if( parent_classes[i].indexOf('collapse-button-') !== -1) {
                    collapse_item = parent_classes[i].substring(16);
                }
            }


            if( collapse_item == 'module') {
                next_module.slideToggle();
            } else {
                column_modules.slideToggle();
            }

            button.toggleClass('closed');

        }
    }

    $(function(){
        ZestSMSExtendButton._init();
    });
})(jQuery);