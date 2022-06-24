/**
 * File scipts.js.
 */

// On page load set theme mode
let bcbOnpageLoad = localStorage.getItem("bcbThemeMode") || "";
let bodyElement = document.body;
if(bcbOnpageLoad) {
    bodyElement.classList.add(bcbOnpageLoad);
}

// Toggle theme mode
function bcbModeToggle() {
    bodyElement.classList.toggle("bcb-dark-mode");
    let bcbThemeMode = localStorage.getItem("bcbThemeMode");
    if (bcbThemeMode && bcbThemeMode === "bcb-dark-mode") {
        localStorage.setItem("bcbThemeMode", "");
    } else {
        localStorage.setItem("bcbThemeMode", "bcb-dark-mode");
    }
}

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
    let sidebarCardUl = document.querySelectorAll('#sidebar .card ul, #sidebar .custom-html-widget');
    sidebarCardUl.forEach(function(ul) {
        ul.outerHTML = `<div class="card-body">${ul.outerHTML}</div>`;
    });

    // Change dropdown from click to hover
    let navbarDropdown = document.querySelectorAll('.navbar .dropdown');
    navbarDropdown.forEach(function(dropdown) {
        dropdown.addEventListener('mouseenter', function( event ) {   
            dropdownMenu = this.querySelector('.dropdown-menu');
                dropdownMenu.style.display = 'block';
      
        });
        dropdown.addEventListener('mouseleave', function( event ) {   
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

    // Add data attribute to any div that has a class of '.fixed-top'
    let classOfFixedTop = document.querySelector('.fixed-top');
    if(classOfFixedTop) {
        classOfFixedTop.setAttribute('data-toggle', 'sticky-onscroll');
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

    jQuery('[data-toggle="sticky-onscroll"]').each(function () {
        let sticky = jQuery(this);
        let stickyWrapper = jQuery('<div>').addClass('sticky-wrapper');
        sticky.before(stickyWrapper);

        // Scroll & resize events
        jQuery(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function () {
            stickyToggle(sticky, stickyWrapper, jQuery(this));
        });

        // On page load
        stickyToggle(sticky, stickyWrapper, jQuery(window));
    });

    // The cookie name
    let bcbCookieName = 'bcbPopup'; 
    
    // Cookie expiry in days
    let bcbCookieLifetime = 1; 
 
    // Set cookie
    let _setCookie = function (cname, cvalue, exdays) {
        let d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    };
 
    // Get cookie
    let _getCookie = function (cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    };
 
    // Should the cookie popup be shown?
    let _shouldShowPopup = function () {
        if (_getCookie(bcbCookieName)) {
            return false;
        } else {
            return true;
        }
    };
 
    // Show the cookie popup on load
    if (_shouldShowPopup()) {
        setTimeout(function() {
            jQuery('#bcb-popup').modal('show');
        }, 3000)
    }
 
    // Modal dismiss
    jQuery('[data-bs-dismiss="modal"]').on('click', function () {
        _setCookie(bcbCookieName, 1, bcbCookieLifetime);
    });

});