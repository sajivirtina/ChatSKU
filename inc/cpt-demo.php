<?php
/**
 * Demo system — Custom Post Type + widget shortcode.
 *
 * Registers the `demo` post type (one editable record per client demo) and the
 * [chatsku_demo_widget] shortcode used to place the live widget block inside an
 * Elementor layout when a demo's "Widget placement" is set to Manual.
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

// ── Register the `demo` post type ────────────────────────────────────────────
add_action( 'init', function () {
	register_post_type( 'demo', [
		'labels'        => [
			'name'          => 'Demos',
			'singular_name' => 'Demo',
			'add_new'       => 'Add New Demo',
			'add_new_item'  => 'Add New Demo',
			'edit_item'     => 'Edit Demo',
			'all_items'     => 'All Demos',
			'view_item'     => 'View Demo',
			'search_items'  => 'Search Demos',
			'menu_name'     => 'Demos',
		],
		'public'        => true,
		'has_archive'   => true,  // public listing at /demos/ (archive-demo.php)
		'show_in_rest'  => true,  // Gutenberg / Elementor compatibility
		'menu_icon'     => 'dashicons-desktop',
		'menu_position' => 26,
		'supports'      => [ 'title', 'editor', 'thumbnail', 'custom-fields' ],
		'rewrite'       => [ 'slug' => 'demos', 'with_front' => false ],
	] );
} );

// Flush rewrite rules once after enabling the archive so /demos/ resolves
// without a manual Settings → Permalinks save. Bump the version to re-flush.
add_action( 'init', function () {
	if ( get_option( 'chatsku_demo_rewrite_v' ) !== '2' ) {
		flush_rewrite_rules( false );
		update_option( 'chatsku_demo_rewrite_v', '2' );
	}
}, 11 );

// ── [chatsku_demo_widget] — render the ACF-driven demo widget block ──────────
// Use inside an Elementor layout when "Widget placement" = Manual. Optional id="".
add_shortcode( 'chatsku_demo_widget', function ( $atts ) {
	$atts    = shortcode_atts( [ 'id' => 0 ], $atts, 'chatsku_demo_widget' );
	$demo_id = absint( $atts['id'] ) ?: get_the_ID();

	if ( ! $demo_id || get_post_type( $demo_id ) !== 'demo' ) {
		return '';
	}

	global $post;
	$saved_post = $post;
	$post       = get_post( $demo_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride
	setup_postdata( $post );

	ob_start();
	get_template_part( 'template-parts/demo/demo-widget' );
	$html = ob_get_clean();

	wp_reset_postdata();
	$post = $saved_post; // phpcs:ignore WordPress.WP.GlobalVariablesOverride

	return $html;
} );
