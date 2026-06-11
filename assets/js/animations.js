/**
 * ChatSKU Scroll Reveal Animations
 * Uses IntersectionObserver to add .is-visible when elements enter viewport
 */
(function () {
    'use strict';

    // Skip if IntersectionObserver not supported
    if (!('IntersectionObserver' in window)) {
        // Fallback: show all elements immediately
        document.querySelectorAll('.reveal').forEach(function (el) {
            el.classList.add('is-visible');
        });
        return;
    }

    const observer = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target); // Only animate once
                }
            });
        },
        {
            threshold: 0.1,      // Trigger when 10% visible
            rootMargin: '0px 0px -40px 0px', // 40px early trigger
        }
    );

    // Observe all .reveal elements
    function initObservers() {
        document.querySelectorAll('.reveal').forEach(function (el) {
            observer.observe(el);
        });
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initObservers);
    } else {
        initObservers();
    }

    // Counter animation for stats
    function animateCounter(el) {
        const target   = parseInt(el.dataset.count || el.textContent, 10);
        const duration = 1500;
        const start    = performance.now();
        const suffix   = el.dataset.suffix || '';

        if (isNaN(target)) return;

        function update(now) {
            const elapsed  = now - start;
            const progress = Math.min(elapsed / duration, 1);
            // Ease out cubic
            const eased    = 1 - Math.pow(1 - progress, 3);
            const current  = Math.floor(eased * target);

            el.textContent = current.toLocaleString() + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.textContent = target.toLocaleString() + suffix;
            }
        }

        requestAnimationFrame(update);
    }

    // Observe counter elements
    const counterObserver = new IntersectionObserver(
        function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.5 }
    );

    document.querySelectorAll('[data-count]').forEach(function (el) {
        counterObserver.observe(el);
    });

})();
