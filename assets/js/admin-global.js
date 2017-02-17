(function ($, document, window, undefined) {
    
    'use strict';
    
    var $document = $(document), $window = $(window), notifications = {
        show: {
            duration: 'slow',
            delay: 500
        },
        hide: {
            duration: 'slow',
            delay: 5000
        }
    }, eventNames = {
        ready: 'ise:ready',
        load: 'ise:load'
    }, selectors = {
        body: 'body',
        table: '.data-table',
        modal: '.modal',
        alert: '.alert-notifications .alert',
        cancel: '.btn.cancel',
        collapse: '[data-toggle="collapse"][value!="Cancel"]'
    };
    
    /**
     * Initialise
     */
    function initialise() {
        $document.ready(documentReady).on(eventNames.ready, iseReady);
        $window.load(windowLoad);
    }
    
    /**
     * One time document ready event
     */
    function documentReady() {
        $document.ajaxify();
    }
    
    /**
     * One time window load event
     */
    function windowLoad() {
        $(selectors.body).addClass('loaded');
    }
    
    /**
     * Custom ready event
     */
    function iseReady() {
        $(selectors.table).dataTable();
        $(selectors.modal).on('hidden.bs.modal', hideModal);
        $(selectors.alert).each(showNotification);
        $(selectors.collapse).each(prepareCollapse);
    }
    
    /**
     * Hide modal
     */
    function hideModal() {
        var href = $(selectors.cancel, this).attr('data-href');
        if (href) {
            window.location.href;
        }
    }
    
    /**
     * Show a notification
     */
    function showNotification() {
        $(this).delay(notifications.show.delay).fadeIn(notifications.show.duration, hideNotification).hover(hoverNotification, hideNotification);
    }
    
    /**
     * On hover of a notification
     */
    function hoverNotification() {
        $(this).stop(true).show();
    }

    /**
     * Hide a notification
     */
    function hideNotification() {
        $(this).delay(notifications.hide.delay).fadeOut(notifications.hide.duration);
    }
    
    /**
     * Prepare a collapse element
     */
    function prepareCollapse() {
        var $button = $(this), $target = $($button.attr('data-target')), template = '<span class="glyphicon glyphicon-minus" aria-hidden="true" /> Hide';
        
        /**
         * On collapse hidden
         */
        function collapseHidden() {
            $button.html($button.data('originalTitle'));
        }
        
        /**
         * On collapse shown
         */
        function collapseShown() {
            $button.html(template);
        }
        
        $button.data('originalTitle', $button.html());
        $target.on({
            'hidden.bs.collapse': collapseHidden,
            'shown.bs.collapse': collapseShown
        });
        if ($target.hasClass('in')) {
            $button.data('originalTitle', $button.html());
            $button.html(template);
        }
    }
    
    // Initialise
    initialise();
    
})(jQuery, document, window);