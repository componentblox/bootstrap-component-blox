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
    let menuItemHasChildren = document.querySelectorAll('.navbar .menu-item-has-children:not(.bcb-mega-menu)');
    menuItemHasChildren.forEach(function(childItem) {
        childItem.classList.add('dropdown');
    });

    // Add Bootstrap toggle classes to nested menu items
    let menuItemHasChildrenAnchor = document.querySelectorAll('.navbar .menu-item-has-children:not(.bcb-mega-menu) > a');
    menuItemHasChildrenAnchor.forEach(function(childItemAnchor) {
        childItemAnchor.classList.add('dropdown-toggle');
    });

    // Add animation class to dropdown menu
    let addAnimationClasses = document.querySelectorAll('.navbar .dropdown-menu');
    addAnimationClasses.forEach(function(animationClasses) {
        animationClasses.classList.add('sub-menu-animate' , 'slideUp');
    });

    // Add Bootstrap toggle classes to nested menu items
    let sidebarCardUl = document.querySelectorAll('#sidebar .card ul, #sidebar .custom-html-widget');
    sidebarCardUl.forEach(function(ul) {
        ul.outerHTML = `<div class="card-body">${ul.outerHTML}</div>`;
    });

    // Change dropdown from click to hover, only for non mega-menus
    let navbarDropdown = document.querySelectorAll('.navbar .dropdown:not(.bcb-mega-menu)');
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
    
    // Reposition Mega Menu Modals right under the corresponding .bcb-mega-menu links
    let megaMenuItems = document.querySelectorAll('.navbar .bcb-mega-menu > a'); // This targets anchor tags within .bcb-mega-menu items.
    megaMenuItems.forEach(function(menuLink) {
        let modalId = 'bcb-menu-item-' + menuLink.parentNode.id.split("-")[2]; // parentNode refers to the .bcb-mega-menu element.
        let modalElement = document.getElementById(modalId);
        
        if (modalElement) {
            // Insert the modal directly after the menu link
            menuLink.insertAdjacentElement('afterend', modalElement);
        }
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

    // Sticky Navbar
    function stickyToggle(sticky, stickyWrapper) {
        let stickyHeight = sticky.offsetHeight;
        let stickyTop = stickyWrapper.offsetTop;
        let scrollPosition = window.scrollY || window.pageYOffset;

        if (scrollPosition >= stickyTop) {
            stickyWrapper.style.height = `${stickyHeight}px`;
            sticky.classList.add('fixed-top');
        } else {
            sticky.classList.remove('fixed-top');
            stickyWrapper.style.height = 'auto';
        }
    }

    // Apply sticky behavior to every element with the class '.fixed-top'
    let classOfFixedTops = document.querySelectorAll('.fixed-top');

    classOfFixedTops.forEach(function(element) {
        let stickyWrapper = document.createElement('div');
        stickyWrapper.className = 'sticky-wrapper';

        element.parentNode.insertBefore(stickyWrapper, element);
        stickyWrapper.appendChild(element);

        // On page load
        stickyToggle(element, stickyWrapper);

    });

    // Modal Popup

    // Cookie name
    let bcbCookieName = 'bcbPopup'; 
    
    // Set cookie expiry time
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

    let bcbPopup = document.getElementById('bcb-popup');
 
    // Show the cookie popup on load
    if (_shouldShowPopup()) {
        setTimeout(function() {
            jQuery('#bcb-popup').modal('show');
        }, 3000)
    }
 
    // Modal dismiss
    if(bcbPopup) {
        bcbPopup.addEventListener('hidden.bs.modal', event => {
            _setCookie(bcbCookieName, 1, bcbCookieLifetime);
        });
    }

});