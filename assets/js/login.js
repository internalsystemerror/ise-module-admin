(function ($, document, window, undefined) {
    
    'use strict';
    
    var $document = $(document), $window = $(window);
    
    /**
     * Initialise
     */
    function initialise() {
        $document.ready(documentReady);
    }
    
    /**
     * One time document ready event
     */
    function documentReady() {
        if ($document.ajaxify === undefined) {
            return;
        }
        $document.ajaxify({selectors: {wrapper: 'main'}});
    }
    
    // Initialise
    initialise();
    
})(jQuery, document, window);