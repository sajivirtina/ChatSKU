<?php
/**
 * Contact Page Template
 * Template Name: Contact
 *
 * @package ChatSKU
 */

get_header();
?>

<style>
/* ─── Contact Page ────────────────────────────────────────────────── */
.contact-page {
    min-height: 100vh;
    background: var(--color-bg-primary, #0f172a);
    padding: 96px 16px 80px;
}

.contact-page__inner {
    max-width: 560px;
    margin: 0 auto;
}

.contact-page__heading {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 700;
    color: var(--color-text-primary, #f8fafc);
    margin: 0 0 12px;
    line-height: 1.15;
}

.contact-page__subtext {
    font-size: 1rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0 0 40px;
    line-height: 1.6;
}

/* Revenutize embed wrapper */
.contact-revenutize-wrap {
    position: relative;
    min-height: 320px;
}

.contact-spinner {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.contact-spinner__ring {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(0, 201, 177, 0.15);
    border-top-color: var(--color-accent, #00C9B1);
    border-radius: 50%;
    animation: contact-spin 0.7s linear infinite;
}

@keyframes contact-spin {
    to { transform: rotate(360deg); }
}
</style>

<main id="main" class="contact-page">
    <div class="contact-page__inner">

        <h1 class="contact-page__heading">Get in touch</h1>
        <p class="contact-page__subtext">We typically respond within a few hours.</p>

        <!-- Revenutize embed — token div + inline script must stay adjacent -->
        <div class="contact-revenutize-wrap" id="contact-embed-wrap">

            <!-- Spinner: hidden once Revenutize form loads -->
            <div class="contact-spinner" id="contact-spinner" aria-label="Loading contact form">
                <span class="contact-spinner__ring"></span>
            </div>

            <div data-cf-token="af175cab1678fbf8897bb299afc5d6fb92e8234926d5fd3bba6c62882ef17efe"></div>
            <script>
            (function(){
                var t = "af175cab1678fbf8897bb299afc5d6fb92e8234926d5fd3bba6c62882ef17efe",
                    u = "https://revenutize.com";
                var s = document.createElement("script");
                s.src = u + "/api/public/forms/widget.js";
                s.setAttribute("data-token", t);
                s.setAttribute("data-base-url", u);
                s.onload = s.onerror = function() {
                    var spinner = document.getElementById("contact-spinner");
                    if (spinner) spinner.style.display = "none";
                };
                // Insert before this <script> so widget.js finds [data-cf-token] as previousSibling
                document.currentScript.parentNode.insertBefore(s, document.currentScript);
            })();
            </script>

        </div>

    </div>
</main>

<?php get_footer(); ?>
