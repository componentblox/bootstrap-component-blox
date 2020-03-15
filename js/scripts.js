/**
 * File scipts.js.
 */

jQuery(document).ready(function($) {
	
    // Add class to unset navbar
	$('false ul').addClass('navbar-nav ml-auto');
	
	// Resize body container based on navbar height
	$('article > .entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());
    $(window).resize(function(){
  		$('article > .entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());
	});

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
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100);
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

    // Adjust navbar if WP toolbar is visible
    let wpToolbar = document.getElementById('wpadminbar')
    let navbar = document.getElementsByClassName('fixed-top')

    if (typeof(wpToolbar) != 'undefined' && wpToolbar != null) {
        for(let i = 0; i < navbar.length; i++) {
            navbar[i].classList.add('wp-toolbar');
        }
    } else {
        for(let i = 0; i < navbar.length; i++) {
            navbar[i].classList.remove('wp-toolbar');
        }
    }
     
});