/**
 * ChatSKU FAQ Accordion + Sidebar
 * Matches page-faq.php HTML: .faq-accordion__trigger / .faq-accordion__item / .faq-accordion__body
 * Sidebar: .faq-sidebar__btn[data-target="faq-section-{id}"]
 */
(function () {
    'use strict';

    // ── Accordion Items ───────────────────────────────────────────────────
    function initAccordion() {
        var triggers = document.querySelectorAll('.faq-accordion__trigger');
        if (!triggers.length) return;

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                var item     = trigger.closest('.faq-accordion__item');
                var body     = document.getElementById(trigger.getAttribute('aria-controls'));
                var isOpen   = trigger.getAttribute('aria-expanded') === 'true';

                // Close all siblings in the same accordion group
                var parent = item ? item.closest('.faq-accordion') : null;
                if (parent) {
                    parent.querySelectorAll('.faq-accordion__item').forEach(function (sibling) {
                        if (sibling !== item) {
                            var sibBtn  = sibling.querySelector('.faq-accordion__trigger');
                            var sibBody = sibling.querySelector('.faq-accordion__body');
                            if (sibBtn)  sibBtn.setAttribute('aria-expanded', 'false');
                            if (sibBody) sibBody.hidden = true;
                        }
                    });
                }

                // Toggle current
                trigger.setAttribute('aria-expanded', String(!isOpen));
                if (body) body.hidden = isOpen;
            });

            // Keyboard: Enter / Space
            trigger.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    trigger.click();
                }
            });
        });

        // Open first item in each accordion group by default
        document.querySelectorAll('.faq-accordion').forEach(function (acc) {
            var firstTrigger = acc.querySelector('.faq-accordion__trigger');
            var firstBody    = firstTrigger ? document.getElementById(firstTrigger.getAttribute('aria-controls')) : null;
            if (firstTrigger && firstBody) {
                firstTrigger.setAttribute('aria-expanded', 'true');
                firstBody.hidden = false;
            }
        });
    }

    // ── Sidebar Category Buttons ──────────────────────────────────────────
    function initSidebar() {
        var btns = document.querySelectorAll('.faq-sidebar__btn');
        if (!btns.length) return;

        btns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var targetId = btn.getAttribute('data-target');
                var target   = targetId ? document.getElementById(targetId) : null;

                // Update active state
                btns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');

                // Scroll target section into view
                if (target) {
                    var headerHeight = parseInt(
                        getComputedStyle(document.documentElement)
                            .getPropertyValue('--header-height') || '64',
                        10
                    );
                    var top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 16;
                    window.scrollTo({ top: top, behavior: 'smooth' });
                }
            });
        });

        // IntersectionObserver: highlight sidebar button when section is in view
        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            var id  = entry.target.id;
                            var btn = document.querySelector('.faq-sidebar__btn[data-target="' + id + '"]');
                            if (btn) {
                                btns.forEach(function (b) { b.classList.remove('is-active'); });
                                btn.classList.add('is-active');
                            }
                        }
                    });
                },
                { rootMargin: '-20% 0px -60% 0px', threshold: 0 }
            );

            document.querySelectorAll('.faq-category[id]').forEach(function (section) {
                io.observe(section);
            });
        }
    }

    // ── FAQ Question Box ──────────────────────────────────────────────────
    function initQuestionBox() {
        var form     = document.getElementById('faq-question-form');
        var textarea = document.getElementById('faq-question-textarea');
        var charCount= document.getElementById('faq-char-count');

        if (textarea && charCount) {
            textarea.addEventListener('input', function () {
                charCount.textContent = textarea.value.length + ' / 500';
            });
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                var question = textarea ? textarea.value.trim() : '';
                if (!question) return;
                window.location.href = '/contact/?question=' + encodeURIComponent(question);
            });
        }
    }

    // ── Init ──────────────────────────────────────────────────────────────
    function init() {
        initAccordion();
        initSidebar();
        initQuestionBox();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
