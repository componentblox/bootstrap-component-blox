/**
 * File scipts.js.
 */

jQuery(document).ready(function($) {
	
	// Add Bootstrap dropdown classes to nested menu items
    let menuItemHasChildren = document.querySelectorAll('.navbar .menu-item-has-children');
    menuItemHasChildren.forEach(function(childItem) {
        childItem.classList.add('dropdown');
    });

    // Add Bootstrap toggle classes to nested menu items
    let menuItemHasChildrenAnchor = document.querySelectorAll('.navbar .menu-item-has-children > a');
    menuItemHasChildrenAnchor.forEach(function(childItemAnchor) {
        childItemAnchor.classList.add('dropdown-toggle');
    });

    // Add animation class to dropdown menu
    let addAnimationClasses = document.querySelectorAll('.navbar .dropdown-menu');
    addAnimationClasses.forEach(function(animationClasses) {
        animationClasses.classList.add('sub-menu-animate' , 'slideUp');
    });
 
    // Add attributes to sub menus
    let menuAttributes = document.querySelectorAll('.dropdown-toggle');
    menuAttributes.forEach(function(attributes) {
        function setAttributes(el, options) {
            Object.keys(options).forEach(function(attr) {
                el.setAttribute(attr, options[attr]);
            })
        }
        setAttributes(attributes, {"role": "button", "aria-haspopup": "true", "aria-expanded": "false" , "data-toggle": "dropdown" });
    });

    // Add Bootstrap toggle classes to nested menu items
    let sidebarCardUl = document.querySelectorAll('#sidebar .card ul');
    let cardUl = sidebarCardUl;
    cardUl.forEach(function(ul) {
        ul.outerHTML = `<div class="card-body">${ul.outerHTML}</div>`;
    });

    // Change dropdown from click to hover
    let navbarDropdown = document.querySelectorAll('.navbar .dropdown');
    navbarDropdown.forEach(function(dropdown) {
        dropdown.addEventListener("mouseenter", function( event ) {   
            dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.style.display = 'block';
      
        });
        dropdown.addEventListener("mouseleave", function( event ) {   
            dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.style.display = 'none';
      
        });
    });

    // Add Bootstrap pagination classes
    let paginationIndex = document.querySelectorAll('.pagination a, .pagination span');
    paginationIndex.forEach(function(index) {
        index.classList.add('page-link');
    });

    // Add class to body tag when user scrolls
    let scrollPosition = window.scrollY;
    let body = document.getElementsByTagName('body')[0];
    window.addEventListener('scroll', function() {
        scrollPosition = window.scrollY;
        
        if(scrollPosition >= 100) {
            body.classList.add('scrolled');
        } else {
            body.classList.remove('scrolled');
        }
    });

    // Add data attribute for Navbar
    let navbar = document.querySelector('.navbar');
    let hasFixedTop = navbar.classList.contains('fixed-top');
    if (hasFixedTop == true) {
       navbar.setAttribute('data-toggle', 'sticky-onscroll')
    }

    // Sticky Navbar
    let stickyToggle = function (sticky, stickyWrapper, scrollElement) {
        let stickyHeight = sticky.outerHeight();
        let stickyTop = stickyWrapper.offset().top;
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
        let sticky = $(this);
        let stickyWrapper = $('<div>').addClass('sticky-wrapper');
        sticky.before(stickyWrapper);

        // Scroll & resize events
        $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function () {
            stickyToggle(sticky, stickyWrapper, $(this));
        });

        // On page load
        stickyToggle(sticky, stickyWrapper, $(window));
    });


     
});