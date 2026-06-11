/**
 * ChatSKU Navigation
 * Handles: sticky header scroll class, mobile menu open/close
 */
(function () {
    'use strict';

    const header      = document.getElementById('site-header');
    const hamburger   = document.getElementById('header-hamburger');
    const mobileMenu  = document.getElementById('mobile-menu');
    const closeBtn    = document.getElementById('mobile-menu-close');
    const overlay     = document.getElementById('mobile-menu-overlay');

    // ── Sticky header scroll class ────────────────────────────────────────
    if (header) {
        let lastScroll = 0;
        let ticking    = false;

        function onScroll() {
            const currentScroll = window.scrollY;

            if (currentScroll > 50) {
                header.classList.add('is-scrolled');
            } else {
                header.classList.remove('is-scrolled');
            }

            lastScroll = currentScroll;
            ticking    = false;
        }

        window.addEventListener('scroll', function () {
            if (!ticking) {
                requestAnimationFrame(onScroll);
                ticking = true;
            }
        }, { passive: true });

        // Run once on load
        onScroll();
    }

    // ── Mobile menu ───────────────────────────────────────────────────────
    function openMenu() {
        if (!mobileMenu || !hamburger) return;
        mobileMenu.classList.add('is-open');
        hamburger.setAttribute('aria-expanded', 'true');
        mobileMenu.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';

        // Focus first link in menu
        const firstLink = mobileMenu.querySelector('a, button');
        if (firstLink) setTimeout(() => firstLink.focus(), 300);
    }

    function closeMenu() {
        if (!mobileMenu || !hamburger) return;
        mobileMenu.classList.remove('is-open');
        hamburger.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        hamburger.focus();
    }

    if (hamburger) hamburger.addEventListener('click', openMenu);
    if (closeBtn)  closeBtn.addEventListener('click', closeMenu);
    if (overlay)   overlay.addEventListener('click', closeMenu);

    // Close on Escape key
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('is-open')) {
            closeMenu();
        }
    });

    // ── Sub-menu accordion ────────────────────────────────────────────────
    if (mobileMenu) {
        // Inject a toggle button next to each parent link
        mobileMenu.querySelectorAll('.menu-item-has-children').forEach(function (item) {
            var subMenu = item.querySelector('.sub-menu');
            if (!subMenu) return;

            var btn = document.createElement('button');
            btn.className = 'mobile-submenu-toggle';
            btn.type = 'button';
            btn.setAttribute('aria-label', 'Toggle sub-menu');
            btn.setAttribute('aria-expanded', 'false');
            btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>';

            // Wrap parent <a> + toggle button in a flex row so button stays at the top
            var parentLink = item.querySelector(':scope > a');
            if (!parentLink) return;
            var row = document.createElement('div');
            row.className = 'mobile-parent-row';
            parentLink.replaceWith(row);
            row.appendChild(parentLink);
            row.appendChild(btn);

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                var isOpen = item.classList.contains('is-open');

                // Close all sibling sub-menus
                var siblings = item.parentElement
                    ? item.parentElement.querySelectorAll('.menu-item-has-children.is-open')
                    : [];
                siblings.forEach(function (s) {
                    s.classList.remove('is-open');
                    var sBtn = s.querySelector(':scope > .mobile-submenu-toggle');
                    if (sBtn) sBtn.setAttribute('aria-expanded', 'false');
                });

                // Toggle this one
                if (!isOpen) {
                    item.classList.add('is-open');
                    btn.setAttribute('aria-expanded', 'true');
                }
            });
        });
    }

    // Close menu when a non-parent link is clicked
    if (mobileMenu) {
        mobileMenu.querySelectorAll('a').forEach(function (link) {
            // Skip parent links that just toggle sub-menus
            if (link.closest('.menu-item-has-children') &&
                link.parentElement.classList.contains('menu-item-has-children')) return;
            link.addEventListener('click', closeMenu);
        });
    }

    // ── Active nav item ───────────────────────────────────────────────────
    // Mark the current page's nav link as active
    const currentPath = window.location.pathname;
    document.querySelectorAll('.header-nav__link, .mobile-menu__link').forEach(function (link) {
        const linkPath = new URL(link.href, window.location.origin).pathname;
        if (linkPath === currentPath) {
            link.closest('li')?.classList.add('is-active');
        }
    });

})();
