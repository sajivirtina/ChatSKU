<?php
/**
 * Signup Page Template
 * Template Name: Signup
 *
 * @package ChatSKU
 */

get_header();
?>

<style>
/* ─── Signup Page ─────────────────────────────────────────────────── */
.signup-page {
    display: flex;
    flex-direction: row;
    min-height: 100vh;
    padding-top: var(--header-height, 64px);
    background: var(--color-bg-primary, #0f172a);
}

/* Left: form area */
.signup-page__form-side {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 48px 32px;
}

.signup-page__form-inner {
    width: 100%;
    max-width: 520px;
}

.signup-page__heading {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: clamp(1.75rem, 3vw, 2.25rem);
    font-weight: 700;
    color: var(--color-text-primary, #f8fafc);
    margin: 0 0 12px;
    line-height: 1.2;
}

.signup-page__subtitle {
    font-size: 1rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0 0 36px;
    line-height: 1.6;
}

/* Revenutize embed wrapper */
.signup-revenutize-wrap {
    position: relative;
    min-height: 320px;
}

.signup-revenutize-wrap .signup-spinner {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

.signup-spinner__ring {
    width: 40px;
    height: 40px;
    border: 3px solid rgba(0,201,177,0.15);
    border-top-color: var(--color-accent, #00C9B1);
    border-radius: 50%;
    animation: signup-spin 0.7s linear infinite;
}

@keyframes signup-spin {
    to { transform: rotate(360deg); }
}

/* Right: info panel */
.signup-page__info-side {
    display: none;
    width: 420px;
    flex-shrink: 0;
    background: var(--color-bg-secondary, #1e293b);
    border-left: 1px solid var(--color-border, rgba(255,255,255,0.08));
    padding: 48px;
    position: relative;
    overflow: hidden;
    flex-direction: column;
    justify-content: center;
}

/* Radial teal glow */
.signup-page__info-side::before {
    content: '';
    position: absolute;
    top: -120px;
    right: -80px;
    width: 420px;
    height: 420px;
    background: radial-gradient(circle, rgba(0,201,177,0.18) 0%, transparent 70%);
    pointer-events: none;
    z-index: 0;
}

.signup-page__info-side > * {
    position: relative;
    z-index: 1;
}

.signup-info__logo {
    display: block;
    margin-bottom: 40px;
}

.signup-info__logo img {
    height: 32px;
    width: auto;
    display: block;
}

.signup-info__heading {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--color-text-primary, #f8fafc);
    margin: 0 0 14px;
    line-height: 1.3;
}

.signup-info__lead {
    font-size: 0.9rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0 0 32px;
    line-height: 1.65;
}

/* Feature list */
.signup-feature-list {
    list-style: none;
    margin: 0 0 32px;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

.signup-feature-list__item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.signup-feature-list__icon {
    flex-shrink: 0;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    background: rgba(0,201,177,0.1);
    border: 1px solid rgba(0,201,177,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-accent, #00C9B1);
}

.signup-feature-list__text {
    font-size: 0.875rem;
    color: var(--color-text-primary, #f8fafc);
    line-height: 1.5;
    padding-top: 9px;
}

/* Free plan box */
.signup-free-plan {
    background: rgba(0,201,177,0.07);
    border: 1px solid rgba(0,201,177,0.2);
    border-radius: 10px;
    padding: 18px 20px;
}

.signup-free-plan__label {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--color-accent, #00C9B1);
    margin: 0 0 8px;
}

.signup-free-plan__items {
    font-size: 0.84rem;
    color: var(--color-text-primary, #f8fafc);
    margin: 0 0 6px;
    line-height: 1.55;
}

.signup-free-plan__note {
    font-size: 0.75rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0;
    line-height: 1.5;
}

@media (min-width: 900px) {
    .signup-page__info-side {
        display: flex;
    }
}
</style>

<main id="main" class="signup-page">

    <!-- Left: Form Side -->
    <div class="signup-page__form-side">
        <div class="signup-page__form-inner">
            <h1 class="signup-page__heading">Start selling in minutes</h1>
            <p class="signup-page__subtitle">Tell us a bit about your business and we'll get you set up.</p>

            <!-- Revenutize embed container -->
            <div class="signup-revenutize-wrap" id="signup-embed-wrap">
                <!-- Loading spinner (hidden once form loads) -->
                <div class="signup-spinner" id="signup-spinner" aria-label="Loading signup form">
                    <span class="signup-spinner__ring"></span>
                </div>
                <!-- Revenutize: token div + inline script must be adjacent -->
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
                        var spinner = document.getElementById("signup-spinner");
                        if (spinner) spinner.style.display = "none";
                    };
                    // Insert before this script so widget.js finds [data-cf-token] as its previousSibling
                    document.currentScript.parentNode.insertBefore(s, document.currentScript);
                })();
                </script>
            </div>
        </div>
    </div>

    <!-- Right: Info Side (hidden on mobile) -->
    <aside class="signup-page__info-side" aria-label="Why ChatSKU">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="signup-info__logo" aria-label="ChatSKU — Home">
            <?php if ( has_custom_logo() ) :
                $logo_id = get_theme_mod( 'custom_logo' );
                echo wp_get_attachment_image( $logo_id, 'full', false, [
                    'style' => 'height:32px;width:auto;display:block;',
                    'alt'   => 'ChatSKU',
                ] );
            else : ?>
                <span style="font-size:22px;font-weight:800;color:var(--color-accent);">ChatSKU</span>
            <?php endif; ?>
        </a>

        <h2 class="signup-info__heading">Everything you need to start selling.</h2>
        <p class="signup-info__lead">Join B2B businesses that are turning their static catalogs into live buying experiences.</p>

        <!-- Feature list -->
        <ul class="signup-feature-list">

            <!-- Chat icon -->
            <li class="signup-feature-list__item">
                <span class="signup-feature-list__icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                    </svg>
                </span>
                <span class="signup-feature-list__text">AI that knows your entire catalog from day one</span>
            </li>

            <!-- Check icon -->
            <li class="signup-feature-list__item">
                <span class="signup-feature-list__icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </span>
                <span class="signup-feature-list__text">Most stores go live the same day they sign up</span>
            </li>

            <!-- Zap icon -->
            <li class="signup-feature-list__item">
                <span class="signup-feature-list__icon" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
                    </svg>
                </span>
                <span class="signup-feature-list__text">One line of code — no developers needed</span>
            </li>

        </ul>

        <!-- Free plan box -->
        <div class="signup-free-plan">
            <p class="signup-free-plan__label">Free plan includes:</p>
            <p class="signup-free-plan__items">50 products · AI chat widget · Quote management · 1 admin user</p>
            <p class="signup-free-plan__note">90 days or until your first quote — whichever comes first.</p>
        </div>

    </aside>

</main>

<?php get_footer(); ?>
