<?php
/**
 * ChatSKU Theme Functions
 *
 * @package ChatSKU
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

// ─── Constants ───────────────────────────────────────────────────────────────
define( 'CHATSKU_VERSION',   '1.0.0' );
define( 'CHATSKU_DIR',       get_template_directory() );
define( 'CHATSKU_URI',       get_template_directory_uri() );
define( 'CHATSKU_ASSETS',    CHATSKU_URI . '/assets' );

// ─── Load modules ────────────────────────────────────────────────────────────
require_once CHATSKU_DIR . '/inc/setup.php';
require_once CHATSKU_DIR . '/inc/enqueue.php';
require_once CHATSKU_DIR . '/inc/helpers.php';

// ACF-dependent files — only load when ACF is active
if ( function_exists( 'acf_add_options_page' ) ) {
    require_once CHATSKU_DIR . '/inc/acf-options.php';
}

// Register ACF field groups programmatically (fallback + for version control)
if ( function_exists( 'acf_add_local_field_group' ) ) {
    require_once CHATSKU_DIR . '/inc/acf-fields.php';
    require_once CHATSKU_DIR . '/inc/acf-fields-demo.php';
    require_once CHATSKU_DIR . '/inc/acf-fields-industry.php';
}

// Demo custom post type + [chatsku_demo_widget] shortcode
require_once CHATSKU_DIR . '/inc/cpt-demo.php';

// Industry custom post type (shown as cards on the /demos/ listing page)
require_once CHATSKU_DIR . '/inc/cpt-industry.php';

// Bespoke Calgary Chocolate Factory live-demo section — [chatsku_calgary_demo]
require_once CHATSKU_DIR . '/inc/shortcode-calgary-demo.php';

// ─── ACF Local JSON ───────────────────────────────────────────────────────────
// Save ACF field group JSON to theme folder (version control friendly)
add_filter( 'acf/settings/save_json', function() {
    return CHATSKU_DIR . '/acf-json';
} );

// Load ACF field group JSON from theme folder
add_filter( 'acf/settings/load_json', function( $paths ) {
    $paths[] = CHATSKU_DIR . '/acf-json';
    return $paths;
} );

// ─── Partner Applications CPT ────────────────────────────────────────────────
// Stores every partner form submission in WP Admin as a fallback when email fails.
add_action( 'init', function () {
    register_post_type( 'partner_application', [
        'label'               => 'Partner Applications',
        'labels'              => [
            'name'          => 'Partner Applications',
            'singular_name' => 'Application',
            'all_items'     => 'All Applications',
            'view_item'     => 'View Application',
        ],
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_icon'           => 'dashicons-groups',
        'menu_position'       => 25,
        'supports'            => [ 'title', 'custom-fields' ],
        'capability_type'     => 'post',
        'map_meta_cap'        => true,
    ] );
} );

// ─── SMTP Configuration ──────────────────────────────────────────────────────
// Configure wp_mail() to send via SMTP instead of PHP mail().
// Fill in your SMTP credentials below (or use WP Mail SMTP plugin instead).
add_action( 'phpmailer_init', function ( $phpmailer ) {
    $host     = defined( 'CHATSKU_SMTP_HOST' )     ? CHATSKU_SMTP_HOST     : '';
    $port     = defined( 'CHATSKU_SMTP_PORT' )     ? CHATSKU_SMTP_PORT     : 587;
    $user     = defined( 'CHATSKU_SMTP_USER' )     ? CHATSKU_SMTP_USER     : '';
    $pass     = defined( 'CHATSKU_SMTP_PASS' )     ? CHATSKU_SMTP_PASS     : '';
    $from     = defined( 'CHATSKU_SMTP_FROM' )     ? CHATSKU_SMTP_FROM     : '';
    $fromname = defined( 'CHATSKU_SMTP_FROMNAME' ) ? CHATSKU_SMTP_FROMNAME : 'ChatSKU';

    if ( ! $host || ! $user ) return; // Skip if not configured

    $phpmailer->isSMTP();
    $phpmailer->Host       = $host;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = $port;
    $phpmailer->Username   = $user;
    $phpmailer->Password   = $pass;
    $phpmailer->SMTPSecure = $port === 465 ? 'ssl' : 'tls';
    if ( $from )     $phpmailer->setFrom( $from, $fromname );
    if ( $fromname ) $phpmailer->FromName = $fromname;
} );

/**
 * Override the Calendly redirect URL to pass only the WPForms Entry ID (as a1).
 * Runs at priority 21 — just after the Calendly WPForms Redirect plugin stores
 * its transient (priority 20). We overwrite the transient with a minimal URL so
 * Calendly receives only a clean reference ID, while all calculator data remains
 * stored in the WPForms DB entry for the sales team to look up.
 */
