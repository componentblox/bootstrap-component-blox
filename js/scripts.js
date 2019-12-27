/**
 * File scipts.js.
 */

jQuery(document).ready(function() {

	let $ = jQuery
	
	$("false ul").addClass("navbar-nav ml-auto");
	
	// Resize Body Container Based on Navbar Height
	$('article > .entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());
	
	$(window).resize(function(){
  		$('article > .entry-content, #sidebar').css('margin-top', $('#nav-header .fixed-top').height());
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

    // Add Bootstrap Pagination Classes
    $( ".pagination a" ).wrap( "<li class='page-item'></li>" );
    $( ".pagination a, .pagination span" ).addClass("page-link");

    // Add class to body tag when user scrolls
    var scrolled_class = $("body");
      
    $(window).scroll(function() {    
          
    var scroll = $(window).scrollTop();
        if (scroll >= 100) {
            scrolled_class.addClass("scrolled");
        } else {
            scrolled_class.removeClass("scrolled");
        }
    });
     
});
