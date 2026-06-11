/**
 * ChatSKU Main JavaScript
 * Module initializer — runs after nav.js and animations.js are loaded
 */
(function () {
    'use strict';

    // ── Copy any code snippet block ────────────────────────────────────────
    document.querySelectorAll('.embed-code-block__copy').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const block  = btn.closest('.embed-code-block');
            const codeEl = block ? block.querySelector('.embed-code-block__code, code') : null;
            if (!codeEl) return;

            const text = codeEl.textContent.trim();
            navigator.clipboard.writeText(text).then(function () {
                const orig = btn.textContent;
                btn.textContent = '✓ Copied';
                setTimeout(function () { btn.textContent = orig; }, 2000);
            });
        });
    });

    // ── Smooth scroll for anchor links ─────────────────────────────────────
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(anchor.getAttribute('href'));
            if (!target) return;
            e.preventDefault();

            const headerHeight = document.getElementById('site-header')?.offsetHeight || 72;
            const top = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;
            window.scrollTo({ top: top, behavior: 'smooth' });
        });
    });

    // ── Pricing toggle (monthly / annual) ─────────────────────────────────
    function initPricingToggle() {
        const toggle   = document.getElementById('pricing-toggle');
        const prices   = document.querySelectorAll('[data-monthly][data-annual]');

        if (!toggle) return;

        toggle.addEventListener('change', function () {
            const isAnnual = toggle.checked;

            prices.forEach(function (el) {
                el.textContent = isAnnual ? el.dataset.annual : el.dataset.monthly;
            });

            document.querySelectorAll('.pricing-billing-label').forEach(function (label) {
                label.textContent = isAnnual ? label.dataset.annual : label.dataset.monthly;
            });
        });
    }

    initPricingToggle();

    // ── External link indicator ────────────────────────────────────────────
    document.querySelectorAll('a[target="_blank"]').forEach(function (link) {
        if (!link.querySelector('.sr-only')) {
            link.insertAdjacentHTML('beforeend', '<span class="sr-only"> (opens in new tab)</span>');
        }
    });

})();
