<?php
/**
 * Industry custom post type.
 *
 * Each post represents one industry vertical shown as a card on the /demos/ page.
 * Industry landing pages live at /industry/{slug}/ (built with Elementor via
 * single-industry.php). CTA links and descriptions are managed via ACF
 * (see acf-fields-industry.php).
 *
 * @package ChatSKU
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', function () {
	register_post_type( 'industry', [
		'labels'        => [
			'name'          => 'Industries',
			'singular_name' => 'Industry',
			'add_new'       => 'Add New Industry',
			'add_new_item'  => 'Add New Industry',
			'edit_item'     => 'Edit Industry',
			'all_items'     => 'All Industries',
			'view_item'     => 'View Industry',
			'search_items'  => 'Search Industries',
			'menu_name'     => 'Industries',
		],
		'public'        => true,
		'has_archive'   => false,          // listing is handled by archive-demo.php
		'show_in_rest'  => true,           // Gutenberg / Elementor compatibility
		'show_in_menu'  => 'edit.php?post_type=demo', // nest under the Demos admin menu
		'supports'      => [ 'title', 'editor', 'thumbnail', 'page-attributes', 'elementor' ],
		'rewrite'       => [ 'slug' => 'industry', 'with_front' => false ],
	] );
} );

// Flush rewrite rules once so /industry/{slug}/ resolves without a manual
// Settings → Permalinks save. Bump the version string to re-flush after slug changes.
add_action( 'init', function () {
	if ( get_option( 'chatsku_industry_rewrite_v' ) !== '1' ) {
		flush_rewrite_rules( false );
		update_option( 'chatsku_industry_rewrite_v', '1' );
	}
}, 12 );
