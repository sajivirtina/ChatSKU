<?php
/**
 * Asset Enqueue
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', 'chatsku_enqueue_assets' );
function chatsku_enqueue_assets() {

    // ── Styles ──────────────────────────────────────────────────────────────
    // Google Fonts: Inter + Space Grotesk
    wp_enqueue_style(
        'chatsku-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'chatsku-main',
        CHATSKU_ASSETS . '/css/main.css',
        [ 'chatsku-fonts' ],
        CHATSKU_VERSION
    );

    // ── Scripts ─────────────────────────────────────────────────────────────
    // Navigation (sticky header + mobile menu)
    wp_enqueue_script(
        'chatsku-nav',
        CHATSKU_ASSETS . '/js/nav.js',
        [],
        CHATSKU_VERSION,
        true
    );

    // Animations (IntersectionObserver scroll reveals)
    wp_enqueue_script(
        'chatsku-animations',
        CHATSKU_ASSETS . '/js/animations.js',
        [],
        CHATSKU_VERSION,
        true
    );

    // Main initializer
    wp_enqueue_script(
        'chatsku-main',
        CHATSKU_ASSETS . '/js/main.js',
        [ 'chatsku-nav', 'chatsku-animations' ],
        CHATSKU_VERSION,
        true
    );

    // FAQ accordion — only on FAQ page
    if ( is_page( 'faq' ) ) {
        wp_enqueue_script(
            'chatsku-accordion',
            CHATSKU_ASSETS . '/js/accordion.js',
            [],
            CHATSKU_VERSION,
            true
        );
    }

    // Demo interactive JS — only on demo pages
    if ( is_page( [ 'demo', 'demo-widget' ] ) ) {
        wp_enqueue_script(
            'chatsku-demo',
            CHATSKU_ASSETS . '/js/demo.js',
            [],
            CHATSKU_VERSION,
            true
        );
    }

    // Pass data to JS
    wp_localize_script( 'chatsku-main', 'chatskuData', [
        'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'chatsku_nonce' ),
        'siteUrl'  => get_site_url(),
        'themeUrl' => CHATSKU_URI,
    ] );

    // Comments script — only on singular posts with comments open
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

// ─── Admin styles ─────────────────────────────────────────────────────────────
add_action( 'admin_enqueue_scripts', 'chatsku_admin_styles' );
function chatsku_admin_styles() {
    wp_enqueue_style(
        'chatsku-admin',
        CHATSKU_ASSETS . '/css/admin.css',
        [],
        CHATSKU_VERSION
    );
}
