(function ($)
{
    var constants = {
        notification: {
            show: {
                duration: 'slow',
                delay: 500
            },
            hide: {
                duration: 'slow',
                delay: 5000
            }
        }
    },
    properties = {
    },
            methods = {
                init: function ()
                {
                    $(window).load(methods.loaded);
                    $('.table').dataTable();
                    $('.modal').on('hide.bs.modal', methods.hideModal);
                    $('.alert-notifications .alert').each(methods.showNotification);
                },
                loaded: function ()
                {
                    $('body').addClass('loaded');
                },
                hideModal: function ()
                {
                    var href = $('.btn-cancel', this).attr('data-href');
                    if (href) {
                        window.location.href = href;
                    }
                },
                showNotification: function ()
                {
                    $(this).delay(constants.notification.show.delay).fadeIn(
                            constants.notification.show.duration,
                            methods.hideNotification
                            ).hover(
                            methods.hoverNotification,
                            methods.hideNotification
                            );
                },
                hideNotification: function ()
                {
                    $(this).delay(constants.notification.hide.delay).fadeOut(
                            constants.notification.hide.duration
                            );
                },
                hoverNotification: function ()
                {
                    $(this).stop(true).show();
                }
            };

    $(document).ready(methods.init);
})(jQuery);