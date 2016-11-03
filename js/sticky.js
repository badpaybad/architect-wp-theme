jQuery(document).ready(function() {
    function isScrolledTo(elem) {
        var docViewTop = jQuery(window).scrollTop(); //num of pixels hidden above current screen
        var docViewBottom = docViewTop + jQuery(window).height();

        var elemTop = jQuery(elem).offset().top; //num of pixels above the elem
        var elemBottom = elemTop + jQuery(elem).height();

        return ((elemTop <= docViewTop));
    }

    var catcher = jQuery('#catcher'),
        sticky = jQuery('#sticky'),
        headerHeight = sticky.height();

    jQuery(window).scroll(function() {
        if (isScrolledTo(sticky)) {
            sticky.addClass('shrink');
            catcher.css('height', headerHeight );
        }
        if (jQuery(window).scrollTop() == 0) {
            sticky.removeClass('shrink');
            catcher.height(0);
        }
    });
});