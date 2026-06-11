<?php
/**
 * Mobile Menu Drawer
 *
 * @package ChatSKU
 */

$login_url  = chatsku_option( 'login_url', '/login/' );
$header_cta = chatsku_option( 'header_cta_text', 'Get Started' );
$header_url = chatsku_option( 'header_cta_url', '#' );
?>
<div class="mobile-menu" id="mobile-menu" aria-hidden="true">
    <div class="mobile-menu__overlay" id="mobile-menu-overlay"></div>
    <nav class="mobile-menu__panel" aria-label="Mobile Navigation">
        <button class="mobile-menu__close" id="mobile-menu-close" aria-label="Close menu">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18"/>
                <line x1="6" y1="6" x2="18" y2="18"/>
            </svg>
        </button>

        <?php
        wp_nav_menu( [
            'theme_location' => 'primary',
            'menu_class'     => 'mobile-menu__list',
            'container'      => false,
            'fallback_cb'    => 'chatsku_mobile_fallback_menu',
            'depth'          => 2,
        ] );
        ?>

        <div class="mobile-menu__actions">
            <a href="<?php echo esc_url( $login_url ); ?>" class="mobile-menu__login">Log In</a>
            <a href="<?php echo esc_url( $header_url ); ?>" class="chatsku-btn chatsku-btn--primary mobile-menu__cta">
                <?php echo esc_html( $header_cta ); ?>
            </a>
        </div>
    </nav>
</div>

<?php
function chatsku_mobile_fallback_menu() {
    $items = [
        'Home'     => home_url( '/' ),
        'Features' => home_url( '/features/' ),
        'Demo'     => home_url( '/demo-widget/' ),
        'Pricing'  => home_url( '/pricing/' ),
        'FAQ'      => home_url( '/faq/' ),
        'Blog'     => home_url( '/blog/' ),
    ];
    echo '<ul class="mobile-menu__list">';
    foreach ( $items as $label => $url ) {
        echo '<li class="mobile-menu__item"><a href="' . esc_url( $url ) . '" class="mobile-menu__link">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}
?>
