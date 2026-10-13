/** Shared Bootstrap dropdown state; enabled only by bcb-ui-v1. */
(() => {
    'use strict';
    const init = () => {
        if (!document.body.classList.contains('bcb-ui-v1') || !window.bootstrap) return;
        const finePointer = window.matchMedia('(hover: hover) and (pointer: fine)');
        const items = [...document.querySelectorAll('.navbar .dropdown:not(.bcb-mega-menu)')];
        const isDesktop = item => {
            const navbar = item.closest('.navbar');
            const toggler = navbar && navbar.querySelector('.navbar-toggler');
            return finePointer.matches && (!toggler || getComputedStyle(toggler).display === 'none');
        };
        // Bootstrap show() focuses its trigger, even for hover. Record the actual input
        // before opening, so that programmatic focus never impersonates keyboard input.
        document.addEventListener('pointerdown', () => { document.body.dataset.bcbInput = 'pointer'; }, true);
        document.addEventListener('keydown', () => { document.body.dataset.bcbInput = 'keyboard'; }, true);
        items.forEach(item => {
            const toggle = item.querySelector(':scope > [data-bs-toggle="dropdown"]');
            if (!toggle) return;
            const dropdown = bootstrap.Dropdown.getOrCreateInstance(toggle);
            let pointerOpened = false;
            item.addEventListener('pointerenter', event => {
                if (!isDesktop(item) || event.pointerType === 'touch') return;
                // Do not interrupt a keyboard user working inside this menu.
                if (item.contains(document.activeElement) && document.body.dataset.bcbInput === 'keyboard') return;
                document.body.dataset.bcbInput = 'pointer';
                pointerOpened = true;
                dropdown.show();
            });
            item.addEventListener('pointerleave', () => {
                if (!isDesktop(item)) return;
                if ((pointerOpened && document.activeElement === toggle) || !item.contains(document.activeElement)) dropdown.hide();
            });
            item.addEventListener('keydown', event => {
                pointerOpened = false;
                if (event.key === ' ' && event.target === toggle && toggle.tagName === 'A') {
                    event.preventDefault();
                    dropdown.toggle();
                }
            });
            item.addEventListener('focusout', () => {
                setTimeout(() => {
                    if (!item.contains(document.activeElement) && !item.matches(':hover')) dropdown.hide();
                }, 0);
            });
            let wasDesktop = isDesktop(item);
            const changed = () => {
                const desktop = isDesktop(item);
                if (desktop !== wasDesktop) { dropdown.hide(); pointerOpened = false; }
                wasDesktop = desktop;
            };
            window.addEventListener('resize', changed);
            finePointer.addEventListener('change', changed);
        });
        // Native disclosure provides keyboard and no-JS support for language links.
        document.querySelectorAll('.bcb-language').forEach(details => {
            details.addEventListener('keydown', event => {
                if (event.key === 'Escape' && details.open) {
                    details.open = false;
                    details.querySelector('summary').focus();
                }
            });
            details.addEventListener('focusout', () => setTimeout(() => {
                if (!details.contains(document.activeElement)) details.open = false;
            }, 0));
            document.addEventListener('pointerdown', event => {
                if (!details.contains(event.target)) details.open = false;
            });
        });
    };
    // Parent prepares dropdown markup in its earlier jQuery ready callback.
    window.jQuery(init);
})();
