/**
 * File scipts.js.
 */

jQuery(document).ready(function() {

	let $ = jQuery
	
	$("false ul").addClass("navbar-nav ml-auto");
	
	// Resize Body Container Based on Navbar Height
	$('.entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());
	
	$(window).resize(function(){
  		$('.entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());
	});

	 // Add Bootstrap Dropdown Classes to Nested Menu Items
    $(".navbar .menu-item-has-children").addClass("dropdown");
    $(".navbar .menu-item-has-children > a").addClass("dropdown-toggle");

    // Add Attributes to sub menu
    $(".dropdown-toggle").attr({
     'role': "button",
     'aria-haspopup': "true",
     'aria-expanded': "false",
     'data-toggle': "dropdown",
    });

    // Wrap Widget With card-body Class
    $('#sidebar .card-header ').next().wrap('<div class="card-body"></div>');

    // Change dropdown from click to hover
    $('.navbar .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(250).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).fadeOut(200);
    });
	    
});
