<?php
/**
 * Helper Functions
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

/**
 * Get ACF field with optional fallback value.
 *
 * @param string $key      ACF field name.
 * @param mixed  $post_id  Post ID, 'option', or false for current post.
 * @param mixed  $fallback Fallback value if field is empty.
 * @return mixed
 */
function chatsku_field( $key, $post_id = false, $fallback = '' ) {
    if ( ! function_exists( 'get_field' ) ) {
        return $fallback;
    }
    $value = get_field( $key, $post_id );
    return ! empty( $value ) ? $value : $fallback;
}

/**
 * Get a global option field from ACF Options Page.
 *
 * @param string $key      ACF options field name.
 * @param mixed  $fallback Fallback value.
 * @return mixed
 */
function chatsku_option( $key, $fallback = '' ) {
    return chatsku_field( $key, 'option', $fallback );
}

/**
 * Render an ACF image field as an <img> tag.
 *
 * @param array|int $image   ACF image array or attachment ID.
 * @param string    $size    Image size.
 * @param string    $class   CSS class.
 * @param string    $alt     Alt text fallback.
 * @param array     $attrs   Additional attributes.
 */
function chatsku_image( $image, $size = 'full', $class = '', $alt = '', $attrs = [] ) {
    if ( empty( $image ) ) return;

    if ( is_array( $image ) ) {
        $url    = $image['url']  ?? '';
        $alt    = $image['alt']  ?: $alt;
        $width  = $image['width']  ?? '';
        $height = $image['height'] ?? '';
    } else {
        $url    = wp_get_attachment_image_url( $image, $size );
        $alt    = get_post_meta( $image, '_wp_attachment_image_alt', true ) ?: $alt;
        $meta   = wp_get_attachment_metadata( $image );
        $width  = $meta['width']  ?? '';
        $height = $meta['height'] ?? '';
    }

    if ( empty( $url ) ) return;

    $class_attr = $class ? ' class="' . esc_attr( $class ) . '"' : '';
    $width_attr  = $width  ? ' width="'  . esc_attr( $width )  . '"' : '';
    $height_attr = $height ? ' height="' . esc_attr( $height ) . '"' : '';

    $extra = '';
    foreach ( $attrs as $attr_key => $attr_val ) {
        $extra .= ' ' . esc_attr( $attr_key ) . '="' . esc_attr( $attr_val ) . '"';
    }

    echo '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '"'
        . $class_attr . $width_attr . $height_attr . $extra . ' loading="lazy">';
}

/**
 * Render a CTA button.
 *
 * @param string $text    Button label.
 * @param string $url     Button URL.
 * @param string $variant 'primary' | 'secondary' | 'ghost'.
 * @param string $class   Additional CSS classes.
 * @param array  $attrs   Additional HTML attributes.
 */
function chatsku_button( $text, $url = '#', $variant = 'primary', $class = '', $attrs = [] ) {
    if ( empty( $text ) ) return;

    $classes = 'chatsku-btn chatsku-btn--' . esc_attr( $variant );
    if ( $class ) $classes .= ' ' . esc_attr( $class );

    $extra = '';
    foreach ( $attrs as $attr_key => $attr_val ) {
        $extra .= ' ' . esc_attr( $attr_key ) . '="' . esc_attr( $attr_val ) . '"';
    }

    echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $classes ) . '"' . $extra . '>'
        . esc_html( $text ) . '</a>';
}

/**
 * Get the estimated reading time for post content.
 *
 * @param int $post_id Post ID.
 * @return int Minutes.
 */
function chatsku_reading_time( $post_id = null ) {
    $post_id  = $post_id ?: get_the_ID();
    $content  = get_post_field( 'post_content', $post_id );
    $words    = str_word_count( strip_tags( $content ) );
    $minutes  = (int) ceil( $words / 200 ); // avg 200 wpm
    return max( 1, $minutes );
}

/**
 * SVG icon helper — returns inline SVG from assets/images/icons/
 *
 * @param string $name Icon filename without extension.
 * @param string $class CSS class.
 * @return string SVG markup or empty string.
 */
function chatsku_icon( $name, $class = '' ) {
    $path = CHATSKU_DIR . '/assets/images/icons/' . sanitize_file_name( $name ) . '.svg';
    if ( ! file_exists( $path ) ) return '';
    $svg = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions
    if ( $class ) {
        $svg = str_replace( '<svg', '<svg class="' . esc_attr( $class ) . '"', $svg );
    }
    return $svg;
}

/**
 * Truncate text to a given word count.
 *
 * @param string $text  Input text.
 * @param int    $limit Word limit.
 * @param string $more  Append string.
 * @return string
 */
function chatsku_truncate( $text, $limit = 20, $more = '...' ) {
    $words = explode( ' ', strip_tags( $text ) );
    if ( count( $words ) <= $limit ) return $text;
    return implode( ' ', array_slice( $words, 0, $limit ) ) . $more;
}
