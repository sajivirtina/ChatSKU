<?php
/**
 * Site Footer
 *
 * @package ChatSKU
 */

$logo = chatsku_option( 'site_logo' );
?>

<footer class="site-footer" role="contentinfo">

    <!-- ── Main footer grid ──────────────────────────────────────────────── -->
    <div class="footer-main">
        <div class="container footer-main__grid">

            <!-- Column 1: Brand -->
            <div class="footer-brand">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-brand__logo-link" aria-label="<?php bloginfo( 'name' ); ?> — Home">
                    <?php if ( $logo && is_array( $logo ) && ! empty( $logo['url'] ) ) : ?>
                        <img
                            src="<?php echo esc_url( $logo['url'] ); ?>"
                            alt="<?php echo esc_attr( $logo['alt'] ?: get_bloginfo( 'name' ) ); ?>"
                            class="footer-brand__logo-img"
                        >
                    <?php elseif ( has_custom_logo() ) : ?>
                        <?php
                        $logo_id  = get_theme_mod( 'custom_logo' );
                        $logo_img = wp_get_attachment_image( $logo_id, 'full', false, [
                            'class' => 'footer-brand__logo-img',
                            'alt'   => get_bloginfo( 'name' ),
                        ] );
                        echo $logo_img; // phpcs:ignore
                        ?>
                    <?php else : ?>
                        <span class="footer-brand__logo-text"><?php bloginfo( 'name' ); ?></span>
                    <?php endif; ?>
                </a>

                <p class="footer-brand__tagline">One line of code, one day.</p>
                <p class="footer-brand__desc">AI-powered chat commerce for B2B businesses. Turn your catalog into a buying experience.</p>
            </div><!-- .footer-brand -->

            <!-- Column 2: Product -->
            <div class="footer-column">
                <h4 class="footer-column__heading">Product</h4>
                <?php
                if ( has_nav_menu( 'footer' ) ) {
                    wp_nav_menu( [
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-column__links',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    ] );
                } else {
                ?>
                <ul class="footer-column__links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/demo/' ) ); ?>">Demo</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/features/' ) ); ?>">Features</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/problems/' ) ); ?>">Problems</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/pricing/' ) ); ?>">Pricing</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/privacy/' ) ); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">Terms of Service</a></li>
                </ul>
                <?php } ?>
            </div><!-- .footer-column -->

            <!-- Column 3: Contact -->
            <div class="footer-column">
                <h4 class="footer-column__heading">Contact</h4>
                <ul class="footer-column__links">
                    <li>
                        <a href="mailto:hello@chatsku.com" class="footer-contact-email">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex-shrink:0;margin-top:1px;">
                                <rect x="2" y="4" width="20" height="16" rx="2"/>
                                <polyline points="2,4 12,13 22,4"/>
                            </svg>
                            hello@chatsku.com
                        </a>
                    </li>
                </ul>
            </div><!-- .footer-column -->

        </div><!-- .footer-main__grid -->
    </div><!-- .footer-main -->

    <!-- ── Bottom bar ────────────────────────────────────────────────────── -->
    <div class="footer-bottom">
        <div class="container footer-bottom__inner">

            <!-- Left: copyright -->
            <p class="footer-bottom__copy">
                &copy; 2025 ChatSKU. All rights reserved.
            </p>

            <!-- Center: built-by credits -->
            <p class="footer-bottom__credits">
                Built by&nbsp;<a href="https://virtina.com?src=ChatSku" target="_blank" rel="noopener noreferrer">Virtina</a>
                <span class="footer-bottom__dot" aria-hidden="true">&nbsp;&middot;&nbsp;</span>
                Intelligence by&nbsp;<a href="https://impelhub.com?src=ChatSku" target="_blank" rel="noopener noreferrer">ImpelHub</a>
            </p>

            <!-- Right: tagline (hidden on mobile) -->
            <p class="footer-bottom__tagline">
                Built for B2B commerce
            </p>

        </div><!-- .footer-bottom__inner -->
    </div><!-- .footer-bottom -->

</footer><!-- .site-footer -->

<style>
/* ─── Site Footer ─────────────────────────────────────────────────── */
.site-footer {
    background: var(--color-bg-secondary, #1e293b);
    border-top: 1px solid var(--color-border, rgba(255,255,255,0.08));
    margin-top: auto;
}

/* Main grid */
.footer-main {
    padding: 56px 0 48px;
}

.footer-main__grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
}

@media (min-width: 640px) {
    .footer-main__grid {
        grid-template-columns: 1fr 1fr;
    }
}

@media (min-width: 900px) {
    .footer-main__grid {
        grid-template-columns: 1.6fr 1fr 1fr;
        gap: 48px;
    }
}

/* Brand column */
.footer-brand__logo-link {
    display: inline-block;
    margin-bottom: 18px;
}

.footer-brand__tagline {
    font-size: 0.8rem;
    font-weight: 700;
    color: var(--color-text-muted, #758AA3);
    margin: 0 0 8px;
    letter-spacing: 0.01em;
}

.footer-brand__desc {
    font-size: 0.8rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0;
    line-height: 1.65;
    max-width: 280px;
}

/* Nav columns */
.footer-column__heading {
    font-family: var(--font-heading, 'Space Grotesk', sans-serif);
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--color-text-primary, #f8fafc);
    margin: 0 0 16px;
}

.footer-column__links {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.footer-column__links a {
    font-size: 0.875rem;
    color: var(--color-text-muted, #758AA3);
    text-decoration: none;
    transition: color 0.15s ease;
}

.footer-column__links a:hover,
.footer-column__links a:focus-visible {
    color: var(--color-accent, #00C9B1);
}

/* Contact email link */
.footer-contact-email {
    display: inline-flex;
    align-items: flex-start;
    gap: 7px;
}

/* Bottom bar */
.footer-bottom {
    border-top: 1px solid var(--color-border, rgba(255,255,255,0.08));
    padding: 18px 0;
}

.footer-bottom__inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    text-align: center;
}

@media (min-width: 768px) {
    .footer-bottom__inner {
        flex-direction: row;
        justify-content: space-between;
        text-align: left;
        gap: 0;
    }
}

.footer-bottom__copy,
.footer-bottom__credits,
.footer-bottom__tagline {
    font-size: 0.75rem;
    color: var(--color-text-muted, #758AA3);
    margin: 0;
    line-height: 1.5;
}

.footer-bottom__credits a {
    color: var(--color-text-muted, #758AA3);
    text-decoration: none;
    transition: color 0.15s ease;
}

.footer-bottom__credits a:hover,
.footer-bottom__credits a:focus-visible {
    color: var(--color-accent, #00C9B1);
}

.footer-bottom__dot {
    color: var(--color-border, rgba(255,255,255,0.2));
}

/* Hide right tagline on mobile */
.footer-bottom__tagline {
    display: none;
}

@media (min-width: 640px) {
    .footer-bottom__tagline {
        display: block;
    }
}
</style>
