jQuery(document).ready(function() {

	let $ = jQuery
	
	$("false ul").addClass("navbar-nav ml-auto");
	
	// Resize Body Container Based on Navigation Height
	$('.entry-content, #sidebar').css('padding-top', $('#nav-header .fixed-top').height());
	
	$(window).resize(function(){
  		$('.entry-content, #sidebar').css('padding-top', $('#nav-header .fixed-top').height());
	});
	
	$('#footer-widgets .card-header , #sidebar .card-header ').next().wrap('<div class="card-body"></div>');
	    
});
