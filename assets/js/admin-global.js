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
    }, collapseTitle = 'collapsableTitle';
    
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
        if ($document.ajaxify === undefined) {
            return;
        }
        
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
            $button.html($button.data(collapseTitle));
        }
        
        /**
         * On collapse shown
         */
        function collapseShown() {
            $button.html(template);
        }
        
        if ($button.data(collapseTitle)) {
            return;
        }
        
        $button.data(collapseTitle, $button.html());
        $target.on({
            'hidden.bs.collapse': collapseHidden,
            'shown.bs.collapse': collapseShown
        });
        if ($target.hasClass('in')) {
            collapseShown();
        }
    }
    
    // Initialise
    initialise();
    
})(jQuery, document, window);