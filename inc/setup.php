<?php
/**
 * Theme Setup
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', 'chatsku_setup' );
function chatsku_setup() {

    // Make theme available for translation
    load_theme_textdomain( 'chatsku', CHATSKU_DIR . '/languages' );

    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Enable Post Thumbnails on posts and pages
    add_theme_support( 'post-thumbnails' );

    // HTML5 markup
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    // Custom logo support
    add_theme_support( 'custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-width'  => true,
        'flex-height' => true,
    ] );

    // Custom background
    add_theme_support( 'custom-background', [
        'default-color' => '0f172a',
    ] );

    // Wide & full alignment support (for Gutenberg blocks if used)
    add_theme_support( 'align-wide' );

    // Responsive embeds
    add_theme_support( 'responsive-embeds' );

    // Register navigation menus
    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'chatsku' ),
        'footer'  => __( 'Footer Navigation', 'chatsku' ),
    ] );

    // Set content width
    if ( ! isset( $content_width ) ) {
        $GLOBALS['content_width'] = 1200;
    }
}

// ─── Remove unwanted WordPress defaults ──────────────────────────────────────
add_action( 'init', 'chatsku_cleanup_head' );
function chatsku_cleanup_head() {
    // Remove WP generator meta tag
    remove_action( 'wp_head', 'wp_generator' );
    // Remove RSD link
    remove_action( 'wp_head', 'rsd_link' );
    // Remove Windows Live Writer link
    remove_action( 'wp_head', 'wlwmanifest_link' );
    // Remove shortlink
    remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}

// ─── Custom image sizes ───────────────────────────────────────────────────────
add_action( 'after_setup_theme', 'chatsku_image_sizes' );
function chatsku_image_sizes() {
    add_image_size( 'chatsku-hero',      1600, 900,  true );
    add_image_size( 'chatsku-card',       800, 600,  true );
    add_image_size( 'chatsku-thumbnail',  400, 300,  true );
    add_image_size( 'chatsku-avatar',     100, 100,  true );
}

// ─── Nav Walker — loaded via after_setup_theme to ensure Walker_Nav_Menu exists ──
add_action( 'after_setup_theme', 'chatsku_register_nav_walker', 5 );
function chatsku_register_nav_walker() {
    if ( class_exists( 'Walker_Nav_Menu' ) && ! class_exists( 'ChatSKU_Nav_Walker' ) ) {
        class ChatSKU_Nav_Walker extends Walker_Nav_Menu {
            public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
                $item         = $data_object;
                $classes      = empty( $item->classes ) ? [] : (array) $item->classes;
                $has_children = in_array( 'menu-item-has-children', $classes );

                $classes[] = 'header-nav__item';
                if ( $has_children && $depth === 0 ) $classes[] = 'header-nav__item--has-dropdown';
                if ( in_array( 'current-menu-item', $classes ) ) $classes[] = 'is-active';

                $class_names = implode( ' ', array_filter( $classes ) );
                $output .= '<li class="' . esc_attr( $class_names ) . '">';

                $url   = ! empty( $item->url ) ? $item->url : '#';
                $title = apply_filters( 'the_title', $item->title, $item->ID );

                $link_class = 'header-nav__link';
                if ( $depth > 0 ) $link_class .= ' header-nav__link--sub';

                $output .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $link_class ) . '"';
                if ( ! empty( $item->target ) ) $output .= ' target="' . esc_attr( $item->target ) . '"';
                if ( ! empty( $item->xfn ) )    $output .= ' rel="' . esc_attr( $item->xfn ) . '"';
                $output .= '>' . esc_html( $title );
                if ( $has_children && $depth === 0 ) {
                    $output .= '<svg class="header-nav__chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>';
                }
                $output .= '</a>';
            }

            public function start_lvl( &$output, $depth = 0, $args = null ) {
                $output .= '<div class="header-nav__dropdown-wrap"><ul class="header-nav__dropdown">';
            }

            public function end_lvl( &$output, $depth = 0, $args = null ) {
                $output .= '</ul></div>';
            }

            public function end_el( &$output, $data_object, $depth = 0, $args = null ) {
                $output .= '</li>';
            }
        }
    }
}

// ─── Excerpt length ───────────────────────────────────────────────────────────
add_filter( 'excerpt_length', function() { return 20; } );
add_filter( 'excerpt_more',   function() { return '...'; } );

// ─── Body classes ─────────────────────────────────────────────────────────────
add_filter( 'body_class', function( $classes ) {
    $classes[] = 'chatsku-theme';
    $classes[] = 'dark-theme';
    return $classes;
} );
