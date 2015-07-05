jQuery(function(){

    // Navigation dropdown menu for mobile
    jQuery( '#menu-primary-items .menu-item-has-children' ).each(function(){
        jQuery( this ).append( '<span></span>' );
    });

    jQuery( '#menu-primary-items .menu-item-has-children span' ).click( function(){
        jQuery( this ).parent().children( 'ul' ).slideToggle( 'normal', function(){
            jQuery( this ).parent().toggleClass( 'open' );
        });
    });

    // Navigation for mobile
    jQuery("#small-menu").click(function(){
        jQuery('#menu-wrapper').toggleClass('current');
        jQuery("#menu-primary-items").slideToggle();
        jQuery(this).toggleClass("current");
    });

    // back to pagetop
    var totop = jQuery('#back-top');
    totop.hide();
    jQuery(window).scroll(function () {
        if (jQuery(this).scrollTop() > 800) totop.fadeIn(); else totop.fadeOut();
    });
    totop.click(function () {
        jQuery('body,html').animate({scrollTop: 0}, 500); return false;
    });

});
