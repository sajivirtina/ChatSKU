<?php
/**
 * Template Name: Landing Page (Elementor)
 * Template Post Type: page
 *
 * Full-width content area for Elementor-built promotional landing pages.
 * Uses the default ChatSKU header and footer.
 * Supports URL-param and IP-geolocation state detection for dynamic content.
 *
 * @package ChatSKU
 */

// ── State Detection ───────────────────────────────────────────────────────────
// Priority 1: explicit URL param (?Dallas, ?NewYork, ?LosAngeles, ...)
$chatsku_state_display = 'Dallas'; // default

if ( ! empty( $_GET ) ) {
    $raw = array_key_first( $_GET );
    // Convert CamelCase → spaced words: "NewYork" → "New York"
    $spaced = trim( preg_replace( '/(?<=[a-z])(?=[A-Z])/', ' ', $raw ) );
    if ( $spaced ) {
        $chatsku_state_display = sanitize_text_field( $spaced );
    }
} else {
    // Priority 2: IP geolocation via ip-api.com (free, no key needed)
    $ip = '';
    if ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
        // On WP Engine / CDN, the real IP is in X-Forwarded-For (may be comma-separated list)
        $ip = trim( explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] )[0] );
    } elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $ip = filter_var( $ip, FILTER_VALIDATE_IP ) ? $ip : '';

    if ( $ip && $ip !== '127.0.0.1' && $ip !== '::1' ) {
        $cache_key = 'chatsku_geo_' . md5( $ip );
        $cached    = get_transient( $cache_key );

        if ( false !== $cached ) {
            // Use cached result (empty string means non-US or API failed → use default)
            $chatsku_state_display = $cached ?: 'Dallas';
        } else {
            $api_url  = 'http://ip-api.com/json/' . rawurlencode( $ip ) . '?fields=regionName,countryCode';
            $response = wp_remote_get( $api_url, [ 'timeout' => 3 ] );
            $state    = ''; // empty = non-US or failed

            if ( ! is_wp_error( $response ) ) {
                $body = json_decode( wp_remote_retrieve_body( $response ), true );
                if ( ! empty( $body['regionName'] ) && isset( $body['countryCode'] ) && $body['countryCode'] === 'US' ) {
                    $state = sanitize_text_field( $body['regionName'] );
                }
            }

            // Cache for 24 hours to avoid repeat API calls
            set_transient( $cache_key, $state, DAY_IN_SECONDS );
            $chatsku_state_display = $state ?: 'Dallas';
        }
    }
}

// ── Patch <title> tag in <head> for detected state ───────────────────────────
if ( $chatsku_state_display !== 'Dallas' ) {
    add_filter( 'document_title_parts', function ( $parts ) use ( $chatsku_state_display ) {
        if ( ! empty( $parts['title'] ) ) {
            $parts['title'] = str_replace( 'Dallas', $chatsku_state_display, $parts['title'] );
        }
        return $parts;
    } );
}

get_header();
?>

<main id="main" class="chatsku-main chatsku-landing-content" role="main">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();
            the_content();
        endwhile;
    endif;
    ?>
</main>

<style>
/* Remove default page padding so Elementor sections go full-width */
.chatsku-landing-content {
    padding: 0;
    margin: 0;
    width: 100%;
}

/* Expose ChatSKU brand tokens to Elementor colour picker */
:root {
    --e-global-color-chatsku-accent:    #00C9B1;
    --e-global-color-chatsku-bg:        #0f172a;
    --e-global-color-chatsku-secondary: #1e293b;
    --e-global-color-chatsku-text:      #f8fafc;
    --e-global-color-chatsku-muted:     #94a3b8;
}
</style>

<?php if ( $chatsku_state_display !== 'Dallas' ) : ?>
<script>
(function () {
    var from = 'Dallas';
    var to   = <?php echo wp_json_encode( $chatsku_state_display ); ?>;
    if ( from === to ) return;

    function walkText( node ) {
        if ( node.nodeType === 3 ) {
            // Text node — replace all occurrences
            if ( node.nodeValue.indexOf( from ) !== -1 ) {
                node.nodeValue = node.nodeValue.split( from ).join( to );
            }
            return;
        }
        if ( node.nodeType !== 1 ) return;
        var tag = node.tagName.toLowerCase();
        // Skip non-content tags
        if ( tag === 'script' || tag === 'style' || tag === 'noscript' || tag === 'iframe' ) return;
        // Walk children
        Array.from( node.childNodes ).forEach( walkText );
        // Patch relevant attributes on element nodes
        [ 'title', 'aria-label', 'placeholder', 'alt', 'data-tooltip' ].forEach( function ( attr ) {
            if ( node.hasAttribute( attr ) ) {
                var val = node.getAttribute( attr );
                if ( val.indexOf( from ) !== -1 ) {
                    node.setAttribute( attr, val.split( from ).join( to ) );
                }
            }
        } );
    }

    function run() {
        var root = document.getElementById( 'main' ) || document.body;
        walkText( root );
        // Also update browser tab title
        if ( document.title.indexOf( from ) !== -1 ) {
            document.title = document.title.split( from ).join( to );
        }
    }

    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', run );
    } else {
        run();
    }
})();
</script>
<?php endif; ?>

<?php get_footer(); ?>
