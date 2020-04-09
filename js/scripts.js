/**
 * File scipts.js.
 */

jQuery(document).ready(function($) {
	
    // Add class to unset navbar
	$('false ul').addClass('navbar-nav ml-auto');
	
	// // Resize body container based on navbar height
	// $('article > .entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());

	// Add Bootstrap dropdown classes to nested menu items
    $('.navbar .menu-item-has-children').addClass('dropdown');
    $('.navbar .menu-item-has-children > a').addClass('dropdown-toggle');

    // Add attributes to sub menu
    $('.dropdown-toggle').attr({
        'role' : 'button',
        'aria-haspopup' : 'true',
        'aria-expanded' : 'false',
        'data-toggle' : 'dropdown',
    });

    // Wrap widget with card-body class
    $('#sidebar .card-header').next().wrap('<div class="card-body"></div>');

    // Change dropdown from click to hover
    $('.navbar .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(300);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(300);
    });

    // Add Bootstrap pagination classes
    $('.pagination a').wrap('<li class="page-item"></li>');
    $('.pagination a, .pagination span').addClass('page-link');

    // Add class to body tag when user scrolls
    var scrollPosition = window.scrollY;
    var body = document.getElementsByTagName('body')[0];

    window.addEventListener('scroll', function() {

        scrollPosition = window.scrollY;

        if (scrollPosition >= 100) {
            body.classList.add('scrolled');
        } else {
            body.classList.remove('scrolled');
        }

    });

    // Add data attribute
    if($('.navbar').hasClass('fixed-top')) {
        $('.navbar').attr('data-toggle', 'sticky-onscroll');
    }

    // Sticky navbar
    var stickyToggle = function (sticky, stickyWrapper, scrollElement) {
        var stickyHeight = sticky.outerHeight();
        var stickyTop = stickyWrapper.offset().top;
        if (scrollElement.scrollTop() >= stickyTop) {
            stickyWrapper.height(stickyHeight);
            sticky.addClass('fixed-top');
        }
        else {
            sticky.removeClass('fixed-top');
            stickyWrapper.height('auto');
        }
    };

    // Find all data-toggle="sticky-onscroll" elements
    $('[data-toggle="sticky-onscroll"]').each(function () {
        var sticky = $(this);
        var stickyWrapper = $('<div>').addClass('sticky-wrapper');
        sticky.before(stickyWrapper);

        // Scroll & resize events
        $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function () {
            stickyToggle(sticky, stickyWrapper, $(this));
        });

        // On page load
        stickyToggle(sticky, stickyWrapper, $(window));
    });
     
});