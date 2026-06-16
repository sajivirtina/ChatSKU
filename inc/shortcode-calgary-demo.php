<?php
/**
 * [chatsku_calgary_demo] — render the ACF-driven demo widget block (the ".cdw"
 * section) for the current (or a given) Demo, so it can be placed anywhere
 * inside an Elementor layout.
 *
 * This is a thin alias of [chatsku_demo_widget] (registered in inc/cpt-demo.php)
 * so there is a single source of truth for the markup
 * (template-parts/demo/demo-widget.php).
 *
 * IMPORTANT: set the Demo's "Widget placement" to Manual (Layout tab) so the
 * block is NOT also auto-rendered above the Elementor content by single-demo.php
 * — otherwise the section appears twice.
 *
 * Usage:  [chatsku_calgary_demo]            uses the current Demo
 *         [chatsku_calgary_demo id="155"]   a specific Demo by ID
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'chatsku_calgary_demo', function ( $atts ) {
	$atts = shortcode_atts( [ 'id' => 0 ], $atts, 'chatsku_calgary_demo' );
	$id   = absint( $atts['id'] );

	return do_shortcode( '[chatsku_demo_widget' . ( $id ? ' id="' . $id . '"' : '' ) . ']' );
} );
