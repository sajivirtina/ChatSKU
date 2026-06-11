<?php
/**
 * Glassmorphism Sticky Header
 *
 * @package ChatSKU
 */

$logo          = chatsku_option( 'site_logo' );
$logo_dark     = chatsku_option( 'site_logo_dark' );
$header_cta    = chatsku_option( 'header_cta_text', 'Get Started' );
$header_url    = chatsku_option( 'header_cta_url', '/signup/' );
$login_url     = chatsku_option( 'login_url', 'https://app.chatsku.com/login' );
$is_front_page = is_front_page();
?>
<header class="site-header" id="site-header" role="banner">
    <div class="header-inner container">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header-logo" aria-label="<?php bloginfo( 'name' ); ?> — Home">
            <?php if ( $logo_dark && is_array( $logo_dark ) && ! empty( $logo_dark['url'] ) ) : ?>
                <img
                    src="<?php echo esc_url( $logo_dark['url'] ); ?>"
                    alt="<?php echo esc_attr( $logo_dark['alt'] ?: get_bloginfo( 'name' ) ); ?>"
                    class="header-logo__img"
                >
            <?php elseif ( $logo && is_array( $logo ) && ! empty( $logo['url'] ) ) : ?>
                <img
                    src="<?php echo esc_url( $logo['url'] ); ?>"
                    alt="<?php echo esc_attr( $logo['alt'] ?: get_bloginfo( 'name' ) ); ?>"
                    class="header-logo__img"
                >
            <?php elseif ( has_custom_logo() ) : ?>
                <?php
                // Use wp_get_attachment_image() to get just the <img> without a nested <a> wrapper
                $logo_id = get_theme_mod( 'custom_logo' );
                echo wp_get_attachment_image( $logo_id, 'full', false, [
                    'class'   => 'header-logo__img',
                    'alt'     => get_bloginfo( 'name' ),
                    'loading' => 'eager',
                ] );
                ?>
            <?php else : ?>
                <span class="header-logo__text"><?php bloginfo( 'name' ); ?></span>
            <?php endif; ?>
        </a>

        <!-- Primary Navigation -->
        <nav class="header-nav" id="header-nav" aria-label="Primary Navigation">
            <?php
            $printed = false;
            if ( has_nav_menu( 'primary' ) ) {
                $menu_html = wp_nav_menu( [
                    'theme_location' => 'primary',
                    'menu_class'     => 'header-nav__menu',
                    'container'      => false,
                    'fallback_cb'    => '__return_false',
                    'depth'          => 2,
                    'walker'         => class_exists( 'ChatSKU_Nav_Walker' ) ? new ChatSKU_Nav_Walker() : '',
                    'echo'           => false,
                ] );
                if ( $menu_html ) {
                    echo $menu_html; // phpcs:ignore WordPress.Security.EscapeOutput
                    $printed = true;
                }
            }
            if ( ! $printed ) {
                chatsku_fallback_menu();
            }
            ?>
        </nav>

        <!-- Header Actions -->
        <div class="header-actions">
            <a href="<?php echo esc_url( $login_url ); ?>" class="header-actions__login">Log In</a>
            <a href="<?php echo esc_url( $header_url ); ?>" class="chatsku-btn chatsku-btn--primary header-actions__cta">
                <?php echo esc_html( $header_cta ); ?>
            </a>
        </div>

        <!-- Mobile Hamburger -->
        <button class="header-hamburger" id="header-hamburger" aria-label="Toggle mobile menu" aria-expanded="false" aria-controls="mobile-menu">
            <span class="header-hamburger__bar"></span>
            <span class="header-hamburger__bar"></span>
            <span class="header-hamburger__bar"></span>
        </button>

    </div><!-- .header-inner -->
</header><!-- .site-header -->

<?php get_template_part( 'template-parts/header/mobile-menu' ); ?>

<?php
/**
 * Fallback nav matching chatsku.com structure with Problems mega-dropdown.
 */
function chatsku_fallback_menu() {
    $current = trailingslashit( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );
    $problems = [
        [ 'label' => 'The Response Gap',               'url' => '/problems/response-gap/' ],
        [ 'label' => 'The Passive Catalog Problem',     'url' => '/problems/passive-catalog/' ],
        [ 'label' => 'The Human Bottleneck',            'url' => '/problems/human-bottleneck/' ],
        [ 'label' => 'The Black Hole Pipeline',         'url' => '/problems/black-hole-pipeline/' ],
        [ 'label' => 'The Complex Configuration Problem','url' => '/problems/complex-configuration/' ],
        [ 'label' => 'The Headcount Ceiling',           'url' => '/problems/headcount-ceiling/' ],
    ];
    $simple_links = [
        'Demo'     => '/demo/',
        'Features' => '/features/',
        'Pricing'  => '/pricing/',
        'FAQ'      => '/faq/',
        'Blog'     => '/blog/',
    ];
    echo '<ul class="header-nav__menu">';
    // Simple links before Problems
    foreach ( [ 'Demo' => '/demo/', 'Features' => '/features/' ] as $label => $path ) {
        $active = ( $current === $path ) ? ' is-active' : '';
        echo '<li class="header-nav__item' . $active . '"><a href="' . esc_url( home_url( $path ) ) . '" class="header-nav__link">' . esc_html( $label ) . '</a></li>';
    }
    // Problems with mega-dropdown
    echo '<li class="header-nav__item header-nav__item--has-dropdown">';
    echo '<a href="' . esc_url( home_url( '/problems/' ) ) . '" class="header-nav__link">Problems';
    echo '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>';
    echo '</a>';
    echo '<div class="header-nav__dropdown-wrap">';
    echo '<div class="header-nav__dropdown">';
    // Left col: 6 problem links
    echo '<div>';
    echo '<div class="header-nav__dropdown-label">The 6 Revenue Gaps</div>';
    echo '<div class="header-nav__dropdown-items">';
    foreach ( $problems as $p ) {
        echo '<a href="' . esc_url( home_url( $p['url'] ) ) . '" class="header-nav__link--sub">';
        echo '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/></svg>';
        echo esc_html( $p['label'] ) . '</a>';
    }
    echo '</div>'; // items
    echo '<a href="' . esc_url( home_url( '/problems/' ) ) . '" class="header-nav__dropdown-cta-link" style="margin-top:16px;">See all six problems →</a>';
    echo '</div>'; // left col
    // Right col: CTA
    echo '<div class="header-nav__dropdown-cta">';
    echo '<div>';
    echo '<p style="font-size:12px;color:#758AA3;line-height:1.5;margin:0 0 16px;">B2B buying is broken. See exactly how much revenue your catalog is leaving behind.</p>';
    echo '</div>';
    echo '<a href="' . esc_url( home_url( '/demo/' ) ) . '" class="chatsku-btn chatsku-btn--primary chatsku-btn--sm">Try Live Demo</a>';
    echo '</div>'; // right col
    echo '</div>'; // dropdown grid
    echo '</div>'; // dropdown-wrap
    echo '</li>';
    // Remaining simple links
    foreach ( [ 'Pricing' => '/pricing/', 'FAQ' => '/faq/', 'Blog' => '/blog/' ] as $label => $path ) {
        $active = ( $current === $path ) ? ' is-active' : '';
        echo '<li class="header-nav__item' . $active . '"><a href="' . esc_url( home_url( $path ) ) . '" class="header-nav__link">' . esc_html( $label ) . '</a></li>';
    }
    echo '</ul>';
}

?>