add_action( 'wpforms_process_complete', 'chatsku_cwr_entry_id_only', 21, 4 );
function chatsku_cwr_entry_id_only( $fields, $entry, $form_data, $entry_id ) {
    // Only act on the Calculator Lead Capture form (ID 253)
    if ( (int) ( $form_data['id'] ?? 0 ) !== 253 ) return;

    // Read the one-time token the CWR plugin stored in the cookie (set at priority 20)
    $token = $_COOKIE['cwr_token'] ?? '';
    if ( ! $token ) return;

    // Get the base Calendly URL from the plugin's settings
    $opts     = get_option( 'cwr_settings', [] );
    $base_url = rtrim( $opts['calendly_url'] ?? '', '/' ) . '/';
    if ( ! $base_url || $base_url === '/' ) return;

    // Build a minimal URL: only the WPForms Entry ID as ?a1=XX
    $new_url = add_query_arg( 'a1', rawurlencode( (string) $entry_id ), $base_url );

    // Overwrite the transient — the browser JS reads this same key to get the redirect URL
    set_transient( 'cwr_redirect_' . sanitize_text_field( $token ), $new_url, 5 * MINUTE_IN_SECONDS );
}

/**
 * Cache-proof Calendly token exchange (fixes redirect for logged-out guests).
 *
 * The Calendly WPForms Redirect plugin guards its token→URL exchange with a nonce
 * printed into the page. On WP Engine the Revenue Calculator page is full-page-cached
 * for guests, so that nonce is stale and check_ajax_referer() fails — guests never get
 * redirected (logged-in admins bypass the cache, so it works for them).
 *
 * We register our own handler at priority 1. It performs the same token→URL lookup
 * WITHOUT the cached nonce and terminates via wp_send_json_*, so the plugin's
 * nonce-guarded handler at priority 10 never runs. Security still rests on the
 * unguessable, single-use UUID token (5-min TTL); the payload is only a Calendly URL
 * containing the WPForms entry ID.
 */
add_action( 'wp_ajax_cwr_exchange_token',        'chatsku_cwr_exchange_token_cacheproof', 1 );
add_action( 'wp_ajax_nopriv_cwr_exchange_token', 'chatsku_cwr_exchange_token_cacheproof', 1 );
function chatsku_cwr_exchange_token_cacheproof() {
    $token = isset( $_POST['token'] ) ? sanitize_text_field( wp_unslash( $_POST['token'] ) ) : '';
    if ( ! $token ) {
        wp_send_json_error( 'No token' );
    }
    $key = 'cwr_redirect_' . $token;
    $url = get_transient( $key );
    if ( ! $url ) {
        wp_send_json_error( 'Token expired or not found' );
    }
    delete_transient( $key ); // one-time use
    wp_send_json_success( [ 'url' => esc_url_raw( $url ) ] );
}

/**
 * Cache-safe, cookie-free Calendly redirect for the Calculator Lead Capture form (253).
 *
 * Requires the form's confirmation to be "Go to URL (Redirect)" with a non-empty URL.
 * WPForms returns this URL in its dynamic AJAX response (res.data.redirect_url) and its
 * own JS performs the redirect — so it works for logged-out guests on WP Engine's
 * full-page cache, with no cookie / nonce / transient involved.
 *
 * Makes the URL authoritative: base Calendly URL + the WPForms entry ID as ?a1=.
 */
add_filter( 'wpforms_process_redirect_url', 'chatsku_calendly_redirect_url', 10, 5 );
function chatsku_calendly_redirect_url( $url, $form_id, $fields, $form_data, $entry_id ) {
    if ( (int) $form_id !== 253 ) {
        return $url;
    }
    $opts     = get_option( 'cwr_settings', [] );
    $base_url = ! empty( $opts['calendly_url'] ) ? $opts['calendly_url'] : 'https://calendly.com/roshin/';
    $base_url = rtrim( $base_url, '/' ) . '/';
    return add_query_arg( 'a1', rawurlencode( (string) $entry_id ), $base_url );
}
