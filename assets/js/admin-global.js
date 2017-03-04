(function ($, document, window, undefined) {
    
    'use strict';
    
    var $document = $(document), $window = $(window), eventNames = {
        ready: 'ise:ready',
        load: 'ise:load'
    }, selectors = {
        body: 'body',
        newTable: '.data-table:not(.dataTable)',
        oldTable: '.data-table',
        cancel: '.btn.cancel',
        collapse: '[data-toggle="collapse"][value!="Cancel"]',
        title: '[title]'
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
        $(selectors.newTable).dataTable();
        $(selectors.collapse).each(prepareCollapse);
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