jQuery(document).ready(function() {

	let $ = jQuery
	
	$("false ul").addClass("navbar-nav ml-auto");
	
	// Resize Body Container Based on Navigation Height
	$('.entry-content, #sidebar').css('padding-top', $('#nav-header .fixed-top').height());
	
	$(window).resize(function(){
  		$('.entry-content, #sidebar').css('padding-top', $('#nav-header .fixed-top').height());
	});
	
	// Wrap widget with card-body class
	$('#footer-widgets .card-header , #sidebar .card-header ').next().wrap('<div class="card-body"></div>');

	 // Bootstrap Classes
    $(".navbar .menu-item-has-children").addClass("dropdown");
    $(".navbar .menu-item-has-children > a").addClass("dropdown-toggle");

    // Add Attributes to sub menu
    $(".dropdown-toggle").attr({
     'role': "button",
     'aria-haspopup': "true",
     'aria-expanded': "false",
     'data-toggle': "dropdown",
    });

    // Change dropdown from click to hover
    $('.navbar .dropdown').hover(function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
		$(this).find('.fa-angle-right').first().css({'transform' : 'rotate(90deg)', 'transition' : 'all .4s'});
    }, function() {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();
		$(this).find('.fa-angle-right').first().css({'transform' : 'rotate(0deg)' , 'transition' : 'all .4s'});
    });
	    
});
